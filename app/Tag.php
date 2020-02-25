<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // テーブル名の設定
    protected $table = 'tags';
    protected $fillable = ['name', ];

    // phrasesテーブルに対するリレーション(互いに複数)
    public function phrases()
    {
        return $this->belongsToMany('App\Phrase');
    }
}
