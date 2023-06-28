<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Contracts\Auth\CanResetPassword;

class admins extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded=[];
    protected $table='admins';

    protected $fillable=[
        'name_admin',
        'email',
        'token',
        'is_verified',
        'phone',
        'address',
        'avatar',
        'pass_word',
    ];

    protected $hidden=[
        'rememberToken',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products() {
  
        return $this->hasMany(products::class);
     
    }
}
