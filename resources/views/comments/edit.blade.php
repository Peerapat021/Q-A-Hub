<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Edit Comment
            </h2>
        </x-slot>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6">
                    <!-- ฟอร์มสำหรับแก้ไขคอมเมนต์ -->
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">คอมเมนต์</label>
                            <textarea id="content" name="content" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ $comment->content }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">อัปเดต</button>
                        <a href="{{ route('posts.show', $comment->post_id) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            ยกเลิก
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
