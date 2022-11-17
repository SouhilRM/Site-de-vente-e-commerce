<?php

namespace App\Models;
use App\Models\Multi_image;
use App\Models\Brand;
use App\Models\Categorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Multi_image::class);
    }

    public function category(){
    	return $this->belongsTo(Categorie::class,'categorie_id','id');
    }
    
    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
