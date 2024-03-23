<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();

        // return view('product.products', compact('products'));
        return view('product.products');
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string', 
            'description' => 'required|string',
            'price' => 'required|int',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'category' => 'required|string'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $filename = $this->imageUpload($request);
        $product->image = $filename;
        $product->category = auth()->id();
        $product->save();
        return redirect()->back()->withSuccess('Prdoduct Added');

    }

        protected function imageUpload($request): string
        {
            if($request->hasfile('image')){
                $file=$request->file('image');
                $filename = time() . '.' .$file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
                return $filename;
            }
            return null;
        }

    /**
     * Display the specified resource.
     */
    public function show(Product $product )
    {
        return view('product.product_details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string', 
            'description' => 'required|string',
            'price' => 'required|int',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'category' => 'required|string'
        ]);

        $newFile= $product->image;
        if ($request->hasFile('image')) {
            //If new image is selected, remove the old one from path and 
            //then upload new one and update information accordingly
            $oldFilePath = $product->image;
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }
            $newFile = $this->imageUpload($request);
        }
        

        $product->fill([
            'name' => $request->name,
            'description' => $request->discription,
            'price'=> $request->price,
            'image' => $newFile,
            'category'=>$request->auth()->id()
        ])->save();

        return redirect()->back()->withSuccess('Product details Edited successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->withSuccess('Product Deleted.');
    }
}
