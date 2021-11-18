<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\niveauRequest;
use App\Niveau;


class NiveauController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$listniveau=Niveau::all();
    	return view('niveau.index',['niveau' => $listniveau]);
    }
    public function create(){
    	return view('niveau.create');
    }
    public function store(Request $request){
        try{
    	$niveau=new Niveau();
    	$niveau->annee=$request->input('annee');
    	$niveau->intitule=$request->input('intitule');
    	$niveau->save();
    	return redirect('niveaux');
        }
        catch (\PDOException $e) {
        session()->flash('fail',$e->errorInfo[2]);
        return redirect('niveaux/create');
        }
    }
    public function edit($id){
    	$niveau=Niveau::find($id);
        return view('niveau.edit',['niveau' => $niveau]);
    }
    public function update(Request $request,$id){
        try{
    	$niveau=Niveau::find($id);
        $niveau->annee=$request->input('annee');
        $niveau->intitule=$request->input('intitule');
        $niveau->save();
        }
        catch (\PDOException $e) {
        session()->flash('fail',$e->errorInfo[2]);
        return redirect('niveaux/' . $id . '/create');
        }
        return redirect('niveaux');
    }
    public function destroy($id){
    	$niveau=Niveau::find($id);
        $niveau->delete();
        return redirect('niveaux');
    }
}
