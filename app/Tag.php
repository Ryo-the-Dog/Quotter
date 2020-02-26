<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // テーブル名の設定
    protected $table = 'tags';
    protected $fillable = ['name', 'id'];

    // phrasesテーブルに対するリレーション(互いに複数)
    public function phrases()
    {
        return $this->belongsToMany('App\Phrase');
    }

    /**
     * カテゴリリストを取得する
     *
     * @param int    $num_per_page 1ページ当たりの表示件数
     * @param string $order        並び順の基準となるカラム
     * @param string $direction    並び順の向き asc or desc
     * @return mixed
     */
    public function getTagList(int $num_per_page = 0)
    {
        $query = $this;
        if ($num_per_page) {
            return $query->paginate($num_per_page);
        }
        return $query->get();
    }
}
