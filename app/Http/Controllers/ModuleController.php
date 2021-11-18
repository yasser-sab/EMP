<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\moduleRequest;
use App\Module;
use App\Niveau;
use App\Filier;

class ModuleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listmodule=Module::paginate(3);
        return view('module.index',['module' => $listmodule]);
    }
    public function create(){
        $niveaux = Niveau::all();
        $filier = Filier::all();
    	return view('module.create',['niveaux'=>$niveaux,'filier'=>$filier]);
    }
    public function search(Request $request){
        $module= $request->input('module');
        $res= Module::where('refMod','like','%' . $module . '%')
                        ->orWhere('nomMod','like','%' . $module . '%')
                        ->orWhere('abrMod','like','%' . $module . '%')
                        ->orWhere('masHor','like','%' . $module . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());

        return view('module.index',['module' => $res]);
    }
    public function store(moduleRequest $request){
        try{
    	$module=new Module();
    	$module->refMod=$request->input('ref');
    	$module->nomMod=$request->input('nom');
    	$module->abrMod=$request->input('abr');
    	$module->masHor=$request->input('masse');
        $module->niveau_id=$request->input('niveau');
        $module->filier_id=$request->input('filier');
        $module->order=$request->input('order');
    	$module->save();
        }
        catch (\PDOException $e) {
        session()->flash('fail',$e->errorInfo[2]);
        return redirect('modules/create');
        }
    	return redirect('modules');
    }
    public function edit($id){
        $niveaux = Niveau::all();
        $filier=Filier::all();
        $module=Module::find($id);
        return view('module.edit',['module' => $module,'niveaux'=>$niveaux,'filier'=>$filier]);
    }
    public function update(moduleRequest $request,$id){
        try{
    	$module=Module::find($id);
        $module->refMod=$request->input('ref');
        $module->nomMod=$request->input('nom');
        $module->abrMod=$request->input('abr');
        $module->masHor=$request->input('masse');
        $module->niveau_id=$request->input('niveau');
        $module->filier_id=$request->input('filier');
        $module->order=$request->input('order');
        $module->save();
        }
        catch (\PDOException $e) {
        session()->flash('fail',$e->errorInfo[2]);
        return redirect('modules/' . $id . '/edit');
        }
        return redirect('modules');
    }
    public function destroy($id){
    	$module=Module::find($id);
        $module->delete();
        return redirect('modules');
    }
}
