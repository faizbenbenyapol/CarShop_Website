<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'image'];
    public $timestamps = true;

    // Relationship with cars
    public function cars()
    {
        return $this->hasMany(TestModel::class, 'category_id');
    }

    // Accessor for backwards compatibility
    public function getCategoryNameAttribute()
    {
        return $this->name;
    }
}