<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // ระบุฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',

    ];

    // ความสัมพันธ์กับโมเดล User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
