<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Publication extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'message', 'path_file', 'type_file', 'count_file', 'group_publication', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
