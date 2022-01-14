<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Etat::truncate();
        Schema::enableForeignKeyConstraints();

        $etats = ['Bon etat', 'A renover'];
        foreach($etats as $Key => $etat){
            $new_etat = new Etat();
            $new_etat->name = $etat;
            $new_etat->save();
        }
    }
}
