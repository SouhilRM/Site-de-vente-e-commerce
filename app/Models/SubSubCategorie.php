<?php

namespace App\Models;
use App\Models\Categorie;
use App\Models\SubCategorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function sub_categorie(){
        return $this->belongsTo(SubCategorie::class);
    }
}
