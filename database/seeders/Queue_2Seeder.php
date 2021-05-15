<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Queue_2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('queue2s')->insert(array(
            'client_id' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
    }
}
