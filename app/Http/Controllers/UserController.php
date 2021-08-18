<?php 

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{


    public function postSignUp(Request $request){

        $this->validate($request, [
            'email' => 'required | email | unique:users',
            'name' => 'required | max:120',
            'password' => 'required | min:3'
        ]);

        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['password']);

        $User = new User();
        $User->email = $email;
        $User->name = $name;
        $User->password = $password;

        $User->save();
        
        Auth::login($User);

        return redirect() -> route('timeline');
        
    }

    public function postSignIn(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){

            return redirect()->route('timeline');
        }
        return redirect() -> back();         
    }

    public function getLogout(){

        Auth::logout();

        return redirect() -> route('welcome');
    }

 
}