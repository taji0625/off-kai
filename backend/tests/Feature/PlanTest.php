<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Plan;

class PlanTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPlanCreateTest()
    {
        $plan = new Plan;
        $plan->title = "オフラインもくもく会";
        $plan->venue = "山田珈琲";
        $plan->meeting_date_time = "2021-03-27 18:00:00";
        $plan->prefecture = "東京都";
        $plan->address = "渋谷区道玄坂1-2-3";
        $plan->membership_fee = "3000円";
        $plan->capacity = 5;
        $plan->age = "20代限定";
        $plan->body = str_repeat('a', 80);
        $plan->user_id = 1;
        $plan->save();

        $readPlan = Plan::where('title', 'オフラインもくもく会')->first();
        $this->assertNotNull($readPlan);

        Plan::where('title', 'オフラインもくもく会')->delete();
    }
}
