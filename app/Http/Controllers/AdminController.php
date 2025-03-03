<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลโพสต์ทั้งหมดจากฐานข้อมูล
        $posts = Post::all();
        return view('admin.adminhome', compact('posts'));
    }
}
