@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			$("#lib").text($("#filier").children("option:selected").attr("id"));
			$("#email").text($("#formateur").children("option:selected").attr("id").split(";")[0]);
			$("#sal").text($("#formateur").children("option:selected").attr("id").split(";")[1]);
			
		    $("#formateur").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#email').text(res[0]);
		        $('#sal').text(res[1]);
		    });
		    $("#filier").change(function(){
		        var res = $(this).children("option:selected").attr('id');
		        $('#lib').text(res);
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
				<h1>Edit affectation filier</h1>
			</center>
			<form action="{{url('filier_formateur/' . $affilier->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
			<table class="table">
				<figure>
					<thead>
						<tr><th style="color: white;background-color: grey">Filier : </th></tr>
						<th>libele</th>
					</thead>
					<tbody>
						<td>
							<select name="filier" id="filier" class="form-control">
							@foreach($filier as $fil)
							@if($affilier->filier_id!=$fil->id)
							<option id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@else
							<option selected="" id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@endif
							@endforeach
							</select>
						</td>
						<td id="lib" width="50%"></td>
					</tbody>
				</figure>	
				<figure>
					<thead>
						<tr><th style="color: white;background-color: grey;">Formateur : </th></tr>
						<th>nom & prenom</th>
						<th>email</th>
						<th>salle</th>
					</thead>
					<tbody>
					<td>
						<select name="formateur" id="formateur" class="form-control">
							@foreach($formateur as $f)
							@if($affilier->formateur_id!=$f->id)
							<option id="{{$f->emailF}};{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
							@else
							<option selected="" id="{{$f->emailF}};{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
							@endif
							@endforeach
						</select>
					</td>
						<td id="email"></td>
						<td id="sal"></td>
					</tbody>
				</figure>
				
			</table>
			<input type="submit" value="Modifier" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection