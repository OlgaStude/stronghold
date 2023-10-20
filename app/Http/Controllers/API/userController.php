<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function addUser(registrationRequest $req){

        $user = User::create(['name' => $req->name, 'login' => $req->login, 'email' => $req->email, 'password' => Hash::make($req->password), 'status' => 'user']);
        

        if($user){
            Auth::login($user);
            return redirect('user');
        }


    }

    public function loginUser(loginRequest $req){
        $formFields = $req->only(['login', 'password']);
        
        if (Auth::attempt($formFields)){
            $user = User::where("login", $formFields['login'])->get();
            if($user[0]->status == 'admin'){
                return redirect('admin');

            }
            return redirect('user');
        }

        return redirect(route('userlogin'))->withErrors([
            'formError' => 'Неверный логин или пароль'
        ]);
    }

    public function logout(){

        Auth::logout();

        return redirect('/');

    }
}
