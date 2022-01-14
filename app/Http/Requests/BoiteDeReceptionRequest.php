<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoiteDeReceptionRequest extends BaseRequest
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
        if(request()->routeIs('boite_de_messages.store')){
            return $this->storeOrUpdate();
        }elseif(request()->routeIs('boite_de_messages.update') || request()->routeIs('boite_de_messages.show')){
            return ['id' => 'exists:boite_de_receptions,id'];
        }elseif(request()->routeIs('boite_de_messages.delete')){
            return $this->delete();
        }elseif(request()->routeIs('boite_de_messages.index')){
            return [];
        }elseif(request()->routeIs('boite_de_messages.getByFilter')){
            return $this->getByFilter();
        }
    }

    public function storeOrUpdate()
    {
        return [
            'id_type_de_bien'       => ['bail', 'required', 'integer', 'exists:type_de_biens,id'],
            'id_type_de_message'    => ['bail', 'required', 'integer', 'exists:type_de_messages,id'],
            'planing'               => ['bail', 'nullable', 'max:30'],
            'civilite'              => ['bail', 'required', 'max:20'],
            'nom_de_societe'        => ['bail', 'nullable', 'max:50'],
            'nom_complet'           => ['bail', 'required', 'max:50'],
            'email'                 => ['bail', 'nullable', 'max:30'],
            'telephone'             => ['bail', 'required', 'max:15'],
            'message'               => ['bail', 'nullable', 'max:1000'],
            'ville'                 => ['bail', 'nullable', 'required_if:id_type_de_message,1,4,5', 'max:30'],
            'adresse'               => ['bail', 'nullable', 'max:150'],
            'code_postal'           => ['bail', 'nullable', 'max:10'],
        ];
    }

    public function getByFilter()
    {
        return [
            'id_type_de_message' => ['bail', 'nullable', 'integer', 'exists:type_de_messages,id'],
            'search'             => ['bail', 'nullable', 'string'],
        ];
    }

    public function delete()
    {
        return [
            'boite_de_receptions_ids'   => ['bail', 'array', 'required'],
            'boite_de_receptions_ids.*' => ['bail', 'exists:boite_de_receptions,id']
        ];
    }
}
