<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            'message' => 'required',
            'question_id' => 'required | exists:questions,id',
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
            'message.required' => 'メッセージを入力してください。',
            'question_id.required' => '不正な操作です。',
            'question_id.exists' => '存在しない投稿への返信です。すでに削除済みの可能性があります。画面をリロードしてください。',

        ];
    }
}
