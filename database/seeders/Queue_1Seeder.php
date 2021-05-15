<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Queue_1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('queue1s')->insert(array(
            'client_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
        \DB::table('queue1s')->insert(array(
            'client_id' => '3',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
    }
}
