<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AnnonceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->routeIs('annonces.store')){
            return $this->storeOrUpdate();
        }elseif(request()->routeIs('annonces.update')){
            return $this->storeOrUpdate() + ['id' => 'exists:annonces,id'];
        }elseif(request()->routeIs('annonces.show') || request()->routeIs('annonces.delete') || request()->routeIs('annonces.active')
        || request()->routeIs('annonces.unactive')){
            return ['id' => 'exists:annonces,id'];
        }elseif(request()->routeIs('annonces.index')){
            return [];
        }elseif(request()->routeIs('annonces.getByFilter')){
            return $this->getByFilter();
        }
    }

    public function storeOrUpdate()
    {
        return [
            'id_transaction'            => ['bail', 'required', 'integer', 'exists:transactions,id'],
            'id_type_de_bien'           => ['bail', 'required', 'integer', 'exists:type_de_biens,id'],
            'id_etat'                   => ['bail', 'required', 'integer', 'exists:etats,id'],
            'id_ville'                  => ['bail', 'required', 'integer', 'exists:villes,id'],
            'adresse'                   => ['bail', 'required', 'max:300'],
            'etages'                    => ['bail', 'nullable', 'numeric', 'max:100'],
            'chambres'                  => ['bail', 'nullable', 'numeric', 'max:100'],
            'salons'                    => ['bail', 'nullable', 'numeric', 'max:100'],
            'sejours'                   => ['bail', 'nullable', 'numeric', 'max:100'],
            'sale_de_bains'             => ['bail', 'nullable', 'numeric', 'max:100'],
            'toilettes'                 => ['bail', 'nullable', 'numeric', 'max:100'],
            'age_de_bien'               => ['bail', 'nullable', 'string', 'max:20'],
            'surface'                   => ['bail', 'nullable', 'integer', 'min:0', 'max:999999999'],
            'prix'                      => ['bail', 'nullable', 'integer', 'min:0', 'max:99999999999999'],
            'lien_video'                => ['bail', 'nullable', 'string', 'max:250'],
            'titre'                     => ['bail', 'required', 'string', 'max:75'],
            'description'               => ['bail', 'nullable', 'string', 'max:10000'],
            'images'                    => ['bail', 'required', 'array'],
            'images.*'                  => ['mimes:jpg,jpeg,png'],
            'c_generales_ids'           => ['bail', 'nullable', 'array'],
            'c_generales_ids.*'         => ['bail', 'integer', 'exists:c_generales,id'],
            'c_interieurs_ids'          => ['bail', 'nullable', 'array'],
            'c_interieurs_ids.*'        => ['bail', 'integer', 'exists:c_interieurs,id'],
            'c_supplementaires_ids'     => ['bail', 'nullable', 'array'],
            'c_supplementaires_ids.*'   => ['bail' ,'integer', 'exists:c_supplementaires,id'],
        ];
    }

    public function getByFilter()
    {
        return [
            'id_transaction'    => ['bail', 'nullable', 'integer', 'exists:transactions,id'],
            'search'            => ['bail', 'nullable', 'string'],
            'id_ville'          => ['bail', 'nullable', 'integer', 'min:0'],
            'id_type_de_bien'   => ['bail', 'nullable', 'integer', 'min:0'],
            'is_active'         => ['bail', 'nullable', 'integer', 'min:0'],
            'c_generales_ids'   => ['bail', 'nullable', 'array'],
            'c_generales_ids.*' => ['bail', 'integer'],
            'is_user'           => ['bail', 'required', 'numeric']
        ];
    }
}
