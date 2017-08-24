<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FoldingGateOrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folding_gate_order_details';

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
        $query = self::where('folding_gate_order_details.folding_gate_order_id', $id)
                     ->join('folding_gates', 'folding_gate_order_details.folding_gate_id', '=', 'folding_gates.id')
                     ->join('units', 'folding_gates.unit_id', '=', 'units.id')
                     ->select('folding_gate_order_details.price', 'folding_gate_order_details.qty', 'folding_gate_order_details.size', 'units.name AS UnitName', 'folding_gates.name AS ItemName', 'folding_gate_order_details.folding_gate_id', 'folding_gates.price AS MinPrice')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }
}