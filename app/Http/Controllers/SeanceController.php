<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seance;
use App\Periodejournee;

class SeanceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$listseance=Seance::all();
        $periode=Periodejournee::all();
    	return view('seance.index',['seance' => $listseance,'periode'=>$periode]);
    }
    public function create(){
        $periode=Periodejournee::all();
    	return view('seance.create',['periode'=>$periode]);
    }
    public function store(Request $request){
    	$seance=new Seance();
    	$seance->nomSe=$request->input('nom');
    	$seance->dureeSe=$request->input('duree');
        $seance->periodejournee_id=$request->input('periode');
    	$seance->save();
    	return redirect('seances');
    }
    public function edit($id){
    	$seance=Seance::find($id);
        $periode=Periodejournee::all();
        return view('seance.edit',['seance' => $seance,'periode'=>$periode]);
    }
    public function update(Request $request,$id){
    	$seance=Seance::find($id);
        $seance->nomSe=$request->input('nom');
        $seance->dureeSe=$request->input('duree');
        $seance->periodejournee_id=$request->input('periode');
        $seance->save();
        return redirect('seances');
    }
    public function destroy($id){
    	$seance=Seance::find($id);
        $seance->delete();
        return redirect('seances');
    }
}
