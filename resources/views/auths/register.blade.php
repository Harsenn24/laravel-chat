<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
            <h3 class="text-2xl font-bold text-center">Register Form</h3>
            <form action="{{route('auth.register')}}" method="post">
                @csrf
                @method('post')
                <div class="mt-5">
                    <div>
                        <label class="block">Name<label>
                                <input type="text" placeholder="Name" name="name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block">Email<label>
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
                        <input class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900 text-center" value="Register" type="submit">
                    </div>
                    <div class="mt-4 flex-auto">
                        <div class="text-base">Already have an account?</div>
                        <a href="{{route('auth.login')}}" class="text-sm text-blue-600 hover:underline">Login</a>
                    </div>
                </div>
            </form>

        </div>

    </div>
</body>

</html>