<?php

namespace App\Models\Data\Price;

use Illuminate\Database\Eloquent\Model;

class Prices_Day_Ahead extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Day', 'Hour_1', 'Hour_2', 'Hour_3A', 'Hour_3B', 'Hour_4', 'Hour_5', 'Hour_6', 'Hour_7', 'Hour_8', 'Hour_9', 'Hour_10',
        'Hour_11', 'Hour_12', 'Hour_13', 'Hour_14', 'Hour_15','Hour_16', 'Hour_17', 'Hour_18', 'Hour_19','Hour_20',
        'Hour_21', 'Hour_22', 'Hour_23', 'Hour_24', 'Minimum', 'Maximum', 'Middle_Night', 'Early_Morning',
        'Late_Morning', 'Early_Afternoon', 'Rush_Hour', 'Off-Peak_2', 'Baseload', 'Peakload','Night', 'Off-Peak_1',
        'Business', 'Offpeak', 'Morning', 'High_Noon', 'Afternoon', 'Evening', 'Sunpeak'
    ];

    protected  $guarded = [];





    public function uploadToTD($data){

        Foreach($data as $mapKey => $arr)
        {
            Foreach($arr as $key => $value)
            {
                If ($value == "") // prüft ob es null Wert gibt
                {
                    if ($key == 3 and $data[$mapKey][4] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][4];
                    }elseif ($key == 4 and $data[$mapKey][3] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][3];
                    }else
                    {
                        if ($data[$mapKey][$key-1]== "" or $data[$mapKey][$key+1]== "")
                        {
                            // Mittelwert  vom Tag statt null werte speichern
                            $data[$mapKey][$key] = ($data[$mapKey][26]+ $data[$mapKey][27]) / 2;
                        }else
                        {
                            // die Mittelwert von der vorherigen Stunde und der nächsten Stunde speichern
                            $data[$mapKey][$key] = ($data[$mapKey][$key-1] + $data[$mapKey][$key+1]) / 2;
                        }
                    }
                }
            }
        }
        foreach ($data as $row) {
            self::updateOrCreate([
                'Day'=>date("Y-m-d", strtotime(str_replace('/', '-', $row[0]))),
                'Hour_1'=> $row[1],
                'Hour_2'=> $row[2],
                'Hour_3A'=> $row[3],
                'Hour_3B'=> $row[4],
                'Hour_4'=>$row[5],
                'Hour_5'=> $row[6],
                'Hour_6'=> $row[7],
                'Hour_7'=> $row[8],
                'Hour_8'=>$row[9],
                'Hour_9' => $row[10],
                'Hour_10' => $row[11],
                'Hour_11' => $row[12],
                'Hour_12'=>$row[13],
                'Hour_13' => $row[14],
                'Hour_14' => $row[15],
                'Hour_15' => $row[16],
                'Hour_16'=>$row[17],
                'Hour_17' => $row[18],
                'Hour_18' => $row[19],
                'Hour_19' => $row[20],
                'Hour_20'=>$row[21],
                'Hour_21' => $row[22],
                'Hour_22' => $row[23],
                'Hour_23' => $row[24],
                'Hour_24'=>$row[25],
                'Minimum' => $row[26],
                'Maximum' => $row[27],
                'Middle_Night' => $row[28],
                'Early_Morning'=>$row[29],
                'Late_Morning' => $row[30],
                'Early_Afternoon' => $row[31],
                'Rush_Hour' => $row[32],
                'Off-Peak_2'=>$row[33],
                'Baseload' => $row[34],
                'Peakload' => $row[35],
                'Night' => $row[36],
                'Off-Peak_1' => $row[37],
                'Business' => $row[38],
                'Offpeak' => $row[39],
                'Morning' => $row[40],
                'High_Noon' => $row[41],
                'Afternoon' => $row[42],
                'Evening' => $row[43],
                'Sunpeak' => $row[44]

            ]);
        }
    }


}
