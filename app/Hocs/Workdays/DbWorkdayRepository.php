<?php

namespace Nht\Hocs\Workdays;

use Nht\Hocs\Core\BaseRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DbWorkdayRepository extends BaseRepository implements WorkdayRepository {

    /**
     * workday
     */
    protected $model;

    /**
     * Constructor
     * @param Workday $workday
     */
    public function __construct(Workday $workday)
    {
        $this->model = $workday;
    }

    /**
     * Lấy thông tin workday theo thời gian và user. Mặc định thời gian là ngày hiện tại.
     * @param  integer $user        User ID
     * @param  string $startdate    Start date
     * @param  string $enddate      End date
     * @return Collection
     */
    public function getByTimeAndId($user = null, $startdate = null, $enddate = null)
    {
        $user = $user ? $user : \Auth::user()->id;
        $startdate = $startdate ? $startdate : Carbon::today();
        $enddate = $enddate ? $enddate : Carbon::tomorrow();

        return $this->model->where('user_id', $user)
                        ->whereBetween('checkin_at', [$startdate, $enddate])
                        ->get();
    }

    public function getWorkdayForChart($user = null, $startdate = null, $enddate = null)
    {
        $user = $user ? $user : \Auth::user()->id;
        $startdate = $startdate ?
            Carbon::createFromFormat('d/m/Y', $startdate)->startOfDay() :
            Carbon::now()->startOfMonth();
        $enddate = $enddate ?
            Carbon::createFromFormat('d/m/Y', $enddate)->endOfDay() :
            Carbon::now()->endOfMonth();

        return $this->model->select(\DB::raw("DATE_FORMAT(checkin_at, '%d-%m-%Y') as mydate, count(id) as count, SUM(menhours) as menhours"))
                ->where('user_id', $user)
                ->whereBetween('checkin_at', [$startdate, $enddate])
                ->groupBy(\DB::raw("DATE_FORMAT(checkin_at, '%d-%m-%Y')"))
                ->get();
    }

    public function countWorkdays($user = null)
    {
        $user = $user ? $user : \Auth::user()->id;
        return $this->model->select(\DB::raw("COUNT(id) as count"))
                ->where('user_id', $user)
                ->whereBetween('checkin_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->groupBy('user_id')
                ->count();
    }

    public function countMenHours($user = null)
    {
        $user = $user ? $user : \Auth::user()->id;
        return $this->model->select(\DB::raw("SUM(menhours) as menhours"))
                ->where('user_id', $user)
                ->whereBetween('checkin_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->groupBy('user_id')
                ->lists('menhours')
                ->first();
    }
}
