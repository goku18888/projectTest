<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    protected $fillable=[
        'comment',
        'customer_name',
        'product_id',
        'comment_parent_comment',
        'comment_status',
        'created_at',
    ];
    
    public function customers()
    {
        return $this->belongsTo(customers::class);
    }
    public function product()
    {
        return $this->belongsTo(products::class,'product_id');
    }
    
}
