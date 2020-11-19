<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
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

    public function edit( $id )
    {
        // TODO: use route model binding
        $user = User::with('roles')->findOrFail( $id );

        $roles = Role::all();

        return view( 'admin.user.roles', compact( 'user', 'roles' ) );
    }

    public function update( $id, Request $request )
    {
        $roles = $request->get( 'roles', [] );

        $user = User::findOrFail( $id );
        $user->roles()->sync( $roles ); // this does the trick

        return redirect()->back()->with( 'info', 'success' );
    }
}
