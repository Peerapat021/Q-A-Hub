<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
    <title>Welcome</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-sans antialiased">

    <header class="bg-white shadow-md rounded-lg">
        <nav class="container mx-auto flex items-center justify-between p-5">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('image/logo Q&A Hub pn 20a80efd-5653-40fe-9751-3b71a88a8346.png') }}" alt="Logo"
                    class=" text-white  rounded-3xl" style="width: 3rem; height: 3rem;">
                <span class="text-xl font-semibold">{{ __('Q&A HUB') }}</span>
            </a>
            <div class="space-x-6">
                @if (Route::has('login'))
                    @auth
                        <!-- Authenticated links -->
                    @else
                        <a href="{{ route('login') }}" class="text-blue-900 hover:text-blue-600 transition">เข้าสู่ระบบ</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-blue-900 hover:text-blue-600 transition">สมัครสมาชิก</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <main class="container mx-auto p-8">
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
        <section class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ __('รายการกระทู้') }}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}" class="block">
                        <div
                            class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border border-blue-200">
                            @if ($post->user)
                                <p class="text-blue-900 mb-2">สร้างโดย : <span
                                        class="font-semibold text-blue-900">{{ $post->user->name }}</span></p>
                            @else
                                <p class="text-gray-600 mb-2">Created by: <span
                                        class="font-semibold text-gray-800">Unknown</span></p>
                            @endif
                            <p class="text-lg font-semibold text-gray-900">{{ $post->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>

</body>

</html>
