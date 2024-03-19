<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();

        return view('payment.payments', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method'=> 'required|string',
            'transaction_id'=> 'required|string',
            'amount'=> 'required|int',
            'status'=> 'required|string'
        ]);
        $payment = new Payment();
            $payment->order_id = auth()->id();
            $payment->payment_method = $request->payment_method;
            $payment->transactio_id = $request->transactio_id;
            $payment->amount = $request->amount;
            $payment->status = $request->status;
            $payment->save();
            return redirect()->back()->withSuccess('Ordered Items taken successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_method'=> 'required|string',
            'transaction_id'=> 'required|string',
            'amount'=> 'required|int',
            'status'=> 'required|string'
        ]);
        $payment->fill($request->all());
        $payment->save();
        return redirect()->back()->withSuccess('Payment edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->back()->withSuccess('Ordered items Deleted.');
    }
}
