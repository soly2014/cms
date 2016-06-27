<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Auth;
class HomeController extends Controller
{

   public function Index()
   {
   	return view(app('at').'.home');
   }

   public function login()
   {
   	return view(app('at').'.login',['title'=>trans('main.login')]);
   }

   public function post_login(Request $request)
   {

 	if($request->has('remember'))
 	{
 		$remember = true;
 	}else{
 		$remember = false;	
 	}
   	 if(Auth::guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$remember))
   	 {
   	 	session()->flash('success',trans('main.account_loggedin'));
   	 	return redirect()->intended('admin');
   	 }else{
   	 	session()->flash('errors',trans('main.account_have_error_login'));
   	 }
   }

   public function logout()
   {
   	Auth::guard('admin')->logout();
   	return redirect('admin/login');
   }
}
