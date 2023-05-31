<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = [
        'email',
        'phone_number', 
        'phone_number_verified',
        'address',
        'created_at',
        'updated_at',
    ];
}
