<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Question;

class DeleteQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // パラメータのIDからで削除対象のリプライを取得
        $question = Question::find($this->route("id"));

        return $question && $this->user()->id == $question->user_id ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:questions,id',
        ];
    }

    // バリデーション対象のデータにリクエストパラメータを追加する
    public function validationData()
    {
        $data = $this->all();
        if (isset($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}