<?php

namespace App\Models\Users;
//1行追加
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    use HasFactory;
    
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // リレーションの定義
    //一対多の「1」側
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}