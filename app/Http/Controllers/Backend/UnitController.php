<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Unit;
use Auth;
use Session;

class UnitController extends Controller
{
    public function view()
    {
    	Session::put('page', 'units');
    	$alldata = Unit::all();
    	return view('backend.unit.view-unit')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.unit.add-unit');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
    	]);
    	$data = new Unit;
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	$message = "Data inserted successfully";
    	return redirect()->route('units.view')->with('success_message',$message);
    }
    public function edit($id)
    {
    	$editdata = Unit::find($id);
    	return view('backend.unit.edit-unit')->with(compact('editdata'));
    }
    public function update(Request $request, $id)
    {
    	$this->validate($request,[
            'name'=>'required',
    	]);
    	$data = Unit::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->save();
    	$message = "Data updated successfully";
    	return redirect()->route('units.view')->with('success_message',$message);
    }
    public function delete($id)
    {
    	$unit = Unit::find($id);
    	$unit->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('units.view')->with('success_message',$message);
    }
}
