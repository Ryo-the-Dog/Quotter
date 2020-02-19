<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    // テーブル名の設定
    protected $table = 'phrases';

    protected $fillable = ['title', 'title_img', 'phrase', 'category', 'detail',];
}
