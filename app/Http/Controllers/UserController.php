<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * user list
     */
    public function index()
    {
        // 1.get user info
        $userInfo = User::all();

        //this three below get the same result
        // return view('user/index',['userInfo'=>$userInfo]);
        // return view('user/index',compact('userInfo'));
        return view('user/index')->with('userInfo',$userInfo);
    }
    /**
     * return a add view
     */
    public function add()
    {
        return view('user/add');
    }

    /**
     * return a edit view
     */
    public function edit($id)
    {
        // 1.get userinfo which id equal $id
        $userInfo = User::get($id);

        return view('user/edit',compact('userInfo',$userInfo));
    }
    /**
     * store the form value
     * return result of form submition
     */
    public function store(Request $request)
    {
        //1.get form data
        $input = $request->except('_token');

        //2.validate

        //3.insert into db
        $res = User::create($input);

        //4.if succcess redirect to list page,if not rejump
        if($res)
        {
            return redirect('user/index');
        }else{
            return back();
        }
    }
}
