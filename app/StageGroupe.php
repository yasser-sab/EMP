<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StageGroupe extends Model
{
	use SoftDeletes;
	protected $table='stage_groupe';
	protected $dates=['deleted_at'];
    public function stage(){
    	return $this->belongsTo('App\Stage');
    }
     public function groupe(){
    	return $this->belongsTo('App\Groupe');
    }
}
