<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class RollingDoorSparepartOrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rolling_door_sparepart_order_details';

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
        $query = self::where('rolling_door_sparepart_order_details.rolling_door_sparepart_order_id', $id)
                     ->join('rolling_door_spareparts', 'rolling_door_sparepart_order_details.rolling_door_sparepart_id', '=', 'rolling_door_spareparts.id')
                     ->join('units', 'rolling_door_spareparts.unit_id', '=', 'units.id')
                     ->select('rolling_door_sparepart_order_details.price', 'rolling_door_sparepart_order_details.qty', 'rolling_door_sparepart_order_details.size', 'units.name AS UnitName', 'rolling_door_spareparts.name AS ItemName', 'rolling_door_sparepart_order_details.rolling_door_sparepart_id', 'rolling_door_spareparts.price AS MinPrice')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }
}