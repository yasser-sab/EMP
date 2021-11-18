<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilierFormateur extends Model
{
	use SoftDeletes;
	protected $table='filier_formateur';
	
    public function filier(){
    	return $this->belongsTo('App\Filier');
    }
    public function formateur(){
    	return $this->belongsTo('App\Formateur');
    }
    protected $dates=['deleted_at'];
}
