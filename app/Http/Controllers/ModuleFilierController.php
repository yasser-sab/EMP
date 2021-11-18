<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModuleFilier;
use App\Module;
use App\Filier;

class ModuleFilierController extends Controller
{
 	public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$mfilier=ModuleFilier::paginate(3);
    	return view('modulefilier.index',['mfilier' => $mfilier]);
    }
    public function create(){
    	$module=Module::all();
    	$filier=Filier::all();
    	return view('modulefilier.create',['module' => $module,'filier' => $filier]);
    }
    public function search(Request $request){
        $modulefilier= $request->input('ModuleFilier');
        $res= ModuleFilier::join('filiers','filiers.id','=','module_filier.filier_id')->join('modules','modules.id','=','module_filier.module_id')
                        ->where('modules.refMod','like','%' . $modulefilier . '%')
                        ->orWhere('modules.nomMod','like','%' . $modulefilier . '%')
                        ->orWhere('modules.abrMod','like','%' . $modulefilier . '%')
                        ->orWhere('filiers.nomFil','like','%' . $modulefilier . '%')
                        ->orWhere('filiers.abrFil','like','%' . $modulefilier . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());
        return view('modulefilier.index',['mfilier' => $res]);
    }
    public function store(Request $request){
    	$data=$request->except(['_token']);
    	$filier="";
    	if(count($data)>1){
    		try{
		    	foreach ($data as $key => $value) {
		    		if($key=="filier"){
		    			$filier=$value;
		    		}else{
		    			
			    			$modulefilier=new ModuleFilier();
					    	$modulefilier->module_id=$value;
					    	$modulefilier->filier_id=$filier;
					    	$modulefilier->save();
		    		}
		        }
	        return redirect('module_filier');
	        }
	        catch (\PDOException $e) {
				session()->flash('fail',$e->errorInfo[2]);
				return redirect('module_filier/create');
			}
    	}
	}
    public function edit($id){
    	$mfilier=Modulefilier::find($id);
    	$module=Module::all();
    	$filier=Filier::all();
    	return view('modulefilier.edit',['mfilier' => $mfilier,'module' => $module,'filier' => $filier]);
    }
    public function update(Request $request,$id){
    	try{
	    	$mfilier=ModuleFilier::find($id);
	    	$mfilier->module_id=$request->input('module');
	    	$mfilier->filier_id=$request->input('filier');
	    	$mfilier->save();
    	}	
    	catch (\PDOException $e) {
			session()->flash('fail',$e->errorInfo[2]);
			return redirect('module_filier/' . $id . '/edit');
		}
    	return redirect('module_filier');
    }
    public function destroy($id){
    	$mfilier=ModuleFilier::find($id);
    	$mfilier->delete();
    	return redirect('module_filier');
    }
}
