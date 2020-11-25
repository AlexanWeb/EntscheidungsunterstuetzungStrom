<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\MarketValues;
use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;
use App\Models\Data\Price\Pricesdayahdead__prediction;
use App\Models\Data\Price\Pricesinteradays__prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \DateTime;


class GraphDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $test_pda = \DB::table('prices__day__aheads')->first();
        $test_pid = \DB::table('prices__interadies')->first();
        if(!$test_pda) {

            return view('dashboard');
        } else{
            $pid_data = '';
            if(!$test_pid){
                $pid_data = 'disabled';
            }
            $end = \DB::table('prices__day__aheads')->orderBy('Day','desc')->first('Day');
            $end = date("d-m-Y", strtotime($end->Day));

            $test_pda_pre = \DB::table('pricesdayahdead__predictions')->first();

            if($test_pda_pre){
                $end_pda_pre = \DB::table('pricesdayahdead__predictions')->orderBy('Day','desc')->first('Day');
                $end_pda_pre = date("d-m-Y", strtotime($end_pda_pre->Day));
                if($end_pda_pre > $end){
                    $end = $end_pda_pre;
                }
            }

            $start = \DB::table('prices__day__aheads')->orderBy('Day','asc')->first('Day');
            $start = date("d-m-Y", strtotime($start->Day));



            return view('charts.input', compact('end', 'start', 'pid_data'));
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBoxplot ()
    {

        $test_pda = \DB::table('prices__day__aheads')->first();
        $test_pid = \DB::table('prices__interadies')->first();
        // dd(count($test_pda->isEmpty()));
        // dd((count($test_pda) > 0 && $test_pid->isEmpty()));
        if(!$test_pid || !$test_pda) {

            return view('dashboard');
        } else{

            $end_pda = \DB::table('prices__day__aheads')->orderBy('Day','desc')->first('Day');
            $end_pda = date("Y-m-d", strtotime($end_pda->Day));
            $start_pda = \DB::table('prices__day__aheads')->orderBy('Day','asc')->first('Day');
            $start_pda = date("Y-m-d", strtotime($start_pda->Day));

            $end_pid = \DB::table('prices__interadies')->orderBy('Day','desc')->first('Day');
            $end_pid = date("Y-m-d", strtotime($end_pid->Day));
            $start_pid = \DB::table('prices__interadies')->orderBy('Day','asc')->first('Day');
            $start_pid = date("Y-m-d", strtotime($start_pid->Day));

            $end=$end_pda;
            $start=$start_pda;

            if ($end_pda>$end_pid){
                $end=$end_pid;
            }

            if ($start_pid>$start_pda){
                $start=$start_pid;
            }

            $end= date("m-Y", strtotime($end));
            $start=date("m-Y", strtotime($start));


            return view('charts.inputBoxPlot', compact('end', 'start'));
        }

    }


    public function store(Request $request)
    {
        $rules = [
            'type_sale' => 'required',
            'start_day' => 'required|date_format:d-m-Y|before:end_day',
            'end_day' => 'required|date_format:d-m-Y|after:start_day'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }


        if($request->type_sale == "day_Ahead"){
            return $this->day_ahead_Data($request);
        } elseif ($request->type_sale == "intraday"){
            return $this->intrady_Data($request);

        }
    }

    public function intrady_Data(Request $request){

        $start_date = date("Y-m-d", strtotime($request->start_day));
        $end_date = date("Y-m-d", strtotime($request->end_day));

        // get marketvalues from start day to end day
        $marketValues = $this->getMarketValues($start_date, $end_date);

        $end_pid = \DB::table('prices__interadies')->orderBy('Day','desc')->first('Day')->Day;

        if($end_date > $end_pid){

            $end_pid_pred = \DB::table('pricesinteradays__predictions')->orderBy('Day','desc')->first('Day');
            $end_pid_pred = date("Y-m-d", strtotime($end_pid_pred->Day));

            // end data not in DB, gelt the end data like the last day in Prediction data
            if($end_date > $end_pid_pred){
                $end_date = $end_pid_pred;
            }
            $prices_past = Prices_Interady::whereBetween('Day', [$start_date, $end_pid])->orderBy('Day','desc')->get();

            //get start day of prediction data
            $start_pred = date("Y-m-d", strtotime($end_pid.' +1 day'));

            // get prediction Data
            $prices_pred = Pricesinteradays__prediction::whereBetween('Day', [$start_pred, $end_date])->orderBy('Day','desc')->get();


            $prices = collect($prices_pred->merge($prices_past));
        }else{
            $start_pred= null;
            $prices = Prices_Interady::whereBetween('Day', [$start_date, $end_date])->orderBy('Day','desc')->get();
            $prices = collect($prices);
        }

//        // user prediction data if give today
//        if($request->today){
//            $today = date("Y-m-d", strtotime($request->today));
//            // check if the table fpr prediction not empty
//            $test_pid_pre = \DB::table('pricesinteradays__predictions')->first();
//
//            if($test_pid_pre){
//                $prices_pred = Pricesinteradays__prediction::whereBetween('Day', [$today, $end_date])->orderBy('Day','desc')->get();
//            }else{
//                $prices_pred = Prices_Interady::whereBetween('Day', [$today, $end_date])->orderBy('Day','desc')->get();
//            }
//
//            // today not from past data, it is from prediction data
//            $last_day_Past_data = date("Y-m-d", strtotime($today.' -1 day'));
//            $prices_past = Prices_Interady::whereBetween('Day', [$start_date, $last_day_Past_data])->orderBy('Day','desc')->get();
//
//            $prices = collect($prices_pred->merge($prices_past));
//
//         // not use prediction data if didn't give today
//        }else{
//            $today = date("Y-m-d", strtotime($request->today));
//
//            $prices = Prices_Interady::whereBetween('Day', [$start_date, $end_date])->orderBy('Day','desc')->get();
//            $prices = collect($prices);
//
//        }

        $prices->transform(function ($temp) {
            $data = [];
            for ($i = 1; $i < 25; $i++){
                if($i==3){
                    for($j = 1; $j < 5; $j++){
                        $data[$temp->Day . ':Hour 0'.$i.' Q'.$j] = round($temp['Hour_'.$i.'A_Q'.$j] / 1000, 4);
                    }
                }else{
                    for($j = 1; $j < 5; $j++){
                        if ($i < 10){
                            $data[$temp->Day . ':Hour 0'.$i.' Q'.$j] = round($temp['Hour_'.$i.'_Q'.$j] / 1000, 4);
                        }else{
                            $data[$temp->Day . ':Hour '.$i.' Q'.$j] = round($temp['Hour_'.$i.'_Q'.$j] / 1000, 4);
                        }

                    }
                }
            }

            return $data;
        });

        $prices->transform(function ($temp) {
            $data = [];
            $data = array_reverse($temp);
            return $data;
        });

        $prices = call_user_func_array("array_merge", $prices->all());

        // reverse the array
        $prices = array_reverse($prices);

        $keys = array_keys($prices);
        $values = array_values($prices);

        return view('charts.index', compact("keys", "values", "start_date", "end_date", "start_pred", "marketValues"));
    }



    public function day_ahead_Data(Request $request){

        $start_date = date("Y-m-d", strtotime($request->start_day));
        $end_date = date("Y-m-d", strtotime($request->end_day));

        $marketValues = $this->getMarketValues($start_date, $end_date);

        $end_pda = \DB::table('prices__day__aheads')->orderBy('Day','desc')->first('Day')->Day;

        if($end_date > $end_pda){
            $prices_past = Prices_Day_Ahead::whereBetween('Day', [$start_date, $end_pda])->orderBy('Day','desc')->get();
            $start_pred = date("Y-m-d", strtotime($end_pda.' +1 day'));
            $prices_pred = Pricesdayahdead__prediction::whereBetween('Day', [$start_pred, $end_date])->orderBy('Day','desc')->get();
            $prices = collect($prices_pred->merge($prices_past));
        }else{
            $start_pred= null;

            $prices = Prices_Day_Ahead::whereBetween('Day', [$start_date, $end_date])->orderBy('Day','desc')->get();
            $prices = collect($prices);
        }

        $prices->transform(function ($temp) {
            $data = [];

            for ($i = 1; $i < 25; $i++) {
                if ($i == 3) {
                    $data[$temp->Day . ':Hour 0' . $i] = round($temp['Hour_' . $i.'A'] / 1000, 4);

                } else {
                    if ($i < 10) {
                        $data[$temp->Day . ':Hour 0' . $i] = round($temp['Hour_' . $i] / 1000, 4);
                    } else {
                        $data[$temp->Day . ':Hour ' . $i] = round($temp['Hour_' . $i] / 1000, 4);
                    }
                }
            }


            /*$data[$temp->Day . ':Hour 01'] = round($temp->Hour_1 / 1000, 4);
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
            $data[$temp->Day . ':Hour 24'] = round($temp->Hour_24 / 1000, 4);*/
            return $data;
        });

        $prices->transform(function ($temp) {
            $data = [];
            $data = array_reverse($temp);
            return $data;
        });



        // Merge all arrays in one array
        $prices = call_user_func_array("array_merge", $prices->all());

        // reverse the array
        $prices = array_reverse($prices);

        $keys = array_keys($prices);

        $values = array_values($prices);
        //return $diff;
        return view('charts.index', compact("keys", "values",  "start_date", "end_date", "start_pred", "marketValues"));
    }


    /**
     * @param date $start_date
     * @param date $end_date
     * @return array
     */
    protected function getMarketValues($start_date, $end_date): array
    {
        // first day of the start month
        $firstday = date('Y-m-01', strtotime($start_date));

        $result = MarketValues::whereBetween('Date', [$firstday, $end_date])->get();

        $result = collect($result);

        $result->transform(function ($temp) {

            $data = [];

            $data[$temp->Month] = ['Month' => $temp->Month,
                'MW_EPEX' => $temp->MW_EPEX,
                'MW_Wind_Onshore' => $temp->MW_Wind_Onshore,
                'MW_Wind_Offshore' => $temp->MW_Wind_Offshore,
                'MW_Solar' => $temp->MW_Solar];
            return $data;
        });

        // Merge all arrays in one array
        $result = call_user_func_array("array_merge", $result->all());


        // dd(array_keys ( $result));


        $marketValues = array("MW_EPEX" => array(), "MW_Wind_Onshore" => array(), "MW_Wind_Offshore" => array(), "MW_Solar" => array());
        $marketValues["MW_EPEX"] = array_column($result, 'MW_EPEX', 'Month');
        $marketValues["MW_Wind_Onshore"] = array_column($result, 'MW_Wind_Onshore', 'Month');
        $marketValues["MW_Wind_Offshore"] = array_column($result, 'MW_Wind_Offshore', 'Month');
        $marketValues["MW_Solar"] = array_column($result, 'MW_Solar', 'Month');
        return $marketValues;
    }


    public function boxPlot(Request $request)
    {

        $rules = [
            'start_month' => 'required|date_format:m-Y|before:end_month',
            'end_month' => 'required|date_format:m-Y|after:start_month'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());;
        }

        $start = date("Y-m-d", strtotime('01-'.$request->start_month));
        $end = date("Y-m-t", strtotime('01-'.$request->end_month));

        $prices = Prices_Day_Ahead::whereBetween('Day', [$start, $end])->get(['Day','Minimum', 'Maximum']);
        $prices = collect($prices);

        $pdaMin = [];
        $pdaMax = [];

        foreach($prices as $arr) {
            $pdaMin[date("m",strtotime($arr->Day))][] = $arr->Minimum ;
            $pdaMax[date("m",strtotime($arr->Day))][] = $arr->Maximum ;
        }

        $data = [];
        foreach ($pdaMin as $key => $value){
            $dateObj = DateTime::createFromFormat('!m', $key);

            $data['pda'][$dateObj->format('F')]['min'] = min($value);
        }
        foreach ($pdaMax as $key => $value){
            $dateObj = DateTime::createFromFormat('!m', $key);

            $data['pda'][$dateObj->format('F')]['max'] = max($value);
        }

        $pidprices = Prices_Interady::whereBetween('Day', [$start, $end])->get(['Day','Minimum', 'Maximum']);

        $pidprices = collect($pidprices);

        //dd($prices->toArray());
        $pidMin = [];
        $pidMax = [];

        foreach($pidprices as $arr) {
            $pidMin[date("m",strtotime($arr->Day))][] = $arr->Minimum ;
            $pidMax[date("m",strtotime($arr->Day))][] = $arr->Maximum ;
        }

        foreach ($pidMin as $key => $value){
            $dateObj = DateTime::createFromFormat('!m', $key);

            $data['pid'][$dateObj->format('F')]['min'] = min($value);
        }
        foreach ($pidMax as $key => $value){
            $dateObj = DateTime::createFromFormat('!m', $key);

            $data['pid'][$dateObj->format('F')]['max'] = max($value);
        }

        $data['pda'] = array_reverse($data ['pda']);
        $data['pid'] = array_reverse($data['pid']);

        return view('charts.indexBoxPlot', compact("data"));

    }

}
