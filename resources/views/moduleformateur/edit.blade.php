@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			$('#adr').text($('#formateur').children('option:selected').attr('id').split(";")[0]);
		    $('#sal').text($('#formateur').children('option:selected').attr('id').split(";")[1]);
		    $('#nom').text($('#module').children('option:selected').attr('id').split(";")[0]);
		    $('#abr').text($('#module').children('option:selected').attr('id').split(";")[1]);
		    $('#mh').text($('#module').children('option:selected').attr('id').split(";")[2]);
		    $('#nv').text($('#module').children('option:selected').attr('id').split(";")[3]);
		    $('#ord').text($('#module').children('option:selected').attr('id').split(";")[4]);
		    $("#formateur").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#adr').text(res[0]);
		        $('#sal').text(res[1]);
		    });
		    $("#module").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#nom').text(res[0]);
		        $('#abr').text(res[1]);
		        $('#mh').text(res[2]);
		        $('#nv').text(res[3]);
		        $('#ord').text(res[4]);
		    });
		});
	</script>
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
				<h1>Edit affectation</h1>
			</center>
			<form action="{{url('module_formateur/' . $c->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Formateur : </th></tr>
							<tr><th>nom & prenom</th>
							<th>email</th>
							<th>salle</th></tr>
						</thead>
						<tbody>
						<td>
							<select  class="form-control" name="formateur" id="formateur">
								@foreach($formateur as $f)
								@if($f->id!=$c->formateur_id)
								<option id="{{$f->emailF}};{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
								@else
								<option selected="" id="{{$f->emailF}};{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
								@endif
								@endforeach
							</select>
						</td>
						<td id="adr"></td>
						<td id="sal"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Module : </th></tr>
							<tr><th>numero</th>
							<th>nom</th>
							<th>abbreviation</th>
							<th>masse horaire</th>
							<th>niveau</th>
							<th>order</th>
							</tr>
						</thead>
						<tbody>

							<td>
								<select class="form-control" name="module" id="module">
								@foreach($module as $m)
								@if($m->id!=$c->module->id)
								<option id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}};{{$m->niveau->intitule}};{{$m->order}}" value="{{$m->id}}">{{$m->refMod}}</option>
								@else
								<option selected="" id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}};{{$m->niveau->intitule}};{{$m->order}}" value="{{$m->id}}">{{$m->refMod}}</option>
								@endif
								@endforeach
								</select>
							</td>
							<td id="nom"></td>
							<td id="abr"></td>
							<td id="mh"></td>
							<td id="nv"></td>
							<td id="ord"></td>
						</tbody>
					</figure>
					
				</table>

			<input type="submit" value="Modifier" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection