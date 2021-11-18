<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Formateur;
use App\Module;
use App\Groupe;
use App\Niveau;
use App\FormateurGroupeModule;
use App\ModuleFormateur;
use App\FilierFormateur;
use App\Filier;
use App\Salle;
use App\ModuleFilier;

class FormateurGroupeModuleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listformateurgroupemodule=FormateurGroupeModule::paginate(3);
        return view('formateurgroupemodule.index',['formateurgroupemodule' => $listformateurgroupemodule]);
    }
    public function create(){
    	$listformateur=Formateur::all();
    	$listmodule=Module::all();
    	$listgroupe=Groupe::all();
        $filier=Filier::all();
    	return view('formateurgroupemodule.create',['formateur' => $listformateur,'module' => $listmodule,'groupe' => $listgroupe,'filier'=>$filier]);
        
    }
    public function getformateurs(Request $data){
        $id = $data->get('data');
        $formateurs=FilierFormateur::join('formateurs','formateurs.id','=','filier_formateur.formateur_id')->where('filier_id','=',$id)->select('formateurs.*')->get();
        $output = "<option id=';' value='-1'> select formateur </option>";
        if(count($formateurs)>0){
        foreach ($formateurs as $row) {
            $output .= "<option id='" . Salle::find($row->salle_id)->nomSa . ";$row->emailF;$row->telF' value='" . $row->id . "'> " . $row->nomF . ' - ' . $row->prenomF . " </option>";
        }
        }
        echo $output;
    }
    public function getmodules(Request $data){
        $id = $data->get('data');
        $modules=ModuleFormateur::join('modules','modules.id','=','module_formateur.module_id')->where('module_formateur.formateur_id','=',$id)->select('modules.*')->get();
        $output = "<option id=';' value='-1'> select module </option>";
        if(count($modules)>0){
            foreach ($modules as $row) {
                $output .= "<option id='$row->nomMod;$row->abrMod;$row->masHor;" . Niveau::find($row->niveau_id)->intitule . ";$row->order' value='" . $row->id . "'> " . $row->refMod . " </option>";
            }
        }
        echo $output;
    }
    public function getgroupes(Request $data){
        $id = $data->get('data');
        $module = Module::findOrFail($id);
        $groupes=ModuleFilier::join('filiers','filiers.id','=','module_filier.filier_id')->join('modules','modules.id','=','module_filier.module_id')->join('groupes','groupes.filier_id','=','module_filier.filier_id')->where([['module_filier.module_id','=',$module->id],['groupes.niveau_id','=',$module->niveau_id]])->select('groupes.*')->distinct()->get();
        $output="";
        if(count($groupes)>0){
            foreach ($groupes as $row) {
                $output .= "<tr><td><input type='checkbox' name='groupe_" . $row->id ."' value='" . $row->id . "'></td><td>" . $row->nomG . "</td><td>" . Filier::find($row->filier_id)->abrFil . "</td><td>" . Niveau::find($row->niveau_id)->intitule . "</td></tr>";
            }
        }
        echo $output;
    }
    public function search(Request $request){
        $module= $request->input('module');
        $res= FormateurGroupeModule::join('modules','modules.id','=','formateur_groupe_module.module_id')
                        ->where('modules.refMod','like','%' . $module . '%')
                        ->orWhere('modules.nomMod','like','%' . $module . '%')
                        ->orWhere('modules.abrMod','like','%' . $module . '%')
                        ->orWhere('modules.masHor',$module)
                        ->orWhere('modules.order',$module)
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());

        return view('formateurgroupemodule.index',['formateurgroupemodule' => $res]);
    }
    public function store(Request $request){

        $data=$request->except(['_token']);
        $formateur="";
        $module="";
        if(count($data)>2){
            try{
                foreach ($data as $key => $value) {
                    if($key=="formateur"){
                        $formateur=$value;
                    }elseif($key=="module") {
                        $module=$value;
                    }
                    else{
                        
                            $formateurGroupeModule=new FormateurGroupeModule();
                            $formateurGroupeModule->formateur_id=$formateur;
                            $formateurGroupeModule->module_id=$module;
                            $formateurGroupeModule->groupe_id=$value;
                            $formateurGroupeModule->save();
                        
                        
                    }
                }
            return redirect('formateur_groupe_module');
            }
            catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('formateur_groupe_module/create');
            }
        }
        session()->flash('fail','you must select at least one groupe');
        return redirect('formateur_groupe_module/create');

    }
    public function edit($id){
    	$formateurgroupemodule=FormateurGroupeModule::find($id);
        $module=Module::all();
        $formateur=Formateur::all();
        $groupe=Groupe::all();
        return view('formateurgroupemodule.edit',['afmodule' =>$formateurgroupemodule,'module' => $module,'formateur' =>$formateur,'groupe' =>$groupe]);
    }
    public function update(Request $request,$id){
        try{
    	$afmodule=FormateurGroupeModule::find($id);
        $afmodule->formateur_id=$request->input('formateur');
        $afmodule->module_id=$request->input('module');
        $afmodule->groupe_id=$request->input('groupe');
        $afmodule->save();
        return redirect('formateur_groupe_module');
        }
        catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('formateur_groupe_module/' . $id . '/edit');
        }
    }
    public function destroy($id){
    	$afmodule=FormateurGroupeModule::find($id);
        $afmodule->delete();
        return redirect('formateur_groupe_module');
    }
}
