<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class MarketValues extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Date', 'Month', 'Year', 'MW_EPEX', 'MW_Wind_Onshore', 'PM_Wind_Onshore_fernsteuerbar', 'MW_Wind_Offshore',
        'PM_Wind_Offshore_fernsteuerbar', 'MW_Solar', 'PM_Solar_fernsteuerbar', 'MW_steuerbar', 'PM_steuerbar',
        'Negative_Stunden'
    ];

    protected  $guarded = [];



    public function uploadToTD($data){


        foreach ($data as $key => $row) {
            $date = $this->changDate($key);

            self::updateOrCreate(['Date' => $date,
                'Month'=> $month = date("F",strtotime($date)),
                'Year'=> date("yy",strtotime($date)),
                'MW_EPEX'=> $this->toNumber($row[0]),
                'MW_Wind_Onshore'=> $this->toNumber($row[2]),
                'PM_Wind_Onshore_fernsteuerbar'=> $this->toNumber($row[3]),
                'MW_Wind_Offshore'=> $this-> toNumber($row[5]),
                'PM_Wind_Offshore_fernsteuerbar'=> $this->toNumber($row[6]),
                'MW_Solar'=> $this->toNumber($row[8]),
                'PM_Solar_fernsteuerbar'=> $this->toNumber($row[9]),
                'MW_steuerbar' => $this->toNumber($row[11]),
                'PM_steuerbar' => $this->toNumber($row[12]),
                'Negative_Stunden' => $this->jaOderNein($row[14])
            ]);
        }


        return dd($data);
        /**
        Foreach($data as $mapKey => $arr)
        {
            Foreach($arr as $key => $value)
            {
                If ($value == "")
                {
                    if ($key == 3 and $data[$mapKey][4] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][4];
                    }elseif ($key == 4 and $data[$mapKey][3] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][3];
                    }else
                    {
                        if ($data[$mapKey][$key-1]== "" or $data[$mapKey][$key+1]== "")
                        {
                            $data[$mapKey][$key] = ($data[$mapKey][26]+ $data[$mapKey][27]) / 2;
                        }else
                        {
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
         * */
    }


    function toNumber($target){
        $switched = str_replace(',', '.', $target);
        if(is_numeric($target)){
            return intval($target);
        }elseif(is_numeric($switched)){
            return floatval($switched);
        } else {
            return 0;
        }
    }

    private function jaOderNein($in)
    {
        if(strcasecmp($in, 'Ja')== 0){
            return true;
        }else{
            return false;
        }
    }

    private function changDate($key)
    {

        return date("Y-m-d", strtotime(str_replace('/', '-',
            str_replace('Mär', 'Mar',
                str_replace('Mai', 'May',
                    str_replace('Okt', 'Oct',
                        str_replace('Dez ', 'Dec', $key)))))));
    }


}
