<?php

namespace App\Services;

class FilterAnnoncesService
{
    public function FilterAnnoncesByVisiteur($query, $data)
    {
        if(isset($data['id_transaction']) and $data['id_transaction'] > 0){
            $query = $query->where('id_transaction', $data['id_transaction']);
        }
        if(isset($data['search']) and $data['search'] != null){
            $query = $query->where('titre', 'LIKE', "%{$data['search']}%");
        }
        if(isset($data['id_ville']) and $data['id_ville'] > 0){
            $query = $query->where('id_ville', $data['id_ville']);
        }
        if(isset($data['id_type_de_bien']) and $data['id_type_de_bien'] > 0){
            $query = $query->where('id_type_de_bien', $data['id_type_de_bien']);
        }
        if(isset($data['min_prix']) and $data['min_prix'] >= 0){
            $query = $query->where('prix', '>=', $data['min_prix']);
        }
        if(isset($data['max_prix']) and $data['max_prix'] >= 0){
            $query = $query->where('prix', '<=', $data['max_prix']);
        }
        if(isset($data['min_surface']) and $data['min_surface'] >= 0){
            $query = $query->where('surface', '>=', $data['min_surface']);
        }
        if(isset($data['max_surface']) and $data['max_surface'] >= 0){
            $query = $query->where('surface', '<=', $data['max_surface']);
        }
        if(isset($data['c_generales_ids']) and count($data['c_generales_ids']) > 0){
            $c_generales_ids = $data['c_generales_ids'];
            $query = $query->whereHas('c_generales', function ($query) use ($c_generales_ids){
                $query->whereIn('id_c_generale', $c_generales_ids);
            });
        }
        return $query;
    }

    public function FilterAnnoncesByUser($query, $data)
    {
        if(isset($data['id_transaction']) and $data['id_transaction'] > 0){
            $query = $query->where('id_transaction', $data['id_transaction']);
        }
        if(isset($data['search']) and $data['search'] != null){
            $query = $query->where('titre', 'LIKE', "%{$data['search']}%");
        }
        if(isset($data['id_ville']) and $data['id_ville'] > 0){
            $query = $query->where('id_ville', $data['id_ville']);
        }
        if(isset($data['id_type_de_bien']) and $data['id_type_de_bien'] > 0){
            $query = $query->where('id_type_de_bien', $data['id_type_de_bien']);
        }
        if(isset($data['is_active']) and is_numeric($data['is_active'])){
            $query = $query->where('is_active', $data['is_active']);
        }
        return $query;
    }
}
