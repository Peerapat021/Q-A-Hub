<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ListpostController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                // ดึงข้อมูลกระทู้ทั้งหมดสำหรับผู้ใช้ทั่วไป
                $posts = Post::with('user')->get();
                return view('listpost', compact('posts'));
            } else if ($usertype == 'admin') {
                // ดึงข้อมูลกระทู้ทั้งหมดสำหรับผู้ดูแลระบบ
                $posts = Post::with('user')->get();
                return view('admin.adminlistpost', compact('posts'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
            /*หากผู้ใช้พยายามเข้าถึงหน้าเว็บที่ต้องการการยืนยันตัวตน (auth) แต่ยังไม่ได้เข้าสู่ระบบ คำสั่งนี้จะช่วยเปลี่ยนเส้นทางผู้ใช้ไปยังหน้าเข้าสู่ระบบเพื่อให้พวกเขาทำการล็อกอินก่อนที่จะเข้าถึงหน้าที่ต้องการ*/
        }
    }
}
