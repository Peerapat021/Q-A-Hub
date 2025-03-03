<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('หน้าแก้ไขโพสต์') }}
            </h2>
        </x-slot>

        <div class="py-6">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ __('แก้ไขโพสต์') }}</h1>

                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">ชื่อเรื่อง</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">รายละเอียด</label>
                            <textarea id="description" name="description"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $post->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">หมวดหมู่</label>
                            <select id="category_id" name="category_id"
                                class="text-black mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">เลือกหมวดหมู่</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end gap-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                อัปเดต
                            </button>
                            <a href="#" id="cancelButton"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>

</html>

<script>
    document.getElementById('cancelButton').addEventListener('click', function(event) {
        event.preventDefault();
        window.history.back();
    });
</script>
