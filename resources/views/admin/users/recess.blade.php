@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
       <h4>Nghỉ phép</h4>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <label for="recess_date" class="col-sm-3 control-label">Ngày nghỉ <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control date-picker" id="recess_date" name="recess_date" placeholder="Ngày xin nghỉ" value="{{ Request::old('recess_date', date('d/m/Y')) }}">
                </div>
            </div>
            <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                <label for="reason" class="col-sm-3 control-label">Lý do <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="reason" name="reason" placeholder="Lý do xin nghỉ">{{ Request::old('reason') }}</textarea>
                    {!! $errors->first('reason', '<span class="help-inline text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Gửi</button>
                <a href="{{ url('/login/dashboard') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
        <hr>
        <h4>Lịch sử nghỉ phép . <small class="text-info">Bạn đã nghỉ <b>{{$validRecess}}</b> ngày trong năm nay.</small></h4>
        <p><b style="text-decoration: underline">Lưu ý</b>: <i>Thời gian nghỉ phép của công ty được tính nghỉ vào chiều thứ 7 hàng tuần. Do đó, công ty không áp dụng chế độ nghỉ phép vẫn nhận lương.</i></p>
        <div class="adv-table">
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
                                        <a href="{{ route('recess.update', [$r->id, Nht\Hocs\Recesses\Recess::CANCEL]) }}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Hủy</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr align="center">
                                <td colspan="5">Bạn hiện không có bản ghi nghỉ phép nào!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $recesses, 'appended' => []])
            </div>
        </div>
    </div>
@stop
