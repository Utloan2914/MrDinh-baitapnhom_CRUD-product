<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Product;

class apiProduct extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function detail($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric',
            'promotion_price' => 'nullable|numeric',
            'unit' => 'required|string|max:50',
            'new' => 'required|integer|min:0|max:1',
            'id_type' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'unit_price' => $request->unit_price,
            'promotion_price' => $request->promotion_price ?? 0,
            'unit' => $request->unit,
            'new' => $request->new,
            'id_type' => $request->id_type,
            'image' => $imagePath,
        ]);

        return response()->json(['message' => 'Product added successfully', 'product' => $product]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'editName' => 'required|string|max:255',
            'editDescription' => 'nullable|string',
            'editPrice' => 'required|numeric',
            'editPromotionPrice' => 'nullable|numeric',
            'editUnit' => 'required|string|max:50',
            'editNew' => 'required|integer|min:0|max:1',
            'editType' => 'required|integer',
            'editImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice ?? 0;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;
        if ($request->hasFile('editImage')) {
            $image = $request->file('editImage');
            $imagePath = $image->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'error' => 'Product does not exist']);
        }
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product removed']);
    }
}
