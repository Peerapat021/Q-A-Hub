<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class ListcategoriesController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'user') {
            $categories = Category::with('user')->get();
            return view('Listcategories', compact('categories'));
        } else if ($usertype == 'admin') {
            $categories = Category::with('user')->get();
            return view('admin.adminListcategories', compact('categories'));
        } else {
            return redirect()->back();
        }
    }
}


/*<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class ListcategoriesController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'user') {
            // ส่งผู้ใช้ไปที่หน้า listpost ถ้าเป็น user ปกติ
            return redirect()->route('listpost');
        } else if ($usertype == 'admin') {
            // ดึงข้อมูล category สำหรับ admin
            $categories = Category::with('user')->get();
            return view('admin.adminListcategories', compact('categories'));
        } else {
            return redirect()->back();
        }
    }
}
    */
