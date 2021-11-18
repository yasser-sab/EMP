<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semaine;
use App\Emploi;
use Illuminate\Support\Facades\DB;
class SemaineController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
    	$lstsemaine=Semaine::all();
    	return view('semaine.index',['semaines'=>$lstsemaine]);
    }
    public function create(){
    	return view('semaine.create');
    }
    public function store(Request $request){
    	if(count(Emploi::all())==0){
            DB::select('call generateSemaine(?,?)',array($request->input('dateD'),$request->input('dateF')));
        session()->flash('success','semaines est bien generée !!');
        return redirect('semaines');
        }
        session()->flash('fail','l\'emploi deja remplis !!');
        return view('semaine.create');
    }   
    
    public function edit($id){
    	$semaine=Semaine::find($id);
    	return view('semaine.edit',['semaine'=>$semaine]);
    }
    public function update(Request $request,$id){
    	$semaine =Semaine::find($id);
    	$semaine->dateDSemaine=$request->input('dateD');
    	$semaine->dateFSemaine=$request->input('dateF');
    	$semaine->save();
    	return redirect('semaines');
    }
    public function destroy($id){
    	$semaine =Semaine::find($id);
    	$semaine->delete();
    	return redirect('semaines');
    }
}
