<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address_resolve extends Model
{
    use HasFactory;
    protected $primary_key=['latitude','longitude'];
    public $incrementing=false;
    protected $fillable=[
       'latitude',
       'longitude',
       'formatted_address'
    ];
}
