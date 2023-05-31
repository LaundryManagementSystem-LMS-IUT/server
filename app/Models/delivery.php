<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = [
        'email',
        'phone_number', 
        'phone_number_verified',
        'mode_of_transportation',
        'created_at',
        'updated_at',
    ];
}
