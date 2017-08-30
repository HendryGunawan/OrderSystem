<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

// Call Facade
use Auth;

class ChangePasswordsController extends Controller 
{
	public function Index()
    {
		return view('change_passwords.index');
    }

    public function postSave(request $request)
    {
        $response = $request->all();
        $DBpassword = Auth::user()->password;

        if(!Hash::check($response['OldPassword'], $DBpassword))
        {
            flash('Password lama salah')->error();
            return redirect()->route('change_password');
        }

        if($response['NewPassword'] != $response['ConfirmNewPassword'])
        {
            flash('Password baru tidak sama dengan konfirmasi')->error();
            return redirect()->route('change_password');
        }

        $newPassword = bcrypt($response['NewPassword']);
        $update = User::where('id', Auth::user()->id)
                    ->update([
                        'password' => $newPassword
                    ]);
        if($update)
        {
            flash('Password berhasil diubah')->success();
            return redirect()->route('home');
        }
        else
        {
            flash('Password gagal diubah')->error();
            return redirect()->route('change_password');
        }
    }
}