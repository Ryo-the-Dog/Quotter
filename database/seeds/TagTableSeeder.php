<?php

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => '小説',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => 'エッセイ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => '映画',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => '仕事',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => 'お金',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => '人生',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'name' => '恋愛',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
//        // 1レコード
//        $tag = new \App\Tag([
//            'name' => 'ビジネス書'
//        ]);
//        $tag->save();
//        // 2レコード
//        $tag = new \App\Tag([
//            'name' => 'マネー'
//        ]);
//        $tag->save();
//        // 3レコード
//        $tag = new \App\Tag([
//            'name' => '小説'
//        ]);
//        $tag->save();
//        // 4レコード
//        $tag = new \App\Tag([
//            'name' => 'エッセイ'
//        ]);
//        $tag->save();
//        // 5レコード
//        $tag = new \App\Tag([
//            'name' => '映画'
//        ]);
//        $tag->save();
//        // 6レコード
//        $tag = new \App\Tag([
//            'name' => '仕事'
//        ]);
//        $tag->save();
//        // 7レコード
//        $tag = new \App\Tag([
//            'name' => 'お金'
//        ]);
//        $tag->save();
//        // 8レコード
//        $tag = new \App\Tag([
//            'name' => '人生'
//        ]);
//        $tag->save();
//        // 9レコード
//        $tag = new \App\Tag([
//            'name' => '恋愛'
//        ]);
//        $tag->save();
//
//        $this->call(TagTableSeeder::class);
    }
}
