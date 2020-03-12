<?php

use Illuminate\Database\Seeder;
use Quill\PowerWords\Models\PowerWords;

class PowerWordsTableSeeder extends Seeder
{
   	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PowerWords::class, 10)->create();
    }

}
