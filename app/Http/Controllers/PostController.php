<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $posts = Post::when($query, function($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->get();
    
        return view('listpost', compact('posts'));
    }

    // ฟังก์ชันสำหรับแสดงฟอร์มสร้างโพสต์
    public function create()
    {
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
        return view('post', compact('categories'));
    }

    // ฟังก์ชันสำหรับจัดการการบันทึกโพสต์ใหม่
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id', // ตรวจสอบว่า category_id เป็นค่าในตาราง categories
        ]);

        // สร้างโพสต์ใหม่และกำหนด user_id จากผู้ใช้ที่ล็อกอินอยู่
        Post::create(array_merge($validatedData, ['user_id' => Auth::id()]));

        // Redirect หลังจากสร้างเสร็จ
        return redirect()->route('posts.create')->with('success', 'Post created successfully!');
    }

    // แสดงฟอร์มสำหรับแก้ไขโพสต์
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
        return view('editpost', compact('post', 'categories'));
    }

    // บันทึกการแก้ไขโพสต์
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // ลบโพสต์
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return back()->with('success', 'Post deleted successfully!');
    }



    public function show($id)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่ ถ้าไม่ล็อกอินให้เปลี่ยนเส้นทางไปหน้าล็อกอิน
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $post = Post::with('user', 'comments')->findOrFail($id);
        return view('show', compact('post'));
    }

    public function myPosts()
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // ดึงโพสต์ทั้งหมดที่ผู้ใช้ล็อกอินอยู่เป็นผู้สร้าง
        $posts = Post::where('user_id', Auth::id())->get();
        $categories = Category::all(); // ดึงหมวดหมู่ทั้งหมด

        return view('myposts', compact('posts', 'categories'));
    }
}
