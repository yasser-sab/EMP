@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			$('#fil').text($('#groupe').children('option:selected').attr('id').split(';')[0]);
			$('#niv').text($('#groupe').children('option:selected').attr('id').split(';')[1]);
		    $("#groupe").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#fil').text(res[0]);
		        $('#niv').text(res[1]);
		    });
		});
	</script>
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('affectstages/' . $afstage->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey">Groupe : </th></tr>
							<tr><th>nom</th>
							<th>filier</th>
							<th>niveau</th></tr>
						</thead>
						<tbody>
							<td>
								<select name="groupe" id="groupe" class="form-control">
									@foreach($groupe as $g)
									@if($g->id!=$afstage->groupe_id)
									<option id="{{$g->filier->abrFil}};{{$g->niveaugroupe()->intitule}}" value="{{$g->id}}">{{$g->nomG}}</option>
									@else
									<option selected="" id="{{$g->filier->abrFil}};{{$g->niveaugroupe()->intitule}}" value="{{$g->id}}">{{$g->nomG}}</option>
									@endif
									@endforeach
								</select>
							</td>
							<td id="fil"></td>
							<td id="niv" width="20%"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Periode de stage : </th></tr>
							<tr><th>Date debut</th>
							<th>Date fin</th></tr>
						</thead>
						<tbody>
						<td>
							<input type="date" name="datedeb" id="datedeb" class="form-control" value="{{$afstage->stage->dateDebStage}}">
						</td>
						<td>
							<input type="date" name="datefin" id="datefin" class="form-control" value="{{$afstage->stage->dateFinStage}}">
						</td>
						</tbody>
					</figure>
				</table>
			<input type="submit" value="Modifier" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection