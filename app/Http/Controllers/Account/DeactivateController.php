<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeactivateAccountRequest;
use Illuminate\Http\Request;

class DeactivateController extends Controller
{
    public function index() {
        return view('account.deactivate.index');
    }

    public function store(DeactivateAccountRequest $request) {
        $request->user()->delete();

        return redirect('/')->with('success', 'your account has been deactivated');
    }
}
