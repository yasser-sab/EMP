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

		    d1=new Date(),
		    d2=new Date(),
		    d2.setDate(d1.getDate()+30),
		    yyyy1 = d1.getFullYear().toString(),
		    mm1 = (d1.getMonth()+1).toString(), 
		    dd1 = d1.getDate().toString(),
		    yyyy2 = d2.getFullYear().toString(),
		    mm2 = (d2.getMonth()+1).toString(), 
		    dd2 = d2.getDate().toString(),
		    res1 = yyyy1 + "-" + (mm1[1]?mm1:"0"+mm1[0]) + "-" + (dd1[1]?dd1:"0"+dd1[0]);
		    res2 = yyyy2 + "-" + (mm2[1]?mm2:"0"+mm2[0]) + "-" + (dd2[1]?dd2:"0"+dd2[0]);
		    $("input[type='date']#datedeb").attr('value',res1);
		    $("input[type='date']#datefin").attr('value',res2);
		});
	</script>
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('success'))
				<div class="alert alert-success" role="alert">
				  {{session()->get('success')}}
				</div>
				@endif
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
				<h1>Nouveau affection stage</h1>
			</center>
			<form action="{{url('stage_groupe')}}" method="post">
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Periode de stage : </th></tr>
							<tr><th>Date debut</th>
							<th>Date fin</th></tr>
						</thead>
						<tbody>
						<td>
							<input type="date" name="datedeb" id="datedeb" class="form-control @error('datedeb') is-invalid @enderror">
							@if($errors->get('datedeb'))
								@foreach($errors->get('datedeb') as $ms)
									<li>{{$ms}}</li>
								@endforeach
							@endif
						</td>
						<td>
							<input type="date" name="datefin" id="datefin" class="form-control @error('datefin') is-invalid @enderror">
							@if($errors->get('datefin'))
								@foreach($errors->get('datefin') as $ms)
									<li>{{$ms}}</li>
								@endforeach
							@endif
						</td>
						</tbody>
					</figure>
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
									<option id="{{$g->filier->abrFil}};{{$g->niveau->intitule}}" value="{{$g->id}}">{{$g->nomG}}</option>
									@endforeach
								</select>
							</td>
							<td id="fil"></td>
							<td id="niv" width="20%"></td>
						</tbody>
					</figure>
				</table>
			<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection