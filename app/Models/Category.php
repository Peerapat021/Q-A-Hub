<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // ระบุฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'category_name',
        'user_id',
    ];

    // ความสัมพันธ์กับโมเดล Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // ความสัมพันธ์กับโมเดล User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
