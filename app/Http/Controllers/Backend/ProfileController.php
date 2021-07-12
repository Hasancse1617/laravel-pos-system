<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;


class ProfileController extends Controller
{
    public function view()
    {
    	Session::put('page', 'profile');
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	//dd($user);
    	return view('backend.user.view-profile')->with(compact('user'));
    }
    public function edit()
    {
    	$id = Auth::user()->id;
    	$editData = User::find($id);
    	return view('backend.user.edit-profile')->with(compact('editData'));
    }
    public function update(Request $request)
    {
    	$id = Auth::user()->id;
    	$data = User::find($id);
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
    	$data->address = $request->address;
    	$data->gender = $request->gender;

    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/user_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/user_images/'), $filename);
    		$data['image'] = $filename;
    	}
    	$data->save();
    	$message = 'Your Profile has been Updated Successfully';
    	return redirect()->route('profiles.view')->with('success_message', $message);
    }
    public function passwordView()
    {
    	Session::put('page', 'editpassword');
    	return view('backend.user.edit-password');
    }
    public function passwordUpdate(Request $request)
    {
    	$id = Auth::user()->id;
    	if (Auth::attempt(['id'=>$id,'password'=>$request->current_password])) {
    		$user = User::find($id);
    		$user->password = bcrypt($request->new_password);
    		$user->save();
    		$message = 'Your password has been updated Successfully';
    		return redirect()->route('profiles.view')->with('success_message',$message);
    	}
    	else{
    		$message = 'Sorry! Your current password does not match';
    		return redirect()->back()->with('error_message',$message);
    	}
    }
}
