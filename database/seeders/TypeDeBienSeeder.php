<?php

namespace Database\Seeders;

use App\Models\TypeDeBien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TypeDeBienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        TypeDeBien::truncate();
        Schema::enableForeignKeyConstraints();

        $type_de_biens = ['Appartements', 'Maisons', 'Villas', 'Riads', 'Bureaux', 'Locaux commerciaux',
        'Locaux industriels', 'Terrains', 'Fermes'];
        foreach($type_de_biens as $Key => $type_de_bien){
            $new_type_de_bien = new TypeDeBien();
            $new_type_de_bien->name = $type_de_bien;
            $new_type_de_bien->save();
        }
    }
}
