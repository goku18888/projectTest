<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class customers extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $table='customers';

    protected $fillable=[
        'name_customer',
        'email',
        'phone',
        'address',
        'img_customer',
        'pass_word',
        'token',
        'status',
        'is_verified',
    ];

    protected $hidden=[
        'pass_word',
        'rememberToken',
    ];

    public function thread(){
        return $this->hasMany(threads::class,'id','threads_id');
    }
}
