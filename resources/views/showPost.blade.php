<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->category_name }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
    <style>
        .card {
            display: block;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="bg-gray-100">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $category->category_name }}
            </h2>
        </x-slot>

        <div class="content p-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ __('รายการทั้งหมด') }}</h1>
                @if ($posts->isEmpty())
                    <p class="text-gray-600">No posts found in this category.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post->id) }}" class="card p-4">
                                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $post->title }}</h2>
                                <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>

</body>

</html>
