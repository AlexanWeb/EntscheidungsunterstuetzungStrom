<?php

namespace App\Http\Controllers\account;

use App\Models\PowerPlant;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PowerPlantController extends Controller
{
    public function index(){
        return view('account.powerplant.index');
    }

################ Start Test #######################
    public function getMachine($user_id){

        ###### get User ############
        $user = User::find($user_id);

        ########### get Machines ##########

        $machins = $user->powerplants;

        ############### get user and machins ########

        // find alle powerplants for eine bestimmte user
        $user = User::with('powerplants')->find($user_id);
        return $user;
    }
    ############## End Test ####################

    public function store(Request $request){

        $rules = [
            'power_plant_name' => 'required|max:225', // string maximal 225
            'type_powerplant' => 'required|max:225', // string maximal 225
            'marginal_cost' => 'numeric', // nur Nummer eingeben
            'test1' => 'numeric', // nur Nummer eingeben
            'test2' => 'numeric', // nur Nummer eingeben
            'test3' => 'numeric', // nur Nummer eingeben
            'test4' => 'numeric', // nur Nummer eingeben
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }

        PowerPlant::create([
            'name' => $request['power_plant_name'],
            'type' => $request['type_powerplant'],
            'marginal_cost' => $request['marginal_cost'],
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('powerplant.index')->with('success', 'your machine has been added');
    }



    public function show(){

        return view('account.powerplant.show');
    }


    public function powerplants(int $id){

        $poweplant = PowerPlant::find($id);

        return view('account.powerplant.edit')->with('powerplant',$poweplant);
    }

    public function showToEdit(int $id){

        $poweplant = PowerPlant::find($id);


        return view('account.powerplant.edit')->with('powerplant',$poweplant);
    }

    public function edit(Request $request){

        $rules = [
            'power_plant_name' => 'required|max:225',
            'type_powerplant' => 'required|max:225',
            'marginal_cost' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }

        PowerPlant::where('id', $request->id)->update([
            'name' => $request['power_plant_name'],
            'type' => $request['type_powerplant'],
            'marginal_cost' => $request['marginal_cost'],
        ]);

        return redirect()->route('powerplant.show')->with('success', 'your machine has been updated');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $powerplant = PowerPlant::find($id);
        //$post = Post::findOrFail($id);
        $powerplant->delete();

        return redirect()->route('powerplant.show')->with('success', 'your machine has been deleted');

    }
}
