<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Load SweetAlert2 from CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('สร้างกระทู้') }}
            </h2>
        </x-slot>

        <div class="container mx-auto p-6 mt-8 w-[70%]">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            <div class="bg-white shadow-md rounded-lg p-6 ">
                <h1 class="text-3xl font-bold mb-6 ">สร้างกระทู้ใหม่</h1>

                <!-- Form for creating a new post -->
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-semibold mb-2">ชื่อหัวข้อ</label>
                        <input type="text" name="title" id="title"
                            class="form-input w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="ป้อนชื่อโพสต์ของคุณ" required>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-semibold mb-2">รายละเอียด</label>
                        <textarea name="description" id="description" rows="5"
                            class="form-textarea w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="ป้อนคำอธิบายของโพสต์ของคุณ" required></textarea>
                    </div>

                    <!-- Category Input -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-semibold mb-2">หมวดหมู่</label>
                        <select name="category_id" id="category_id"
                            class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">เลือกหมวดหมู่</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            สร้าง
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
