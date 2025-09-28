<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = 'cars'; // เปลี่ยนจาก tbl_test
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_name', 
        'product_detail', 
        'price', 
        'picture',
        'category_id',
        'brand_id',
        'model_year',
        'fuel_type',
        'transmission',
        'mileage',
        'status'
    ];
    public $incrementing = true;
    public $timestamps = true;

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

