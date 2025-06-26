<?php

namespace App\Models;
 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'iduser'; // Définir la clé primaire personnalisée
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
        'sexe' // Attention : évitez les espaces dans les noms de colonnes
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
         'password' => 'hashed',
    ];

  public function roles(){
    return $this->belongsToMany(role::class, "user_role", "iduser", "role_id");
  }
  public function permissions(){
    return $this->belongsToMany(permissions::class, "user_permission", "iduser", "permission_id");
  }
  public function hasrole($role){
    return $this->role()->where("role", $role)->first !== null;
  }

}
