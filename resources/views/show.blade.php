<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ $post->title }}
            </h2>
        </x-slot>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Post Details Section -->
            <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
                <div class="mb-4">
                    <!-- Title and Post Info -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                    <p class="text-sm text-gray-600 font-semibold mb-4">สร้างโดย : {{ $post->user->name }}</p>
                    <p class="text-sm text-orange-500 font-semibold mb-2">รายละเอียด</p>
                    <p class="text-gray-700 leading-relaxed">{{ $post->description }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
                <h3 class="text-2xl font-semibold mb-4">การตอบกลับโพสต์</h3>

                @foreach ($post->comments as $comment)
                    <div class="border-t border-gray-300 pt-4 mb-4">
                        <!-- Comment Info -->
                        <p class="text-xs text-gray-500 mb-2">สร้างโดย: {{ $comment->user->name }}</p>
                        <p class="text-base text-gray-800">{{ $comment->content }}</p>

                        <!-- Edit/Delete Buttons -->
                        @if (auth()->check() && auth()->id() == $comment->user_id)
                            <div class="mt-2 flex space-x-2">
                                <a href="{{ route('comments.edit', $comment->id) }}"
                                    class="text-blue-600 hover:text-blue-800">แก้ไข</a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">ลบ</button>
                                </form>
                            </div>
                        @endif

                        <!-- Replies Section -->
                        @foreach ($comment->replies as $reply)
                            <div class="ml-6 border-l border-gray-300 pl-4 mt-4">
                                <p class="text-xs text-gray-500 mb-2">Replied by: {{ $reply->user->name }}</p>
                                <p class="text-base text-gray-800">{{ $reply->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Add Comment Section -->
            @if (auth()->check())
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">แสดงความคิดเห็น</h3>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="content" rows="4"
                            class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="เพิ่มความคิดเห็นของคุณที่นี่" required></textarea>
                        <button type="submit"
                            class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">คอมเมนต์
                        </button>
                    </form>
                </div>
            @else
                <p class="text-gray-600 mt-6">คุณต้อง <a href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-800">เข้าสู่ระบบ</a> แสดงความคิดเห็น</p>
            @endif
        </div>
    </x-app-layout>
</body>

</html>
