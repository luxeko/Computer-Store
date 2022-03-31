<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Discount extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $guarded = [];

    public function product_discount(){
        return $this->hasMany(Product_discount::class, 'discount_id');
    }
}
