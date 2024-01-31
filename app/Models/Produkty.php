<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkty extends Model
{
    use HasFactory;

    protected $table = 'produkty';
    protected $primaryKey = 'produkty_id';


    protected $fillable = [
        'kategoria_id',
        'nazov',
        'cena',
        'star_rating',
        'cesta_obrazok',
    ];
    
    public function kategoria()
    {
        return $this->belongsTo(KategorieProduktov::class, 'kategoria_id');
    }
}
