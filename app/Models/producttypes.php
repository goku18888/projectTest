<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producttypes extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table='producttypes';

    protected $fillable=[
        'name_producttype',
        'supplier_id',
    ];

    public function products(){
        return $this->hasMany(products::class,'producttype_id','id');
    }
}
