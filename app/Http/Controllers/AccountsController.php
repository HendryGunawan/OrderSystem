<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Unit;
use App\Http\Models\Role;

class AccountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('accounts.index');
    }

    public function getAdd()
    {
        $option = Role::getData();
        $data = [
                'option' => $option,
            ];
        return view('accounts.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $check_account = User::where('email', $response['email'])->first();

        if(!empty($check_account))
        {
            flash('Username telah digunakan')->error();
            return redirect()->route('account');
        }
        if($response['password'] != $response['password_confirm'])
        {
            flash('Password Tidak Sama')->error();
            return redirect()->route('account');
        }

        $User = new User();
        $User->name = $response['name'];
        $User->email = $response['email'];
        $User->password = bcrypt($response['password']);
        $User->role_id = $response['role_id'];
        
        if($User->save()) {
            flash('Akun berhasil disimpan')->success();
            return redirect()->route('account');
        } else {
            flash('Akun gagal disimpan')->error();
            return redirect()->route('account');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('account');
        }

        $content = User::getData($response['id']);
        if(empty($content))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('account');
        }
        $option = Role::getData();

        $data = [
                'content' => $content,
                'option' => $option
            ];
        return view('accounts.edit', $data);
    }


    public function postEdit(Request $request) {
        $respons = $request->all();
        $id = $respons['id'];
        $name = $respons['name'];
        $email = $respons['email'];
        $password = $respons['password'];
        $password_confirm = $respons['password_confirm'];
        $role_id = $respons['role_id'];

        if($password != $password_confirm)
        {
            flash('Password Tidak Sama')->error();
            return redirect()->route('account');
        }

        $User = new User();
        $save = $User::where('id', $id)
                                    ->update([
                                        'name' => $name,
                                        'email' => $email,
                                        'password'  => bcrypt($password),
                                        'role_id' => $role_id,
                                    ]);

        if($save) {
            flash('Data berhasil di update')->success();
            return redirect()->route('account');
        } else {
            flash('Data gagal di update')->error();
            return redirect()->route('account');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('account');
        }

        $content = User::getData($response['id']);
        if(empty($content))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('account');
        }

        $data = [
                'data' => $content
            ];

        return view('accounts.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $delete = User::where('id', $id)->delete();

        if($delete) {
            flash('Data berhasil dihapus')->success();
            return redirect()->route('account');
        } else {
            flash('Data gagal dihapus')->error();
            return redirect()->route('account');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(User::getDataTable())->make(true);
    }
}
