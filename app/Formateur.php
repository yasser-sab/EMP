<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table='formateurs';
	public function salle(){
		return $this->belongsTo('App\Salle');
	}
	public function modules(){
		return $this->belongsToMany("App\Module","formateur_module");
	}
   
}
