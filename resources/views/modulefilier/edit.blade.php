@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			$("#lib").text($("#filier").children("option:selected").attr("id"));
			$("#nomMod").text($("#module").children("option:selected").attr("id").split(";")[0]);
			$("#abrMod").text($("#module").children("option:selected").attr("id").split(";")[1]);
			$("#masHor").text($("#module").children("option:selected").attr("id").split(";")[2]);
			
		    $("#module").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#nomMod').text(res[0]);
		        $('#abrMod').text(res[1]);
		        $('#masHor').text(res[1]);
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
				<h1>Edit affectation</h1>
			</center>
			<form action="{{url('module_filier/' . $mfilier->id)}}" method="post">
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
							@if($mfilier->filier_id!=$fil->id)
							<option id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@else
							<option selected="" id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@endif
							@endforeach
							</select>
						</td>
						<td id="lib" width="25%"></td>
					</tbody>
				</figure>
				<figure>
					<thead>
						<tr><th style="color: white;background-color: grey;">Module : </th></tr>
						<th>reference</th>
						<th>libele</th>
						<th>abbreviation</th>
						<th>masse horaire</th>
					</thead>
					<tbody>
					<td>
						<select name="module" id="module" class="form-control">
							@foreach($module as $m)
							@if($mfilier->module_id!=$m->id)
							<option id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}}" value="{{$m->id}}">{{$m->refMod}}</option>
							@else
							<option selected="" id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}}" value="{{$m->id}}">{{$m->refMod}}</option>
							@endif
							@endforeach
						</select>
					</td>
						<td id="nomMod"></td>
						<td id="abrMod"></td>
						<td id="masHor"></td>
					</tbody>
				</figure>
					
			</table>
			<input type="submit" value="Modifier" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection