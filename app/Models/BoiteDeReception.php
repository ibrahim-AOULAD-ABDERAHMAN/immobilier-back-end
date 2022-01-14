<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoiteDeReception extends Model
{
    use HasFactory;

    protected $table = 'boite_de_receptions';

    protected $fillable = [
    'id_type_de_bien',
    'planing',
    'civilite',
    'nom_de_societe',
    'nom_complet',
    'email',
    'telephone',
    'message',
    'ville',
    'adresse',
    'code_postal',
    'id_type_de_message',
    ];

    public function type_de_bien()
    {
        return $this->belongsTo(TypeDeBien::class, 'id_type_de_bien', 'id');
    }

    public function type_de_message()
    {
        return $this->belongsTo(TypeDeMessage::class, 'id_type_de_message', 'id');
    }

    public function scopeSearch($query, $data)
    {
        return $query->where('nom_complet', 'LIKE', "%{$data}%")
                     ->orWhere('nom_de_societe', 'LIKE', "%{$data}%")
                     ->orWhere('email', 'LIKE', "%{$data}%")
                     ->orWhere('telephone', 'LIKE', "%{$data}%");
    }
}
