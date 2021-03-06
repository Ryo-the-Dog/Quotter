<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TagTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PhrasesTableSeeder::class);
        $this->call(Phrase_tagTableSeeder::class);
    }
}
