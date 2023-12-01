<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\complainRequest;
use App\Http\Requests\solvedRequest;
use App\Models\Category;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class complainController extends Controller
{

    public function addCategory(categoryRequest $req){

        $category = Category::create(['name' => $req->name]);

        if($category){
            return redirect()->back();
        }

    }

    public function categoryDelete(Request $req) {
        Complain::where('categories_id', '=', $req->id)->delete();
        Category::where('id', '=', $req->id)->delete();
    }


    public function addComplaint(Request $req){

        $req->file('img')->store('public/old_ver_imgs');
        $image = $req->file('img')->hashName();

        $complaint = Complain::create(['name' => $req->name, 'description' => $req->description, 
                                        'categories_id' => $req->category_id, 'users_id' => Auth::user()->id, 
                                        'image_old' => $image, 'image_new' => '', 'status' => 'Новая']);

        if($complaint){
            $success_message = $req->session()->put('success_message', 'Отправлено успешно!');
            return redirect()->back()->with($success_message);
        }

    }


    public function changeStatus(solvedRequest $req){

        $req->file('image_new')->store('public/new_ver_imgs');
        $img_name = $req->file('image_new')->hashName();
        
        Complain::where('id', '=', $req->id)->update(['status' => 'Решено', 'image_new' => $img_name]);

        return redirect()->back();

    }


    public function decline(Request $req){


        if($req->reason){
            Complain::where('id', '=', $req->id)->update(['status' => 'Отклонена']);
            return redirect()->back();

        } 

        $fail_message = $req->session()->put('fail_message', 'Необходимо заполнить поле!');
        return redirect()->back()->with($fail_message);

    }


    public function complaintDelete($id) {
        Complain::where('id', '=', $id)->delete();

        $complaints = Complain::join('categories', 'categories.id', '=', 'complains.categories_id')
        ->where('users_id', '=', Auth::user()->id)
        ->select('complains.id as complains_id', 'categories.name as category_name', 
                'complains.name', 'complains.description', 'complains.image_old', 'complains.status', 
                'complains.created_at')->get();

        return redirect()->back();
    }





}
