<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@extends('swal')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->has('Error_Login'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-4 mb-4" role="alert">
                {{ $errors->first('Error_Login') }}
            </div>
            @endif

            <form action="{{route('auth.loginProcess')}}" method="post">
                @csrf
                @method('post')
                <div class="mt-5">
                    <div>
                        <label class="block" for="email">Email<label>
                                <input type="text" placeholder="Email" name="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block">Password<label>
                                <input type="password" placeholder="Password" name="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                    </div>
                    <div class="flex items-baseline justify-between">
                        <input class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900" value="Login" type="submit" />
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                    <div class="mt-5 flex-auto">
                        <div class="text-base">Don't have an account?</div>
                        <a href="{{route('auth.registerForm')}}" class="text-sm text-blue-600 hover:underline">Register</a>
                    </div>
                </div>
            </form>

        </div>

    </div>

</body>


</html>