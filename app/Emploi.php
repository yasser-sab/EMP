<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    public function formateur(){
    	return $this->belongsTo('App\Formateur');
    }
    public function jour(){
    	return $this->belongsTo('App\Jour');
    }
    public function seance(){
    	return $this->belongsTo('App\Seance');
    }
    public function groupe(){
    	return $this->belongsTo('App\Groupe');
    }
    public function module(){
    	return $this->belongsTo('App\Module');
    }
    public function salle(){
    	return $this->belongsTo('App\Salle');
    }
    public function semaine(){
        return $this->belongsTo('App\Semaine');
    }
}
