<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:500',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Comment added successfully');
    }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update(['content' => $request->input('content')]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $postId = $comment->post_id;

        // ตรวจสอบว่าเป็นเจ้าของคอมเม้นหรือเป็นแอดมิน
        if (auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin') {
            $comment->delete();
            return redirect()->route('posts.show', $postId)->with('success', 'ลบคอมเม้นเรียบร้อยแล้ว');
        }

        return redirect()->route('posts.show', $postId)->with('error', 'คุณไม่มีสิทธิ์ในการลบคอมเม้นนี้');
    }
}
