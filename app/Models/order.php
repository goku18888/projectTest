<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table='order';
    public $timestamps=true;

    protected $fillable=[
        'customer_id',
        'shipping_id',
        'total',
        'status',
        'destroy',
        'code_ship',
    ];

    public function customers()
    {
        return $this->hasOne(customers::class,'id','customer_id');    
    }
}
