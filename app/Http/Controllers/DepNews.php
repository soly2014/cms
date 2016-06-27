<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DepartmentNews as Dep;
use Validator;

class DepNews extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
            $alldep = Dep::orderBy('id','desc')->paginate(10);
        return view(app('at').'.news.department.index',['title'=>trans('main.department_news'),'alldep'=>$alldep]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(app('at').'.news.department.create',['title'=>trans('main.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules       = Forms::rules('_name','required');
        $Validator   = Validator::make($request->all(),$rules[0]);
        $Validator->SetAttributeNames($rules[1]);
        if($Validator->fails())
        {
            return back()->withInput()->withErrors($Validator);
        }else{
            $add = new Dep;
            Forms::rows($add,'_name',$request);
            $add->save();
            session()->flash('success',trans('main.added'));
        }
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                $dep = Dep::find($id);
        return view(app('at').'.news.department.edit',['title'=>trans('main.edit'),'edit'=>$dep]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $db = Dep::find($id);
        $db->update(array_except($request->all(),['_method','_token']));
        session()->flash('success',trans('main.updated'));

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $db = Dep::find($id);
        $db->delete();
        session()->flash('success',trans('main.deleted'));
        return back();

    }
}
