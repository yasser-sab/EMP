<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Filier;
use App\FilierFormateur;

class FilierFormateurController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   	public function index(){
   		$filier_formateur=FilierFormateur::paginate(3);
   		return view('filierformateur.index',['filierformateur' => $filier_formateur]);
    }
    public function create(){
    	$formateur=Formateur::all();
    	$filier=Filier::all();
    	return view('filierformateur.create',['formateur' => $formateur,'filier' => $filier]);
    }
    public function search(request $request)
    {
        $filier= $request->input('filier');
        $res= FilierFormateur::join('filiers','filiers.id','=','filier_formateur.filier_id')->join('formateurs','formateurs.id','=','filier_formateur.formateur_id')
                        ->where('filiers.nomFil','like','%' . $filier . '%')
                        ->orWhere('filiers.abrFil','like','%' . $filier . '%')
                        ->orWhere('formateurs.nomF','like','%' . $filier . '%')
                        ->orWhere('formateurs.prenomF','like','%' . $filier . '%')
                        ->paginate(3)->setpath('');
                        $res->appends($request->all());

        return view('filierformateur.index',['filierformateur' => $res]);
    }
    public function store(Request $request){
    	$data=$request->except(['_token']);
    	$filier="";
    	if(count($data)>1){
    		try{
		    	foreach ($data as $key => $value) {
		    		if($key=="filier"){
		    			$filier=$value;
		    		}else{
		    			
			    			$filierformateur=new FilierFormateur();
					    	$filierformateur->formateur_id=$value;
					    	$filierformateur->filier_id=$filier;
					    	$filierformateur->save();
				    	
				    	
		    		}
		        }
	        return redirect('filier_formateur');
	        }
	        catch (\PDOException $e) {
				session()->flash('fail',$e->errorInfo[2]);
				return redirect('filier_formateur/create');
			}
       	}
       	session()->flash('fail','you must select at least one formateur');
       	return redirect('filier_formateur/create');
    }
    public function edit($id){
    	$affilier=FilierFormateur::find($id);
        $formateur=Formateur::all();
        $filier=Filier::all();
        return view('filierformateur.edit',['affilier' => $affilier,'formateur' => $formateur,'filier' =>$filier]);
    }
    public function update(Request $request,$id){
    	try{
	    	$affilier=FilierFormateur::find($id);
	        $affilier->formateur_id=$request->input('formateur');
	        $affilier->filier_id=$request->input('filier');
	        $affilier->save();
    	}
        catch (\PDOException $e) {
			session()->flash('fail',$e->errorInfo[2]);
			return redirect('filier_formateur/' . $id . '/edit');
		}
        return redirect('filierformateurs');
    }
    public function destroy($id){
    	$filierformateur=FilierFormateur::find($id);
        $filierformateur->delete();
        return redirect('filier_formateur');
    }
}
