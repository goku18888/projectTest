<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producttypes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='producttypes';

    protected $fillable=[
        'name_producttype',
        'supplier_id',
    ];
}
