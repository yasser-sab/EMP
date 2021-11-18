@extends('layouts.app')
@section('content')
<?php 
// $arrayName = array('Formateur'=>$formateur,'Salle'=>$salle,'Module'=>$module,'Absence'=>['non','oui']);
	$arrayName = array('Formateur;Salle;Module;Absence');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
	<center>


		@if(session()->has('success'))
	        <div class="alert alert-success">
	          {{session()->get('success')}}
	        </div>
	        @endif</center>
	         <center>@if(session()->has('fail'))
	        <div class="alert alert-danger">
	          {{session()->get('fail')}}
	        </div>
	        @endif
	        <h1>validation emplois</h1>

			
<div class="container">
	<button type="button" class="btn btn-default btn-sm" style="" data-toggle="collapse" data-target="#demo">
          <span class="glyphicon glyphicon-search"></span> Search 
        </button>
  <div id="demo" class="collapse">
    <form action="{{url('emplois/edit')}}" method="get">
				         <table class="table">
				           <thead>
				              <th>Semaine</th>
				              <th>Filier</th>
				             <th>Groupe</th>
				           </thead>
				           <tbody>
				             <tr>
				              <td>
				                <select name="semaine" class="form-control">
				                  <option value="-1">select semaine</option>
				                  @foreach(App\Semaine::all() as $s)
				                  <option value= "{{$s->id}}">{{$s->dateDSemaine}} -> {{$s->dateFSemaine}}</option>
				                  @endforeach
				                </select>
				              </td>
				              <td>
				                <select name="filier" class="form-control">
				                  <option value="-1">select filier</option>
				                  @foreach(App\Filier::all() as $fil)
				                  <option value="{{$fil->groupes()->get('id')}}">{{$fil->abrFil}}</option>
				                  @endforeach
				                </select>
				              </td>
				              <td>
				                <select name="groupe" class="form-control">
				                  <option value="-1">select groupe</option>
				                  @foreach(App\Groupe::all() as $g)
				                  <option value="{{$g->id}}">{{$g->nomG}}</option>
				                  @endforeach
				                </select>
				              </td>
				             </tr>
				             <!-- <tr><td colspan="" class="col-md-4"><input type="submit" class="form-control btn btn-primary"></td></tr> -->
				             <tr><td colspan="3"><center><input value="Search" type="submit" class="form-control btn btn-primary col-md-2"></center></td></tr>
				           </tbody>
				         </table>
	      			</form>
  </div>
</div>				
	</center>
@if(@count($select)>0)
<form action="{{url('emplois/update')}}" method="post" style="position: relative;">
	<div style="position: fixed; right: 0%;top:10%;z-index: 1111">
		<input type="submit" value="valider" class="form-control btn btn-primary ">
	</div>

	<input type="hidden" name="_method" value="PUT">
	{{csrf_field()}}
	@foreach($semaine as $sem)
	<h6>Semaine : ( {{$sem->dateDSemaine}} -> {{$sem->dateFSemaine}} )</h6>
	<table class="table table-bordered table-striped table-hover" id="table" border="1">
		<thead align="center">
			<tr>
				<td colspan="2" rowspan="3">groupe</td>
				<td colspan="2" rowspan="3">F<br/>S<br/>M<br/>A</td>
				@foreach($jour as $j)
				<td colspan="4">{{$j->jour}}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($jour as $j)
				<td colspan="2">matin</td>
				<td colspan="2">apres midi</td>
				@endforeach
			</tr>
			<tr>
				@foreach($jour as $j)
					@foreach($seance as $s)
					<td>{{$s->nomSe}}</td>
					@endforeach
				@endforeach
			</tr>
		</thead>
		
		<tbody>
				@foreach($groupe as $g)
				
					<td colspan="2" rowspan="2">{{$g->nomG}}</td>
				
				@foreach($arrayName as $value)
				<tr>
					<td colspan="2">
						<?php
	                        $res=explode(';', $value);
								foreach ($res as $key => $value) {
									echo "</p>" . $value . "<p>";
										if(count($res)-1 != $key)
										{
											echo "<hr>";
										}
									}
	                        	 ?>
					</td>
					@foreach($jour as $j)
						@foreach($seance as $s)
								@if(count($select->where('groupe_id',$g->id)->where('semaine_id',$sem->id)->where('jour_id',$j->id)->where('seance_id',$s->id))>0)
								<td style="background-color: #4682B4;color: white">
									@foreach($select as $emp)
									@if($emp->semaine_id==$sem->id && $emp->groupe_id==$g->id && $emp->jour_id==$j->id && $emp->seance_id==$s->id)
										@if($emp->isvalide=='oui')
										<center><h6 style="background-color: white;color: green">( valide )</h6></center>
										@else
										<center><h6 style="background-color: white;color: #DC143C">( non valide )</h6></center>
										@endif

										<span>
											<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},{{$emp->id}},f:{{$emp->formateur_id}}" style="background-color: orange;color:white;">
											<!-- <option value="-1">select formateur</option> -->
											@foreach($formateur as $f)
												@if($emp->formateur_id!=$f->id)
												<option title="{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}} - {{$f->prenomF}}</option>
												@else
												<option title="{{$f->salle->nomSa}}" selected="" value="{{$f->id}}">{{$f->nomF}} - {{$f->prenomF}}</option>
												@endif
											@endforeach
											</select>
										</span><hr>
										<!-- <p style="background-color: orange;color:white;">{{$f->salle->nomSa}}</p><hr> -->

										<span>
											<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},{{$emp->id}},s:{{$emp->salle_id}}" style="background-color: green;color:white;">
											@foreach($salle as $sa)
												@if($emp->salle_id!=$sa->id)
												<option value="{{$sa->id}}">{{$sa->nomSa}}</option>
												@else
												<option selected="" value="{{$sa->id}}">{{$sa->nomSa}}</option>
												@endif
											@endforeach
											</select>
										</span><hr>


										<p>
											<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},{{$emp->id}},m:{{$emp->module_id}}" style="background-color:blue;color:white;">
											<!-- <option value="-1">select module</option> -->
											@foreach($module as $m)
												@if($emp->module_id!=$m->id)
													<option title="{{$m->nomMod}}" value="{{$m->id}}">{{$m->refMod}}</option>
													@else
													<option title="{{$m->nomMod}}" selected="" value="{{$m->id}}">{{$m->refMod}}</option>
												@endif
											@endforeach
											</select>
										</p><hr>

										{{--<select id="{{$sem->id}}{{$j->id}}{{$s->id}}{{$g->id}}absence" name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},{{$emp->id}},absence" style="background-color:yellow;">
											@foreach($value as $abs)
												@if($emp->Absence_id!=null)
												<option selected="" value="{{$abs}}">{{$abs}}</option>
												@else
												<option value="{{$abs}}">{{$abs}}</option>
												@endif
											@endforeach
										</select>
										<script type="text/javascript">
										$(document).ready(function(){
											$('#{{$sem->id}}{{$j->id}}{{$s->id}}{{$g->id}}absence').change(function(){
											 Swal.fire('</table border="1">\
											 	<tr>\
											 	<td>\
											 	select motif\
											 	</td>\
											 	<td>\
											 	<select>\
											 	@foreach(App\Salle::all() as $s)\
											 	<option>{{$s->nomSa}}</option>\
											 	@endforeach\
											 	</select>\
											 	</td>\
											 	<tr>\
											 	</table>');
											});

										});
										</script>--}}
									
									@endif
									@endforeach
								</td>
								@else
								<td style="background-color: #4682B4;color: white;opacity: .8">
									
									<center><h6 style="color: green;background-color: white">( disponible )</h6></center>
									<span>
										<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},-1,f" style="background-color: orange;color:white;">
												<option value="-1">select formateur</option>
												@foreach($formateur as $f)
												<option title="{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}} - {{$f->prenomF}}</option>
												@endforeach
										</select>
									</span><hr>

									<span>
										<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},-1,s" style="background-color: green;color:white;">
											<option value="-1">select salle</option>
											@foreach($salle as $sa)
												<option value="{{$sa->id}}">{{$sa->nomSa}}</option>
											@endforeach
										</select>
									</span><hr>

									<span>
										<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},-1,m" style="background-color:blue;color:white;">
													<option value="-1">select module</option>
													@foreach($module as $m)
														<option title="{{$m->nomMod}}" value="{{$m->id}}">{{$m->refMod}}</option>
													@endforeach
										</select>
									</span><hr>

									<span>
										{{--<select id="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}}ab" name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},abs" style="background-color:yellow;">
												<option>oui</option>
												<option>non</option>
										</select>
										<script type="text/javascript">
											$(document).ready(function(){
												('#{{$j->id}}{{$s->id}}{{$g->id}}absence').change(function(){
														 var res=prompt('Absence','{{$j->jour}} ; {{$s->nomSe}} ; {{$g->nomG}}');
															if(res==null){
																$("#{{$j->jour}}{{$s->nomSe}}{{$g->nomG}}abs").attr('checked','true');
															}
														});
													});
										</script>--}}
									</span>
								</td>
								@endif
						@endforeach
					@endforeach
				</tr>
				@endforeach
			@endforeach
		</tbody>
		
	</table>
	@endforeach
</form>
@else
<div class="container" style="z-index: 0;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">information</div>

                            <center>
                                <div style="color: red" class="card-body">
                                occune emplois trouver !!
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
 </div>
@endif
@endsection