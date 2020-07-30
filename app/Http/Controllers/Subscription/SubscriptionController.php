<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){

        $plans = Plan::active()->get();

        return view('subscriptions.index', compact('plans'));
    }

    public function store(){

        $plans = Plan::active()->get();
        return view('subscriptions.index', compact('plans'));
    }
}
