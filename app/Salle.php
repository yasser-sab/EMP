<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	public function formateurs(){
		return $this->hasMany('App\Formateur');
	}
}
