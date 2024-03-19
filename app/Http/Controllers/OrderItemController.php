<?php

namespace App\Http\Controllers;

use App\Models\Order_item;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_items = Order_item::all();

        return view('order_item.order_items', compact('order_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order_item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->Validate([ 
            'quantity'=> 'required|int',
            'price'=> 'required|int',
            'total'=> 'required|int'
        ]);
            $order_item = new Order_item();
            $order_item->order_id = auth()->id();
            $order_item->product_id = auth()->id();
            $order_item->quantity = $request->quantity;
            $order_item->price = $request->price;
            $order_item->total = $request->total;
            $order_item->save();
            return redirect()->back()->withSuccess('Ordered Items taken successfully');
        
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Order_item $order_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_item $order_item)
    {
        return view('order_item.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order_item $order_item)
    {
        $request->Validate([ 
            'quantity'=> 'required|int',
            'price'=> 'required|int',
            'total'=> 'required|int'
        ]);

            $order_item->fill($request->all());
            $order_item->save();
            return redirect()->back()->withSuccess('Ordered Items edited successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order_item $order_item)
    {
        $order_item->delete();

        return redirect()->back()->withSuccess('Ordered items Deleted.');
    }
}
