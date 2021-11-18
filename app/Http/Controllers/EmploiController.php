<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jour;
use App\Seance;
use App\Formateur;
use App\Module;
use App\Salle;
use App\Groupe;
use App\Emploi;
use App\Semaine;
use App\Filier;
use PDF;

class EmploiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return "true";
    }
    public function pdf(Request $data){

        $data = "<div>" . $data->get('data') . "</div>";
        return $data;
        // $pdf=\App::make('dompdf.wrapper');
        // $listfilier=Filier::all();
        // $pdf = PDF::loadView('Emploi.test',['res'=>$listfilier])->setPaper('a4', 'landscape')->setWarnings(false);
        // $pdf->loadHTML($data);
        // return $pdf->download('skhj.pdf');
        // return response()->download($pdf);       
        // $pdf->save('emplois/pdf');
         // $pdf->download('pdf.pdf');
    }
    public function test2($data){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($data);
        return $pdf->download("pdf.pdf");
    }
    public function indexFormateur(Request $request){
        $data=array('frm' => 'formateur_id','smn' =>'semaine_id','sal'=>'salle_id','sea'=>'seance_id','jour'=>'jour_id','filier'=>'groupe_id');
        $query=Emploi::where('id','!=','');
        $v=$request->except('_token');
        foreach ($v as $key => $value) {
            if($value!=-1){
                if(strpos($value, '[{')!==false){
                    $ar = array();
                    foreach (json_decode($value,true) as $fv) {
                        array_push($ar,$fv["id"]);
                    }
                    $query->whereIn($data[$key],$ar);
                
                }
                else{
                    $query->where($data[$key],'=',$request->input($key));
                }
            }
        }
        $select=Emploi::whereIn('id',$query->get('id'))->where('isvalide','=','oui')->orderBy('seance_id','desc')->get();

        $jour = Jour::all();
        $semaine=Emploi::join('semaines','semaines.id','=','emplois.semaine_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('semaines.*')->distinct()->get();
        // $semaine = Semaine::whereIn('id',$query->groupBy('semaine_id')->get('semaine_id'))->get();
        $formateur=Emploi::join('formateurs','formateurs.id','=','emplois.formateur_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('formateurs.*')->distinct()->get();
        // $formateur=Formateur::whereIn('id',$query->groupBy('formateur_id')->get('formateur_id'))->get();
        $seance = Seance::orderBy('nomSe','asc')->get();
        return view('Emploi.index.indexFormateur',['semaine'=>$semaine,'jour'=>$jour,'formateur'=>$formateur,'seance'=>$seance,'select'=>$select]);
        
    }
    public function indexSalle(Request $request){
        $data=array('frm' => 'formateur_id','smn' =>'semaine_id','sal'=>'salle_id','sea'=>'seance_id','jour'=>'jour_id','filier'=>'groupe_id');
        $query=Emploi::where('id','!=','');
        $v=$request->except('_token');
        foreach ($v as $key => $value) {
            if($value!=-1){
                // if(strpos($value, '[{')!==false){
                //     $ar = array();
                //     foreach (json_decode($value,true) as $fv) {
                //         array_push($ar,$fv["id"]);
                //     }
                //     $query->whereIn($data[$key],$ar);
                
                // }
                // else{
                    $query->where($data[$key],'=',$request->input($key));
                // }
            }
        }
        // $select=Emploi::whereIn('id',$query->get('id'))->orderBy('seance_id','desc')->get();
        // $jour = Jour::all();
        // $semaine = Semaine::whereIn('id',$query->groupBy('semaine_id')->get('semaine_id'))->get();
        // $formateur=Formateur::whereIn('id',$query->groupBy('formateur_id')->get('formateur_id'))->get();
        // $seance = Seance::orderBy('nomSe','asc')->get();

         $select=Emploi::whereIn('id',$query->get('id'))->where('isvalide','=','oui')->orderBy('semaine_id','asc')->get();
        // $groupe=DB::table('emplois')->join('groupes','emplois.groupe_id','=','groupes.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('groupes.*')->orderBy('groupes.id','asc')->get();
        $jour =Jour::all();//DB::table('emplois')->join('jours','emplois.jour_id','=','jours.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('jours.*')->orderBy('jours.id','asc')->get();
        // $semaine=DB::table('emplois')->join('semaines','emplois.semaine_id','=','semaines.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('semaines.*')->orderBy('semaines.id','asc')->get();
        $semaine=Emploi::join('semaines','semaines.id','=','emplois.semaine_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('semaines.*')->distinct()->get();
        $seance=Seance::orderBy('nomSe','asc')->get();
        // $formateur=Formateur::all();
        // $module=Module::all();
        $salle=Emploi::join('salles','salles.id','=','emplois.salle_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('salles.*')->distinct()->get();
        // return view('Emploi.index.indexSalle',['semaine'=>$semaine,'jour'=>$jour,'formateur'=>$formateur,'seance'=>$seance,'select'=>$select]);
        // return view('Emploi.index.indexSalle',['semaine'=>$semaine,'jour'=>$jour,'formateur'=>$formateur,'seance'=>$seance,'select'=>$select,'groupe'=>$groupe,'module'=>$module,'salle'=>$salle]);
        return view('Emploi.index.indexSalle',['semaine'=>$semaine,'jour'=>$jour,'seance'=>$seance,'select'=>$select,'salle'=>$salle]);
        
    }
    public function indexGroupe(Request $request){
        $data=array('frm' => 'formateur_id','smn' =>'semaine_id','sal'=>'salle_id','sea'=>'seance_id','jour'=>'jour_id','filier'=>'groupe_id','groupe'=>'groupe_id');
        $query=Emploi::where('id','!=','');
        $v=$request->except('_token');
        foreach ($v as $key => $value) {
            if($value!=-1){
                if(strpos($value, '[{')!==false){
                    $ar = array();
                    foreach (json_decode($value,true) as $fv) {
                        array_push($ar,$fv["id"]);
                    }
                    $query->whereIn($data[$key],$ar);
                
                }
                else{
                    $query->where($data[$key],'=',$request->input($key));
                }
            }
        }

        $select=Emploi::whereIn('id',$query->get('id'))->where('isvalide','=','oui')->orderBy('semaine_id','asc')->get();
        $groupe=Emploi::join('groupes','groupes.id','=','emplois.groupe_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('groupes.*')->distinct()->get();
        // $groupe=DB::table('emplois')->join('groupes','emplois.groupe_id','=','groupes.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('groupes.*')->orderBy('groupes.id','asc')->get();
        $jour =Jour::all();//DB::table('emplois')->join('jours','emplois.jour_id','=','jours.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('jours.*')->orderBy('jours.id','asc')->get();
        // $semaine=DB::table('emplois')->join('semaines','emplois.semaine_id','=','semaines.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('semaines.*')->orderBy('semaines.id','asc')->get();
        $semaine=Emploi::join('semaines','semaines.id','=','emplois.semaine_id')->where('emplois.isvalide','=','oui')->whereIn('emplois.id',$query->get('emplois.id'))->select('semaines.*')->distinct()->get();
        $seance=Seance::orderBy('nomSe','asc')->get();
        // $formateur=Formateur::all();
        // $module=Module::all();
        // $salle=Salle::all();


        // $select=Emploi::whereIn('id',$query->get('id'))->orderBy('seance_id','desc')->get();
        // $jour = Jour::all();
        // $semaine = Semaine::whereIn('id',$query->groupBy('semaine_id')->get('semaine_id'))->get();
        // $formateur=Formateur::whereIn('id',$query->groupBy('formateur_id')->get('formateur_id'))->get();
        // $seance = Seance::orderBy('nomSe','asc')->get();
        // return view('Emploi.index.indexGroupe',['semaine'=>$semaine,'jour'=>$jour,'formateur'=>$formateur,'seance'=>$seance,'select'=>$select,'groupe'=>$groupe,'module'=>$module,'salle'=>$salle]);
        return view('Emploi.index.indexGroupe',['semaine'=>$semaine,'jour'=>$jour,'seance'=>$seance,'select'=>$select,'groupe'=>$groupe]);
        
    }
    public function consultFilterFormateur(){
        $formateur=Formateur::all();
        $semaine =Semaine::all();
        $salle=Salle::all();
        $seance=Seance::all();
        $jour=Jour::all();
        $filier=Filier::all();
        return view('Emploi.filter.consulte.consultFilterFormateur',['formateur'=>$formateur,'semaine'=>$semaine,'salle'=>$salle,'seance' => $seance,'jour'=>$jour,'filier'=>$filier]);
    }
     public function consultFilterGroupe(){
        $formateur=Formateur::all();
        $semaine =Semaine::all();
        $salle=Salle::all();
        $seance=Seance::all();
        $jour=Jour::all();
        $groupe=Groupe::all();
        $filier=Filier::all();
        return view('Emploi.filter.consulte.consultFilterGroupe',['formateur'=>$formateur,'semaine'=>$semaine,'salle'=>$salle,'seance' => $seance,'jour'=>$jour,'filier'=>$filier,'groupe'=>$groupe]);
    }
     public function consultFilterSalle(){
        // $formateur=Formateur::all();
        $semaine =Semaine::all();
        $salle=Salle::all();
        // $seance=Seance::all();
        // $jour=Jour::all();
        // $filier=Filier::all();
        // return view('Emploi.filter.consulte.consultFilterSalle',['formateur'=>$formateur,'semaine'=>$semaine,'salle'=>$salle,'seance' => $seance,'jour'=>$jour,'filier'=>$filier]);
        return view('Emploi.filter.consulte.consultFilterSalle',['semaine'=>$semaine,'salle'=>$salle]);
    }
    // public function createFilter(){
    //     $semaine =Semaine::all();
    //     $groupe=Groupe::all();
    //     $filier=Filier::all();
    //     return view('Emploi.filter.createFilter',['semaine'=>$semaine,'groupe'=>$groupe,'filier'=>$filier]);
    // }
    // public function editFilter(){
    //     $semaine =Semaine::all();
    //     $filier=Filier::all();
    //     $groupe=Groupe::all();
    //     return view('Emploi.filter.editFilter',['semaine'=>$semaine,'filier'=>$filier,'groupe'=>$groupe]);
        
    // }
    // public function create(Request $request){
    //     $data=array('smn' =>'semaine_id','gr'=>'groupe_id','fl'=>'Groupe_id');
    //     $query=Emploi::where('id','!=','');
    //     $v=$request->except('_token');
    //     foreach ($v as $key => $value) {
    //         if($value!=-1){
    //             if(strpos($value, '[{')!==false){
    //                 $ar = array();
    //                 foreach (json_decode($value,true) as $fv) {
    //                     array_push($ar,$fv["id"]);
    //                 }
    //                 $query->whereIn($data[$key],$ar);
                
    //             }
    //             else{
    //                 $query->where($data[$key],'=',$request->input($key));
    //             }
    //         }
    //     }
    //     $select=Emploi::whereIn('id',$query->get('id'))->orderBy('semaine_id','asc')->get();
    //     $groupe=DB::table('emplois')->join('groupes','emplois.groupe_id','=','groupes.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('groupes.*')->orderBy('groupes.id','asc')->get();
    //     $jour =Jour::all();//DB::table('emplois')->join('jours','emplois.jour_id','=','jours.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('jours.*')->orderBy('jours.id','asc')->get();
    //     $semaine=DB::table('emplois')->join('semaines','emplois.semaine_id','=','semaines.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('semaines.*')->orderBy('semaines.id','asc')->get();
    // 	$seance=Seance::orderBy('nomSe','asc')->get();
    //     $formateur=Formateur::all();
    //     $module=Module::all();
    //     $salle=Salle::all();
    //     // $emp = array();
    //     // foreach ($semaine as $sem) {
    //     //     foreach ($groupe as $g) {
    //     //         foreach ($jour as $j) {
    //     //             foreach ($seance as $s) {
    //     //                 if(count(Emploi::where([['semaine_id',$sem->id],['groupe_id',$g->id],['jour_id',$j->id],['seance_id',$s->id]])->get('id'))==0){
    //     //                     array_push($emp,(object)["semaine_id"=>$sem->id,"groupe_id"=>$g->id,"jour_id"=>$j->id,"seance_id"=>$s->id]);
    //     //                 }
    //     //             }
    //     //         }
    //     //     }
    //     // }
    //     // // return $emp;
    //     $Absence= json_decode('[{"abs":"oui"},{"abs":"non"}]',true);
    //     return view('Emploi.create',['jour' => $jour,'seance' => $seance,'formateur' => $formateur,'module' =>$module,'salle' => $salle,'groupe' => $groupe,'Absence'=>$Absence,'semaine'=>$semaine,'select'=>$select]);
    // }
    // public function store(Request $request){
    //     $data=$request->except(['_token']);
    //     $arrayName = array();
    //     foreach ($data as $key => $value) {
    //         $v=substr($key,0,strripos($key,','));
    //         // if($value!=-1){
    //             if(array_key_exists($v, $arrayName)){
    //             $arrayName[$v] = $arrayName[$v] . ',' . $value;
    //             }
    //             else{
    //             $arrayName[$v]=$value;
    //             }
    //         // }else{
    //         //     session()->flash('fail','voullez vous selectionner une valeur !!');
    //         //     return redirect('emplois/filter/createFilter');
    //         // }
    //     }
    //     $result;
    //     $result = array();

    //     foreach ($arrayName as $key => $value) {
    //         $result = explode(",", $key . ',' . $value);
    //         if($result[4]!=-1 && $result[5]!=-1) //&& $result[6]!=-1)
    //         {
    //             try{
    //                 $emplois = new Emploi();
    //                 $emplois->semaine_id=$result[0];
    //                 $emplois->jour_id=$result[1];
    //                 $emplois->seance_id=$result[2];
    //                 $emplois->groupe_id=$result[3];
    //                 $emplois->formateur_id=$result[4];
    //                 // $emplois->salle_id=$result[5];
    //                 $emplois->module_id=$result[5];
    //                 // $emplois->isvalide='oui';
    //                 $sm=Semaine::find($emplois->semaine_id);
    //                 // return $emplois;

    //                 // return $result[1];
    //                 // for ($i=$sm->dateDSemaine; $i < $sm->dateFSemaine; $i++) { 
    //                 //     if (date('N',strtotime($i))==$result[1]) {
    //                 //         $emplois->date=$i;
    //                 //     }
    //                 //     else{
    //                 //         continue;
    //                 //     }
    //                 // }

    //                     $i=$sm->dateDSemaine;
    //                     while($i<=$sm->dateFSemaine){
    //                          // return $i;
    //                         if (date('N',strtotime($i))==$result[1]) {
    //                             $emplois->date=$i;

    //                          }
    //                          $i=date('Y-m-d', strtotime($i . ' + 1 day'));
                             
    //                     }
    //                 // $emplois->absence_id=$result[7];
    //                 $emplois->save();
    //             }
    //             catch(\PDOException $e){
    //                 session()->flash('fail',$e->errorInfo[2]);
    //                 return back();
    //             }
    //         }
    //     }
    //     session()->flash('success','l\'emploi est Ajouter en success !!');
    //     return redirect('emplois/filter/createFilter');
    // }
    public function edit(Request $request){
        $data=array('semaine' =>'semaine_id','filier'=>'groupe_id','groupe'=>'groupe_id');
        $v=$request->except('_token');
        $query=Emploi::where('id','!=','');
        if($request->input('filier')=='-1' && $request->input('groupe')=='-1' && $request->input('semaine')=='-1')
        {
        $select=null;
        }else{
            foreach ($v as $key => $value) {
                if($value!=-1){
                    if(strpos($value, '[{')!==false){
                        $ar = array();
                        foreach (json_decode($value,true) as $fv) {
                            array_push($ar,$fv["id"]);
                        }
                        $query->whereIn($data[$key],$ar);
                    
                    }
                    else{
                        $query->where($data[$key],'=',$request->input($key));
                    }
                }
            }
            $select=Emploi::whereIn('id',$query->get('id'))->orderBy('semaine_id','asc')->get();
        }
        $groupe=DB::table('emplois')->join('groupes','emplois.groupe_id','=','groupes.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('groupes.*')->orderBy('groupes.id','asc')->get();
        $semaine=DB::table('emplois')->join('semaines','emplois.semaine_id','=','semaines.id')->whereIn('emplois.id',$query->get('emplois.id'))->distinct()->select('semaines.*')->orderBy('semaines.id','asc')->get();
        $jour = Jour::all();
        $seance=Seance::orderBy('nomSe','asc')->get();
        $formateur=Formateur::all();
        $module=Module::all();
        $salle=Salle::all();
        $filier=Filier::all();
        return view('Emploi.edit',['jour' => $jour,'seance' => $seance,'formateur' => $formateur,'module' =>$module,'salle' => $salle,'groupe' => $groupe,'semaine'=>$semaine,'select'=>$select,'filier'=>$filier]);

    }
    public function update(Request $request){
        $data=$request->except(['_token','_method']);
        $arrayName = array();
        foreach ($data as $key => $value){
            $v=substr($key,0,strripos($key,','));
            // if($value!=-1){
                if(array_key_exists($v, $arrayName)){
                $arrayName[$v] = $arrayName[$v] . ',' . $value;
                }
                else{
                $arrayName[$v]=$value;
                }
            // }else{
            //     session()->flash('fail','voullez vous selectionner une valeur !!');
            //     return redirect('emplois/filter/editFilter');
            // }
        }
        // return $arrayName;
        foreach ($arrayName as $key => $value) {
            $result = array();
            $result = explode(",", $key . ',' . $value);
            if($result[5]!='-1'&&$result[6]!='-1'&&$result[7]!='-1'){
                try{
                    $emplois;
                    if(Emploi::find($result[4])!=null){
                     $emplois=Emploi::find($result[4]);
                    }else{
                        $emplois=new Emploi();
                        $sm=Semaine::find($result[0]);
                        $i=$sm->dateDSemaine;
                        while($i<=$sm->dateFSemaine){
                            if (date('N',strtotime($i))==$result[1]) {
                                $emplois->date=$i;
                             }
                             $i=date('Y-m-d', strtotime($i . ' + 1 day'));
                        }
                    }
                    $emplois->semaine_id=$result[0];
                    $emplois->jour_id=$result[1];
                    $emplois->seance_id=$result[2];
                    $emplois->groupe_id=$result[3];
                    $emplois->formateur_id=$result[5];
                    $emplois->salle_id=$result[6];
                    $emplois->module_id=$result[7];
                    $emplois->isvalide='oui';
                    // $emplois->absence_id=$result[8];
                    $emplois->save();
                }
                catch(\PDOException $e){
                    session()->flash('fail',$e->errorInfo[2]);
                    return redirect('emplois/edit?semaine=' . $result[0] . '&filier=-1&groupe=' . $result[3]);
                }
            }
        }
        session()->flash('success','l\'emploi est bien valider !!');
        return redirect('emplois/edit?semaine=-1&filier=-1&groupe=-1');
        // return redirect('emplois/filter/editFilter');
    }
    public function destroy($id){
    }
}
