<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    public $incrementing = false;

    protected $fillable=[
         'order_id',
         'customer_email',
         'manager_email',
         'status',
         'updated_at',
         'created_at'
    ];
}
