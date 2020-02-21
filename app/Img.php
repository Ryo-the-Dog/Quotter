<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    // テーブル名の設定
    protected $table = 'imgs';

    protected $fillable = ['file_name',];
}
