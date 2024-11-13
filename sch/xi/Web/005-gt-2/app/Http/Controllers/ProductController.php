<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// use Flasher\Prime\FlasherInterface;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        flash()->options([
            "timeout" => 61440,
            "position" => "top-left"
        ])->info("Halo!");

        return view("product.index", [
            "products" => $products
        ]);
    }

    public function create()
    {
        return view("product.create");
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        flash()->success("$product->name berhasil ditambahkan");

        return redirect()->route("products.index");
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view("product.show", ["product" => $product]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        flash()->success("Data berhasil diubah");

        return redirect()->route("products.index");
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        flash()->success("Data telah berhasil dihapus!");

        return redirect()->route("products.index");
    }
}
