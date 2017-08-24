<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getData($id){
        $query = self::where('id', $id)
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::where('delete_flag', 0)
                      ->orderBy('id', 'asc')
                      ->get();
        if(!empty($query))
        {
            foreach($query as $key=> $val)
            {
                if($query[$key]['super_admin'] ==1)
                {
                    $query[$key]['role'] = 'Super Admin';
                }
                else
                {
                    $query[$key]['role'] = 'Admin';
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
