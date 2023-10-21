<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data_product = Product::all();

        return view('products.index', ['products' => $data_product]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data_input = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
        ]);

        Product::create($data_input);

        return redirect(route('product.index'));
    }

    public function edit(Product $id)
    {
        return view('products.edit', ['products' => $id]);
    }


    public function edit_existing_product(Product $id, Request $request)
    {
        $data_input = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
        ]);

        $id->update($data_input);

        return redirect(route('product.index'))->with('success', 'Product update successfully');
    }

    public function delete(Product $id)
    {
        $id->delete();

        return redirect(route('product.index'))->with('success', 'Product delete successfully');
    }
}
