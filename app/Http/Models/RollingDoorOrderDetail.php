<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class RollingDoorOrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rolling_door_order_details';

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

    public $timestamps = false;

    public static function getData($id){
        $query = self::where('rolling_door_order_details.rolling_door_order_id', $id)
                     ->join('rolling_doors', 'rolling_door_order_details.rolling_door_id', '=', 'rolling_doors.id')
                     ->join('units', 'rolling_doors.unit_id', '=', 'units.id')
                     ->select('rolling_door_order_details.price', 'rolling_door_order_details.qty', 'rolling_door_order_details.size', 'units.name AS UnitName', 'rolling_doors.name AS ItemName', 'rolling_door_order_details.rolling_door_id', 'rolling_doors.price AS MinPrice')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }
}