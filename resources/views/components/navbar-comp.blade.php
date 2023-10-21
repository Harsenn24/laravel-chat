<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <nav class="bg-green-500 p-4">
        <div class="flex items-center justify-between">
            <div class="flex">
                <h1 class="text-white text-2xl font-semibold mr-4">
                    <a href="{{route('content.showUser')}}">Laravel App</a>
                </h1>
                <h1 class="text-white text-2xl font-semibold mr-4">|</h1>
                <h1 class="text-white text-2xl font-semibold mr-4">
                    <a href="{{ route('content.editUser', ['id' => $data['iduse']]) }}">Hello {{ $data['attribute1'] }} !</a>
                </h1>

            </div>
            <form action="{{route('auth.logout')}}" method="POST">
                @csrf
                @method('post')
                <button type="submit" class="text-white text-sm bg-red-500 px-4 py-2 rounded-lg hover:bg-red-700">Logout</button>
            </form>
        </div>
    </nav>
</div>