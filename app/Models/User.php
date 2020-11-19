<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $default = [
        'id' => 0,
        'email' => '',
        'name' => '',
        'phone_no' => '',
        'password' => '',
        'password_confirmation' => '',
        'role_id' => 0,
        'lastlogin_at' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

//    protected $attributes = [
//        'id',
//        'email',
//        'name',
//        'phone_no',
//        'password',
//        'role_id',
//        'lastlogin_at',
//        'created_at',
//        'updated_at',
//        'deleted_at',
//    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    // Field yang bisa di insert dati model
    protected $fillable = [
        'email',
        'name',
        'password',
        'phone_no',
        'role_id',
        'lastlogin_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getDefault(){
        dd($this);
        return $this->default;
    }
}
