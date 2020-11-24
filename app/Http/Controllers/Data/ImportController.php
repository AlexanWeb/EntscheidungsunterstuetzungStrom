<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\MarketValues;
use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;
use App\Models\Data\Price\Pricesdayahdead__prediction;
use App\Models\Data\Price\Pricesinteradays__prediction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Data.import');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'=> 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file')->getRealPath();

        if($request->data == "day_Ahead")
        {
            $data = array_map('str_getcsv', file($file));
            $data = array_slice($data, 2); // return die Daten ohne erste zwei Zeille
            (new Prices_Day_Ahead())->uploadToTD($data);
        }
        elseif ($request->data == "intraday")
        {
            $data = array_map('str_getcsv', file($file));
            $data = array_slice($data, 2);
            (new Prices_Interady())->uploadToTD($data);
        }
        elseif ($request->data == "market_values"){
            // import the csv file with ; als delimiter
             $data = ($this->csv_to_array($file, ';'));

            // delete the firts row
            $data = array_slice($data, 1);

            // delete the empty rows
            unset($data[1]);
            unset($data[4]);
            unset($data[7]);
            unset($data[10]);
            unset($data[13]);

            // swap the array columns with rows
            $data = $this->flip($data);

            // delet the firts row
            $data = array_slice($data, 1);

            (new MarketValues())->uploadToTD($data);
        }
        elseif ($request->data == "day_Ahead_prediction")
        {
            $data = array_map('str_getcsv', file($file));
            $data = array_slice($data, 2); // return die Daten ohne erste zwei Zeille
            (new Pricesdayahdead__prediction())->uploadToTD($data);
        }
        elseif ($request->data == "intraday_prediction")
        {
            $data = array_map('str_getcsv', file($file));
            $data = array_slice($data, 2); // return die Daten ohne erste zwei Zeille
            (new Pricesinteradays__prediction())->uploadToTD($data);
        }


        session()->flash('status', 'queued for importing');

          return redirect()->route('admin.import')->with('success', 'your Data has been uploaded');
    }


    function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }


    function flip($arr) {
        $out = array();

        foreach ($arr as $key => $subarr)
        {
            foreach ($subarr as $subkey => $subvalue)
            {
                $out[$subkey][$key] = $subvalue;
            }
        }

        return $out;
    }


}
