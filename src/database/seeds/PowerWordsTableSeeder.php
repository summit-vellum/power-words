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
        $old_db = DB::connection('olddb');

        $itemsPerBatch = 500;

    	$powerWords = $old_db->table('tbl_power_words');

    	$this->command->getOutput()->progressStart($powerWords->count());

    	$vellumPowerWords = $powerWords->orderBy('pwid')->chunk($itemsPerBatch, function($powerWords){

    		foreach ($powerWords as $powerWord) {
    			$migratedPowerWord = new PowerWords;
        		$migratedPowerWord->create([
        			'id' => $powerWord->pwid,
        			'site_id' => $powerWord->site_id,
        			'parent_id' => $powerWord->pw_parent_id,
        			'word' => $powerWord->power_words
        		]);

        		$this->command->getOutput()->progressAdvance();
    		}

    	});

    	$this->command->getOutput()->progressFinish();

    }

}
