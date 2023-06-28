<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imgproducts extends Model
{
    use HasFactory;
    protected $table='imgproducts';
    protected $guarded=[];

    protected $fillable=[
        'imgs_product',
        'products_id',
    ];
}
