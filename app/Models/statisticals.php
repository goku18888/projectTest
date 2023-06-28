<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statisticals extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='statisticals';
    protected $fillable=[
        'order_date',
        'sales',
        'quantity',
        'total_order',
    ];
}
