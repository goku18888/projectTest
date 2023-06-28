<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    use HasFactory;

    protected $table='bills';
    public $timestamps=true;

    protected $fillable=[
        'product_id',
        'order_id',
        'total_product',
        'product_type',
        'name_product',
        'money_ship',
        'order_date',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(products::class,'id','product_id');
    }
}
