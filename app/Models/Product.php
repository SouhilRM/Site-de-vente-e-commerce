<?php

namespace App\Models;
use App\Models\Multi_image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Multi_image::class);
    }
}
