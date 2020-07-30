<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivationResendRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ActivationResendController extends Controller
{
    public function index(){
        return view('auth.activation.resend.index');
    }

    public function  store(ActivationResendRequest $request){
        $user = User::where('email', $request->email)->first();

        if (optional($user->hasNotActivated())){
            event(new UserRequestedActivationEmail($user));
        }

        return redirect()->route('activation.resend')->with('success', 'An activation Mail has been send');
    }

}
