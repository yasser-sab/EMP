<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\groupeRequest;
use App\Groupe;
use App\Niveau;
use App\Filier;

class GroupeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$listgroupe=Groupe::paginate(3);
    	return view('groupe.index',['groupe' => $listgroupe]);
    }
    public function create(){
    	$listniveau=Niveau::all();
    	$listfilier=Filier::all();
    	return view('groupe.create',['niveau' => $listniveau,'filier' => $listfilier]);
    }
    public function search(Request $request){
        $groupe= $request->input('groupe');
        $res= Groupe::join('filiers','filiers.id','=','groupes.filier_id')->join('niveaux','niveaux.id','=','groupes.niveau_id')
                        ->where('niveaux.annee','=',$groupe)
                        ->orWhere('niveaux.intitule','like','%' . $groupe . '%')
                        ->orWhere('filiers.abrFil','like','%' . $groupe . '%')
                        ->orWhere('filiers.nomFil','like','%' . $groupe . '%')
                        ->orWhere('groupes.nomG','like','%' . $groupe . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());

        return view('groupe.index',['groupe' => $res]);
    }
    public function store(groupeRequest $request){
        try{
        	$groupe=new Groupe();
        	$groupe->nomG=$request->input('nom');
        	$groupe->filier_id=$request->input('nomFil');
        	$groupe->niveau_id=$request->input('nomNiveau');
        	$groupe->save();
        	return redirect('groupes');
        }
        catch (\PDOException $e) {
                session()->flash('fail',$e->errorInfo[2]);
                return redirect('groupes/create');
        }
    }
    public function edit($id){
        	$groupe=Groupe::find($id);
            $filier=Filier::all();
            $nvgroupe=Niveau::all();
            return view('groupe.edit',['groupe' => $groupe,'filier' => $filier,'nvgroupe' => $nvgroupe]);
        
    }
    public function update(groupeRequest $request,$id){
        try{
    	$groupe=Groupe::find($id);
        $groupe->nomG=$request->input('nom');
        $groupe->filier_id=$request->input('nomFil');
        $groupe->niveau_id=$request->input('niv');
        $groupe->save();
        return redirect('groupes');
        }
        catch (\PDOException $e) {
            session()->flash('fail',$e->errorInfo[2]);
            return redirect('groupes/' . $id . '/edit');
        }
    }
    public function destroy($id){
    	$groupe=Groupe::find($id);
        $groupe->delete();
        return redirect('groupes');
    }
}
