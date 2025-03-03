<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">

    <!-- Include SweetAlert2 from CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeletion(event, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบโพสต์นี้หรือไม่!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</head>

<body class="bg-gray-100">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('กระทู้ของฉัน') }}
            </h2>
        </x-slot>

        <div class="content p-6">
            <!-- Success Alert -->
            @if (session('success'))
                <div id="success-alert"
                    class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-md transition-opacity duration-1000">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Post Button -->
            <div class="mb-6 flex justify-end">
                <a href="{{ route('posts.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow-lg flex items-center">
                    <span class="text-xl">+ สร้างกระทู้ใหม่</span>
                </a>
            </div>

            <!-- Posts Grid -->
            <div class="block">
                @if ($posts->isEmpty())
                    <div class="col-span-1">
                        <div class="bg-white shadow rounded-lg p-6 text-center">
                            <p class="text-gray-600">คุณยังไม่ได้สร้างโพสต์ใดๆ</p>
                        </div>
                    </div>
                @else
                    @foreach ($posts as $post)
                        <div class="col-span-1 bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                                <p class="text-gray-700 mb-4">
                                    {{ Str::limit($post->description, 100) }}
                                </p>
                                <p class="text-gray-500 text-sm mb-4">
                                    {{ $post->created_at ? $post->created_at->format('Y-m-d H:i') : 'N/A' }}
                                </p>
                                <div class="flex space-x-4">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        รายละเอียด
                                    </a>
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        แก้ไข
                                    </a>
                                    <form id="del_form_{{ $post->id }}" class="inline-block"
                                        action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDeletion(event, 'del_form_{{ $post->id }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                            ลบ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @endif
            </div>
        </div>

    </x-app-layout>

</body>

</html>

<!-- Include SweetAlert2 from CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Display success alert for 1 second
        @if (session('success'))
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = 0;
                }, 1000);
            }
        @endif
    });
</script>
