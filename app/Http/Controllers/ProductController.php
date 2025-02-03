<?php

namespace App\Http\Controllers;

use App\Models\ProductOfService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        $service = Service::where('user_id', Auth::id())->first();
        
        if (!$service) {
            return redirect()->route('dashboard')
                ->with('error', 'Please add a service first before creating products.');
        }

        return view('products.create', compact('service'));
    }

    public function store(Request $request){
        
        if (!Service::where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You must create service first.');
        }
        $request->validate([
            'name'=> 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category'=>'required|string',
            'price'=> 'required|numeric|min:0',
            'service_id'=> 'required|exists:services,id',
        ]);
        
        if (!Storage::exists('public/products')) {
            Storage::makeDirectory('public/products');
        }
        $imagePath = $request->file('image')->store('products', 'public');

        $product = ProductOfService::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'category' => $request->category,
            'image' => $imagePath,
            'price' => $request->price,
        ]);
        if (!$product) {
            return back()->with('error','cannot create product');
        }
        return redirect()->route('dashboard')->with('success','Product created successfully!');
    }
    public function edit($id)
{
    $product = ProductOfService::findOrFail($id);
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = ProductOfService::findOrFail($id);
    $product->name = $request->name;
    $product->category = $request->category;
    $product->price = $request->price;

    if ($request->hasFile('image')) {
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $save = $product->save();
    if (!$save) {
        return back()->with('error', 'Cannot update product');
    }
    return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    $product = ProductOfService::find($id);

    if (!$product) {
        return redirect()->route('dashboard')->with('error', 'Product not found.');
    }

    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
}

}
