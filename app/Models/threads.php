<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class threads extends Model
{
    use HasFactory;
    protected $table='threads';

    protected $fillable=[
        'email',
        'subject',
        'status',
        'something',
        'customer_id',
    ];
    public function user(){
        return $this->hasOne(customers::class,'id','customers_id');
    }
}
