<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class google_oauth extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = [
        'email',
        'google_id'
    ];
}
