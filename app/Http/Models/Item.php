<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Item extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

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


    public static function getData(){
        $query = self::where('delete_flag', 0)
                     ->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataById($id){
        $query = self::where('id', $id)
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }
}