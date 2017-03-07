<?php

namespace Nht\Hocs\Recesses;

use Illuminate\Database\Eloquent\Model;

class Recess extends Model
{
    /**
     * Status
     */
    const PENDING = 0;
    const CONFIRMED = 1;
    const DENIED = 2;
    const CANCEL = 3;

    protected $statusText = [
        0 => '<span class="label label-info">Chờ duyệt</span>',
        1 => '<span class="label label-success">Đã xác nhận</span>',
        2 => '<span class="label label-danger">Bị từ chối</span>',
        3 => '<span class="label label-default">Đã hủy</span>',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    public $fillable = [
        'employee_id', 'recessed_at', 'reason', 'status', 'manager_id'
    ];

    public function user()
    {
        return $this->belongsTo(\Nht\Hocs\Users\User::class);
    }

    public function manager()
    {
        return $this->belongsTo(\Nht\Hocs\Users\User::class, 'manager_id');
    }

    public function getStatusText()
    {
        return $this->statusText[$this->status];
    }
}
