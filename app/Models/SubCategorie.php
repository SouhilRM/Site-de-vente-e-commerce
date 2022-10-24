<?php

namespace App\Models;
use App\Models\Categorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
