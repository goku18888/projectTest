<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];
    protected $table='products';

    protected $fillable = [
        'name_product',
        'serie',
        'old_price',
        'price_product',
        'amount',
        'depscribe',
        'img_product',
        'supplier_id',
        'producttype_id',
        'product_views',
    ];

    public function supplier()
    {
        return $this->hasOne(suppliers::class, 'id', 'supplier_id');
    }
    public function imgproducts(){
        return $this->hasMany(imgproducts::class,'id','products_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    public function admin()
    {
        return $this->belongsTo(admins::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function bill()
    {
        return $this->hasOne(bills::class);
    }
}