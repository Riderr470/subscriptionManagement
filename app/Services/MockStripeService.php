<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;

class MockStripeService
{
    public function createSubscription($user, $planStripePriceId, $paymentMethodToken)
    {
        // Simulate payment failure
        if ($paymentMethodToken === 'fail') {
            throw new Exception('Payment failed: Card was declined');
        }

        // Return mock subscription data
        return [
            'id' => 'sub_' . Str::random(14),
            'status' => 'active',
            'current_period_end' => now()->addMonth()->timestamp,
            'cancel_at_period_end' => false,
        ];
    }

    public function cancelSubscription($subscriptionId)
    {
        return [
            'id' => $subscriptionId,
            'status' => 'active',
            'cancel_at_period_end' => true,
        ];
    }
}
