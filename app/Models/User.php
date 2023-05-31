<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = [
        'username',
        'email',
        'profile_picture',
        'email_verified',
        'created_at',
        'updated_at'
    ];
}
