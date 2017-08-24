<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Unit;

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
        return view('accounts.add');
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $check_account = User::where('email', $response['email'])->first();

        if(!empty($check_account))
        {
            flash('Account already used')->error();
            return redirect()->route('account');
        }
        if($response['password'] != $response['password_confirm'])
        {
            flash('Password Not Match')->error();
            return redirect()->route('account');
        }

        $User = new User();
        $User->name = $response['name'];
        $User->email = $response['email'];
        $User->password = bcrypt($response['password']);
        $User->super_admin = $response['super_admin'];
        $User->delete_flag = 0;
        
        if($User->save()) {
            flash('Account succefully saved')->success();
            return redirect()->route('account');
        } else {
            flash('Account failed to save')->error();
            return redirect()->route('account');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('account');
        }

        $content = User::getData($response['id']);
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('account');
        }

        $data = [
                'content' => $content
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
        $super_admin = $respons['super_admin'];

        if($password != $password_confirm)
        {
            flash('Password Not Match')->error();
            return redirect()->route('account');
        }

        $User = new User();
        $save = $User::where('id', $id)
                                    ->update([
                                        'name' => $name,
                                        'email' => $email,
                                        'password'  => bcrypt($password),
                                        'super_admin' => $super_admin,
                                    ]);

        if($save) {
            flash('Data succefully updated')->success();
            return redirect()->route('account');
        } else {
            flash('Data failed to updated')->error();
            return redirect()->route('account');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('account');
        }

        $content = User::getData($response['id']);
        if(empty($content))
        {
            flash('Data not found')->error();
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

        $delete = User::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($delete) {
            flash('Data succefully deleted')->success();
            return redirect()->route('account');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('account');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(User::getDataTable())->make(true);
    }
}
