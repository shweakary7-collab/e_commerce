<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('view products')) {
            abort(403, 'You do not have permission to view products.');
        }
        $products = Product::latest()->paginate(15);
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('create products')) {
            abort(403, 'You do not have permission to create products.');
        }
        $categories = Product::getCategories();
        unset($categories['all']);
        return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('create products')) {
            abort(403, 'You do not have permission to create products.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . uniqid();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        
        Product::create($data);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('view products')) {
            abort(403, 'You do not have permission to view products.');
        }
        $product = Product::findOrFail($id);
        return view('backend.products.show', compact('product'));
    }

    public function edit($id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('edit products')) {
            abort(403, 'You do not have permission to edit products.');
        }
        $product = Product::findOrFail($id);
        $categories = Product::getCategories();
        unset($categories['all']);
        return view('backend.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('edit products')) {
            abort(403, 'You do not have permission to edit products.');
        }
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        
        $product->update($data);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('delete products')) {
            abort(403, 'You do not have permission to delete products.');
        }
        $product = Product::findOrFail($id);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}