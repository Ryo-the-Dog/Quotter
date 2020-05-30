<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => '田中　太郎',
                'email' => 'tanaka@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'profile_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848356/user_sample_1_pe9cal.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Erika',
                'email' => 'erika@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'profile_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848356/user_sample_2_kyg9b7.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'ゆり',
                'email' => 'yuri@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'profile_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848356/user_sample_3_dnmxbn.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
