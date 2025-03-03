<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create a New Category') }}
            </h2>
        </x-slot>

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
        <div class="content">
            <div class="boxtype">
                <h1 class="text-3xl font-bold mb-6">Create a New Category</h1>

                <!-- Form for creating a new category -->
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <!-- Category Name Input -->
                    <div class="mb-4">
                        <label for="category_name" class="block text-gray-700 font-bold mb-2">Category Name:</label>
                        <input type="text" name="category_name" id="category_name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter the category name" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
