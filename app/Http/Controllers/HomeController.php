<?php

namespace App\Http\Controllers;

use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;


use App\Models\Data\Price\Pricesdayahdead__prediction;
use App\Models\Data\Price\Pricesinteradays__prediction;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        $test_pda = \DB::table('prices__day__aheads')->first();
        $test_pid = \DB::table('prices__interadies')->first();


        if(!$test_pid || !$test_pda){

            return view('dashboard');
        }else{

            $end_pda = \DB::table('prices__day__aheads')->orderBy('Day','desc')->first('Day');
            $end_pda = date("Y-m-d", strtotime($end_pda->Day));
            $start_pda = \DB::table('prices__day__aheads')->orderBy('Day','asc')->first('Day');
            $start_pda = date("Y-m-d", strtotime($start_pda->Day));

            $end_pid = \DB::table('prices__interadies')->orderBy('Day','desc')->first('Day');

            // the last day in old data in preices interadays
            $end_pid_table = $end_pid->Day;
            $end_pid = date("Y-m-d", strtotime($end_pid->Day.' -2 day'));
            $start_pid = \DB::table('prices__interadies')->orderBy('Day','asc')->first('Day');
            $start_pid = date("Y-m-d", strtotime($start_pid->Day.' +1 day'));

            $end=$end_pda;
            $start=$start_pda;

            if ($end_pda>$end_pid){
                $end=$end_pid;
            }

            if ($start_pid>$start_pda){
                $start=$start_pid;
            }

            // check if we have predition Data
            $test_pid = \DB::table('pricesinteradays__predictions')->first();
            $test_pda = \DB::table('pricesdayahdead__predictions')->first();

            if ($test_pid && $test_pda){

                // last day of pricesinterdays predictions
                $end_pid_pred = \DB::table('pricesinteradays__predictions')->orderBy('Day','desc')->first('Day');
                $end_pid_pred = date("Y-m-d", strtotime($end_pid_pred->Day));

                // last day of pricesdayahdead predictions
                $end_pda_pred = \DB::table('pricesdayahdead__predictions')->orderBy('Day','desc')->first('Day');
                $end_pda_pred = date("Y-m-d", strtotime($end_pda_pred->Day));

                if ($end_pda_pred > $end){
                    $end = $end_pda_pred;
                    if ($end_pid_pred < $end_pda_pred){
                        $end = $end_pid_pred;
                        $end = date("Y-m-d", strtotime($end.' -2 day'));
                    }
                }
            }
            $tempDate = '04.05.2020';
            if($request->filled('date_example')) {
                $tempDate = $request->date_example;
            }



            // if the data are past data
            if(date('Y-m-d', strtotime('+2 days',strtotime($tempDate))) <= $end_pda){
                $prices_day_ahead = Prices_Day_Ahead::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
                    ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
                    ->orderBy('Day')
                    ->get();


            }

            // all data are predaction data
            elseif (date('Y-m-d', strtotime('-1 days',strtotime($tempDate))) > $end_pda){

                $prices_day_ahead = Pricesdayahdead__prediction::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
                    ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
                    ->orderBy('Day')
                    ->get();
            } else
            {
                return view('dashboard');
            }


            $maxDateArray = [];


            if (count($prices_day_ahead) == 4){
                for ($i = 0; $i < 4; $i++) {
                    //$dateMax = $prices_day_ahead[$i]['Day'];
                    $hourMax = array_search($prices_day_ahead[$i]['Maximum'] ,$prices_day_ahead->toArray()[$i]);
                    //$prices_day_ahead[0]['Maximum']
                    if (Isset($hourMax) && strcmp($hourMax,'Maximum') != 0) {
                        $hourMax = explode('_', $hourMax)[1];
                        //3600 are seconds in a hour
                        $hourMax = date('H:i', 3600 * $hourMax);
                    }
                    //$maxDateArray[] = $dateMax;
                    $maxDateArray[] = $hourMax;
                }
            }




            // if the data are past data
            if(date('Y-m-d', strtotime('+2 days',strtotime($tempDate))) <= $end_pid_table){
                $prices_interady = Prices_Interady::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
                    ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
                    ->orderBy('Day')
                    ->get();

            }

            // all data are predaction data
            elseif (date('Y-m-d', strtotime('-1 days',strtotime($tempDate))) > $end_pid_table){

                $prices_interady = Pricesinteradays__prediction::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
                    ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
                    ->orderBy('Day')
                    ->get();

            } else
            {
                return view('dashboard');
            }



            $maxDateArray_pid = [];


            if (count($prices_interady) == 4){
                for ($i = 0; $i < 4; $i++) {
                    //$dateMax = $prices_day_ahead[$i]['Day'];
                    $hourMax = array_search($prices_interady[$i]['Maximum'] ,$prices_interady->toArray()[$i]);
                    //$prices_day_ahead[0]['Maximum']
                    if (Isset($hourMax) && strcmp($hourMax,'Maximum') != 0) {
                        $QuartarMax = explode('_', $hourMax)[2];
                        $hourMax = explode('_', $hourMax)[1];
                        //3600 are seconds in a hour
                        // $hourMax = date('H:i', 3600 * $hourMax);
                        $hourMax = $hourMax.'_'.$QuartarMax;
                    }
                    $maxDateArray_pid[] = $hourMax;
                }
            }

            //Assume a hit every time, might need some counter measure to prevent null data
            return view('home',
                [ 'end' =>$end, 'start' =>$start,
                    'dby'=>$prices_day_ahead[0], 'dbt'=>$prices_day_ahead[1],'dbtm'=>$prices_day_ahead[2],'dbtum'=>$prices_day_ahead[3], 'hY' => $maxDateArray,
                    'dby_pid'=>$prices_interady[0], 'dbt_pid'=>$prices_interady[1],'dbtm_pid'=>$prices_interady[2],'dbtum_pid'=>$prices_interady[3], 'hY_pid' => $maxDateArray_pid]);
        }

    }
}
