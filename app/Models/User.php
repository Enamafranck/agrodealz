<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser'; // Clé primaire personnalisée
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nom_complet',
        'email',
        'password',
        'numero_CNI',
        'telephone',
        'photo_CNI',
        'photo_personne',
        'sexe'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Obtenir la clé de route pour l'URL binding
     */
    public function getRouteKeyName()
    {
        return 'iduser';
    }

    /**
     * Relations
     */
   public function roles()
{
    return $this->belongsToMany(Role::class, 'user_role', 'iduser', 'role_id');
}


    
    public function hasRole($role)
    {
        return $this->roles()->where("role", $role)->first() !== null;
    }
   

}