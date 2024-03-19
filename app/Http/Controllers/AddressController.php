<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::all();

        return view('Address.Addresses', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('address.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
        'type' => 'required|string',
        'address1' => 'required|string',
        'address2' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'country' => 'required|string',
        'postal_code' => 'required|int'
        
    ]);



        $address = new Address;
        $address->user_id = auth()->id();
        $address->order_id = auth('order')->id();
        $address->type = $request->type;
        $address->address1 = ($request->address1);
        $address->addres2 = $request->address2;
        $address->city = $request->city;
        $address->state = ($request->state);
        $address->country = $request->country;
        $address->postal_code = $request->postal_code;
        

        
        $address->save();
        return redirect()->back()->withSuccess('Address Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('address.create', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'type' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|int'
            
        ]);
    
        
            $address->fill($request->all());
            $address->save();
            return redirect()->back()->withSuccess('Address edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back()->withSuccess('Address Deleted.');
    }
}
