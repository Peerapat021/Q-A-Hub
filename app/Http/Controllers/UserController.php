<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'user') {
            return redirect()->route('listpost');
        } else if ($usertype == 'admin') {
            $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมด
            return view('admin.user', compact('users')); // ส่งข้อมูลผู้ใช้ไปยังวิว
        } else {
            return redirect()->back();
        }
    }

    public function edituser($id)
    {
        $user = User::findOrFail($id); // ดึงข้อมูลผู้ใช้จากฐานข้อมูลตาม id
        return view('admin.edit_User', compact('user')); // ส่งข้อมูลผู้ใช้ไปยัง view เพื่อแก้ไข
    }

    // บันทึกการแก้ไขผู้ใช้
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'usertype' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // ลบผู้ใช้
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }
}


