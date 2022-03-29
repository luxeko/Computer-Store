<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Specification extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded = [];
    public function specification_detail(){
        return $this->hasMany(Specification::class, 'specification_id', 'specification_id');
    }
    public function specification_name(){
        return $this->hasMany(Specification::class, 'specification_id', 'specification_id');
    }
}
