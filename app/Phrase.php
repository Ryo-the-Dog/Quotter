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
    public function getPhraseList(int $num_per_page = 20, array $condition = [])
    {
        //dd($condition);// array:2 [▼ "tag_id" => "5","page" => "1"]
//        $tag_id = array_get($condition, 'tag_id');
        // 引数として渡ってきたtag_idとpage_idからtag_idだけ取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        $sort_id = Arr::get($condition, 'sort_id');

        // Eager ロードの設定を追加
//        $query = $this->with('tags'); // このtagsは多分L28の。それとwithはhasMany用かもしれない。
        if($sort_id) {
            $query = $this->withCount('likes','tags')->orderBy('likes_count','desc');
        }else{
            $query = $this->with('tags');
        }

        // カテゴリーIDの指定
//        if ($tag_id) {
//            $query->where('id', $tag_id);
//        }
//        $phrases = $this->all();
//        $query->whereHas('likes')
//        if($sort_id) {
////            $query->orderBy(count($phraseId), 'asc')
//
//        }
        // TODO フレーズに関連付けられたlikesテーブルを呼び出す→そのphrase_idのレコード数をカウントする→その順番を元に並び替えする。
        // $query->orderBy(count($phraseId), 'asc')
        // タグが選択された時のみ、phraseをtagのidで検索をかける
        if ($tag_id) {
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }
//        dd($sort_id); // desc
//        dd($sort_id == 'desc');
//        dd($query);
//        dd(Phrase::withCount('likes')->orderBy('phrase_id', 'asc'));
        if($sort_id == 'asc'){
//            $query->orderBy('created_at', 'asc');
            $query->Like::withCount('likes')->orderBy('phrase_id', 'asc');
        } elseif($sort_id == 'desc') {
            $query->orderBy('created_at', 'desc');
        }
//        dd($query);
        // paginate メソッドを使うと、ページネーションに必要な全件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);

    }
    // 順番表示
    public function order($select)
    {
//        dd($this->orderBy('created_at', 'desc')->get());
        if($select == 'asc'){
            return $this->orderBy('created_at', 'asc')->get();
        } elseif($select == 'desc') {
            return $this->orderBy('created_at', 'desc')->get();
        } else {
            return $this->all();
        }
    }

    public function getLikePhraseList(int $num_per_page = 20, array $condition = [])
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
