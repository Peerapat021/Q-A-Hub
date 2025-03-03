<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </x-slot>
        <div class="content">
            <div class="boxtype">
                <h1 class="post-title text-3xl">{{ __('Dashboard') }}</h1>
                <div class="grid">
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                    <h1>welcome</h1>
                </div>
            </div>
        </div>



    </x-app-layout>
</body>

</html>
