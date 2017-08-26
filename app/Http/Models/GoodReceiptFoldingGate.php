<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GoodReceiptFoldingGate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'good_receipt_folding_gates';

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
        $query = self::where('good_receipt_folding_gates.id', $id)
                     ->join('items', 'good_receipt_folding_gates.item_id', '=', 'items.id')
                     ->select('good_receipt_folding_gates.*', 'items.name')
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataAll(){
        $query = self::where('good_receipt_folding_gates.delete_flag', 0)
                     ->select('good_receipt_folding_gates.id', 'good_receipt_folding_gates.name')
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::select('good_receipt_folding_gates.*', 'items.name')
                      ->where('good_receipt_folding_gates.delete_flag', 0)
                      ->join('items', 'good_receipt_folding_gates.item_id', '=', 'items.id')
                      ->orderBy('id', 'asc')
                      ->get();
        if(!empty($query))
        {
            foreach($query as $key=> $val)
            {
                if(isset($query[$key]['thick']))
                {
                    $query[$key]['thick'] = rtrim(rtrim(number_format($query[$key]['thick'], 10, ".", ","), '0'), '.');
                }
                if(isset($query[$key]['width']))
                {
                    $query[$key]['width'] = rtrim(rtrim(number_format($query[$key]['width'], 10, ".", ","), '0'), '.');
                }
                if(isset($query[$key]['weight']))
                {
                    $query[$key]['weight'] = rtrim(rtrim(number_format($query[$key]['weight'], 10, ".", ","), '0'), '.');
                }
                if(isset($query[$key]['length']))
                {
                    $query[$key]['length'] = rtrim(rtrim(number_format($query[$key]['length'], 10, ".", ","), '0'), '.');
                }
                if(isset($query[$key]['created_at']))
                {
                    $query[$key]['date_created'] = date('d-m-Y', strtotime($query[$key]['created_at']));
                }
            }
            return $query;
        }
        else
        {
            return false;
        }
    }

    public static function getQuota($item_code)
    {
        $stock_quota = 0;
        $usage_quota = 0;
        $stock = self::selectRaw('SUM(length)')
                     ->where('item_code', $item_code)
                     ->groupBy('item_code')
                     ->first();

        if(!empty($stock))
        {
            $stock_quota = $stock['SUM(length)'];
        }                           

        $usage = GoodUsageFoldingGateDetail::getDataUsage($item_code);

        if(!empty($usage))
        {
            $usage_quota = $usage['SUM(good_usage_folding_gate_details.length)'];
        }      

        $quota = $stock_quota - $usage_quota;
        return $quota; 
    }
}