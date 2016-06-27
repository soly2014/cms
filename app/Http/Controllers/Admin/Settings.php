<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Forms;
use App\Http\Requests;
use App\Setting;

class Settings extends Controller
{
  
    public function show()
    {
    	$setting = Setting::orderBy('id','desc')->first();
    	return view(app('at').'.settings',['title'=>trans('main.settings'),'setting'=>$setting]);
    }


    public function save(Request $request)
    {
    	$update = Setting::orderBy('id','desc')->first();
    	$update->url                   = $request->input('url');
    	$update->email                 = $request->input('email');
    	$update->keywords              = $request->input('keywords');
    	$update->description           = $request->input('description');
    	$update->maintenance           = $request->input('maintenance');
    	$update->maintenance_message   = $request->input('maintenance_message');
    	Forms::rows($update,'_sitename',$request);
    	$update->save();
    	session()->flash('success',trans('main.updated'));
    	return back();
    }
    
}
 