<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use SoftDeletes;
    protected $detes=['deleted_at'];
    public function periodejournee(){
		return $this->belongsTo('App\Periodejournee');
	}
}
