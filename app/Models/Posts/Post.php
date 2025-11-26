<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

// 追加
use App\Models\Users\user;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function subCategories(){
        // リレーションの定義
    }

    //いいねの多対多のリレーション追記
    public function likedUsers(){
        return $this->belongsToMany(User::class,'likes', 'like_user_id', 'like_post_id')
            ->withTimestamps();
    }


    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }
}