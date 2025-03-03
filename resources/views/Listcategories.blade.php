<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('หมวดหมู่') }}
            </h2>
        </x-slot>

        <main class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ __('รายการหมวดหมู่') }}</h1>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.showPosts', ['id' => $category->id]) }}"
                            class="bg-white border rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300 ease-in-out border-gray-200 block">
                            <p class="text-lg font-semibold text-gray-900 mb-2">{{ $category->category_name }}</p>
                            <p class="text-sm text-gray-600">
                                @if ($category->created_at)
                                    {{ __('สร้างเมื่อ') }} : {{ $category->created_at->format('Y-m-d H:i') }}
                                @else
                                    {{ __('สร้างเมื่อ') }} : {{ __('N/A') }}
                                @endif
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </main>

    </x-app-layout>

</body>

</html>
