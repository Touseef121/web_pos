<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\LoggedIn;


class UserController extends Controller
{
    public function loginPage(){
        return view('authentication.login');
    }

    public function userLogin(Request $request){
        // $userInfo = $request->validate(
        //     [
        //         'user_name' => 'required',
        //         'password' => 'required'
        //     ]); 
        //     $user_name = $request->user_name;
        //     $role = User::where('user_name', $user_name )->value('role');

        //     if(Auth::attempt($userInfo) && $role === 'admin'){
        //             dd(event(new LoggedIn($user)));
        //         return redirect()->route('admin.index');
        //     }
        //     elseif(Auth::attempt($userInfo) && $role === 'manager'){
        //         return redirect()->route('manager.index');
        //     }elseif(Auth::attempt($userInfo) && $role === 'data-entry'){
        //         return redirect()->route('dataentry.index');
        //     }elseif(Auth::attempt($userInfo) && $role === 'cashier'){
        //         return redirect()->route('cashier.index');
        //     }
        //     else{
        //         return redirect()->route('login.page')->with('error', 'Incorrect User Name / Password!');
        //     }

        $userInfo = $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]); 
        
        if (Auth::attempt($userInfo)) {

            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($role === 'manager') {
                return redirect()->route('manager.index');
            } elseif ($role === 'data-entry') {
                return redirect()->route('dataentry.index');
            } elseif ($role === 'cashier') {
                return redirect()->route('cashier.index');
            }
        } else {
            return redirect()->route('login.page')->with('error', 'Incorrect Username/Password!');
        }
        

}
    public function userLogout(){
        Auth::logout();
        return redirect()->route('login.page')->with('status', 'Logged out Successfully!');
    }
}
