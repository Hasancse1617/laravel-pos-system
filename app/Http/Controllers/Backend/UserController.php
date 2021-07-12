<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;


class UserController extends Controller
{
    public function view()
    {
    	Session::put('page', 'viewuser');
        $allUser = User::all();
    	return view('backend.user.view-user')->with(compact('allUser'));
    }
    public function add()
    {
    	return view('backend.user.add-user');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email'
    	]);
        $message = "Tag has been Added Successfully";
    	$data = new User();
    	$data->usertype = $request->usertype;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($request->password);
    	$data->save();

    	return redirect()->route('users.view')->with('success_message',$message);
    	
    }
    public function edit($id)
    {
    	$editData = User::find($id);
    	return view('backend.user.edit-user')->with(compact('editData'));
    }
    public function update(Request $request, $id)
    {
    	$data = User::find($id);
    	$data->usertype = $request->usertype;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->save();
        $message = "Tag has been Updated Successfully";
    	return redirect()->route('users.view')->with('success_message',$message);
    }
    public function delete($id)
    {
        $user = User::find($id);
        if (file_exists('public/upload/user_images/'.$user->image) && !empty($user->image)) {
            unlink('public/upload/user_images/'.$user->image);
        }
        $user->delete();
        $message = "Tag has been Deleted Successfully";
        return redirect()->route('users.view')->with('success_message',$message);
    }
}
