<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    // テーブル名の設定
    protected $table = 'phrases';
    // テーブルのカラム名を指定する
    protected $fillable = ['user_id','title', 'title_img_path', 'phrase', 'category', 'detail',]; // TODO 練習用のuser_idを削除
}
