<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoiteDeReceptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'type_de_bien'      => $this->type_de_bien->name ?? null,
            'type_de_message'   => $this->type_de_message->name ?? null,
            'civilite'          => $this->civilite,
            'nom_de_societe'    => $this->nom_de_societe,
            'nom_complet'       => $this->nom_complet,
            'planing'           => $this->planing,
            'email'             => $this->email,
            'telephone'         => $this->telephone,
            'message'           => $this->message,
            'ville'             => $this->ville,
            'adresse'           => $this->adresse,
            'code_postal'       => $this->code_postal,
            'created_at'        => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
