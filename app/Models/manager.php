<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = [
        'email',
        'laundry_name',
        'phone_number', 
        'phone_number_verified',
        'address',
        'created_at',
        'updated_at',
        'opening_time',
        'closing_time',
    ];
}
