<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupe;
use App\Stage;
use App\Affectstage;
use App\Emploi;

class AffectstageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listaffectstage=Affectstage::all();
        return view('affectstage.index',['affectstage' => $listaffectstage]);
    }
    public function create(){
    	$lstgroupe=Groupe::all();
    	return view('affectstage.create',['groupe' => $lstgroupe]);
    }
    public function store(Request $request){

        $stage=new Stage();
        $stage->dateDebStage=$request->input('datedeb');
        $stage->dateFinStage=$request->input('datefin');
        if(count((Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]]))->get())==0)
        {

            $stage->save();

        }
        $res = json_decode(Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]])->get('id')->last(),true);
        $affectstage=new Affectstage();
        $affectstage->stage_id=$res['id'];
        $affectstage->groupe_id=$request->input('groupe');
        $affectstage->save();
        $groupe=Affectstage::where('stage_id',$res)->get('groupe_id');
        for ($i=$request->input('datedeb'); $i < $request->input('datefin'); $i++) { 
           $emploi=Emploi::where([['date',$i],['groupe_id',$groupe[0]->groupe_id]]);
           $emploi->delete();
        }
        session()->flash('success','stage bien affecter !! les emploi de ' . $request->input('datedeb') . ' au ' . $request->input('datefin') . ' de ce groupe sont supprimer !!');
        return redirect('affectstages');
    }
    public function edit($id){
    	$afstage=Affectstage::find($id);
        $groupe=Groupe::all();
        return view('affectstage.edit',['afstage' =>$afstage,'groupe' => $groupe]);
    }
    public function update(Request $request,$id){
        $afstage=Affectstage::find($id);
        $stage=new Stage();
        $stage->dateDebStage=$request->input('datedeb');
        $stage->dateFinStage=$request->input('datefin');
        if(count((Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]]))->get())==0)
        {

            $stage->save();

        }
        $res = json_decode(Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]])->get('id')->last(),true);
        $afstage->groupe_id=$request->input('groupe');
        $afstage->stage_id=$res['id'];
        $afstage->save();
        return redirect('affectstages');
    }
    public function destroy($id){
    	$afstage=Affectstage::find($id);
        $afstage->delete();
        return redirect('affectstages');
    }
}