@extends('layouts.app')

@section('content')
<?php
$ma = array('matin','apes midi');
$sea2 = $seance;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>EMPLOI DU TEMPS FORMATEUR</h1>
			</center>
			<!-- <div style="float: right;">
				<a href="{{url('emplois/filter/createFilter')}}" class="btn btn-success">Nouveau Emploi</a>
			</div> -->
			@if(@count($select)>0)
	@foreach($semaine as $sem)
		@foreach($formateur as $f)
		<h3><span style="color: grey">Formateur :</span> <span style="color: blue">{{$f->nomF}} {{$f->prenomF}}</span></h3>
		<table class="table table-bordered table-striped table-hover" border="1" align="center" width="80%" cellpadding="20">
			<thead>
				<tr>
							<th rowspan="2">Jour</th>
								@foreach($ma as $maap)
									<th colspan="2">{{$maap}}</th>
								@endforeach
							</tr>
							<tr>
								@foreach($seance as $sea)
									<th>{{$sea->nomSe}}<br>( {{$sea->dureeSe}} h )</th>
								@endforeach
				</tr>
			</thead>
			<tbody>
				
				@foreach($jour as $j)
					<tr>
						@if(count($select->where('formateur_id',$f->id)->where('semaine_id',$sem->id)->where('jour_id',$j->id))>0)
							<td>{{$j->jour}}</td>
								@foreach($seance as $s)
								@if(count($select->where('formateur_id',$f->id)->where('semaine_id',$sem->id)->where('jour_id',$j->id)->where('seance_id',$s->id))>0)
									@foreach($select as $emp)
										@if($emp->formateur_id==$f->id && $emp->semaine_id==$sem->id && $j->id==$emp->jour_id && $s->id==$emp->seance_id)
											<td style="background-color: #4682B4;color: white">{{$emp->formateur->prenomF}} - {{$emp->formateur->nomF}}<hr>{{$emp->groupe->nomG}}<hr><span title="{{$emp->module->nomMod}}">{{$emp->module->refMod}}</span><hr>{{$emp->salle->nomSa}}</td>
										@endif
								@endforeach
								@else
							<td>Vide</td>
					@endif
					@endforeach
						@endif
					</tr>
				@endforeach
				<tr><td colspan="5"><center><h6 style="color: red;">cet emploi du temps est valable à partir du {{$sem->dateDSemaine}} au {{$sem->dateFSemaine}}</h6></center></td></tr>

			</tbody>


			
			</table>
			
		@endforeach
	@endforeach
	@else
	<div class="container" style="z-index: 0;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">information</div>

                            <center>
                                <div style="color: red" class="card-body">
                                occune emplois valide trouver !
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
	@endif
		</div>
	</div>
</div>
@endsection