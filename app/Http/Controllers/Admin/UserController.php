<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Model\Admin\User;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    /**
     * display a user list view page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = User::all();
        return view('admin/user/list', ['userList' => $userList]);
    }

    /**
     * show a user create view page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.get input data
        $input = $request->all();

        //2.confirm password,validate input
        if($input['password'] != $input['repass'])
        {
            $res = [
                'code' => 0,
                'msg' => 'disconfirm repassword'
            ];
            return json_encode($res);
        }
        
        $rule = ['username' => 'required'];
        $message = ['username.required' => 'username must be required'];
        $validator = Validator::make($input, $rule, $message);
        if($validator->fails()) {
            return $validator->errors()->first();
        }
        
        //3.encrypt password,insert db
        $input['password'] = Crypt::encrypt($input['password']);
        $insert = User::create($input);

        //4.return data
        if ($insert) 
        {
            $res = [
                'code' => 1,
                'msg' => 'add successfully!'
            ];
            return $res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userInfo = User::find($id);
        return view('admin/user/edit', ['user' => $userInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //1.get input date,read user info by $id
        $input = $request->all();
        $userInfo = User::find($id);

        //2.confirm password,validate input
        // $rule = ['username' => 'required'];
        // $message = ['username.required' => 'username must be required'];
        // $validator = Validator::make($input, $rule, $message);
        // if($validator->fails()) {
        //     return $validator->errors()->first();
        // }

        if (!empty($input['password'])) {
            if($input['password'] != $input['repass']) {
                $res = [
                    'code' => 0,
                    'msg' => 'disconfirm repassword'
                ];
                return json_encode($res);
            }
            $userInfo->password = Crypt::encrypt($input['password']);
        }        

        //3.encrypt password,set new param ,update db
        $userInfo->email = $input['email'];
        $userInfo->username = $input['username'];

        $save = $userInfo->save();

        //4.return data
        if ($save) {
            $res = [
                'code' => 1,
                'msg' => 'update successfully!'
            ];
            return $res;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if input $id is string contains multiple nums,split it into array
        $id = explode(',', $id);
        $del = User::destroy($id);

        if ($del) {
            $res = [
                'code' => 1,
                'msg' => 'del successfully!'
            ];
        }else{
            $res = [
                'code' => 0,
                'msg' => 'del error'
            ];
        }
        return $res;
    }
}
