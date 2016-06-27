<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Forms extends Controller
{

  
    //	 Forms::Input() $input_name=[],$css=[],$type
    //   form builder

    public static function Input($input_name=[],$css=[],$type,$mode='old',$data=null)
    {
    	return view($type.'.inputs',compact('input_name','css','mode','data'))->render();
    }


/////////////////////////////////////////////////////////////////////////////////

    /* insert two lang in from model object  */
    public static function rows($db_name,$input_name=[],Request $request)
    {
    	foreach(app('language') as $lang)
    	{
    		$db_name->{$lang.$input_name} = $request->input($lang.$input_name);
    	}	
    	return $db_name;
    }

    /* Forms::rows($add,'_name',$request);  */


///////////////////////////////////////////////////////////

    // form validation  
    // $name=
     public static function rules($name,$rules)
    {
        $arr_rules = [];
        $nice_name = [];
        foreach(app('language') as $lang)
        {
             $arr_rules[$lang.$name] = $rules;
             $nice_name[$lang.$name] = trans('main.'.$lang.$name);
        }   
        return [$arr_rules,$nice_name];
    }

////////////////////////////////////////////////////////////////
    
}
