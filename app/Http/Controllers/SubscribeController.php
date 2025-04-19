<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Services\MockStripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    //
    public function __construct(protected MockStripeService $stripe) {}

    public function index()
    {
        $plans = Plan::all();
        $subscription = Auth::user()->subscription;

        return view('subscriptions.index', compact('plans', 'subscription'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'payment_token' => 'required',
        ]);

        $plan = Plan::find($request->plan_id);

        try {
            $stripeSubscription = $this->stripe->createSubscription(
                Auth::user(),
                $plan->stripe_price_id,
                $request->payment_token
            );

            // Create local subscription
            Subscription::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'plan_id' => $plan->id,
                    'stripe_id' => $stripeSubscription['id'],
                    'stripe_status' => $stripeSubscription['status'],
                    'stripe_price' => $plan->stripe_price_id,
                ]
            );

            return redirect()->route('subscriptions.index')->with('success', 'Subscription created!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        $subscription = Auth::user()->subscription;

        if (!$subscription) {
            return back()->with('error', 'No active subscription');
        }

        $this->stripe->cancelSubscription($subscription->stripe_id);
        $subscription->update(['ends_at' => now()->addMonth()]);

        return back()->with('success', 'Subscription will cancel at period end');
    }
}
