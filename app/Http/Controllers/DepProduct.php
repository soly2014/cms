<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\DepartmentProducts as Dep;
use Forms;
class DepProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if($request->has('department') and is_numeric($request->input('department')))
        {
          $alldep = Dep::where('parent','=',$request->input('department'))->orderBy('id','desc')->paginate(10);
          if($request->input('department') > 0)
          {
          $master = Dep::find($request->input('department'));
          $href = '<a href="'.url(app('aurl').'/department_product?department='.$master->parent).'">'.$master->en_name.'</a>';
          }else{
            $href = ''; 
          }
        }else{
          $alldep = Dep::where('parent','=',0)->orderBy('id','desc')->paginate(10);
          $href = '';
        }
        return view(app('at').'.product.department.index',
                ['title'=>trans('main.department_product'),
                    'alldep'=>$alldep,
                    'master'=>$href,
                    ]);
    }
    
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          // this dep has no parent
          $department = Dep::where('parent','=',0)->lists('ar_name','id');

          return view(app('at').'.product.department.create',['title'=>trans('main.add'),'department'=>$department]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = Forms::rules('_name','required');

        $Validator = Validator::make($request->all(),$rules[0]);

        $Validator->SetAttributeNames($rules[1]);
        if($Validator->fails())
        {
            return back()->withInput()->withErrors($Validator);
        }else{

             $dep = new Dep();

            if($request->has('parent'))
            {
             $dep->parent = $request->input('parent');
            }

            // object input & object output
            Forms::rows($dep,'_name',$request);

            $dep->save();
            
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
        $department = Dep::where('parent','=',0)->lists('en_name','id');
        return view(app('at').'.product.department.edit',['title'=>trans('main.edit'),
              'department'=>$department,
              'edit'=>$dep,
              ]);
    }
 


    public function check_parent(Request $request)
    {
        if($request->ajax())
        {
            if($request->has('parent') && $request->input('parent') > 0)
            {
                $dep = Dep::where('parent','=',$request->input('parent'))->get();
                $data = view(app('at').'.product.department.sub',['department'=>$dep,'parent'=>$request->input('parent')])->render();
              
                if(!empty($data))
                {
                return response()->json($data);
                }else{
                return response()->json('false');
                }
            }
        }
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
        $rules       = Forms::rules('_name','required');
        $Validator   = Validator::make($request->all(),$rules[0]);
        $Validator->SetAttributeNames($rules[1]);
        if($Validator->fails())
        {
            return back()->withInput()->withErrors($Validator);
        }else{
            $add =  Dep::find($id);
            if($request->has('parent'))
            {
             $add->parent = $request->input('parent');
            }
            Forms::rows($add,'_name',$request);
            $add->save();
            session()->flash('success',trans('main.updated'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response  
     */
    public static function DeleteParent($id)
    {
        $getparent = Dep::where('parent','=',$id)->get();
        foreach($getparent as $parent)
        {   
            $check = Dep::find($parent->id);

            if($check->parent > 0)
            {
                self::DeleteParent($check->id);
                $check->delete();
            }else{
                $check->delete();
            }

        }
    }
    public function destroy($id)
    {
         
        @Dep::find($id)->delete();
        self::DeleteParent($id);
        session()->flash('success',trans('main.deleted'));
        return back();
    }
}
