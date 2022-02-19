<?php

namespace App\Http\Controllers\User;
use App\Helpers\Message;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            if($user->status == 'block')
            {
                toastr()->error('You are Blocked,Kindly Contact Support');
                return redirect()->back();
            }
        }
        if(!$user){
            toastr()->error('Please register your account');
            return redirect()->back();
        }
        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('user')->attempt($creds)){
            $user = Auth::guard('user')->user();
            $user->update([
                'last_login' => Carbon::today()
            ]);
            toastr()->success('Login Successfully');
            return redirect('user/dashboard');
        } else {
            toastr()->error('Wrong Password','Please Contact Support');
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();
        // toastr()->success('You Logout Successfully');
        return redirect('/');
    }
    public function index(){
        return redirect('user/login');
    }

}
