<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription Plans') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6"></h1>

        @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
            {{ session('error') }}
        </div>
        @endif

        @if(auth()->user()->subscription)
        <div class="mb-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Current Subscription</h3>
            <p class="text-gray-700 dark:text-gray-300">Plan: <strong>{{ auth()->user()->subscription->plan->name }}</strong></p>
            <p class="text-gray-700 dark:text-gray-300">Status: <strong>{{ auth()->user()->subscription->stripe_status }}</strong></p>

            @if(auth()->user()->subscription->ends_at)
            <p class="text-red-500">Will cancel on: {{ auth()->user()->subscription->ends_at->format('Y-m-d') }}</p>
            @else
            <form action="{{ route('subscriptions.cancel') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Cancel Subscription
                </button>
            </form>
            @endif
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans as $plan)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $plan->name }}</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $plan->description }}</p>
                <p class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                    ${{ $plan->price }} / {{ $plan->interval }}
                </p>

                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="payment_token" value="success">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg w-full">
                        Subscribe
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>