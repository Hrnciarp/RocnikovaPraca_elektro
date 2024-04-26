<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosik extends Model
{
    use HasFactory;

    protected $table = 'kosik';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'produkt_id',
        'quantity'
    ];

    public function itemy()
    {
        return $this->belongsTo(Produkty::class, 'produkt_id');
    }
}
