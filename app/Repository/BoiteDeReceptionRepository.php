<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Models\BoiteDeReception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BoiteDeReceptionRepository implements RepositoryInterface
{
    protected $boite_de_reception;
    public function __construct(BoiteDeReception $boite_de_reception)
    {
        $this->boite_de_reception  = $boite_de_reception;
    }

    public function getAll()
    {
        return $this->boite_de_reception->paginate(Helper::pagination);
    }

    public function getByFilter($data)
    {
        $query = $this->boite_de_reception;

        if(isset($data['id_type_de_message']) and $data['id_type_de_message'] > 0){
            $query = $query->where('id_type_de_message', $data['id_type_de_message']);
        }
        if(isset($data['search']) and $data['search'] != ""){
            $query = $query->search($data['search']);
        }

        return $query->paginate(Helper::pagination);
    }

    public function getByID($id)
    {
        return $this->boite_de_reception->where('id', $id)->first();
    }

    public function create($data)
    {
        $boite_de_reception                     = new $this->boite_de_reception;
        $boite_de_reception->id_type_de_bien    = $data['id_type_de_bien'];
        $boite_de_reception->planing            = $data['planing'] ?? null;
        $boite_de_reception->civilite           = $data['civilite'];
        $boite_de_reception->nom_de_societe     = $data['nom_de_societe'] ?? null;
        $boite_de_reception->nom_complet        = $data['nom_complet'];
        $boite_de_reception->email              = $data['email'] ?? null;
        $boite_de_reception->telephone          = $data['telephone'];
        $boite_de_reception->message            = $data['message'] ?? null;
        $boite_de_reception->ville              = $data['ville'] ?? null;
        $boite_de_reception->adresse            = $data['adresse'] ?? null;
        $boite_de_reception->code_postal        = $data['code_postal'] ?? null;
        $boite_de_reception->id_type_de_message = $data['id_type_de_message'];
        $boite_de_reception->save();

        return $boite_de_reception;
    }

    public function update($id, $data)
    {
        $boite_de_reception   =  $this->boite_de_reception->where('id', $id)->first();
        $boite_de_reception->is_read = 1;
        $boite_de_reception->update();

        return $boite_de_reception;
    }

    public function delete($ids)
    {
        // $boite_de_reception   =  $this->boite_de_reception->where('id', $id)->first();
        // $boite_de_reception->delete();
        $this->boite_de_reception->whereIn('id', $ids['boite_de_receptions_ids'])->delete();
        return 'The operation was successful';
    }
}
