<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//追加
use Illuminate\Support\Facades\Validator;

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
    //生年月日をまとめてbirth_dayにまとめる
    public function prepareForValidation()
    {
        if($this->has(['old_year', 'old_month', 'old_day']))
        {
            $this->merge([
                'birth_day' => sprintf(
                    '%04d-%02d-%02d',
                    $this->input('old_year'),
                    $this->input('old_month'),
                    $this->input('old_day')
                ),
            ]);
        }
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            //string=文字列の意味
            'over_name_kana' => 'required|string|katakana|max:30',
            'under_name_kana' => 'required|string|katakana|max:30',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            //Rule::unique('users', 'mail')　意味:usersテーブルのmailカラムを対象に指定　->ignore(Auth::id())　意味:自分のレコードは除外する
            //Rule::を使用するのは配列形式に書く必要がある為。 'mail'=>[]のように書く必要がある為。
            'sex' => 'required|in:1,2,3',
            //in:値が1,2,3以外無効にする。1=男, 2=女, 3=その他でブレードに設定している。
            'birth_day' => 'required|date|after_or_equal:2000-01-01|before_or_equal:today',
            //old_yearとold_monthとold_dayをまとめてbirth_dayで設定
            //date=正しい日付か,after_or_equal=2000-01-01以降か,before_or_equal=今日以前かどうかチェック
            'role' => 'required|in:1,2,3,4',
            //性別と同じ番号以外無効にする。
            'password' => 'required|min:8|max:30|confirmed',
            'password_confirmation' => 'required|min:8|max:30| ',
        ];
    }

    public function messages()
    {
        return[
            //入力必須
            'over_name.required'=>'姓は必ず入力してください。',
            'under_name.required' =>'名前は必ず入力してください。',
            'over_name_kana.required'=>'セイのフリガナは必ず入力してください。',
            'under_name_kana.required' =>'メイのフリガナは必ず入力してください。',
            'mail_address.required' =>'メールアドレスはず入力してください。',
            'sex.required' =>'性別を必ず選んでください。',
            'birth_day.required' =>'生年月日が未入力です。',
            'role.required' =>'役職を必ず選択してください。',
            'password.required','password_confirmation.required' =>'パスワードを必ず入力してください。',
            //文字列
            'over_name.string','under_name.string','over_name_kana.string','under_name_kana.string' =>'文字列で入力してください。',
            'mail_address.email' =>'メールアドレス形式で入力してください。',
            'over_name_kana.katakana'=>'セイをカタカナで入力してください。',
            'under_name_kana.katakana' =>'メイをカタカナで入力してください。',
            
            //min,max
            'over_name.max'=>'セイを10文字以下で入力してください。',
            'under_name.max' =>'メイを10文字以下で入力してください。',
            'over_name_kana.max' =>'姓を30文字以下で入力してください。',
            'under_name_kana.max' =>'名を30文字以下で入力してください。',
            'mail_address.max' =>'30文字以下で入力してください。',
            'password.min','password_confirmation.min' =>'8文字以上で入力してください。',
            'password.max','password_confirmation.max' =>'30文字以下で入力してください。',
            //メールアドレス登録済み無効
            'mail_address.unique' =>'登録済みのメールアドレスです。',
            //生年月日について
            'birth_day.date' =>'正しい日付を入力してください。',
            'birth_day.after_or_equal' =>'2000年1月1日以降で登録してください。',
            'birth_day.before_or_equal:today' =>'今日までの日付で入力してください。',
            //確認事項
            'password.confirmed' =>'パスワードが確認用と異なります。'
        ];
    }
}
