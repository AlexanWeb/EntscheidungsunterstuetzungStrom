<?php

namespace App\Http\Controllers;

use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;


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


        $end_pda = \DB::table('prices__day__aheads')->orderBy('Day','desc')->first('Day');
        $end_pda = date("Y-m-d", strtotime($end_pda->Day));
        $start_pda = \DB::table('prices__day__aheads')->orderBy('Day','asc')->first('Day');
        $start_pda = date("Y-m-d", strtotime($start_pda->Day));

        $end_pid = \DB::table('prices__interadies')->orderBy('Day','desc')->first('Day');
        $end_pid = date("Y-m-d", strtotime($end_pid->Day.' -1 day'));
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


        $tempDate = '07.07.2020';
        if($request->filled('date_example')) {
            $tempDate = $request->date_example;
        }

        $prices_day_ahead = Prices_Day_Ahead::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
            ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
            ->orderBy('Day')
            ->get();
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


        $prices_interady = Prices_Interady::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
            ->where('Day', '<=', date('Y-m-d', strtotime('+2 days',strtotime($tempDate))))
            ->orderBy('Day')
            ->get();
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
                //$maxDateArray[] = $dateMax;
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
