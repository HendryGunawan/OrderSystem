<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Unit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'units';

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
}