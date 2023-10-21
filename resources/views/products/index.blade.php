<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>Product</h1>

    <div>
        @if(session()->has('success'))
        <div>
            {{session('success')}}
        </div>
        @endif
    </div>

    <div>
        <a href="{{route('product.create')}}">NEW PRODUCT</a>
    </div>
    <br>
    <div>
        <table class="w-auto">
            <thead class="bg-gray-400 border-gray-50">
                <tr>
                    <th class="p-3 text-sm font-bold border-x-2">ID</th>
                    <th class="p-3 text-sm font-bold border-x-2">Name</th>
                    <th class="p-3 text-sm font-bold border-x-2">Quantity</th>
                    <th class="p-3 text-sm font-bold border-x-2">Price</th>
                    <th class="p-3 text-sm font-bold border-x-2">Description</th>
                    <th class="p-3 text-sm font-bold border-x-2">Action</th>
                </tr>
            </thead>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <a href="{{route('product.edit', ['id' => $product->id])}}">Edit</a>
                    <form method="post" action="{{route('product.delete', ['id' => $product->id])}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>