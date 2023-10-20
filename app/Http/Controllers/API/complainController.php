<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\complainRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class complainController extends Controller
{

    public function addCategory(categoryRequest $req){

        $category = Category::create(['name' => $req->name]);

        if($category){
            return redirect()->back();
        }

    }


    public function addComplain(complainRequest $req){

        

    }

}
