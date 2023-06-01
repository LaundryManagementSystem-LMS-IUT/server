<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    protected $primary_key=['order_id','cloth_type','operation'];
    public $incrementing=false;

    protected $fillable=[
        'order_id',
        'cloth_type',
        'operation',
        'manager_email',
        'completed',
        'quantity'
    ];
}
