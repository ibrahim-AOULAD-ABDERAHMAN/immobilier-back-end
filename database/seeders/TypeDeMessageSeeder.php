<?php

namespace Database\Seeders;

use App\Models\TypeDeMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TypeDeMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        TypeDeMessage::truncate();
        Schema::enableForeignKeyConstraints();

        $type_de_messages = [
            'Location', // 1
            'Louer',    // 2
            'Achat',    // 3
            'Vente',    // 4
            'Gérance'   // 5
        ];
        foreach($type_de_messages as $Key => $type_de_message){
            $new_type_de_message = new TypeDeMessage();
            $new_type_de_message->name = $type_de_message;
            $new_type_de_message->save();
        }
    }
}
