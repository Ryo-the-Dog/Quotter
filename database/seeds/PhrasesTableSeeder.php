<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PhrasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phrases')->delete();

        DB::table('phrases')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'FULL POWER',
                'title_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848035/quote_1_rjp9lj.jpg',
                'phrase' => '変わりたいなら、自分の環境を変えよう。意志力でなんとかするなんて考えは、もうやめよう。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'FULL POWER',
                'title_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848035/quote_1_rjp9lj.jpg',
                'phrase' => 'モチベーションが欲しいなら、今よりも多くの「責任」を背負い、成功と失敗どちらのリスクも上げる',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'title' => '株式投資の未来',
                'title_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848035/quote_2_ojn6iw.jpg',
                'phrase' => '株式のリターンが長短期国債を上回る現象は、米国市場にかぎらず、調査対象とした16ケ国すべてでそっくりそのまま確認できる。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'title' => 'バットマン　ビギンズ',
                'title_img_path' => 'https://res.cloudinary.com/hamgqsy4e/image/upload/v1590848035/quote_3_fhb3pt.jpg',
                'phrase' => '人の本性は行動で決まる。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
