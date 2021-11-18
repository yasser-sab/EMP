<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filier;
use App\Http\Requests\filierRequest;

class FilierController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $listfilier=Filier::all();
        return view('filier.index',['filier' => $listfilier]);
    }
    public function create(){
        return view('filier.create');
    }
    public function store(filierRequest $request){
        // return array_slice((array)$request->except(['_token']),1);

        $filier=new Filier();

        foreach($request->except(['_token']) as $key => $value) {
            $filier[$key . "Fil"] = $request->input($key);
        }

        $filier->save();
    	// $filier=new Filier();
     //    $filier->nomFil=$request->input('nom');
     //    $filier->abrFil=$request->input('abr');
     //    $filier->save();
        return redirect('filiers');
    }
    public function edit($id){
    	$filier=Filier::find($id);
        return view('filier.edit',['filier' => $filier]);
    }
    public function update(filierRequest $request,$id){
    	$filier=Filier::find($id);

        foreach($request->except(['_token','_method']) as $key => $value) {
            $filier[$key . "Fil"] = $request->input($key);
        }
        
        // $filier->nomFil=$request->input('nom');
        // $filier->abrFil=$request->input('abr');
        $filier->save();
        return redirect('filiers');
    }
    public function destroy($id){
    	$filier=Filier::find($id);
        $filier->delete();
        return redirect('filiers');
    }
}
