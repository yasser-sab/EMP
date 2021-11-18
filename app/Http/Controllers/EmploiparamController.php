<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\FormateurGroupeModule;
use App\Emploiparam;
use App\Formateur;
use App\Emploi;
use App\Jour;
use App\Periodejournee;
use App\Seance;
use App\Groupe;
use App\Filier;
use App\Niveau;
use App\Semaine;
use App\Module;

class EmploiparamController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $emplois=Emploiparam::all();
        $jour=Jour::all();
        $afmodule=FormateurGroupeModule::all();
        $seance=Seance::all();
        $filier=FormateurGroupeModule::join('groupes','groupes.id','=','formateur_groupe_module.groupe_id')
                        ->join('filiers','filiers.id','=','groupes.filier_id')
                        ->select('filiers.*')
                        ->distinct()
                        ->get();
        $formateur=Formateur::all();
        $groupe=Groupe::join('formateur_groupe_module','formateur_groupe_module.groupe_id','=','groupes.id')->select('groupes.*')->distinct()->get();
    	return view('Emploiparam.index',['emplois' => $emplois,'jour' => $jour,'seance'=>$seance,'filier'=>$filier,'groupe'=>$groupe,'formateur'=>$formateur,'afmodule'=>$afmodule]);
    }
    public function test(){
        return view('test.create');
    }
    public function create(){
        $jour=Jour::all();
        $periode=Periodejournee::all();
        $groupe=Groupe::join('formateur_groupe_module','formateur_groupe_module.groupe_id','=','groupes.id')->select('groupes.*')->distinct()->get();
        $seance=Seance::all();
        $filier=FormateurGroupeModule::join('groupes','groupes.id','=','formateur_groupe_module.groupe_id')
                        ->join('filiers','filiers.id','=','groupes.filier_id')->select('filiers.*')->distinct()->get();
        $niveau=Niveau::All();
        $affectmodule=FormateurGroupeModule::join('modules','modules.id','=','formateur_groupe_module.module_id')->where('modules.order','1')->select('formateur_groupe_module.*')->get();
    	return view('Emploiparam/create',['jour'=>$jour,'seance'=>$seance,'periode'=>$periode,'groupe'=>$groupe,'filier'=>$filier,'niveau'=>$niveau,'affectmodule'=>$affectmodule]);
    }
    public function store(Request $request){
        $data=$request->except(['_token']);
        $arrayName = array();
        foreach ($data as $key => $value) {
            $v=substr($key,0,strripos($key,','));
            if(array_key_exists($v, $arrayName)){
                $arrayName[$v] = $arrayName[$v] . ',' . $value;
            }
            else{
                $arrayName[$v]=$value;
            }
        }
        $result = array();
        foreach ($arrayName as $key => $value) {
            $result = explode(",", $key);
            if($value!=-1){
                try{
                $emploiparam=new Emploiparam();
                $emploiparam->jour_id=$result[0];
                $emploiparam->seance_id=$result[1];
                $emploiparam->formateur_groupe_module_id=$value;
                $emploiparam->save();
                }
                catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('emploiparams/create');
                }
            }
        }
        return redirect('emploiparams');

    }   
    public function generer(){
      if(count(Semaine::all())>0 && count(Emploi::all())==0 && count(Emploiparam::all())>0){
        $emp=Emploiparam::orderBy('jour_id','asc')->orderBy('seance_id','asc')->get();
        $semaine=Semaine::all();


        $affectmodule=Emploiparam::join('formateur_groupe_module','formateur_groupe_module.id','=','emploiparams.formateur_groupe_module_id')->select('formateur_id','groupe_id')->distinct()->get();

        foreach ($affectmodule as $af) {
            $modules=FormateurGroupeModule::where([['formateur_groupe_module.formateur_id',$af->formateur_id],['formateur_groupe_module.groupe_id',$af->groupe_id]])->get('module_id');
            foreach ($modules as $m) {
                $m->nbseance=(Module::find($m->module_id)->masHor/2.5);
                $m->order=Module::find($m->module_id)->order;
            }
            $af->modules=$modules;
        }
        foreach ($semaine as $sem) {
            $i=$sem->dateDSemaine;
            while($sem->dateFSemaine>=$i){
                        foreach ($emp as $e){
                            if($e->jour_id==date('N',strtotime($i))){
                                $em=new Emploi();
                                foreach ($affectmodule as $af) {
                                    if($af->formateur_id==$e->formateur_groupe_module->formateur_id && $af->groupe_id==$e->formateur_groupe_module->groupe_id)
                                    {
                                            $em->module_id=$af->modules[0]->module_id;
                                            $em->formateur_id=$af->formateur_id;
                                            $em->groupe_id=$af->groupe_id;
                                            $af->modules[0]->nbseance-=1;
                                                if($af->modules[0]->nbseance==0 && $af->modules[1]!=null){
                                                    $res=$af->modules[0]=null;
                                                    for ($j=0; $j<count($af->modules)-1; $j++){ 
                                                       $af->modules[$j]=$af->modules[$j+1];
                                                    }
                                                    $af->modules[count($af->modules)-1]=$res;
                                                }
                                    }
                                }
                                // $em->formateur_id=$e->formateur_groupe_module->formateur_id;
                                $em->salle_id=$e->formateur_groupe_module->formateur->salle_id;
                                // $em->groupe_id=$e->formateur_groupe_module->groupe_id;
                                // $em->module_id=$e->formateur_groupe_module->module_id;
                                $em->seance_id=$e->seance_id;
                                // $em->absence_id=null;
                                $em->jour_id=$e->jour_id;
                                $em->date=$i;
                                $em->semaine_id=$sem->id;
                                $em->save();
                            }
                        }
                        $i=date('Y-m-d', strtotime($i . ' + 1 day'));
                    }    
        }
        session()->flash('success','l\'emploi est bien generée !!');
      }else{
        session()->flash('fail','semaine ou/et parametrage pas encore fait et/ou emploi deja generée voulez vous les supprimer et regenerée autre fois !!');
      }
      return redirect('home');
    }
    public function edit($id){
        // $empparams=Emploiparam::find($id);
        // $afformateur=Affectformateur::all();
        // $afmodule=Affectmodule::all();
        // return view('Emploiparam/edit',['afformateur' => $afformateur,'afmodule' => $afmodule,'emploiparam'=>$empparams]);
    }
    public function update(Request $request,$id){
        // $empparams=Emploiparam::find($id);
        // $empparams->affectformateur_id=$request->input('afformateur');
        // $empparams->affectmodule_id=$request->input('afmodule');
        // $empparams->save();
        // return redirect('emploiparams');
    	
    }
    public function destroy($id){
    	// $empparams=Emploiparam::find($id);
     //    $empparams->delete();
     //    return redirect('emploiparams');
    }
    // $afmodule=Affectmodule::all();
    //     $afformateur=Affectformateur::all();
    //     return view('emploiparam.create',['afmodule' => $afmodule,'afformateur' => $afformateur]);
}
