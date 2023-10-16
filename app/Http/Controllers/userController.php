<?php

namespace App\Http\Controllers;

use App\Http\Requests\registrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    
    public function addUser(registrationRequest $req){

        $user = User::create(['name' => $req->name, 'login' => $req->login, 'email' => $req->email, 'password' => Hash::make($req->password)]);
        

        if($user){
            return response()->json(['status' => 200, 'message' => 'user is created!']);
        }

        return response()->json(['status' => 422, 'message' => 'user is obosran!']);

    }


}
