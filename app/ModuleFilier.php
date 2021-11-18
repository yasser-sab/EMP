<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleFilier extends Model
{
	protected $table='module_filier';
	use SoftDeletes;
    protected $dates=['deleted_at'];
    public function module(){
    	return $this->belongsTo('App\Module');
    }
    public function filier(){
    	return $this->belongsTo('App\Filier');
    }
}
