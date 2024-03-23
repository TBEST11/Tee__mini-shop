<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscription = Subscription::all();

        return view('subscription.subscribes', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sunscribe'=> 'required|string'
            ]);
    
            $subscription = new Subscription();
            $subscription->status = $request->status;
            $subscription->save();
            return redirect()->back()->withSuccess('you have subscribed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        return view('subscription.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'subscribe'=> 'required|string'
            ]);

            
            $subscription->fill($request->all());
            $subscription->save();
            return redirect()->back()->withSuccess('subscription details edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->back()->withSuccess('subscription details Deleted.');
    }
}
