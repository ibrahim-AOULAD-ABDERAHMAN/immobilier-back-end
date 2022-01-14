<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Transaction::truncate();
        Schema::enableForeignKeyConstraints();

        $transactions = ['Achat', 'Location', 'Location vacances'];
        foreach($transactions as $Key => $transaction){
            $new_transaction = new Transaction();
            $new_transaction->name = $transaction;
            $new_transaction->save();
        }
    }
}
