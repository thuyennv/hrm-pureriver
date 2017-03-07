<?php

namespace Nht\Hocs\Entrusts;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $guarded = ['_token', 'perms'];

    public function countUsers()
    {
       return $this->users()->count();
    }

    public function users()
    {
        return $this->belongsToMany(\Nht\Hocs\Users\User::class, \Config::get('entrust.role_user_table'),\Config::get('entrust.role_foreign_key'),\Config::get('entrust.user_foreign_key'));
    }
}
