<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Price\Prices_Day_Ahead;
use App\Models\Data\Price\Prices_Interady;
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


        $data = array_map('str_getcsv', file($file));
        $data = array_slice($data, 2);

        if($request->type_sale == "day_Ahead")
        {
            (new Prices_Day_Ahead())->uploadToTD($data);

        } elseif ($request->type_sale == "intraday")
        {
            (new Prices_Interady())->uploadToTD($data);
        }
        session()->flash('status', 'queued for importing');

          return redirect('import');
    }


}
