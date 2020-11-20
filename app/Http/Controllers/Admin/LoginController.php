<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * return login view page
     */
    public function index()
    {
        return view('admin/login');
    }

    /**
     * return a code
     */
    public function code()
    {
        $code = new Code;
        return $code->make();
    }

    /**
     * do login
     */
    public function signIn(Request $request)
    {
        $input = $request->except('_token');

        //1.validate code and login info
        $rule = [
            'username' => 'required',
            'password' => 'required'
        ];
        $message = [
            'required' => 'not required hahaha'
        ];
        $validator = Validator::make($input,$rule,$message);
        if($validator->fails()) {
            return redirect('admin/login')
            ->withErrors($validator)
            ->withInput();
        }

        //2.validate user info

        //3.session user info

        //4.redirect
    }
}
