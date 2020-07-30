<?php

namespace App\Http\Controllers;

use App\Models\GraphData;
use App\Charts\GraphDataChart;

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
    public function index()
    {
        $db = GraphData::pluck('price','date');
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

        return view('home', ['chart' => $chart]);
    }
}
