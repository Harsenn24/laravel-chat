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

<body class="bg-white ">


    <?php
    $dataNavbar = [
        'attribute1' => $username,
        'iduse' => $idUser,
    ];
    ?>

    <x-navbar-comp :data="$dataNavbar" />

    
    <div class="flex flex-col items-center justify-center mt-10">
        <x-searchbar-comp  />
        <div class="sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-fit py-2 sm:px-6 lg:px-8">
                <div class="">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-center">Number</th>
                                <th scope="col" class="px-6 py-4 text-center">Name</th>
                                <th scope="col" class="px-6 py-4 text-center">Email</th>
                                <th scope="col" class="px-6 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 1;
                            @endphp
                            @foreach($userDatas as $user)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{$count}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$user->name}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$user->email}}</td>
                                <td class="flex whitespace-nowrap px-6 py-4 ">
                                    <form method="GET" action="{{ route('content.editUser', ['id' => $user->id]) }}">
                                        @csrf
                                        @method('GET') <!-- Add this method spoofing for DELETE -->
                                        <button type="submit" class="text-white text-sm bg-blue-500 px-4 py-2 rounded-lg w-28 mr-2">Edit</button>
                                    </form>
                                    @if($user->friend === 1)
                                    <form method="GET" action="{{ route('pusher.index', ['id' => $user->id]) }}">
                                        @csrf
                                        @method('GET') <!-- Add this method spoofing for DELETE -->
                                        @if($user->id === $idUser)
                                        <button type="submit" class="text-white text-sm bg-green-500 px-4 py-2 rounded-lg w-28 mr-2" disabled>-</button>
                                        @else
                                        <button type="submit" class="text-white text-sm bg-green-500 px-4 py-2 rounded-lg w-28 mr-2">Chat</button>
                                        @endif
                                    </form>
                                    @elseif($user->friend === 0)
                                    <form method="POST" action="{{ route('content.addFriend', ['id' => $user->id]) }}">
                                        @csrf
                                        @method('POST') <!-- Add this method spoofing for DELETE -->
                                        @if($user->id === $idUser)
                                        <button type="submit" class="text-white text-sm bg-yellow-500 px-4 py-2 rounded-lg mr-2 w-28">-</button>
                                        @else
                                        <button type="submit" class="text-white text-sm bg-yellow-500 px-4 py-2 rounded-lg mr-2 w-28">Add Friend</button>
                                        @endif
                                    </form>
                                    @endif
                                    @if($user->online === 1)
                                    <div class="text-white font-extrabold text-center bg-blue-500 px-4 py-2 rounded-lg mr-2 w-28">ONLINE</div>
                                    @else
                                    <div class="text-white font-extrabold text-center bg-red-500 px-4 py-2 rounded-lg mr-2 w-28">OFFLINE</div>
                                    @endif


                                </td>
                            </tr>
                            @php
                            $count++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>