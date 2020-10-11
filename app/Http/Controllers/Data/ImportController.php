<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Price\Prices_Day_Ahead;
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
        //$data = array_map('str_getcsv', file($path));
        //$data = $file;

        //$fileName = resource_path('day-ahead-auction-files/'.date('y-m-d-H-i-s').$data.'.csv');

        //file_put_contents($fileName, $data);

        (new Prices_Day_Ahead())->uploadToTD($file);

        session()->flash('status', 'queued for importing');

        return redirect('import');
    }


}
