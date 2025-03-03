<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
    <!-- Load SweetAlert2 from CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('หน้าแก้ไขหมวดหมู่') }}
            </h2>
        </x-slot>

        <div class="content max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
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

            <h1 class="text-3xl font-extrabold text-gray-900 mb-8">{{ __('แก้ไขหมวดหมู่') }}</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong class="font-bold">Whoops!</strong>
                    <ul class="list-disc ml-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form for editing an existing category -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Category Name Input -->
                <div>
                    <label for="category_name" class="block text-sm font-medium text-gray-700">ชื่อหมวดหมู่ </label>
                    <input type="text" name="category_name" id="category_name"
                        value="{{ old('category_name', $category->category_name) }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="ป้อนชื่อหมวดหมู่" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        อับเดต
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </x-app-layout>

    <script>
        document.querySelectorAll('button[id^="del_btn_"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                const categoryId = this.id.split('_')[2]; // Extract the category ID from the button ID
                const form = document.getElementById(`del_form_${categoryId}`);

                Swal.fire({
                    title: "Are you sure you want to delete this category?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    </script>
</body>

</html>
