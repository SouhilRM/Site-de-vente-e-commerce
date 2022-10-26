<?php

namespace App\Models;
use App\Models\SubCategorie;
use App\Models\SubSubCategorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany(SubCategorie::class);
    }

    public function subsubcategories(){
        return $this->hasMany(SubSubCategorie::class);
    }
}
