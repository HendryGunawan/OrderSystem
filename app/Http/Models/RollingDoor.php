<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class RollingDoor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rolling_doors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = true;


    public static function getData($id){
        $query = self::where('rolling_doors.id', $id)
                     ->join('units', 'rolling_doors.unit_id','=','units.id')
                     ->select('rolling_doors.*', 'units.name AS UnitName')
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataAll(){
        $query = self::where('rolling_doors.delete_flag', 0)
                     ->select('rolling_doors.id', 'rolling_doors.name')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::select('rolling_doors.*', 'units.name AS UnitName')
                      ->where('rolling_doors.delete_flag', 0)
                      ->join('units', 'rolling_doors.unit_id','=','units.id')
                      ->orderBy('id', 'asc')
                      ->get();
        if(!empty($query))
        {
            foreach($query as $key=> $val)
            {
                if(isset($query[$key]['price']))
                {
                    $query[$key]['price'] = number_format($query[$key]['price']);
                }
            }
            return $query;
        }
        else
        {
            return false;
        }
    }
}