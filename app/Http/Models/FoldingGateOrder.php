<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FoldingGateOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folding_gate_orders';

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
        $query = self::where('folding_gate_orders.id', $id)
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::where('folding_gate_orders.delete_flag', 0)
                      ->orderBy('id', 'asc')
                      ->get();
        if(!empty($query))
        {
            foreach($query as $key=> $val)
            {
                if(isset($query[$key]['id']))
                {
                    $query[$key]['order_number'] = 'FG-'.$val['id'];
                }
                if(isset($query[$key]['date']))
                {
                    $query[$key]['order_date'] = date('d-m-Y', strtotime($query[$key]['date']));
                }
                if(isset($query[$key]['grand_total']))
                {
                    $query[$key]['grand_total'] = number_format($query[$key]['grand_total']);
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