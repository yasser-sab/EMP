<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salle;

class salleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listsalle=Salle::all();
        return view('salle.index',['salle' => $listsalle ]);
        /*return view('formateur.create',['sa' => $listsalle]);*/
    }
    public function create(){
    	return view('salle.create');
    }
    public function store(Request $request){
    	$salle = new Salle();
        $salle->nomSa=$request->input('nom');
        $salle->save();
        return redirect('salles');
    }
    public function edit($id){
    	$salle=Salle::find($id);
        return view('salle.edit',['salle' => $salle]);
    }
    public function update(Request $request,$id){
    	$salle=Salle::find($id);
        $salle->nomSa=$request->input('nom');
        $salle->save();
        return redirect('salles');
    }
    public function destroy($id){
        $salle=Salle::find($id);
    	$salle->delete();
        return redirect('salles');
    }
}
