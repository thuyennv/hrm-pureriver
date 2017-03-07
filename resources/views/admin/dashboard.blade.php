@extends('admin/layouts/master')

@section('main-content')
    <div class="panel-heading">
       <h4>{{ trans('admin/general.modules.dashboard') }}</h4>
    </div>
    <!--mini statistics start-->
    <div class="panel-body">
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
        <!--<div class="row">
             <div class="col-md-3">
                  <div class="mini-stat clearfix">
                        <span class="mini-stat-icon orange"><i class="fa fa-gavel"></i></span>
                        <div class="mini-stat-info">
                             <span>320</span>
                             New Order Received
                        </div>
                  </div>
             </div>
             <div class="col-md-3">
                  <div class="mini-stat clearfix">
                        <span class="mini-stat-icon tar"><i class="fa fa-tag"></i></span>
                        <div class="mini-stat-info">
                             <span>22,450</span>
                             Copy Sold Today
                        </div>
                  </div>
             </div>
             <div class="col-md-3">
                  <div class="mini-stat clearfix">
                        <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
                        <div class="mini-stat-info">
                             <span>34,320</span>
                             Dollar Profit Today
                        </div>
                  </div>
             </div>
             <div class="col-md-3">
                  <div class="mini-stat clearfix">
                        <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                        <div class="mini-stat-info">
                             <span>32720</span>
                             Unique Visitors
                        </div>
                  </div>
             </div>
        </div>-->
        <div class="row">
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
            <div class="col-md-6">
                <a class="btn btn-md {{ in_array(Request::ip(), Config::get('allowable_ip_checkin')['allowable_ips']) ? 'btn-success' : 'btn-danger' }}" id="btn-checkin" href="{{ route('checkin') }}">
                    <i class="fa fa-map-marker"></i> {{ count($workdays) == 0 ? 'Checkin' : 'Checkout' }}</a>
                <a class="btn btn-md btn-info" id="btn-recess" href="{{ route('recess') }}">
                    <i class="fa fa-envelope-o "></i> Nghỉ phép</a>
                <ul class="list-unstyled p0 mt10">
                    @forelse ($workdays as $k => $wd)
                        <li><i class="fa fa-caret-right"></i> Bạn đã {{ $k == 0 ? 'checkin' : 'checkout' }} lúc {{ date('d/m/Y H:i:s', strtotime($wd->checkin_at)) }}</li>
                    @empty
                        <li><i class="fa fa-caret-right"></i> Bạn chưa checkin ngày hôm nay!</li>
                    @endforelse
                </ul>
                <ul class="list-unstyled p0 mt10">
                    <li style="border-top: 1px dotted #ccc" class="pt10"><b class="text-danger">Lưu ý:</b></li>
                    <li>&bullet; Checkin lần đầu sau 10h sáng thì bị mất 1 công sáng. Checkin lần đầu sau 14h30 thì coi là nghỉ cả ngày.</li>
                    <li>&bullet; Riêng thứ 7, checkin sau 9h30 thì coi là nghỉ!</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline" id="chart-guider">
                  <li><i style="background-color: #85BC5E"></i> Số lần checkin trong ngày</li>
                  <li><i style="background-color: #1E83EC"></i> Số giờ làm việc trong ngày</li>
                </ul>
                <div id="workday-chart" style="height: 150px;"></div>
            </div>
        </div>
    </div>
    <!--mini statistics end-->
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
        $('#btn-checkin').click(function(ev) {
            ev.preventDefault();
            $.ajax({
                url: '/admin/checkin/count',
                method: 'GET',
                success: function(res) {
                    if (res.count == 0)
                    {
                        window.alert('Đây là lần checkin đầu tiên trong ngày của bạn. Chúc bạn 1 ngày làm việc hiệu quả!');
                        window.location.href = ev.currentTarget.href;
                    } else if (res.count == 1) {
                        var answ = window.confirm('Đây là lần checkin cuối cùng trong ngày của bạn. Bạn có chắc chắn muốn kết thúc công việc ngay?');
                        if (answ) window.location.href = ev.currentTarget.href;
                    } else {
                        window.alert('Bạn đã xác nhận kết thúc công việc của ngày hôm nay!');
                    }
                }
            });
        });
      });
    </script>
@stop
