<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = 'cars'; // เปลี่ยนจาก tbl_test
    protected $primaryKey = 'id';
    protected $fillable = ['product_name', 'product_detail', 'price', 'picture'];
    public $incrementing = true;
    public $timestamps = false;
}

