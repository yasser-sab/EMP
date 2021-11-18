<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groupe extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	public function filier(){
		return $this->belongsTo('App\Filier');
	}
	public function niveau(){
		return $this->belongsTo('App\Niveau');
	}
}
