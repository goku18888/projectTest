<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $guarded=[];
    protected $table='shipping';
    protected $primaryKey='id';

    protected $fillable = [
        'shipping_name',
        'customer_id',
        'shipping_address',
        'shipping_phone',
        'shipping_email',
        'shipping_note',
        'status',
    ];
    public function customer_id(){
        return $this->hasOne(customers::class,'id','customer_id');
    }
}
