@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>Chấm công nhân sự</h4>
    </header>
    <div class="panel-body">
        <div class="col-md-12">
            <h1 class="text-primary">{{ $user->name }} <small>:: {{ $user->nickname }}</small></h1>
            <form class="form-inline" action="" method="GET">
                <div class="form-group">
                    <label for="type">Từ</label>
                    <input class="form-control input-sm date-picker" type="text" name="startdate" placeholder="dd/mm/yyyy" value="{{ Request::get('startdate') }}">
                </div>
                <div class="form-group">
                    <label for="type">đến</label>
                    <input class="form-control input-sm date-picker" type="text" name="enddate" placeholder="dd/mm/yyyy" value="{{ Request::get('enddate') }}">
                </div>
                <button type="submit" class="btn btn-sm btn-default">Lọc</button>
            </form>
            <hr>
            <h4>Lịch sử chấm công</h4>
            <ul class="list-inline" id="chart-guider">
              <li><i style="background-color: #85BC5E"></i> Số lần checkin trong ngày</li>
              <li><i style="background-color: #1E83EC"></i> Số giờ làm việc trong ngày</li>
            </ul>
            <div id="workday-chart" style="height: 150px;"></div>
        </div>
        <div class="row">
            <div class="col-md-3">
                 <div class="mini-stat clearfix">
                    <span class="mini-stat-icon pink"><i class="fa fa-map-marker"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalWorkdaysInTime }}</span>
                        Checkin trong khoảng T.G
                    </div>
                 </div>
            </div>
            <div class="col-md-3">
                 <div class="mini-stat clearfix">
                    <span class="mini-stat-icon orange"><i class="fa fa-clock-o"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalMenHoursInTime }}</span>
                        Giờ công trong khoảng T.G
                    </div>
                 </div>
            </div>
            <div class="col-md-3">
                <div class="mini-stat clearfix">
                    <span class="mini-stat-icon green"><i class="fa fa-map-marker"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalWorkdays }}</span>
                        Checkin trong tháng
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mini-stat clearfix">
                    <span class="mini-stat-icon tar"><i class="fa fa-clock-o"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalMenHours }}</span>
                        Giờ công trong tháng
                    </div>
                </div>
            </div>
        </div>
        <div class="adv-table">
            <h4>Lịch sử nghỉ phép</h4>
            <p class="text-info">Nhân viên đã nghỉ <b>{{$validRecess}}</b> ngày trong năm nay.</p>
            <div class="dataTables_wrapper">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ngày nghỉ</th>
                            <th>Lý do nghỉ</th>
                            <th>Trạng thái</th>
                            <th>Người duyệt</th>
                            <th class="text-center">{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recesses as $k => $r)
                            <tr>
                                <td>{{ ++$k }}</td>
                                <td>
                                    <ul class="list-unstyled p0">
                                        <li><b>Ngày nghỉ</b>: {{ date('d/m/Y', strtotime($r->recessed_at)) }}</li>
                                        <li class="mt5"><b>Gửi lúc</b>: {{ date('d/m/Y H:i:s', strtotime($r->created_at)) }}</li>
                                    </ul>
                                </td>
                                <td>{{ $r->reason }}</td>
                                <td>
                                    <ul class="list-unstyled p0">
                                        <li>{!! $r->getStatusText() !!}</li>
                                        <li class="mt5">{{ $r->status > 0 ? 'Lúc ' . date('d/m/Y H:i:s', strtotime($r->updated_at)) : ''}}</li>
                                    </ul>
                                </td>
                                <td>{{ $r->manager_id > 0 ? $r->manager->name : 'Chưa xác định' }}</td>
                                <td class="text-center">
                                    @if ($r->status == 0)
                                        <a href="{{ route('recess.update', [$r->id, Nht\Hocs\Recesses\Recess::CONFIRMED]) }}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Xác nhận</a>
                                        <a href="{{ route('recess.update', [$r->id, Nht\Hocs\Recesses\Recess::DENIED]) }}" class="btn btn-xs btn-info"><i class="fa fa-warning"></i> Từ chối</a>
                                        <a href="{{ route('recess.update', [$r->id, Nht\Hocs\Recesses\Recess::CANCEL]) }}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Hủy</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr align="center">
                                <td colspan="5">Nhân viên hiện không có bản ghi nghỉ phép nào!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $recesses, 'appended' => []])
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">
      $(function() {
        new Morris.Line({
          element: 'workday-chart',
          data: <?php echo $data ?>,
          xkey: 'Time',
          ykeys: ['Checkin', 'Menhours'],
          labels: ['Workday'],
          lineColors: ['#85BC5E', '#1E83EC'],
          numLines: 5,
          lineWidth: 1.5,
          smooth: false,
          parseTime: false,
          hideHover: 'always',
          xLabelFormat: function(xObject) {
            var d = new Date(xObject.src.Time * 1000);
            return d.getDate() + '/' + d.getMonth();
          }
        });
      });
    </script>
@stop
