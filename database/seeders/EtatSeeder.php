<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $etats = ['Ouvert', 'En cours', 'Termine'];

    public function run()
    {
        foreach ($this->etats as $etat) {
            DB::table('etats')->insert([
                'name' =>  $etat,
            ]);
        }
    }
}
