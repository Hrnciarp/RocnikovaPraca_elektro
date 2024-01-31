<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategorieProduktov extends Model
{
    use HasFactory;
    protected $table = 'kategoria_produktov';
    protected $primaryKey = 'kategoria_id';
    public $timestamps = false;


    public function produkty()
    {
        return $this->hasMany(Produkty::class, 'kategoria_id');
    }

}
