<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminOrdersedit extends FormRequest
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
            //用户名不能为空规则设置 required 输入的内容不能为空 regex 正则规则
            'oname'=>'required',
            //电话规则
            'phone'=>'required|regex:/\d{11}/',
            //地址规则
            'address'=>'required'
        ];
    }
     //自定义错误消息
    public function messages(){
         return[
            'oname.required'=>'收件人不能为空',
            'phone.required'=>'电话不能为空',
            'phone.regex'=>'电话位数不符合要求',
            'address.required'=>'收件地址不能为空'
            ];
    }
}
