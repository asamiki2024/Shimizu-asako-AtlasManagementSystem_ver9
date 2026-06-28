<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_sub_category_name' => 'required|unique:sub_categories,sub_category',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:2000',
        ];
    }

    public function messages(){
        return [
            'post_sub_category_name.required' => 'サブカテゴリーは必ず選んでください。',
            'post_sub_category_name.unique' =>'サブカテゴリーは既に登録されています。',
            // 'post_sub_category_name.exists' => '登録されているサブカテゴリーを選んでください。',
            'post_title.required' => 'タイトルは必ず入力してください。',
            'post_title.string' => 'タイトルは文字列である必要があります。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_body.required' => '内容は必ず入力してください。',
            'post_body.string' => '内容は文字列である必要があります。',
            'post_body.max' => '最大文字数は2000文字です。',
        ];
    }
}
