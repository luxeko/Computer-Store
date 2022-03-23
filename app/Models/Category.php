<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory;
    use Notifiable,
    SoftDeletes;
    protected $table = 'categories';
    protected $guarded = [];
    protected $fillable = [];

    public function getParentName(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
