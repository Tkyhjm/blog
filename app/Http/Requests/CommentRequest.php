<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|max:150',
            'user_id' => 'required|numeric',
            'post_id' => 'required|numeric'
        ];
    }
    
    public function messages()
    {
        return [
            'comment.required' => 'コメントを入力してください',
            'comment.max:150' => 'コメントは150文字以内で入力してください',
            'user_id.required' => 'ユーザーIDを入力してください',
            'user_id.numeric' => 'ユーザーIDは数値です',
            'post_id.required' => 'ポストIDを入力してください',
            'post_id.numeric' => 'ポストIDは数値です',
        ];
    }
}
