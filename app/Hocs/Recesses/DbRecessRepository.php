<?php

namespace Nht\Hocs\Recesses;

use Nht\Hocs\Core\BaseRepository;

class DbRecessRepository extends BaseRepository implements RecessRepository
{
    /**
     * Recess
     */
    protected $model;

    /**
     * Constructor
     * @param Recess $recess
     */
    public function __construct(Recess $recess)
    {
        $this->model = $recess;
    }

    public function getRecessByUser($status = null, $user_id = null)
    {
        $user_id = $user_id ? $user_id : \Auth::user()->id;
        return $this->model->where(function($q) use ($status, $user_id) {
            if (!is_null($status)) {
                $q->where('status', $status);
            }
            $q->where('employee_id', $user_id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(25);
    }

    public function getRecessInYear($count = false, $user_id = null)
    {
        $user_id = $user_id ? $user_id : \Auth::user()->id;
        $query = $this->model->where('employee_id', $user_id)
            ->where('status', Recess::CONFIRMED)
            ->whereBetween('recessed_at', [\Carbon\Carbon::now()->startOfYear(), \Carbon\Carbon::now()->endOfYear()])
            ->groupBy('employee_id');
        return $count ? $query->count() : $query->get();
    }
}
