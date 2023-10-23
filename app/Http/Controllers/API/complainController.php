<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\complainRequest;
use App\Models\Category;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class complainController extends Controller
{

    public function addCategory(categoryRequest $req){

        $category = Category::create(['name' => $req->name]);

        if($category){
            return redirect()->back();
        }

    }


    public function addComplaint(Request $req){

        $req->file('img')->store('public/old_ver_imgs');
        $image = $req->file('img')->hashName();

        $complaint = Complain::create(['name' => $req->name, 'description' => $req->description, 'categories_id' => $req->category_id, 'users_id' => Auth::user()->id, 'image' => $image, 'status' => 'Новая']);

        if($complaint){
            $success_message = $req->session()->put('success_message', 'Отправлено успешно!');
            return redirect()->back()->with($success_message);
        }

    }

}
