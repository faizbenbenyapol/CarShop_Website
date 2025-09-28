<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'country', 'logo', 'description'];
    public $timestamps = true;

    // Relationship with cars
    public function cars()
    {
        return $this->hasMany(TestModel::class, 'brand_id');
    }

    // Accessor for backwards compatibility
    public function getBrandNameAttribute()
    {
        return $this->name;
    }
}