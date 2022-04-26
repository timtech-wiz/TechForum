<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Validation\Rule;

class StoryRequest extends FormRequest
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
            $storyId = $this->route('story');         
        return [
            'title' => ['required', 'min:10', 'max:50', function($attribute, $value, $fail){
                if($value == 'dummy title'){
                    $fail ($attribute .' is not valid');
                }

            },
            Rule::unique('stories')->ignore($storyId)
        ],
            'body'  => 'required|min:50',
            'type' => 'required',
            'status' => 'required',
            'image' => 'sometimes|mimes:jpg,png,jpeg'
        ];
    }


    public function withValidator($v){
        $v->sometimes('body', 'max:200', function($input){
            return 'short' == $input->type;
        });
    }

    public function messages(){
        return [
            'title.required' => 'Please Enter title'
        ];
    }
}
