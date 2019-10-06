<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:30',
            'content' => 'required|max:150',
            'user_id' => 'required|numeric',
            'type' => 'required',
            'image' => 'file|image'
        ];
    }
    
    public function messages()
    {
        return [
        'title.required' => 'タイトルを入力してください',
        'title.max:30' => 'タイトルは30文字以内で入力してください',
        'user_id.required' => 'ユーザー名を入力してください',
        'type.required' => 'カテゴリーを選択してください',
        'content.required' => 'コメントを入力してください',
        'content.max:150' => 'メッセージは150文字以内で入力してください',
        'image.file' => 'ファイルのアップロードに失敗しました。',
        'image.image' => '画像はjpg、png、bmp、gif、svgのいずれかの形式です。'
        ];
    }
}
