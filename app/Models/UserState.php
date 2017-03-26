<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserState extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'catalogue_user_states';
}
