<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitors extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='visitors';

    protected $fillable=[
        'id',
        'ip_address',
        'date_visitor',
    ];
}
