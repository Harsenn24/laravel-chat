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
    <?php
    $dataNavbar = [
        'attribute1' => $username,
        'iduse' => $idUser,
    ];
    ?>
    <div class="bg-green-200 min-h-screen">
        <x-navbar-comp :data="$dataNavbar" />
        <div class="flex flex-col items-center mt-52">
            <div class=" w-1/3 p-5 text-2xl font-extrabold">NAME'S EDIT</div>
            <div class="bg-white p-10 w-1/3">
                <form method="POST" action="{{ route('content.editUserPost', ['id' => $user_data[0]->id]) }}">
                    @csrf
                    @method('POST')

                    <div class="flex items-center mb-5">
                        <label for="name" class="w-20 inline-block text-right mr-4 text-gray-500 text-xl font-serif ">Name</label>
                        <input name="name" id="name" type="text" value="{{$user_data[0]->name}}" placeholder="Your New Name" class="border-b-2 border-gray-400 flex-1 py-2 placeholder-gray-300 outline-none focus:border-green-400">
                        @error('name')
                        <p class="text-red-500 text-base mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="flex items-center mb-10">
                        <label for="password" class="w-20 inline-block text-right mr-4 text-gray-500 text-xl">Password</label>
                        <input type="password" name="password" placeholder="verify your password" class="border-b-2 border-gray-400 flex-1 py-2 placeholder-gray-300 outline-none focus:border-green-400">
                        @error('password')
                        <p class="text-red-500 text-base mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="text-right">
                        <button type="submit" class="py-3 px-8 bg-green-500 text-green-100 font-bold rounded">Edit</button>
                    </div>
                </form>
            </div>
            <div class="py-3 px-8 bg-red-500 text-green-100 font-bold rounded mt-20">

                <form method="post" action="{{ route('content.deleteUser', ['id' => $user_data[0]->id]) }}">
                    @csrf
                    @method('POST')
                    <button type="submit">DELETE ACCOUNT</button>
                </form>
            </div>
        </div>
</body>


</html>