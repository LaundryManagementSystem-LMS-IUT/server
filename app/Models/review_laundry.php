<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_laundry extends Model
{
    use HasFactory;
    protected $primaryKey = ['manageremail','customeremail'];
    public $incrementing = false;
    protected $fillable = [
        'manager_email',
        'customer_email',
        'review',
        'review_stars'
    ];

}
