<?php

namespace App\Models\Data\Price;

use Illuminate\Database\Eloquent\Model;

class Prices_Interady extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Day', 'Hour_1_Q1', 'Hour_1_Q2', 'Hour_1_Q3', 'Hour_1_Q4', 'Hour_2_Q1', 'Hour_2_Q2', 'Hour_2_Q3', 'Hour_2_Q4',
        'Hour_3A_Q1', 'Hour_3A_Q2', 'Hour_3A_Q3', 'Hour_3A_Q4', 'Hour_3B_Q1', 'Hour_3B_Q2', 'Hour_3B_Q3', 'Hour_3B_Q4',
        'Hour_4_Q1', 'Hour_4_Q2', 'Hour_4_Q3', 'Hour_4_Q4', 'Hour_5_Q1', 'Hour_5_Q2', 'Hour_5_Q3', 'Hour_5_Q4',
        'Hour_6_Q1', 'Hour_6_Q2', 'Hour_6_Q3', 'Hour_6_Q4', 'Hour_7_Q1', 'Hour_7_Q2', 'Hour_7_Q3', 'Hour_7_Q4',
        'Hour_8_Q1', 'Hour_8_Q2', 'Hour_8_Q3', 'Hour_8_Q4', 'Hour_9_Q1', 'Hour_9_Q2', 'Hour_9_Q3', 'Hour_9_Q4',
        'Hour_10_Q1', 'Hour_10_Q2', 'Hour_10_Q3', 'Hour_10_Q4', 'Hour_11_Q1', 'Hour_11_Q2', 'Hour_11_Q3', 'Hour_11_Q4',
        'Hour_12_Q1', 'Hour_12_Q2', 'Hour_12_Q3', 'Hour_12_Q4', 'Hour_13_Q1', 'Hour_13_Q2', 'Hour_13_Q3', 'Hour_13_Q4',
        'Hour_14_Q1', 'Hour_14_Q2', 'Hour_14_Q3', 'Hour_14_Q4', 'Hour_15_Q1', 'Hour_15_Q2', 'Hour_15_Q3', 'Hour_15_Q4',
        'Hour_16_Q1', 'Hour_16_Q2', 'Hour_16_Q3', 'Hour_16_Q4', 'Hour_17_Q1', 'Hour_17_Q2', 'Hour_17_Q3', 'Hour_17_Q4',
        'Hour_18_Q1', 'Hour_18_Q2', 'Hour_18_Q3', 'Hour_18_Q4', 'Hour_19_Q1', 'Hour_19_Q2', 'Hour_19_Q3', 'Hour_19_Q4',
        'Hour_20_Q1', 'Hour_20_Q2', 'Hour_20_Q3', 'Hour_20_Q4', 'Hour_21_Q1', 'Hour_21_Q2', 'Hour_21_Q3', 'Hour_21_Q4',
        'Hour_22_Q1', 'Hour_22_Q2', 'Hour_22_Q3', 'Hour_22_Q4', 'Hour_23_Q1', 'Hour_23_Q2', 'Hour_23_Q3', 'Hour_23_Q4',
        'Hour_23_Q1', 'Hour_23_Q2', 'Hour_23_Q3', 'Hour_23_Q4', 'Hour_24_Q1', 'Hour_24_Q2', 'Hour_24_Q3', 'Hour_24_Q4',
        'Minimum', 'Maximum', 'Off-Peak', 'Baseload', 'Off-Peak_1', 'Peakload', 'Sun_Peak', 'Off-Peak_2'
    ];

    protected  $guarded = [];

    public function uploadToTD($data){

        Foreach($data as $mapKey => $arr)
        {
            Foreach($arr as $key => $value)
            {
                If ($value == "")
                {
                    if ($key == 13 and $data[$mapKey][9] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][9];
                    }elseif ($key == 14 and $data[$mapKey][10] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][10];
                    }elseif ($key == 15 and $data[$mapKey][11] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][11];
                    }elseif ($key == 16 and $data[$mapKey][12] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][12];
                    }elseif ($key == 9 and $data[$mapKey][13] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][13];
                    }elseif ($key == 10 and $data[$mapKey][14] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][14];
                    }elseif ($key == 11 and $data[$mapKey][15] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][15];
                    }elseif ($key == 12 and $data[$mapKey][16] != ""){
                        $data[$mapKey][$key] = $data[$mapKey][16];
                    }else
                    {
                        if ($data[$mapKey][$key-1]== "" or $data[$mapKey][$key+1]== "")
                        {
                            $data[$mapKey][$key] = ($data[$mapKey][101]+ $data[$mapKey][102]) / 2;
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
                'Hour_1_Q1'=> $row[1],
                'Hour_1_Q2'=> $row[2],
                'Hour_1_Q3'=> $row[3],
                'Hour_1_Q4'=> $row[4],
                'Hour_2_Q1'=>$row[5],
                'Hour_2_Q2'=> $row[6],
                'Hour_2_Q3'=> $row[7],
                'Hour_2_Q4'=> $row[8],
                'Hour_3A_Q1'=>$row[9],
                'Hour_3A_Q2' => $row[10],
                'Hour_3A_Q3' => $row[11],
                'Hour_3A_Q4' => $row[12],
                'Hour_3B_Q1'=>$row[13],
                'Hour_3B_Q2' => $row[14],
                'Hour_3B_Q3' => $row[15],
                'Hour_3B_Q4' => $row[16],
                'Hour_4_Q1'=>$row[17],
                'Hour_4_Q2' => $row[18],
                'Hour_4_Q3' => $row[19],
                'Hour_4_Q4' => $row[20],
                'Hour_5_Q1'=>$row[21],
                'Hour_5_Q2' => $row[22],
                'Hour_5_Q3' => $row[23],
                'Hour_5_Q4' => $row[24],
                'Hour_6_Q1'=>$row[25],
                'Hour_6_Q2' => $row[26],
                'Hour_6_Q3' => $row[27],
                'Hour_6_Q4' => $row[28],
                'Hour_7_Q1'=>$row[29],
                'Hour_7_Q2' => $row[30],
                'Hour_7_Q3' => $row[31],
                'Hour_7_Q4' => $row[32],
                'Hour_8_Q1'=>$row[33],
                'Hour_8_Q2' => $row[34],
                'Hour_8_Q3' => $row[35],
                'Hour_8_Q4' => $row[36],
                'Hour_9_Q1'=>$row[37],
                'Hour_9_Q2' => $row[38],
                'Hour_9_Q3' => $row[39],
                'Hour_9_Q4' => $row[40],
                'Hour_10_Q1'=>$row[41],
                'Hour_10_Q2' => $row[42],
                'Hour_10_Q3' => $row[43],
                'Hour_10_Q4' => $row[44],
                'Hour_11_Q1'=>$row[45],
                'Hour_11_Q2' => $row[46],
                'Hour_11_Q3' => $row[47],
                'Hour_11_Q4' => $row[48],
                'Hour_12_Q1'=>$row[49],
                'Hour_12_Q2' => $row[50],
                'Hour_12_Q3' => $row[51],
                'Hour_12_Q4' => $row[52],
                'Hour_13_Q1'=>$row[53],
                'Hour_13_Q2' => $row[54],
                'Hour_13_Q3' => $row[55],
                'Hour_13_Q4' => $row[56],
                'Hour_14_Q1'=>$row[57],
                'Hour_14_Q2' => $row[58],
                'Hour_14_Q3' => $row[59],
                'Hour_14_Q4' => $row[60],
                'Hour_15_Q1'=>$row[61],
                'Hour_15_Q2' => $row[62],
                'Hour_15_Q3' => $row[63],
                'Hour_15_Q4' => $row[64],
                'Hour_16_Q1'=>$row[65],
                'Hour_16_Q2' => $row[66],
                'Hour_16_Q3' => $row[67],
                'Hour_16_Q4' => $row[68],
                'Hour_17_Q1'=>$row[69],
                'Hour_17_Q2' => $row[70],
                'Hour_17_Q3' => $row[71],
                'Hour_17_Q4' => $row[72],
                'Hour_18_Q1'=>$row[73],
                'Hour_18_Q2' => $row[74],
                'Hour_18_Q3' => $row[75],
                'Hour_18_Q4' => $row[76],
                'Hour_19_Q1'=>$row[77],
                'Hour_19_Q2' => $row[78],
                'Hour_19_Q3' => $row[79],
                'Hour_19_Q4' => $row[80],
                'Hour_20_Q1'=>$row[81],
                'Hour_20_Q2' => $row[82],
                'Hour_20_Q3' => $row[83],
                'Hour_20_Q4' => $row[84],
                'Hour_21_Q1'=>$row[85],
                'Hour_21_Q2' => $row[86],
                'Hour_21_Q3' => $row[87],
                'Hour_21_Q4' => $row[88],
                'Hour_22_Q1'=>$row[89],
                'Hour_22_Q2' => $row[90],
                'Hour_22_Q3' => $row[91],
                'Hour_22_Q4' => $row[92],
                'Hour_23_Q1'=>$row[93],
                'Hour_23_Q2' => $row[94],
                'Hour_23_Q3' => $row[95],
                'Hour_23_Q4' => $row[96],
                'Hour_24_Q1'=>$row[97],
                'Hour_24_Q2' => $row[98],
                'Hour_24_Q3' => $row[99],
                'Hour_24_Q4' => $row[100],
                'Minimum'=>$row[101],
                'Maximum' => $row[102],
                'Off-Peak' => $row[103],
                'Baseload'=>$row[104],
                'Off-Peak_1' => $row[105],
                'Peakload' => $row[106],
                'Sun_Peak' => $row[107],
                'Off-Peak_2'=>$row[108]

            ]);
        }

    }
}
