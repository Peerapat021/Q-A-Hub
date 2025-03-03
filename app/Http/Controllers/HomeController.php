<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
    
            if ($usertype == 'user') {
                return redirect()->route('listpost');
            } else if ($usertype == 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        }
    }
    

    public function post()
    {
        return view("post");
    }

    public function reder()
    {
        return view("reder");
    }
    public function welcome2()
    {
        return view("welcome2");
    }
    public function Category()
    {
        return view("category");
    }


}
