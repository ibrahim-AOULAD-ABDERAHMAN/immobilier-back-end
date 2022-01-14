<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceResource extends JsonResource
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
            'transaction'       => new TransactionResource($this->whenLoaded('transaction')),
            'type_de_bien'      => new TransactionResource($this->whenLoaded('type_de_bien')),
            'etat'              => new TransactionResource($this->whenLoaded('etat')),
            'ville'             => new TransactionResource($this->whenLoaded('ville')),
            'adresse'           => $this->adresse,
            'etages'            => $this->etages,
            'chambres'          => $this->chambres,
            'salons'            => $this->salons,
            'sejours'           => $this->sejours,
            'sale_de_bains'     => $this->sale_de_bains,
            'toilettes'         => $this->toilettes,
            'age_de_bien'       => $this->age_de_bien,
            'surface'           => $this->surface,
            'prix'              => $this->prix,
            'lien_video'        => $this->lien_video,
            'titre'             => $this->titre,
            'description'       => $this->description,
            'created_at'        => $this->created_at,
            'is_active'         => $this->is_active,
            // 'updated_at' => $this->updated_at,
            'images'            => ImageRsource::collection($this->whenLoaded('images')),
            'c_generales'       => C_GeneraleRsource::collection($this->whenLoaded('c_generales')),
            'c_interieurs'      => C_InterieurRsource::collection($this->whenLoaded('c_interieurs')),
            'c_supplementaires' => C_SupplementaireRsource::collection($this->whenLoaded('c_supplementaires')),
        ];
    }
}
