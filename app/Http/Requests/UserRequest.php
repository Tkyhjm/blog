<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'user_image' => 'file|image',
            'message' => 'max:200',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください。',
            'name.string' => 'ユーザー名は文字で入力してください。',
            'name.max:20' => 'ユーザー名は20文字以内で入力してください',
            'image.file' => 'ファイルのアップロードに失敗しました。',
            'image.image' => '画像はjpg、png、bmp、gif、svgのいずれかの形式です。',
            'message.max:200' => 'メッセージは200文字以内で入力してください'
        ];
    }
}
