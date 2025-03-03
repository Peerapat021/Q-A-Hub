<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">


</head>

<body class="bg-gray-50 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('กระทู้ทั้งหมด') }}
            </h2>
        </x-slot>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <form action="{{ route('posts.index') }}" method="GET">
                    <div class="flex items-center">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="form-input block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                            placeholder="ค้นหากระทู้...">
                        <button type="submit"
                            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            ค้นหา
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-6 text-gray-900">{{ __('รายการกระทู้') }}</h1>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="bg-white border rounded-lg shadow-md p-6 hover:shadow-xl border-gray-200 block transition-transform transform hover:scale-105">
                                <div class="mb-4">
                                    @if ($post->user)
                                        <p class="text-sm text-gray-700 font-semibold mb-2">สร้างโดย :
                                            {{ $post->user->name }}</p>
                                    @else
                                        <p class="text-sm text-gray-700 font-semibold mb-2">Created by: Unknown</p>
                                    @endif
                                    <p class="text-lg font-semibold text-gray-900">{{ $post->title }}</p>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
