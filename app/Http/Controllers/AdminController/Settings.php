<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Forms;
use App\Http\Requests;
use App\Setting;
use Artisan;
class Settings extends Controller
{
    public function index()
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

  public function ArtissanCommand()
  {
        Artisan::call('db:restore',
                        [
                        "--source"      => 'local',
                        "--sourcePath"  => 'database_27-03-2016.gz',
                        "--database"    => "mysql",
                        "--compression" => "gzip"
                        ]);
    return view(app('at').'.artisan',['title'=>trans('main.artisan')]);
  }

  public function ArtisanPost(Request $request)
  {
    if($request->has('command') and $request->has('name'))
    {
        // php artisan make:model  Test
    //php artisan db:backup --database=mysql --destination=dropbox --destinationPath=`date +\%Y/%d-%m-%Y` --compression=gzip
        Artisan::call('db:backup',
                    [
                    '--database'=>'mysql',
                    '--destination'=>'local',
                    '--destinationPath'=>'database_'.date('d/m/Y'),
                    '--compression'=>'gzip',
                    ],
                     '');


        session()->flash('success','The '.$request->input('command').' '.$request->input('name').' Is done');
        return back();
    }
  }
}
