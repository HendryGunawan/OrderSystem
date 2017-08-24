<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FoldingGateSparepartOrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folding_gate_sparepart_order_details';

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
        $query = self::where('folding_gate_sparepart_order_details.folding_gate_sparepart_order_id', $id)
                     ->join('folding_gate_spareparts', 'folding_gate_sparepart_order_details.folding_gate_sparepart_id', '=', 'folding_gate_spareparts.id')
                     ->join('units', 'folding_gate_spareparts.unit_id', '=', 'units.id')
                     ->select('folding_gate_sparepart_order_details.price', 'folding_gate_sparepart_order_details.qty', 'folding_gate_sparepart_order_details.size', 'units.name AS UnitName', 'folding_gate_spareparts.name AS ItemName', 'folding_gate_sparepart_order_details.folding_gate_sparepart_id', 'folding_gate_spareparts.price AS MinPrice')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }
}