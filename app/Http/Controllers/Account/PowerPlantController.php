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
            'marginal_cost' => 'required_without_all:cost,returns,interest,investment|numeric|nullable', // nur Nummer eingeben
            'investment' => 'required_without:marginal_cost|numeric|nullable',
            'interest' => 'required_without:marginal_cost|numeric|nullable',
            'cost' => 'required_without:marginal_cost|regex:/^[0-9]+(\;[0-9]+)*$/|nullable',
            'returns' => 'required_without:marginal_cost|regex:/^[0-9]+(\;[0-9]+)*$/|nullable',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }
        $marginal_cost_calc = 0;

        if (empty($request['investment'])) { // Can expect all do be filled thus only testing one
            $marginal_cost_calc = $request['marginal_cost'];
        } else {
            $returns = explode(';', $request['returns']);
            $cost = explode(';', $request['cost']);
            if(count($returns) == count($cost)){
                $fitted_returns = 0;
                $fitted_costs = 0;
                for ($i = 1; $i <= count($returns); $i++) {

                    $fitted_returns += $returns[$i-1]/pow((1+($request['interest']/100)), $i);
                    $fitted_costs += $cost[$i-1]/pow((1+($request['interest']/100)),$i);

                    $marginal_cost_calc =($fitted_costs + $request['investment'])/ $fitted_returns;
                    $marginal_cost_calc = round($marginal_cost_calc, 3);
                }
            } else {
                return redirect()->route('powerplant.index')->with('error', 'Annual values must be the same number for cost and returns');
            }
        }

        PowerPlant::create([
            'name' => $request['power_plant_name'],
            'type' => $request['type_powerplant'],
            'marginal_cost' => $marginal_cost_calc,
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
            'power_plant_name' => 'required|max:225', // string maximal 225
            'type_powerplant' => 'required|max:225', // string maximal 225
            'marginal_cost' => 'required_without_all:cost,returns,interest,investment|numeric|nullable', // nur Nummer eingeben
            'investment' => 'required_without:marginal_cost|numeric|nullable',
            'interest' => 'required_without:marginal_cost|numeric|nullable',
            'cost' => 'required_without:marginal_cost|regex:/^[0-9]+(\;[0-9]+)*$/|nullable',
            'returns' => 'required_without:marginal_cost|regex:/^[0-9]+(\;[0-9]+)*$/|nullable',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }
        $marginal_cost_calc = 0;

        if (empty($request['investment'])) { // Can expect all do be filled thus only testing one
            $marginal_cost_calc = $request['marginal_cost'];
        } else {
            $returns = explode(';', $request['returns']);
            $cost = explode(';', $request['cost']);
            if(count($returns) == count($cost)){
                $fitted_returns = 0;
                $fitted_costs = 0;
                for ($i = 1; $i <= count($returns); $i++) {

                    $fitted_returns += $returns[$i-1]/pow((1+($request['interest']/100)), $i);
                    $fitted_costs += $cost[$i-1]/pow((1+($request['interest']/100)),$i);

                    $marginal_cost_calc =($fitted_costs + $request['investment'])/ $fitted_returns;
                    $marginal_cost_calc = round($marginal_cost_calc, 3);
                }
            } else {
                return redirect()->route('powerplant.show')->with('error', 'Annual values must be the same number for cost and returns');
            }
        }

        PowerPlant::where('id', $request->id)->update([
            'name' => $request['power_plant_name'],
            'type' => $request['type_powerplant'],
            'marginal_cost' => $marginal_cost_calc,
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
