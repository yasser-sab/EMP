<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout');
});
// Route::get('/getRequest',function(){
// 	if(Request::ajax()){
// 		return 'message 1 loaded';
// 	}
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('Formateurs', 'FormateurController@index');
Route::get('Formateurs/search', 'FormateurController@search');
Route::get('Formateurs/create', 'FormateurController@create');
Route::post('Formateurs', 'FormateurController@store');
Route::get('Formateurs/{id}/edit', 'FormateurController@edit');
Route::put('Formateurs/{id}', 'FormateurController@update');
Route::delete('Formateurs/d{id}', 'FormateurController@destroy');

Route::get('salles', 'salleController@index');
Route::get('salles/create', 'salleController@create');
Route::post('salles', 'salleController@store');
Route::get('salles/{id}/edit', 'salleController@edit');
Route::put('salles/{id}', 'salleController@update');
Route::delete('salles/d{id}', 'salleController@destroy');

Route::get('groupes', 'GroupeController@index');
Route::get('groupes/create', 'GroupeController@create');
Route::get('groupes/search', 'GroupeController@search');

Route::post('groupes', 'GroupeController@store');
Route::get('groupes/{id}/edit', 'GroupeController@edit');
Route::put('groupes/{id}', 'GroupeController@update');
Route::delete('groupes/d{id}', 'GroupeController@destroy');

Route::get('filiers', 'FilierController@index');
Route::get('filiers/create', 'FilierController@create');
Route::post('filiers', 'FilierController@store');
Route::get('filiers/{id}/edit', 'FilierController@edit');
Route::put('filiers/{id}', 'FilierController@update');
Route::delete('filiers/d{id}', 'FilierController@destroy');

Route::get('niveaux', 'NiveauController@index');
Route::get('niveaux/create', 'NiveauController@create');
Route::post('niveaux', 'NiveauController@store');
Route::get('niveaux/{id}/edit', 'NiveauController@edit');
Route::put('niveaux/{id}', 'NiveauController@update');
Route::delete('niveaux/d{id}', 'NiveauController@destroy');

Route::get('formateur_groupe_module', 'FormateurGroupeModuleController@index');
Route::get('formateur_groupe_module/search', 'FormateurGroupeModuleController@search');
Route::get('formateur_groupe_module/create', 'FormateurGroupeModuleController@create');
Route::post('formateur_groupe_module', 'FormateurGroupeModuleController@store');
Route::get('formateur_groupe_module/{id}/edit', 'FormateurGroupeModuleController@edit');
Route::put('formateur_groupe_module/{id}', 'FormateurGroupeModuleController@update');
Route::delete('formateur_groupe_module/d{id}', 'FormateurGroupeModuleController@destroy');
Route::POST('formateur_groupe_module/getformateurs', 'FormateurGroupeModuleController@getformateurs');
Route::POST('formateur_groupe_module/getmodules', 'FormateurGroupeModuleController@getmodules');
Route::POST('formateur_groupe_module/getgroupes', 'FormateurGroupeModuleController@getgroupes');

Route::get('affectformateurs', 'AffectformateurController@index');
Route::get('affectformateurs/create', 'AffectformateurController@create');
Route::post('affectformateurs', 'AffectformateurController@store');
Route::get('affectformateurs/{id}/edit', 'AffectformateurController@edit');
Route::put('affectformateurs/{id}', 'AffectformateurController@update');
Route::delete('affectformateurs/d{id}', 'AffectformateurController@destroy');

Route::get('stage_groupe', 'StageGroupeController@index');
Route::get('stage_groupe/create', 'StageGroupeController@create');
Route::post('stage_groupe', 'StageGroupeController@store');
Route::get('stage_groupe/{id}/edit', 'StageGroupeController@edit');
Route::put('stage_groupe/{id}', 'StageGroupeController@update');
Route::delete('stage_groupe/d{id}', 'StageGroupeController@destroy');
Route::get('stage_groupe/search', 'StageGroupeController@search');

Route::get('filier_formateur', 'FilierFormateurController@index');
Route::get('filier_formateur/create', 'FilierFormateurController@create');
Route::get('filier_formateur/search', 'FilierFormateurController@search');

Route::post('filier_formateur', 'FilierFormateurController@store');
Route::get('filier_formateur/{id}/edit', 'FilierFormateurController@edit');
Route::put('filier_formateur/{id}', 'FilierFormateurController@update');
Route::delete('filier_formateur/d{id}', 'FilierFormateurController@destroy');

Route::get('module_filier', 'ModuleFilierController@index');
Route::get('module_filier/create', 'ModuleFilierController@create');
Route::get('module_filier/search', 'ModuleFilierController@search');

Route::post('module_filier', 'ModuleFilierController@store');
Route::get('module_filier/{id}/edit', 'ModuleFilierController@edit');
Route::put('module_filier/{id}', 'ModuleFilierController@update');
Route::delete('module_filier/d{id}', 'ModuleFilierController@destroy');

Route::get('module_formateur', 'ModuleFormateurController@index');
Route::get('module_formateur/create', 'ModuleFormateurController@create');
Route::get('module_formateur/search', 'ModuleFormateurController@search');
Route::post('module_formateur', 'ModuleFormateurController@store');
Route::get('module_formateur/{id}/edit', 'ModuleFormateurController@edit');
Route::put('module_formateur/{id}', 'ModuleFormateurController@update');
Route::delete('module_formateur/d{id}', 'ModuleFormateurController@destroy');
Route::POST('module_formateur/getmodules', 'ModuleFormateurController@getmodules');


// Route::post('module_formateur/fetch', 'ModuleFormateurController@fetch')->name('module_formateur.fetch');

Route::get('modules', 'ModuleController@index');
Route::get('modules/create', 'ModuleController@create');
Route::get('modules/search', 'ModuleController@search');

Route::post('modules', 'ModuleController@store');
Route::get('modules/{id}/edit', 'ModuleController@edit');
Route::put('modules/{id}', 'ModuleController@update');
Route::delete('modules/d{id}', 'ModuleController@destroy');

Route::get('seances', 'SeanceController@index');
Route::get('seances/create', 'SeanceController@create');
Route::post('seances', 'SeanceController@store');
Route::get('seances/{id}/edit', 'SeanceController@edit');
Route::put('seances/{id}', 'SeanceController@update');
Route::delete('seances/d{id}', 'SeanceController@destroy');

Route::get('semaines', 'SemaineController@index');
Route::get('semaines/create', 'SemaineController@create');
Route::post('semaines', 'SemaineController@store');
Route::get('semaines/{id}/edit', 'SemaineController@edit');
Route::put('semaines/{id}', 'SemaineController@update');
Route::delete('semaines/d{id}', 'SemaineController@destroy');

Route::post('emplois/indexFormateur', 'EmploiController@indexFormateur');
Route::post('emplois/indexSalle', 'EmploiController@indexSalle');
Route::post('emplois/indexGroupe', 'EmploiController@indexGroupe');

Route::POST('emplois/pdf', 'EmploiController@pdf');

Route::post('emplois/index', 'EmploiController@index');
Route::post('emplois/create', 'EmploiController@create');
Route::post('emplois', 'EmploiController@store');
Route::get('emplois/edit', 'EmploiController@edit');
Route::put('emplois/update', 'EmploiController@update');
Route::delete('emplois/d{id}', 'EmploiController@destroy');
Route::get('emplois/filter/consultFilterFormateur', 'EmploiController@consultFilterFormateur');
Route::get('emplois/filter/consultFilterGroupe', 'EmploiController@consultFilterGroupe');
Route::get('emplois/filter/consultFilterSalle', 'EmploiController@consultFilterSalle');
Route::get('emplois/filter/createFilter', 'EmploiController@createFilter');
Route::get('emplois/filter/editFilter', 'EmploiController@editFilter');




Route::get('emploiparams', 'EmploiparamController@index');
Route::get('emploiparams/create', 'EmploiparamController@create');
Route::post('emploiparams', 'EmploiparamController@store');
Route::get('emploiparams/{id}/edit', 'EmploiparamController@edit');
Route::put('emploiparams/{id}', 'EmploiparamController@update');
Route::delete('emploiparams/d{id}', 'EmploiparamController@destroy');
Route::get('emploiparams/generer', 'EmploiparamController@generer');

Route::post('test', 'EmploiparamController@test');

Route::get('test/create', 'EmploiparamController@test');
