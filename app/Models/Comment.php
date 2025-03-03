<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'post_id', 'user_id', 'parent_id'];

    // ความสัมพันธ์กับ Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // ความสัมพันธ์กับ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
