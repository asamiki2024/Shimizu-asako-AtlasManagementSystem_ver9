<?php

namespace App\Models\Users;
//1行追加
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // リレーションの定義
    //多対多の「多」側
    //リレーションの記述の手順①第一引数:相手のモデル(Subjects.php),②第二引数:中間テーブル(subject_users),③第三引数:自分のID(user_id),④第四引数:相手のID(subject_id)
    public function users(){
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id')->withTimestamps();
    }
}