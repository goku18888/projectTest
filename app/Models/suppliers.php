<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='suppliers';

    protected $fillable=[
        'name_supplier',
        'email',
        'phone',
    ];

    public function product()
    {
        return $this->hasMany(products::class, 'supplier_id', 'id');
    }
}
