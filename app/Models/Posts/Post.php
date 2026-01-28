<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

// 追加
use App\Models\Users\user;
use App\Models\Posts\Like;
use App\Models\Categories\SubCategory;

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
        return $this->belongsToMany(SubCategory::class, 'post_sub_categories', 'post_id', 'sub_category_id');
    }

    //いいねの多対多のリレーション追記
    public function likeUsers(){
        return $this->belongsToMany(User::class,'likes', 'like_post_id', 'like_user_id');
    }

    //いいねの数表示
    public function likeCount(){
        return $this->likeUsers()->count();
    }

    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }
}