<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
    use Notifiable,
    SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];
    protected $fillable = [];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product__tags', 'product_id', 'tag_id')->withTimestamps();
    }
    public function specification(){
        return $this->hasMany(Specification::class, 'product_id');
    }
    public function getPriceUnit(){
        // $check =
        return $this->hasOne(Product_discount::class,'product_id', 'id');
    }
}
