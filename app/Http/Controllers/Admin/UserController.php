<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
      return view('admin.user.index');
    }
    public function active()
    {
      return view('admin.user.active');
    }
    public function create()
    {
      return view('admin.user.create');
    }
    public function store(Request $request)
    {
        User::create($request->all());
        toastr()->success('User Account is Created Successfully');
        return redirect()->back();
    }
    public function blocks()
    {
      return view('admin.user.block');
    }
    public function PoliceStationUser()
    {
      return view('admin.user.police_station');
    }
    public function ProsecutionBranchUsers()
    {
      return view('admin.user.prosecution_branch');
    }
    public function CourtUsers()
    {
      return view('admin.user.court');
    }
    public function showDetail($id)
    {
      $user = User::find($id);
      return view('admin.user.detail',compact('user'));
    }
    public function delete($id){
      User::find($id)->delete();
      toastr()->success('User  is Deleted Successfully');
      return redirect()->route('admin.user.index');
    }
    public function activation($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 'active',
        ]);     
        toastr()->success('User is active Now');
        return redirect()->back();
    } 
    public function block($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 'block',
        ]);     
        toastr()->success('User is block Now');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if($request->password)
        {
            $user->update([
                'password' => $request->password,
                'temp_password' => $request->password
            ]);
        }
        $user->update($request->except('password'));
        toastr()->success('User is Updated Successfully');
        return redirect()->back();
    }
    public function fakeLogin(User $user)
    {
        // Auth::logout();
        Auth::guard('user')->login($user);
        return redirect()->route('user.dashboard.index');
    }
}
