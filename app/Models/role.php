<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];
    protected $table = 'role'; // Spécifier explicitement le nom de la table

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'iduser');
    }
}
