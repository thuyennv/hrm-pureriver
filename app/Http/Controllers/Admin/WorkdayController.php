<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Hocs\Users\UserRepository;
use Nht\Hocs\Workdays\WorkdayRepository;
use Nht\Hocs\Recesses\RecessRepository;
use Nht\Http\Controllers\Admin\AdminController;
use Carbon\Carbon;
use Nht\Hocs\Recesses\Recess;

class WorkdayController extends AdminController
{

    protected $workday;
    protected $user;
    protected $recess;

    public function __construct(WorkdayRepository $workday, UserRepository $user, RecessRepository $recess)
    {
        $this->workday = $workday;
        $this->user = $user;
        $this->recess = $recess;
        parent::__construct();
    }

    /**
     * Xem bảng chấm công của 1 nhân viên
     * @param  integer $id User ID
     * @return Collection
     */
    public function view(Request $request, $id)
    {
        $totalMenHoursInTime = 0;
        $totalWorkdaysInTime = 0;
        $user = $this->user->getById($id);
        $start = $request->get('startdate');
        $end = $request->get('enddate');

        $totalMenHours = $this->workday->countMenHours($user->id);
        $totalWorkdays = $this->workday->countWorkdays($user->id);

        $validRecess = $this->recess->getRecessInYear(true, $id);
        $recesses = $this->recess->getRecessByUser(null, $id);

        $workdays = $this->workday->getWorkdayForChart($user->id, $start, $end);

        $data = [[
            'Time' => time(),
            'Checkin' => 0,
            'Menhours' => 0
        ]];

        foreach ($workdays as $ind => $wd) {
            $data[$ind]['Time'] = strtotime($wd->mydate);
            $data[$ind]['Checkin'] = $wd->count;
            $data[$ind]['Menhours'] = $wd->menhours;
            $totalMenHoursInTime += $wd->menhours;
            $totalWorkdaysInTime += $wd->count;
        }

        $data = json_encode($data);
        return view('admin/users/workdays', compact('user', 'data', 'totalWorkdays', 'totalMenHours',
            'totalWorkdaysInTime', 'totalMenHoursInTime', 'validRecess', 'recesses'));
    }

    /**
     * Employee checkin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (in_array($request->ip(), \Config::get('allowable_ip_checkin')['allowable_ips']))
        {
            $workday = $this->workday->getByTimeAndId();

            $attributes['checkin_at'] = Carbon::now();
            // Checkin lần đầu quá 9h thì mất 1 công, quá 14h30 thì nghỉ 1 ngày
            if (count($workday) == 0) {
                // Thứ 7 mà checkin lần đầu sau 9h thì nghỉ cả ngày
                if (Carbon::today() == new Carbon('saturday') && Carbon::now() >= Carbon::createFromTime(9, 30, 0)) {
                    return $this->redirectBack('Bạn đã bỏ qua ngày làm việc hôm nay do thời gian checkin đã quá hạn!');
                }

                if (Carbon::now() > Carbon::today() && Carbon::now() < Carbon::createFromTime(8, 00, 0)) {
                    $attributes['checkin_at'] = Carbon::createFromTime(8, 0, 0);
                } else if (Carbon::now() >= Carbon::createFromTime(10, 0, 0) && Carbon::now() < Carbon::createFromTime(13, 30, 0)) {
                    $attributes['checkin_at'] = Carbon::createFromTime(13, 30, 0);
                } else if (Carbon::now() >= Carbon::createFromTime(14, 30, 0)) {
                    return $this->redirectBack('Bạn đã bỏ qua ngày làm việc hôm nay do thời gian checkin đã quá hạn!');
                }
            }

            if (count($workday) == 1) {
                $attributes['type'] = 1;
                $menhours = round((strtotime(Carbon::now()) - strtotime($workday[0]->checkin_at)) / 3600 - 1.5, 1);
                if ($menhours < 0 ) {
                    $menhours = 0;
                    if (Carbon::now() >= Carbon::createFromTime(10, 0, 0))
                        $attributes['checkin_at'] = Carbon::createFromTime(8, 0, 0);
                } else if ($menhours > 8) {
                    $extra = $menhours - 8;
                    $attributes['extrahours'] = $extra;
                    $menhours = 8;
                }
                $attributes['menhours'] = $menhours;
            }

            if (count($workday) == 2) {
                return $this->redirectBack('Công việc của ngày hôm nay đã kết thúc!');
            }

            $attributes['user_id'] = $this->auth->user()->id;
            $attributes['ip'] = $request->ip();

            if ($this->workday->create($attributes)) {
                return $this->redirectOk('dashboard', trans('general.messages.create_success'));
            }
            return $this->redirectFail(trans('general.messages.create_fail'));
        }
        return $this->redirectBack('Địa chỉ IP không hợp lệ!');
    }

    /**
     * Count checkin in day
     * @return json
     */
    public function count()
    {
        $workday = $this->workday->getByTimeAndId();
        return response()->json(['count' => count($workday)]);
    }

    public function recess()
    {
        $validRecess = $this->recess->getRecessInYear(true);
        $recesses = $this->recess->getRecessByUser();
        return view('admin/users/recess', compact('recesses', 'validRecess'));
    }

    public function postRecess(Request $request)
    {
        $attributes['recessed_at'] = Carbon::createFromFormat('d/m/Y', $request->get('recess_date'));
        $attributes['reason'] = $request->get('reason');
        $attributes['employee_id'] = $this->auth->user()->id;

        if ($this->recess->create($attributes))
        {
            return $this->redirectOk('recess', 'Gửi đơn xin nghỉ phép thành công!');
        }
        return $this->redirectFail('Gửi đơn nghỉ phép thất bại. Vui lòng thử lại sau!');
    }

    public function updateRecess($id, $status = null)
    {
        if (is_null($status)) {
            return false;
        }

        if (!in_array($status, [Recess::CONFIRMED, Recess::DENIED, Recess::CANCEL])) {
            return $this->redirectBack('Trạng thái đơn không hợp lệ!');
        }

        if ($status != Recess::CANCEL && !\Entrust::ability('superadmin', 'user.handle_recess')) {
            return $this->redirectBack('Bạn không có quyền thực thi!');
        }

        if ($status == Recess::CANCEL) {
            $owner = $this->recess->getById($id);
            if ($owner->employee_id != \Auth::user()->id && !\Entrust::ability('superadmin', 'user.handle_recess')) {
                return $this->redirectBack('Bạn không có quyền thực thi!');
            }
        }

        $attributes['status'] = $status;
        $attributes['manager_id'] = $this->auth->user()->id;

        if ($this->recess->update($id, $attributes))
        {
            return $this->redirectBack('Xử lý đơn xin nghỉ phép thành công!');
        }
        return $this->redirectFail('Xử lý đơn nghỉ phép thất bại. Vui lòng thử lại sau!');
    }
}
