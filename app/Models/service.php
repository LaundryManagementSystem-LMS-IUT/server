<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = ['manager_email', 'cloth_type', 'operation'];
    protected $keyType = 'array';
    public $incrementing = false;
    protected $fillable = [
        'manager_email',
        'cloth_type',
        'operation',
        'price'
    ];
}
