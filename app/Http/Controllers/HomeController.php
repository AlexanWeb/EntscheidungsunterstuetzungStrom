<?php

namespace App\Http\Controllers;

use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\GraphData;
use App\Charts\GraphDataChart;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Isset_;

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
        $tempvar = file_get_contents("https://api.awattar.de/v1/marketdata");
        $tempvar = str_replace("}", "", $tempvar);
        $tempvar = explode ("{",$tempvar);
        $startVars = [];
        $prices = [];
        for ($i = 2; $i < count($tempvar); $i++) {
            $startVars[$i-2] =date("Y-m-d",  explode (":", explode(",", $tempvar[$i])[1])[1]);
            $prices[$i-2] =   explode(":", explode (",",$tempvar[$i])[2])[1];
        }
        $chart = new GraphDataChart;
        $chart->labels($startVars);
        $chart->dataset('TestChart', 'line', $prices);
        //For later use, this for test vaulues it will be fit to the test data
        //$prices_day_ahead = Prices_Day_Ahead::where('Day', '=>', Carbon::yesterday()->format('Y-m-d'))
        //    ->where('Day', '<', Carbon::tomorrow()->addDay()->format('Y-m-d'))->get();
        //$tempDate = Carbon::yesterday();
        $tempDate = '07.07.2020';
        if($request->filled('date_example')) {
            $tempDate = $request->date_example;
        }

        $prices_day_ahead = Prices_Day_Ahead::where('Day', '>=', date('Y-m-d', strtotime('-1 days',strtotime($tempDate))))
            ->where('Day', '<=', date('Y-m-d', strtotime('+1 days',strtotime($tempDate))))
            ->orderBy('Day')
            ->get();
        $maxDateArray = [];

        if (count($prices_day_ahead) == 3){
            for ($i = 0; $i < 3; $i++) {
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
        //echo ($prices_day_ahead->toArray())[0];
        if ($request->file('file')) {
            $file = $request->file('file')->getRealPath();
        }
        echo 'sadfg';
        echo  $request->file('file'). 'sdfhgdlfgjköl';
        //Assume a hit every time, might need some counter measure to prevent null data
        return view('home', ['chart' => $chart, 'dby'=>$prices_day_ahead[0]
            , 'dbt'=>$prices_day_ahead[1],'dbtm'=>$prices_day_ahead[2], 'hY' => $maxDateArray, 'test' => 'Hour_1' ]);
    }
}
