<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StageRequest;
use App\Groupe;
use App\Stage;
use App\StageGroupe;
use App\Emploi;

class StageGroupeController extends Controller
{
 	public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listaffectstage=StageGroupe::paginate(3);
        return view('stagegroupe.index',['affectstage' => $listaffectstage]);
    }
    public function create(){
    	$lstgroupe=Groupe::all();
    	return view('stagegroupe.create',['groupe' => $lstgroupe]);
    }
    public function search(Request $request){
        $groupe= $request->input('groupe');
        $res= StageGroupe::join('groupes','groupes.id','=','stage_groupe.groupe_id')->join('filiers','filiers.id','=','groupes.filier_id')->join('niveaux','niveaux.id','=','groupes.niveau_id')
                        ->where('niveaux.annee','=',$groupe)
                        ->orWhere('niveaux.intitule','like','%' . $groupe . '%')
                        ->orWhere('filiers.abrFil','like','%' . $groupe . '%')
                        ->orWhere('filiers.nomFil','like','%' . $groupe . '%')
                        ->orWhere('groupes.nomG','like','%' . $groupe . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());

        return view('stagegroupe.index',['affectstage' => $res]);
    }
    public function store(StageRequest $request){
   		$stage=new Stage();
        try{
	        $stage->dateDebStage=$request->input('datedeb');
	        $stage->dateFinStage=$request->input('datefin');

	        if(count(Stage::where([['dateDebStage','=',$stage->dateDebStage],['dateFinStage','=',$stage->dateFinStage]])->get())==0)
	        {
	            $stage->save();
	        }
	        $res = Stage::where([['dateDebStage','=',$stage->dateDebStage],['dateFinStage','=',$stage->dateFinStage]])->get('id')->last()["id"];
	        // $res = json_decode(Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]])->get('id')->last(),true);
	        $affectstage=new StageGroupe();
	        $affectstage->stage_id=$res;
	        $affectstage->groupe_id=$request->input('groupe');
	        $affectstage->save();
	        // $groupe=StageGroupe::where('stage_id',$res)->get('groupe_id');
	        $groupe=$affectstage->groupe_id;
	        if(count(Emploi::whereBetween('date',[$stage->dateDebStage,$stage->dateFinStage])->where('groupe_id',$affectstage->groupe_id)->get())>0){
		        $i=$stage->dateDebStage;
		            while($stage->dateFinStage>=$i){

		            	$emploi=Emploi::where([['date',$i],['groupe_id',$groupe]]);
		           		$emploi->delete();
				      	$i=date('Y-m-d', strtotime($i . ' + 1 day'));
				    }   

		        session()->flash('success','stage bien affecter !! les emploi de ' . $stage->dateDebStage . ' au ' . $stage->dateFinStage . ' de groupe : ' . Groupe::find($groupe)->nomG . ' sont supprimer !!');
		        return redirect('stage_groupe');
	    	}
	    	session()->flash('success','stage bien affecter !! Aucun seance n\'a été trouvé pour groupe ' . Groupe::find($groupe)->nomG . ' cela entre ' . $stage->dateDebStage . ' et ' . $stage->dateFinStage);
		        return redirect('stage_groupe');
        }
        catch (\PDOException $e) {
        	$stage->delete();
            session()->flash('fail',$e->errorInfo[2]);
            return redirect('stage_groupe/create');
       	}
    }
    public function edit($id){
    	$afstage=StageGroupe::find($id);
        $groupe=Groupe::all();
        return view('stagegroupe.edit',['afstage' =>$afstage,'groupe' => $groupe]);
    }
    public function update(Request $request,$id){
        $afstage=StageGroupe::find($id);
        $stage=new Stage();
        $stage->dateDebStage=$request->input('datedeb');
        $stage->dateFinStage=$request->input('datefin');
        if(count(Stage::where([['dateDebStage','=',$stage->dateDebStage],['dateFinStage','=',$stage->dateFinStage]])->get())==0)
        {

            $stage->save();

        }
        $res = Stage::where([['dateDebStage','=',$stage->dateDebStage],['dateFinStage','=',$stage->dateFinStage]])->get('id')->last()["id"];
        // $res = json_decode(Stage::where([['dateDebStage','=',$request->input('datedeb')],['dateFinStage','=',$request->input('datefin')]])->get('id')->last(),true);
        $afstage->groupe_id=$request->input('groupe');
        $afstage->stage_id=$res;
        $afstage->save();
        return redirect('stage_groupe');
    }
    public function destroy($id){
    	$afstage=StageGroupe::find($id);
        $afstage->delete();
        return redirect('stage_groupe');
    }
}
