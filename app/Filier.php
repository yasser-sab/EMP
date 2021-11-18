<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filier extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
    public function groupes(){
    	return $this->hasMany('App\Groupe');
    }
}
