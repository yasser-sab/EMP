<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Module;
use App\ModuleFormateur;
use App\Niveau;
use App\FilierFormateur;

class ModuleFormateurController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$listcompetance=ModuleFormateur::paginate(3);
    	return view('moduleformateur.index',['competence' => $listcompetance]);
    }
    public function getmodules(Request $data){
        $id = $data->get('data');
        $modules = FilierFormateur::join('modules','modules.filier_id','filier_formateur.filier_id')->where('filier_formateur.formateur_id','=',$id)->select('modules.*')->get();
        $output="";
        if(count($modules)>0){
            foreach ($modules as $row) {
                $output .= "<tr><td><input type='checkbox' name='module_" . $row->id ."' value='" . $row->id . "'></td><td>" . $row->nomMod . "</td><td>" . $row->refMod . "</td><td>" . $row->masHor . " h</td><td>" . Niveau::find($row->niveau_id)->intitule . "</td><td>" . $row->order . "</td></tr>";
            }
        }
        echo $output;

    }
    public function search(Request $request){
        $moduleformateur= $request->input('ModuleFormateur');
        $res= ModuleFormateur::join('formateurs','formateurs.id','=','module_formateur.formateur_id')->join('modules','modules.id','=','module_formateur.module_id')
                        ->where('formateurs.nomF','like','%' . $moduleformateur . '%')
                        ->orWhere('formateurs.prenomF','like','%' . $moduleformateur . '%')
                        ->orWhere('formateurs.adrF','like','%' . $moduleformateur . '%')
                        ->orWhere('formateurs.emailF','like','%' . $moduleformateur . '%')
                        ->orWhere('formateurs.telF','like','%' . $moduleformateur . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());
        return view('moduleformateur.index',['competence' => $res]);
    }
    public function create(){
    	$formateur=Formateur::all();
    	$module=Module::all();
    	return view('moduleformateur.create',['formateur' => $formateur,'module' => $module]);
    }
    public function store(Request $request){
        $data=$request->except(['_token']);
        $formateur="";
        if(count($data)>1){
            try{
                foreach ($data as $key => $value) {
                    if($key=="formateur"){
                        $formateur=$value;
                    }else{
                        
                            $moduleformateur=new ModuleFormateur();
                            $moduleformateur->module_id=$value;
                            $moduleformateur->formateur_id=$formateur;
                            $moduleformateur->save();
                    }
                }
            return redirect('module_formateur');
            }
            catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('module_formateur/create');
            }
        }
    }
    public function edit($id){
        $competance=ModuleFormateur::find($id);
        $module=Module::all();
        $formateur=Formateur::all();
        return view('moduleformateur.edit',['c' =>$competance,'module' => $module,'formateur' => $formateur]);
    }
    public function update(Request $request,$id){
        try{
    	$competance=ModuleFormateur::find($id);
        $competance->formateur_id=$request->input('formateur');
        $competance->module_id=$request->input('module');
        $competance->save();
        return redirect('module_formateur');
        }
        catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('module_formateur/' . $id . '/edit');
        }
    }
    public function destroy($id){
    	$competance=ModuleFormateur::find($id);
        $competance->delete();
        return redirect('module_formateur');
    }
}
