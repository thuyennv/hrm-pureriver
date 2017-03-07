<?php

namespace Nht\Hocs\Workdays;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    public $fillable = [
        'user_id', 'checkin_at', 'ip', 'authorized', 'type', 'menhours', 'extrahours'
    ];
}
