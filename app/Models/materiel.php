<?php

namespace App\Models;
use Illuminate\Database\Eloquent\factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel extends Model
{
    //
   use  HasFactory;

   protected $table = "materiel";

    // Définir les relations si nécessaire
    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'idproprietaire');
    }
}                 

