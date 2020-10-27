<?php

namespace App\Http\Controllers\Data;

use App\Charts\GraphDataChart;
use App\Http\Controllers\Controller;
use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;
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
            return $this->intrady_Data($request);

        }
    }

    public function intrady_Data(Request $request){

        $start_date = date("Y-m-d", strtotime($request->start_day));
        $end_date = date("Y-m-d", strtotime($request->end_day));

        // $diff=date_diff($request->start_day,$request->today);
        $prices = Prices_Interady::whereBetween('Day', [$start_date, $end_date])->get();
        $prices = collect($prices);

        $labels = $prices->transform(function ($temp) {
            $data = [];
            $data[$temp->Day . ':Hour 01 Q1'] = round($temp->Hour_1_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 01 Q2'] = round($temp->Hour_1_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 01 Q3'] = round($temp->Hour_1_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 01 Q4'] = round($temp->Hour_1_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 02 Q1'] = round($temp->Hour_2_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 02 Q2'] = round($temp->Hour_2_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 02 Q3'] = round($temp->Hour_2_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 02 Q4'] = round($temp->Hour_2_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 03 Q1'] = round($temp->Hour_3A_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 03 Q2'] = round($temp->Hour_3A_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 03 Q3'] = round($temp->Hour_3A_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 03 Q4'] = round($temp->Hour_3A_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 04 Q1'] = round($temp->Hour_4_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 04 Q2'] = round($temp->Hour_4_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 04 Q3'] = round($temp->Hour_4_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 04 Q4'] = round($temp->Hour_4_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 05 Q1'] = round($temp->Hour_5_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 05 Q2'] = round($temp->Hour_5_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 05 Q3'] = round($temp->Hour_5_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 05 Q4'] = round($temp->Hour_5_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 06 Q1'] = round($temp->Hour_6_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 06 Q2'] = round($temp->Hour_6_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 06 Q3'] = round($temp->Hour_6_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 06 Q4'] = round($temp->Hour_6_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 07 Q1'] = round($temp->Hour_7_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 07 Q2'] = round($temp->Hour_7_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 07 Q3'] = round($temp->Hour_7_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 07 Q4'] = round($temp->Hour_7_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 08 Q1'] = round($temp->Hour_8_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 08 Q2'] = round($temp->Hour_8_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 08 Q3'] = round($temp->Hour_8_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 08 Q4'] = round($temp->Hour_8_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 09 Q1'] = round($temp->Hour_9_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 09 Q2'] = round($temp->Hour_9_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 09 Q3'] = round($temp->Hour_9_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 09 Q4'] = round($temp->Hour_9_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 10 Q1'] = round($temp->Hour_10_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 10 Q2'] = round($temp->Hour_10_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 10 Q3'] = round($temp->Hour_10_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 10 Q4'] = round($temp->Hour_10_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 11 Q1'] = round($temp->Hour_11_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 11 Q2'] = round($temp->Hour_11_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 11 Q3'] = round($temp->Hour_11_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 11 Q4'] = round($temp->Hour_11_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 12 Q1'] = round($temp->Hour_12_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 12 Q2'] = round($temp->Hour_12_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 12 Q3'] = round($temp->Hour_12_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 12 Q4'] = round($temp->Hour_12_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 13 Q1'] = round($temp->Hour_13_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 13 Q2'] = round($temp->Hour_13_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 13 Q3'] = round($temp->Hour_13_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 13 Q4'] = round($temp->Hour_13_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 14 Q1'] = round($temp->Hour_14_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 14 Q2'] = round($temp->Hour_14_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 14 Q3'] = round($temp->Hour_14_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 14 Q4'] = round($temp->Hour_14_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 15 Q1'] = round($temp->Hour_15_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 15 Q2'] = round($temp->Hour_15_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 15 Q3'] = round($temp->Hour_15_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 15 Q4'] = round($temp->Hour_15_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 16 Q1'] = round($temp->Hour_16_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 16 Q2'] = round($temp->Hour_16_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 16 Q3'] = round($temp->Hour_16_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 16 Q4'] = round($temp->Hour_16_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 17 Q1'] = round($temp->Hour_17_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 17 Q2'] = round($temp->Hour_17_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 17 Q3'] = round($temp->Hour_17_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 17 Q4'] = round($temp->Hour_17_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 18 Q1'] = round($temp->Hour_18_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 18 Q2'] = round($temp->Hour_18_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 18 Q3'] = round($temp->Hour_18_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 18 Q4'] = round($temp->Hour_18_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 19 Q1'] = round($temp->Hour_19_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 19 Q2'] = round($temp->Hour_19_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 19 Q3'] = round($temp->Hour_19_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 19 Q4'] = round($temp->Hour_19_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 20 Q1'] = round($temp->Hour_20_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 20 Q2'] = round($temp->Hour_20_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 20 Q3'] = round($temp->Hour_20_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 20 Q4'] = round($temp->Hour_20_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 21 Q1'] = round($temp->Hour_21_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 21 Q2'] = round($temp->Hour_21_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 21 Q3'] = round($temp->Hour_21_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 21 Q4'] = round($temp->Hour_21_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 22 Q1'] = round($temp->Hour_22_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 22 Q2'] = round($temp->Hour_22_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 22 Q3'] = round($temp->Hour_22_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 22 Q4'] = round($temp->Hour_22_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 23 Q1'] = round($temp->Hour_23_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 23 Q2'] = round($temp->Hour_23_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 23 Q3'] = round($temp->Hour_23_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 23 Q4'] = round($temp->Hour_23_Q4 / 1000, 4);
            $data[$temp->Day . ':Hour 24 Q1'] = round($temp->Hour_24_Q1 / 1000, 4);
            $data[$temp->Day . ':Hour 24 Q2'] = round($temp->Hour_24_Q2 / 1000, 4);
            $data[$temp->Day . ':Hour 24 Q3'] = round($temp->Hour_24_Q3 / 1000, 4);
            $data[$temp->Day . ':Hour 24 Q4'] = round($temp->Hour_24_Q4 / 1000, 4);
            return $data;
        });

        $result = call_user_func_array("array_merge", $labels->all());
        $keys = array_keys($result);
        $values = array_values($result);
        //return $diff;
         //return dd($values);
        return view('charts.test', compact("keys", "values"));
    }



    public function day_ahead_Data(Request $request){

        $start_date = date("Y-m-d", strtotime($request->start_day));
        $end_date = date("Y-m-d", strtotime($request->end_day));
        $today = date("Y-m-d", strtotime($request->today));

        // $diff=date_diff($request->start_day,$request->today);
        $prices = Prices_Day_Ahead::whereBetween('Day', [$start_date, $end_date])->get();
        $prices = collect($prices);

        $labels = $prices->transform(function ($temp) {
            $data = [];
            $data[$temp->Day . ':Hour 01'] = round($temp->Hour_1 / 1000, 4);
            $data[$temp->Day . ':Hour 02'] = round($temp->Hour_2 / 1000, 4);
            $data[$temp->Day . ':Hour 03'] = round($temp->Hour_3A / 1000, 4);
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
        return view('charts.test', compact("keys", "values",  "start_date", "end_date", "today"));
    }

}
