<?php

namespace Database\Seeders;

use App\Models\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSettings::create([
            'name' => 'Mithun Das',
            'phone' => '01515272338',
            'email' => 'mithuncdas.cse@gmail.com',
            'address' => 'H-27'
        ]);
    }
}
