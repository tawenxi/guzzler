<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct(){
        $this->middleware('auth');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        echo $user['id'].'登录成功！';
    }

        public function logout()
    {
        \Auth::logout();
       \Session::flash('success', "您已经成功退出登录");
        return redirect()->route('loginpage');
    }
        public function edit()
    {
        $user=\Auth::user();
         $this->authorize('update', $user);
        return view('auth.edit', compact('user'));
    }
 public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required'
            ]);
            $user=\Auth::user();
                $user ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $request->session()->flash('success', "修改资料成功");
        return redirect()->route('geren');
       // dd($request);
        
    }
}
