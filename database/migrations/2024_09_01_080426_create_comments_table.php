<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // เนื้อหาคอมเมนต์
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Foreign key ของโพสต์ที่คอมเมนต์นี้อยู่
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Foreign key ของผู้ใช้งานที่คอมเมนต์นี้สร้างขึ้น
            $table->timestamps(); // วันที่สร้างและอัปเดต
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
