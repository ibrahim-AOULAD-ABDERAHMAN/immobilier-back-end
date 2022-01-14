<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Ville::truncate();
        Schema::enableForeignKeyConstraints();

        $villes = ['Tétouan', 'Tanger', 'Martil', 'Mdiq', 'Fnideq', 'Asila', 'Qsar el sghir'];
        foreach($villes as $Key => $ville){
            $new_ville = new Ville();
            $new_ville->name = $ville;
            $new_ville->save();
        }
    }
}
