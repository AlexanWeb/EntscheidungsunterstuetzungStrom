<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('/');
    }

    public function users(){
        $users = User::select('id', 'name', 'email')->get();


        return view('admin.user.users', compact('users'));
    }

    public function powerplants($id){
        $user = User::find($id);

        $powerplants = $user -> powerplants;

        return view('admin.user.powerplants', compact( 'powerplants'));
    }

    public function destroy(){
        return redirect('/');
    }
}
