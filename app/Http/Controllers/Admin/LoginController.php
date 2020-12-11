<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Org\code\Code;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'password' => 'required',
            'code' => 'required'
        ];
        $message = [
            'username.required' => 'username must be required!',
            'password.required' => 'password must be required!',
            'code.required' => 'code must be required!',
        ];
        $validator = Validator::make($input, $rule, $message);
        if ($validator->fails()) {
            return redirect('admin/login')
            ->withErrors($validator)
            ->withInput();
        }

        //2.validate user info and captcha; notice that app\Org\code\Code.class.php has put code into session
        if (strtolower(Session::get('code')) != strtolower($input['code']))
        {
            return redirect('admin/login')->withErrors('wrong captcha!');
        } else {
            Session::remove('code');
        }
        $userInfo = Admin::where('username', $input['username'])->first();
        if (!$userInfo)
        {
            return redirect('admin/login')->withErrors('username unexist!');
        }
        if (Crypt::decrypt($userInfo['password']) != $input['password'])
        {
            return redirect('admin/login')->withErrors('wrong password!');
        }

        //3.session user info
        Session::put('user', $userInfo);

        //4.redirect
        return redirect('admin/index');
    }

    /**
     * sign out account
     */
    public function signOut()
    {
        //dump all session
        Session::flush();
        return redirect('admin/login');
    }

    /**
     * there are 3 ways to encrypt password in laravel;create admin account
     */
    public function encrypt()
    {
        // $rawPassword = '123456';
        
        //function 1:Facedes Crypt,everytime encrypt will return different result,use Crypt::decrypt to decrypt
        // $encryptedPassword = 'eyJpdiI6Im41cHFaUTBcL2RiU0N6c2x5ZExhbXlRPT0iLCJ2YWx1ZSI6IlpaYTZwMW9aTzBCRjBHUUkyWkRtSFE9PSIsIm1hYyI6IjdlNGU0YzQ5ZTJjM2IwZmM5YmI5ZWZmMWQxZWEyMDE1ZTI4YjUxM2UwN2UzYzY4NTY5YWRmNGI3YTE0NzViMDQifQ==';
        // $newPassword = Crypt::encrypt($rawPassword);
        // $decryptedPassword = Crypt::decrypt($encryptedPassword);

        //function 2:md5,everytime encrypt will return same result,easy password with md5 will be easily decrypt by dict ,
        //so we could add a salt that make harder to decrypt
        // $encryptedPassword = md5('salt6688'.$rawPassword);

        //function 3:Facades hash,everytime encrypt will return different result,use Hash::check to decrypt
        // $encryptedPassword = '$2y$10$.ijuocrsD.8.7l/2b1eWd.cK11aMKextyrY3sjwt5qts1m8MF9ZqK';
        // $newPassword = Hash::make($rawPassword);
        // $check = Hash::check($rawPassword,$encryptedPassword);
        // dd($check);

        // dd($newPassword);

        // insert admin account into db
        $data['username'] = 'admin';
        $data['password'] = Crypt::encrypt('admin');
        Admin::create($data);
        
    }
}
