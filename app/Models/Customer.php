<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
        protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'line_id',
    ];
    public $timestamps = true;
}