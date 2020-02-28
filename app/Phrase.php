<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Phrase extends Model
{
    // テーブル名の設定
    protected $table = 'phrases';
    // テーブルのカラム名を指定する
    protected $fillable = ['user_id','title', 'title_img_path', 'phrase', 'tag_ids[]', 'detail',]; // TODO 練習用のuser_idを削除

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
    // 投稿をカテゴリ別表示
    public function getPhraseList(int $num_per_page = 10, array $condition = [])
    {
        //dd($condition);// array:2 [▼ "tag_id" => "5","page" => "1"]
//        $tag_id = array_get($condition, 'tag_id');
        // 引数として渡ってきたtag_idとpage_idからtag_idだけ取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        //dd($tag_id); // 5
        //dd($this); // Phraseモデル
//        dd(Phrase::with(['tags'])->get());

        // Eager ロードの設定を追加
        $query = $this->with('tags'); // このtagsは多分L28の。それとwithはhasMany用かもしれない。
//        dd($this->tags);
        //dd($query);
//        dd( Phrase::whereHas('tags', function ($query) {
//            $query->where('id', 5);
//        })->get() );

        // カテゴリーIDの指定
//        if ($tag_id) {
//            $query->where('id', $tag_id);
//        }
        // タグが選択された時のみ、phraseをtagのidで検索をかける
        if ($tag_id) {
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }
//        dd($query);
        // paginate メソッドを使うと、ページネーションに必要な全件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);

    }
    public function getLikePhraseList(int $num_per_page = 10, array $condition = [])
    {
        // 引数として渡ってきたtag_idとpage_idからtag_idだけ取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        // Eager ロードの設定を追加
        $query = $this->with('tags'); // このtagsは多分L28の。それとwithはhasMany用かもしれない。

        // カテゴリーIDの指定
        // タグが選択された時のみ、phraseをtagのidで検索をかける
        if ($tag_id) {
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }
        // paginate メソッドを使うと、ページネーションに必要な全件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);

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
