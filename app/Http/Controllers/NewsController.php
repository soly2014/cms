<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\DepartmentNews as Dep;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $allneews = News::orderBy('id','desc')->paginate(10);   
         return view(app('at').'.news.news.index',['title'=>trans('main.news'),'allneews'=>$allneews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $alldep = Dep::lists('en_name','id');
     return view(app('at').'.news.news.create',['title'=>trans('main.create'),'alldep'=>$alldep]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules1   = Forms::rules('_title','required');
        $rules2   = Forms::rules('_content','required');

        $validate_merge  = array_merge($rules1[0],$rules2[0]);
        $validate_merge['dep_id'] = 'required';
        $validate_marge['photo']  = 'image|mimes:gif,jpeg,jpg,png'; //|max:150|min:50

        $nicenames = array_merge($rules1[1],$rules2[1]);
        $nicenames['dep_id'] = trans('main.department');
        $nicenames['photo']  = trans('main.photo_news');


         $validator = Validator::make($request->all(), $validate_merge);

        // this attr messeges will be shown on validation message
         $validator->SetAttributeNames($nicenames);


        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }else{
              $add = new News;

              $file     = $request->file('photo');
              $path     = public_path().'/upload/news';
              $filename = time().rand(11111,00000).'.'.$file->getClientOriginalExtension();
               if($file->move($path,$filename))
                 {
                   $add->photo = $filename;
                 }

            $add->user_id   = auth()->user()->id;
            $add->dep_id    = $request->input('dep_id');
            Forms::rows($add,'_title',$request);
            Forms::rows($add,'_content',$request);
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

     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
       $alldep = Dep::lists('en_name','id');
        $news   = News::find($id);
    
        return view(app('at').'.news.news.edit',['title'=>trans('main.edit'),'alldep'=>$alldep,'news'=>$news]);    

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
         $rules1           = Forms::rules('_title','required');
        $rules2           = Forms::rules('_content','required');
        $validate_marge   = array_merge($rules1[0],$rules2[0]);
        $validate_marge['dep_id'] = 'required'; 
        $validate_marge['photo']  = 'image|mimes:gif,jpeg,jpg,png'; //|max:150|min:50
      //  return  $request->file('photo')->getMimeType();
              

        $Validator   = Validator::make($request->all(),$validate_marge);
        $nicename = array_merge($rules1[1],$rules2[1]);
        $nicename['dep_id'] = trans('main.department');
        $nicename['photo']  = trans('main.photo_news');
        
        $Validator->SetAttributeNames($nicename);
        if($Validator->fails())
        {
            return back()->withInput()->withErrors($Validator);
        }else{
              $update =  News::find($id);
              if($request->hasFile('photo'))
              { 
                  @unlink(public_path().'/upload/news/'.$update->photo);  
                  $file     = $request->file('photo');
                  $path     = public_path().'/upload/news';
                  $filename = time().rand(11111,00000).'.'.$file->getClientOriginalExtension();
                  if($file->move($path,$filename))
                  {
                    $update->photo = $filename;
                  }
              }
            $update->dep_id    = $request->input('dep_id');
            Forms::rows($update,'_title',$request);
            Forms::rows($update,'_content',$request);
            $update->save();
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
    public function destroy($id)
    {
        //
        $delete =  News::find($id);
        if(!empty($delete->photo) and file_exists(public_path().'/upload/news/'.$delete->photo))
        {
         unlink(public_path().'/upload/news/'.$delete->photo);   
        }
        $delete->delete();
            session()->flash('success',trans('main.deleted'));
            return back();
    }

}
