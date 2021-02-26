<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoto extends FormRequest
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
            'photo_title' => 'required',
            'photo' => 'required|file|mimes:jpg,jpeg,png,gif'
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'photo_title.required' => 'タイトルを入力してください。',
            'photo.required' => 'ファイルの形式を確認してください。(jpg, jpeg, png, gifが利用できます)',
        ];
    }
}