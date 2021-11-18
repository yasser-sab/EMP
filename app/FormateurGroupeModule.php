<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormateurGroupeModule extends Model
{
	use SoftDeletes;
	protected $table='formateur_groupe_module';
    protected $dates=['deleted_at'];
    public function formateur()
    {
    	return $this->belongsTo('App\Formateur');
    }
    public function groupe()
    {
    	return $this->belongsTo('App\Groupe');
    }
    public function module()
    {
    	return $this->belongsTo('App\Module');
    }
}
