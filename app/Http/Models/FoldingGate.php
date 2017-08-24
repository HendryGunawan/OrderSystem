<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FoldingGate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folding_gates';

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
        $query = self::where('folding_gates.id', $id)
                     ->join('units', 'folding_gates.unit_id','=','units.id')
                     ->select('folding_gates.*', 'units.name AS UnitName')
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataAll(){
        $query = self::where('folding_gates.delete_flag', 0)
                     ->select('folding_gates.id', 'folding_gates.name')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::select('folding_gates.*', 'units.name AS UnitName')
                      ->where('folding_gates.delete_flag', 0)
                      ->join('units', 'folding_gates.unit_id','=','units.id')
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