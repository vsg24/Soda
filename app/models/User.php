<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','userimage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Get Todo of User
    *
    */

    public function todo()
    {
        return $this->hasMany('Todo');
    }
}