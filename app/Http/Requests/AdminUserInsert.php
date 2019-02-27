<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //给表单授权
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //添加校验规则
    public function rules()
    {
        return [
            //username 校验的参数  required 规则 用户名不能为空  users 表名
            'username'=>'required|regex:/\w{4,8}/|unique:users',
            'password'=>'required|regex:/\w{6,12}/',
            'repassword'=>'required|regex:/\w{6,12}/|same:password',
            'email'=>'required|email',
            'phone'=>'required|regex:/\d{11}/'

        ];
    }

    //自定义错误
    public function messages(){
        return [
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须为4-8位任意的数字字母下划线',
            'username.unique'=>'用户名重复',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须为6-12位任意的数字字母下划线',
            'repassword.required'=>'确认密码不能为空',
            'repassword.regex'=>'确认密码必须为6-12位任意的数字字母下划线',
            'repassword.same'=>'两次密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不对',
            'phone.required'=>'电话不能为空',
            'phone.regex'=>'电话格式不对'
                ];
    }
}
