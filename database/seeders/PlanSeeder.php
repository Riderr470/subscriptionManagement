<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Plan::create([
            'id' => '1',
            'name' => 'Basic Monthly',
            'description' => 'Basic features, billed monthly',
            'price' => 10.00,
            'interval' => 'month',
            'stripe_price_id' => 'price_basic_monthly',
        ]);

        Plan::create([
            'id' => '2',
            'name' => 'Pro Monthly',
            'description' => 'All features, billed monthly',
            'price' => 25.00,
            'interval' => 'month',
            'stripe_price_id' => 'price_pro_monthly',
        ]);

        Plan::create([
            'id' => '3',
            'name' => 'Pro Yearly',
            'description' => 'All features, billed yearly (save 20%)',
            'price' => 240.00,
            'interval' => 'year',
            'stripe_price_id' => 'price_pro_yearly',
        ]);
    }
}
