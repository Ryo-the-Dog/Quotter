<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    // テーブル名の設定
    protected $table = 'phrases';
    // テーブルのカラム名を指定する
    protected $fillable = ['user_id','title', 'title_img_path', 'phrase', 'tags[]', 'detail',]; // TODO 練習用のuser_idを削除

    // usersテーブルに対してのリレーション
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // YouTube
    // likesテーブルに対してのリレーション(１つのフレーズに対して複数のいいねが付く)
    public  function likes() {
        return $this->hasMany('App\Like');
//        return $this->belongsToMany('App\Like');
    }

    // tagsテーブルに対するリレーション(互いに複数)
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


    // https://qiita.com/ma7ma7pipipi/items/50a77cd392e9f27915d7
//    public  function likes() {
//        return $this->hasMany('App\Like', 'foreign_key')->where('model', 'User');
//    }

    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
//    public function like_users() {
//        return $this->belongsToMany(
//            'App/User','likes','phrase_id','user_id'
//        )->withTimestamps();
//    }
}
