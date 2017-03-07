<?php

namespace Nht\Hocs\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**,
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'nickname', 'phone', 'address', 'avatar', 'gender', 'active',
        'type', 'trial_time', 'offical_time', 'contract_start_time', 'contract_end_time'
    ];

    protected $guarded = ['roles'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Status of an user
     */
    const ACTIVE = 1;
    const INACTIVE = 0;

    /**
     * Get name user
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    public function getType()
    {
        $arrType = $this->getTypes();
        return isset($arrType[$this->type]) ? $arrType[$this->type] : 'Chưa xác định';
    }

    public function getTypes()
    {
        return [
            0 => 'Thử việc',
            1 => 'Chính thức',
            2 => 'Thực tập sinh',
        ];
    }

    /**
     * Get avatar's path
     * @param  string $size
     * @return string
     */
    public function getAvatarPath($size = 'sm_') {
        $avatar = public_path() . PATH_USER_AVATAR . $size . $this->avatar;

        if (is_file($avatar))
        {
            $avatar = PATH_USER_AVATAR . $size . $this->avatar;
            return $avatar;
        }

        return '/images/profiles/lock_thumb.png';
    }

    /**
     * Check user is active
     * @return bool
     */
    public function isActive() {
        return !! $this->active;
    }

    /**
     * Lấy checked của checkbox của user đã active
     * @return string
     */
    public function showCheckActive() {
        return $this->isActive()
                    ? '<i class="fa fa-2x fa-check-square"></i>'
                    : '<i class="fa fa-2x fa-square"></i>';
    }

    public function setTrialTimeAttribute($trial_time)
    {
        return $this->attributes['trial_time'] = $trial_time ? Carbon::createFromFormat('d/m/Y', $trial_time) : null;
    }

    public function setOfficalTimeAttribute($offical_time)
    {
        return $this->attributes['offical_time'] = $offical_time ? Carbon::createFromFormat('d/m/Y', $offical_time) : null;
    }

    public function setContractStartTimeAttribute($contract_start_time)
    {
        return $this->attributes['contract_start_time'] = $contract_start_time ? Carbon::createFromFormat('d/m/Y', $contract_start_time) : null;
    }

    public function setContractEndTimeAttribute($contract_end_time)
    {
        return $this->attributes['contract_end_time'] = $contract_end_time ? Carbon::createFromFormat('d/m/Y', $contract_end_time) : null;
    }

    public function getTrialTimeAttribute($trial_time)
    {
        if ($trial_time == '') return;
        return date('d/m/Y', strtotime($trial_time));
    }

    public function getOfficalTimeAttribute($offical_time)
    {
        if ($offical_time == '') return;
        return date('d/m/Y', strtotime($offical_time));
    }

    public function getContractStartTimeAttribute($contract_start_time)
    {
        if ($contract_start_time == '') return;
        return date('d/m/Y', strtotime($contract_start_time));
    }

    public function getContractEndTimeAttribute($contract_end_time)
    {
        if ($contract_end_time == '') return;
        return date('d/m/Y', strtotime($contract_end_time));
    }
}
