<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Photo;

class DeletePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // パラメータのIDからで削除対象のリプライを取得
        $photo = Photo::find($this->route("id"));

        return $photo && $this->user()->id == $photo->user_id ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:photos,id',
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