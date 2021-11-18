<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emploiparam extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	
    public function seance(){
    	return $this->belongsTo("App\Seance");
    }
    public function jour(){
    	return $this->belongsTo("App\Jour");
    }
    public function formateur_groupe_module(){
    	return $this->belongsTo("App\FormateurGroupeModule");
    }
}
