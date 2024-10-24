<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;
    protected $fillable = ['nomcategorie', 'imagecategorie', 'categorieID'];
    public function category()
    {
        return $this->belongsTo(Categorie::class, "categorieID");
    }
    public function article()
    {
        return $this->hasMany(Article::class, "scategorieID");
    }
}
