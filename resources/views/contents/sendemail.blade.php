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

<body class=" ">

    <x-navbar-comp :attribute1=$username />
    <main class="max-w-4xl mx-auto w-screen flex flex-col items-center justify-center mt-28">
        <header class="my-6">
            <p class="text-center font-extrabold text-sky-700 tracking-tight text-6xl">Send Email</p>
        </header>
        <form class="w-full grid gap-2 px-4">
            <div class="flex justify-between items-center">
                <label for="subject" class="w-32 text-right pr-4 font-bold text-gray-700">Subject</label>
                <div class="flex-1">
                    <input required placeholder="subject" type="text" id="subject" class="w-full rounded-md appearance-none border border-gray-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent">
                </div>
            </div>
            <div class="flex justify-between items-center">
                <label for="to" class="w-32 text-right pr-4 font-bold text-gray-700">to</label>
                <input placeholder="to@mail.com" type="email" id="to" class="w-52 rounded-md flex-1 appearance-none border border-gray-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent">
            </div>
            <div class="flex justify-between items-center">
                <label for="message" class="self-start w-32 text-right mt-2 pr-4 font-bold text-gray-700">Message</label>
                <textarea id="message" name="message" placeholder="Your message here ..." rows="3" class="disabled:bg-gray-100 w-full flex-1 placeholder:text-slate-400 appearance-none border border-gray-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-600"></textarea>
            </div>
            <div class="flex justify-start items-center">
                <label for="attachment" class="w-32 text-right pr-4 font-bold text-gray-700">Attachment</label>
                <input type="file" class="block w-60 text-sm text-gray-400 file:mr-2 file:py-2 file:px-2 file:rounded-md file:border-solid file:border file:border-gray-200 file:text-sm file:bg-white file:text-gray-500 hover:file:bg-gray-100">
            </div>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-white py-2 px-2 border border-gray-300 rounded-md shadow-sm font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">Cancel</button>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-2 border border-transparent shadow-sm font-bold rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">Send</button>
            </div>
        </form>
    </main>

</body>

</html>