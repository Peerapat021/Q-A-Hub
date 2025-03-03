<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                // ดึงข้อมูลกระทู้ทั้งหมดสำหรับผู้ใช้ทั่วไป
                $categories = Category::all();
                return view('listcategory', compact('categories'));
            } else if ($usertype == 'admin') {
                // ดึงข้อมูลกระทู้ทั้งหมดสำหรับผู้ดูแลระบบ
                $categories = Category::all();
                return view('admin.adminListcategories', compact('categories'));
            } else {
                return redirect()->back();
            }
        }
    }


    // ฟังก์ชันสำหรับแสดงฟอร์มสร้างหมวดหมู่
    public function create()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                // ดึงข้อมูลหมวดหมู่ทั้งหมดจากฐานข้อมูล
                $categories = Category::all();
                return view('categories', compact('categories')); // ส่งข้อมูลหมวดหมู่ไปยังวิว
            } else {
                return redirect()->route('listpost'); // รีไดเร็กไปที่หน้าโฮมถ้าผู้ใช้ไม่ใช่แอดมิน
            }
        } else {
            return redirect()->route('home'); // รีไดเร็กไปที่หน้าโฮมถ้าผู้ใช้ยังไม่ได้ล็อกอิน
        }
    }

    // ฟังก์ชันสำหรับจัดการการบันทึกหมวดหมู่ใหม่
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
        ]);

        // สร้างหมวดหมู่ใหม่และกำหนด user_id จากผู้ใช้ที่ล็อกอินอยู่
        Category::create(array_merge($validatedData, ['user_id' => Auth::id()]));

        // Redirect หลังจากสร้างเสร็จ
        return redirect()->route('categories.create')->with('success', 'Category created successfully!');
    }


    // แสดงฟอร์มสำหรับแก้ไขหมวดหมู่
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.admineditcategory', compact('category'));
    }

    // บันทึกการแก้ไขหมวดหมู่
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // ลบหมวดหมู่
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }


    public function showPosts($id)
    {
        $category = Category::findOrFail($id);
        $posts = $category->posts;

        return view('categories.showPosts', compact('category', 'posts'));
    }
}
