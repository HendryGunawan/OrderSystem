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

    public function role()
    {
        return $this->belongsTo('App\Http\Models\Role', 'role_id', 'id');
    }


    public static function getData($id){
        $query = self::where('users.id', $id)
                     ->join('roles', 'users.role_id', '=', 'roles.id')
                     ->select('users.*', 'roles.name as RoleName')
                     ->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function getDataTable(){
        $query =  self::orderBy('id', 'asc')
                      ->join('roles', 'users.role_id', '=', 'roles.id')
                      ->select('users.*', 'roles.name as RoleName')
                      ->get();

        if(!empty($query))
        {
            return $query;
        }
        else
        {
            return false;
        }
    }
}
