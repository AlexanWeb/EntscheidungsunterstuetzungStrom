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
