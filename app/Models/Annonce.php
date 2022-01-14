<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonces';

    protected $fillable = [
    'id_transaction',
    'id_type_de_bien',
    'id_etat',
    'id_ville',
    'adresse',
    'etages',
    'chambres',
    'salons',
    'sejours',
    'sale_de_bains',
    'toilettes',
    'age_de_bien',
    'surface',
    'prix',
    'lien_video',
    'titre',
    'description'
    ];

    public function c_generales()
    {
        return $this->belongsToMany(C_generale::class, 'annonce_c_generales', 'id_annonce', 'id_c_generale');
    }

    public function c_interieurs()
    {
        return $this->belongsToMany(C_interieur::class, 'annonce_c_interieurs', 'id_annonce', 'id_c_interieur');
    }

    public function c_supplementaires()
    {
        return $this->belongsToMany(C_supplementaire::class, 'annonce_c_supplementaires', 'id_annonce', 'id_c_supplementaire');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_annonce');
    }

    public function transaction()
    {
        return $this->belongsTo(transaction::class, 'id_transaction', 'id');
    }

    public function type_de_bien()
    {
        return $this->belongsTo(TypeDeBien::class, 'id_type_de_bien', 'id');
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class, 'id_etat', 'id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville', 'id');
    }
}
