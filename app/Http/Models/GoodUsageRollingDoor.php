<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GoodUsageRollingDoor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'good_usage_rolling_doors';

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

    //Fungsi untuk select order yang sudah pernah dipakai sehingga tidak bisa dipilih lagi
    public static function getData($id){
        $query = self::where('good_usage_rolling_doors.id', $id)
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    //Fungsi untuk select order yang sudah pernah dipakai sehingga tidak bisa dipilih lagi
    public static function getDataUsage(){
        $query = self::select('rolling_door_order_id')
                     ->where('delete_flag', 0)
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::where('good_usage_rolling_doors.delete_flag', 0)
                      ->orderBy('id', 'asc')
                      ->get();
        if(!empty($query))
        {
            foreach($query as $key=> $val)
            {
                if(isset($query[$key]['rolling_door_order_id']))
                {
                    $query[$key]['order_number'] = 'RD-'. $query[$key]['rolling_door_order_id'];
                }
                if(isset($query[$key]['created_at']))
                {
                    $query[$key]['created'] = date('d-m-Y', strtotime($query[$key]['created_at']));
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