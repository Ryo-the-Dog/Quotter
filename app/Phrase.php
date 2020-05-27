<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Phrase extends Model
{
    // テーブル名の設定
    protected $table = 'phrases';

    // テーブルのカラム名を指定する
    protected $fillable = ['user_id','title', 'title_img_path', 'phrase', 'tag_ids[]', 'detail',];

    // usersテーブルに対してのリレーション
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // likesテーブルに対してのリレーション(１つのフレーズに対して複数のいいねが付く)
    public  function likes() {
        return $this->hasMany('App\Like');
    }

    // tagsテーブルに対するリレーション(互いに複数)
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    // 投稿をカテゴリ別表示
    public function getPhraseList(int $num_per_page = 20, array $condition = [])
    {
        // 引数として渡ってきたtag_idとpage_idからtag_idだけ取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        $sort_id = Arr::get($condition, 'sort_id');

        // Eager ロードの設定を追加
        if($sort_id === 'like') {
            // ソート順を指定されている場合
            $query = $this->withCount('likes','tags')->orderBy('likes_count','desc');

        }else{
            $query = $this->with('tags');
        }

        // タグが選択された時のみ、phraseをtagのidで検索をかける
        if ($tag_id) {
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }

        if($sort_id === 'like'){

//            $query->Like::withCount('likes')->orderBy('phrase_id', 'asc');

        } elseif($sort_id === 'new') {

            $query->orderBy('created_at', 'desc');

        }
        // paginate メソッドを使うと、ページネーションに必要な全件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);

    }
    // 順番表示
    public function order($select)
    {
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

}
