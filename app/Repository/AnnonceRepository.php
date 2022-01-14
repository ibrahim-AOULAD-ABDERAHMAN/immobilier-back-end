<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Models\Annonce;
use App\Models\Image;
use App\Services\AnnonceServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnnonceRepository implements RepositoryInterface
{
    protected $annonce;
    protected $annonceServices;
    public function __construct(Annonce $annonce, AnnonceServices $annonceServices)
    {
        $this->annonce         = $annonce;
        $this->annonceServices = $annonceServices;
    }

    public function getAll()
    {
        return $this->annonce->with('transaction', 'type_de_bien', 'etat', 'ville', 'images', 'c_generales', 'c_interieurs', 'c_supplementaires')
                             ->orderBy('id', 'desc')->paginate(Helper::pagination);
    }

    public function getByFilter($data)
    {
        $query = $this->annonce->with('transaction', 'type_de_bien', 'etat', 'ville', 'images', 'c_generales', 'c_interieurs', 'c_supplementaires');
        if(isset($data['is_user']) and $data['is_user'] == 1){
            $query = $this->annonceServices->FilterAnnoncesByUser($query, $data);
        }else{
            $query = $this->annonceServices->FilterAnnoncesByVisiteur($query, $data);
        }
        return $query->orderBy('id', 'desc')->paginate(Helper::pagination);
    }

    public function getById($id)
    {
        return $this->annonce->with('transaction', 'type_de_bien', 'etat', 'ville', 'images', 'c_generales', 'c_interieurs', 'c_supplementaires')
                             ->where('id', $id)->first();
    }

    public function create($data)
    {
        $annonce                    = new $this->annonce;
        $annonce->id_transaction    = $data['id_transaction'];
        $annonce->id_type_de_bien   = $data['id_type_de_bien'];
        $annonce->id_etat           = $data['id_etat'];
        $annonce->id_ville          = $data['id_ville'];
        $annonce->adresse           = $data['adresse'];
        $annonce->etages            = $data['etages'];
        $annonce->chambres          = $data['chambres'];
        $annonce->salons            = $data['salons'];
        $annonce->sejours           = $data['sejours'];
        $annonce->sale_de_bains     = $data['sale_de_bains'];
        $annonce->toilettes         = $data['toilettes'];
        $annonce->age_de_bien       = $data['age_de_bien'];
        $annonce->surface           = $data['surface'];
        $annonce->prix              = $data['prix'];
        $annonce->lien_video        = $data['lien_video'];
        $annonce->titre             = $data['titre'];
        $annonce->description       = $data['description'];
        $annonce->is_active         = 1;
        $annonce->id_user           = 1; //Auth::user()->id;
        $annonce->save();

        // Images
        foreach($data['images'] as $image){
            $new_image  = new Image();
            $new_image->image      = Helper::saveFile($image, "annonces");
            $new_image->id_annonce = $annonce->id;
            $new_image->save();
        }

        // Caractéristique génerales
        if( isset($data['c_generales_ids'])  and count($data['c_generales_ids']) > 0 ){
            $annonce->c_generales()->attach($data['c_generales_ids']);
        }

        // Intérieur
        if( isset($data['c_interieurs_ids'])  and count($data['c_interieurs_ids']) > 0 ){
            $annonce->c_interieurs()->attach($data['c_interieurs_ids']);
        }

        // Options supplémentaires
        if( isset($data['c_supplementaires_ids'])  and count($data['c_supplementaires_ids']) > 0 ){
            $annonce->c_supplementaires()->attach($data['c_supplementaires_ids']);
        }

        return $annonce;
    }

    public function update($id, $data)
    {
        $annonce                    = $this->annonce->where('id', $id)->first();
        $annonce->id_transaction    = $data['id_transaction'];
        $annonce->id_type_de_bien   = $data['id_type_de_bien'];
        $annonce->id_etat           = $data['id_etat'];
        $annonce->id_ville          = $data['id_ville'];
        $annonce->adresse           = $data['adresse'];
        $annonce->etages            = $data['etages'];
        $annonce->chambres          = $data['chambres'];
        $annonce->salons            = $data['salons'];
        $annonce->sejours           = $data['sejours'];
        $annonce->sale_de_bains     = $data['sale_de_bains'];
        $annonce->toilettes         = $data['toilettes'];
        $annonce->age_de_bien       = $data['age_de_bien'];
        $annonce->surface           = $data['surface'];
        $annonce->prix              = $data['prix'];
        $annonce->lien_video        = $data['lien_video'];
        $annonce->titre             = $data['titre'];
        $annonce->description       = $data['description'];
        $annonce->update();

        // Images
        if(isset($data['images']) and count($data['images']) > 0 ) //$annonce->images()->delete();
        $this->annonceServices->deleteAllImages($id, $annonce->images());
        foreach($data['images'] as $image){
            $new_image  = new Image();
            $new_image->image      = Helper::saveFile($image, "annonces");
            $new_image->id_annonce = $annonce->id;
            $new_image->save();
        }

        // Caractéristique génerales
        $annonce->c_generales()->sync($data['c_generales_ids']);

        // Intérieur
        $annonce->c_interieurs()->sync($data['c_interieurs_ids']);

        // Options supplémentaires
        $annonce->c_supplementaires()->sync($data['c_supplementaires_ids']);

        return  $annonce;
    }

    public function active($id)
    {
        $annonce = $this->annonce->where('id', $id)->first();
        $annonce->is_active = 1;
        $annonce->update();

        return $annonce;
    }

    public function unactive($id)
    {
        $annonce = $this->annonce->where('id', $id)->first();
        $annonce->is_active = 0;
        $annonce->update();

        return  $annonce;
    }

    public function delete($id)
    {
        $annonce = $this->annonce->where('id', $id)->first();
        $this->annonceServices->deleteAllImages($id, $annonce->images());
        $annonce->delete();
        return  $annonce;
    }

}
