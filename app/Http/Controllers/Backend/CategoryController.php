<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use Auth;
use Session;

class CategoryController extends Controller
{
    public function view()
    {
    	Session::put('page', 'categories');
    	$alldata = Category::all();
    	return view('backend.category.view-category')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.category.add-category');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
    	]);
    	$data = new Category;
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	$message = "Data inserted successfully";
    	return redirect()->route('categories.view')->with('success_message',$message);
    }
    public function edit($id)
    {
    	$editdata = Category::find($id);
    	return view('backend.category.edit-category')->with(compact('editdata'));
    }
    public function update(Request $request, $id)
    {
    	$this->validate($request,[
            'name'=>'required',
    	]);
    	$data = Category::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->save();
    	$message = "Data updated successfully";
    	return redirect()->route('categories.view')->with('success_message',$message);
    }
    public function delete($id)
    {
    	$category = Category::find($id);
    	$category->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('categories.view')->with('success_message',$message);
    }
}
