<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FoldingGateSparepart extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folding_gate_spareparts';

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
        $query = self::where('folding_gate_spareparts.id', $id)
                     ->join('units', 'folding_gate_spareparts.unit_id','=','units.id')
                     ->select('folding_gate_spareparts.*', 'units.name AS UnitName')
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataAll(){
        $query = self::where('folding_gate_spareparts.delete_flag', 0)
                     ->select('folding_gate_spareparts.id', 'folding_gate_spareparts.name')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::select('folding_gate_spareparts.*', 'units.name AS UnitName')
                      ->where('folding_gate_spareparts.delete_flag', 0)
                      ->join('units', 'folding_gate_spareparts.unit_id','=','units.id')
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