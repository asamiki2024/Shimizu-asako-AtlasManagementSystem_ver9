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
            //string=文字列の意味
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
            'password' => 'required|min:8|max:30|alpha_num|confirmed',
            'password_confirmation' => 'required|min:8|max:30|alpha_num',
        ];
    }

    public function messages()
    {
        return[
            //入力必須
            'over_name.required','under_name.required' =>'名前は必ず入力してください。',
            'over_name_kana.required','under_name_kana.required' =>'フリガナは必ず入力してください。',
            'mail_address.required' =>'メールアドレスは必ず入力してください。',
            'sex.required' =>'性別を必ず選んでください。',
            'birth_day.required' =>'生年月日を必ず入力してください。',
            'role.required' =>'役職を必ず選択してください。',
            'password.required','password_confirmation.required' =>'パスワードを必ず入力してください。',
            //文字列
            'over_name.string','under_name.string','over_name_kana.string','under_name_kana.string' =>'文字列で入力してください。',
            'mail_address.email' =>'メールアドレスの形式で入力してください。',
            //min,max
            'over_name.min','under_name.min' =>'10文字以下で入力してください。',
            'over_name_kana.min','under_name_kana.min' =>'30文字以下で入力してください。',
            'mail_address.min' =>'30文字以下で入力してください。',
            'password.min','password_confirmation.min' =>'8文字以上で入力してください。',
            'password.max','password_confirmation.max' =>'30文字以下で入力してください。',

        ];
    }
}
