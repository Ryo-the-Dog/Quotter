<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Phrase_tagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phrase_tag')->delete();

        DB::table('phrase_tag')->insert([
            [
                'phrase_id' => 1,
                'tag_id' => 4,
            ],
            [
                'phrase_id' => 1,
                'tag_id' => 6,
            ],
            [
                'phrase_id' => 2,
                'tag_id' => 4,
            ],
            [
                'phrase_id' => 2,
                'tag_id' => 6,
            ],
            [
                'phrase_id' => 3,
                'tag_id' => 5,
            ],[
                'phrase_id' => 4,
                'tag_id' => 3,
            ],


        ]);
    }
}
