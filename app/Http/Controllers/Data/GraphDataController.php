<?php

namespace App\Http\Controllers\Data;

use App\Charts\GraphDataChart;
use App\Http\Controllers\Controller;
use App\Models\Data\Price\Prices_Day_Ahead;
use Illuminate\Http\Request;

class GraphDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('charts.input');

    }


    public function store(Request $request)
    {
        if($request->type_sale == "day_Ahead"){
            return $this->day_ahead_Data($request);
        } elseif ($request->type_sale == "intraday"){
            return $request;
        }
    }

    public function day_ahead_Data(Request $request){

        $start_date = date("Y-m-d", strtotime($request->start_day));
        $end_date = date("Y-m-d", strtotime($request->end_day));

        // $diff=date_diff($request->start_day,$request->today);
        $prices = Prices_Day_Ahead::whereBetween('Day', [$start_date, $end_date])->get();
        $prices = collect($prices);

        $labels = $prices->transform(function ($temp) {
            $data = [];
            $data[$temp->Day . ':Hour 01'] = round($temp->Hour_1 / 1000, 4);
            $data[$temp->Day . ':Hour 02'] = round($temp->Hour_2 / 1000, 4);
            $data[$temp->Day . ':Hour 03A'] = round($temp->Hour_3A / 1000, 4);
            $data[$temp->Day . ':Hour 03B'] = round($temp->Hour_3B / 1000, 4);
            $data[$temp->Day . ':Hour 04'] = round($temp->Hour_4 / 1000, 4);
            $data[$temp->Day . ':Hour 05'] = round($temp->Hour_5 / 1000, 4);
            $data[$temp->Day . ':Hour 06'] = round($temp->Hour_6 / 1000, 4);
            $data[$temp->Day . ':Hour 07'] = round($temp->Hour_7 / 1000, 4);
            $data[$temp->Day . ':Hour 08'] = round($temp->Hour_8 / 1000, 4);
            $data[$temp->Day . ':Hour 09'] = round($temp->Hour_9 / 1000, 4);
            $data[$temp->Day . ':Hour 10'] = round($temp->Hour_10 / 1000, 4);
            $data[$temp->Day . ':Hour 11'] = round($temp->Hour_11 / 1000, 4);
            $data[$temp->Day . ':Hour 12'] = round($temp->Hour_12 / 1000, 4);
            $data[$temp->Day . ':Hour 13'] = round($temp->Hour_13 / 1000, 4);
            $data[$temp->Day . ':Hour 14'] = round($temp->Hour_14 / 1000, 4);
            $data[$temp->Day . ':Hour 15'] = round($temp->Hour_15 / 1000, 4);
            $data[$temp->Day . ':Hour 16'] = round($temp->Hour_16 / 1000, 4);
            $data[$temp->Day . ':Hour 17'] = round($temp->Hour_17 / 1000, 4);
            $data[$temp->Day . ':Hour 18'] = round($temp->Hour_18 / 1000, 4);
            $data[$temp->Day . ':Hour 19'] = round($temp->Hour_19 / 1000, 4);
            $data[$temp->Day . ':Hour 20'] = round($temp->Hour_20 / 1000, 4);
            $data[$temp->Day . ':Hour 21'] = round($temp->Hour_21 / 1000, 4);
            $data[$temp->Day . ':Hour 22'] = round($temp->Hour_22 / 1000, 4);
            $data[$temp->Day . ':Hour 23'] = round($temp->Hour_23 / 1000, 4);
            $data[$temp->Day . ':Hour 24'] = round($temp->Hour_24 / 1000, 4);
            return $data;
        });

        $result = call_user_func_array("array_merge", $labels->all());
        $keys = array_keys($result);
        $values = array_values($result);
        //return $diff;
        return view('charts.test', compact("keys", "values"));
    }

}
