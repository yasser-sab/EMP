<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleFormateur extends Model
{
	protected $table='module_formateur';
    use SoftDeletes;
	protected $dates=['deleted_at'];
    public function formateur(){
    	return $this->belongsTo('App\Formateur');
    }
    public function module(){
    	return $this->belongsTo('App\Module');
    }
}
