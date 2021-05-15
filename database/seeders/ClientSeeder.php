<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('clients')->insert(array(
            'id' => '1',
            'name' => 'Pablo',
            'status' => 'En espera',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
        \DB::table('clients')->insert(array(
            'id' => '2',
            'name' => 'Sharlotte',
            'status' => 'En espera',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
        \DB::table('clients')->insert(array(
            'id' => '3',
            'name' => 'Coraline',
            'status' => 'En espera',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
    }
}
