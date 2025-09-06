<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //新規登録のバリデーション
            'over_name' => 'required|string|min:10',
            'under_name' => 'required|string|min:10',
            'over_name_kana' => 'required|string|katakana|min:30',
            'under_name_kana' => 'required|string|katakana|min:30',
            'mail_address' => 'required|email|min:100', Rule::unique('users', 'mail_address')->ignore(Auth::id()),
            //Rule::unique('users', 'mail')　意味:usersテーブルのmailカラムを対象に指定　->ignore(Auth::id())　意味:自分のレコードは除外する
            //Rule::を使用するのは配列形式に書く必要がある為。 'mail'=>[]のように書く必要がある為。
            'sex' => 'required|in:1,2,3',
            //in:値が1,2,3以外無効にする。1=男, 2=女, 3=その他でブレードに設定している。
            'birth_day' => 'required|date|after_or_equal:2000-01-01|before_or_equal:today',
            //old_yearとold_monthとold_dayをまとめてbirth_dayで設定
            //date=正しい日付か,after_or_equal=2000-01-01以降か,before_or_equal=今日以前かどうかチェック
            'role' => 'required|in:1,2,3,4',
            //性別と同じ番号以外無効にする。
            'password' => 'required|min:8|max:30|alpha_num',
        ];
    }

    public function messages()
    {
        return[
            'over_name' =>'',
            'under_name' =>'',
            'over_name_kana' =>'',
            'under_name_kana' =>'',
            'mail_address' =>'',
            'sex' =>'',
            'birth_day' =>'',
            'role' =>'',
            'password' =>'',
        ];
    }
}
