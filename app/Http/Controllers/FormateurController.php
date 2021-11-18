<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salle;
use App\Formateur;
use App\Http\Requests\formateurRequest;

class FormateurController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listformateur=Formateur::paginate(3);
        return view('formateur.index',['formateur' => $listformateur]);
    }
    public function create(){
        $listsalle=Salle::all();
    	return view('formateur.create',['sa' => $listsalle]);
    }
    public function search(Request $request){
        $listformateur=Formateur::where('nomF','like','%' . $request->get('formateur') . '%')
                                    ->orWhere('id','like','%' . $request->get('formateur') . '%')
                                    ->orWhere('prenomF','like','%' . $request->get('formateur') . '%')
                                    ->orWhere('emailF','like','%' . $request->get('formateur') . '%')
                                    ->orWhere('telF','like','%' . $request->get('formateur') . '%')
                                    ->orWhere('adrF','like','%' . $request->get('formateur') . '%')
                                    ->paginate(3)->setpath('');
                                    $listformateur->appends($request->all());
        return view('formateur.index',['formateur' => $listformateur]);
    }
    public function store(formateurRequest $request){
    	$formateur =new Formateur();
        $formateur->nomF=$request->input('nom');
        $formateur->prenomF=$request->input('prenom');
        $formateur->emailF=$request->input('email');
        $formateur->telF=$request->input('telephone');
        $formateur->adrF=$request->input('adresse');
        $formateur->salle_id=$request->input('salle');
        if($formateur->salle_id!="-1"){
            if(count(Formateur::where('salle_id','=',$request->input('salle'))->get('id'))==2){
            session()->flash('fail',Salle::find($request->input('salle'))->nomSa . ' deja occuper');
            return redirect('Formateurs/create');
            }else{
            $formateur->save();
            session()->flash('success','le formateur ' . $request->input('nom') . ' ' . $request->input('prenom') . ' et bien Ajouter !!');
            return redirect('Formateurs');
            }
        }
        $formateur->salle_id=null;
        $formateur->save();
        session()->flash('success','le formateur ' . $request->input('nom') . ' ' . $request->input('prenom') . ' et bien Ajouter !!');
        return redirect('Formateurs');
    }
    public function edit($id){
    	$listformateur=Formateur::find($id);
        $listsalle=Salle::all();
        return view('formateur.edit',['formateur' => $listformateur,'salle' => $listsalle]);
    }
    public function update(Request $request,$id){
        try{
            $formateur=Formateur::find($id);
        $nom=$formateur->nomF;
        $prenom=$formateur->prenomF;
        $formateur->nomF=$request->input('nom');
        $formateur->prenomF=$request->input('prenom');
        $formateur->adrF=$request->input('adresse');
        $formateur->emailF=$request->input('email');
        $formateur->telF=$request->input('telephone');
        $formateur->salle_id=$request->input('salle');
        if($formateur->salle_id!="-1"){
            
            if(count(Formateur::where([['salle_id','=',$request->input('salle')],['nomF','!=',$nom]])->get('id'))==2){
            session()->flash('fail',Salle::find($request->input('salle'))->nomSa . ' deja occuper');
            return redirect('Formateurs/' . $id . '/edit');
            }else{
            $formateur->save();
            session()->flash('success','le formateur ' . $nom . ' ' . $prenom . ' et bien Modifier !!');
            return redirect('Formateurs');
            }
        }
        $formateur->salle_id=null;
        $formateur->save();
        session()->flash('fail',$formateur->nomF . " - " . $formateur->prenomF . ' salle été supprimer !!');
        return redirect('Formateurs');
    }catch (\PDOException $e) {
        session()->flash('fail',$e->errorInfo[2]);
    return redirect('Formateurs/' . $id . '/edit');
    }
    }
    public function destroy($id){
    	$formateur=Formateur::find($id);
        $formateur->delete();
        return redirect('Formateurs');
    }
}
