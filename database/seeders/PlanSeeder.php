<?php

namespace Database\Seeders;

use App\Models\Feature;
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
        $plans = [
            [
                'name' => 'Free',
                'description' => 'This is free plan which has email limit upto 500',
                'price' => 0,
                'email_limit' => 500,
            ],
            [
                'name' => 'Silver',
                'description' => 'Silver plan have limit upto 10k emails',
                'price' => 2999,
                'email_limit' => 10000,
            ],
            [
                'name' => 'Platinum',
                'description' => 'Platinum plan have email limit upto 15k',
                'price' => 3499,
                'email_limit' => 15000,
            ],
            [
                'name' => 'Gold',
                'description' => 'This gold plan have limit of email verification upto 30k',
                'price' => 4999,
                'email_limit' => 30000,
            ],
        ];

        foreach ($plans as $plan) {
            $planModel = Plan::updateOrCreate(
                ['name' => $plan['name']],
                [
                    'description' => $plan['description'],
                    'price' => $plan['price'],
                ]
            );
            Feature::updateOrCreate(
                ['plan_id' => $planModel->id],
                ['email_limit' => $plan['email_limit']]
            );
        }
    }
}
