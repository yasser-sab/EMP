<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    public function formateurs(){
    	return $this->belongsToMany("App\Formateur","formateur_module");
    }
    public function niveau(){
    	return $this->belongsTo("App\Niveau");
    }
    public function filier(){
    	return $this->belongsTo("App\Filier");
    }
}
