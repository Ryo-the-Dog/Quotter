<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_img_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Phraseモデルとのリレーション。これであるユーザーが投稿したフレーズを取得できる。
    public function phrases() {
        return $this->hasMany('App\Phrase');
    }

    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
    // このユーザーが押したいいね
    public function likes() {
        return $this->belongsToMany(
            'App\Phrase', 'likes', 'user_id', 'phrase_id'
        )->withTimestamps();
    }
    public function like($phraseId) {
        $exist = $this->is_like($phraseId);
        if($exist){
            return false;
        }else{
            $this->likes()->attach($phraseId);
            return true;
        }
    }
    public function dislike($phraseId) {
        $exist = $this->is_like($phraseId);

        if($exist){
            $this->likes()->detach($phraseId);
            return true;
        }else{
            return false;
        }
    }
    public function is_like($phraseId) {
        return $this->likes()->where('phrase_id', $phraseId)->exists();
    }
}
