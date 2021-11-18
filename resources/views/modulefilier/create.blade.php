@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			$("#lib").text($("#filier").children("option:selected").attr("id"));
			// $("#nomMod").text($("#module").children("option:selected").attr("id").split(";")[0]);
			// $("#abrMod").text($("#module").children("option:selected").attr("id").split(";")[1]);
			// $("#masHor").text($("#module").children("option:selected").attr("id").split(";")[2]);
			
		    // $("#module").change(function(){
		    //     var res = $(this).children("option:selected").attr('id').split(';');
		    //     $('#nomMod').text(res[0]);
		    //     $('#abrMod').text(res[1]);
		    //     $('#masHor').text(res[1]);
		    // });
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
				<h1>Nouveau affectation</h1>
			</center>
			<form action="{{url('module_filier')}}" method="post">
				{{csrf_field()}}
			<table class="table">
				<figure>
					<thead>
						<tr><th style="color: white;background-color: grey">Filier : </th></tr>
						<th>libele</th>
					</thead>
					<tbody width="100%">
						<td>
							<select name="filier" id="filier" class="form-control">
							@foreach($filier as $fil)
							<option id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@endforeach
							</select>
						</td>
						<td id="lib"></td>
					</tbody>
				</figure>	
				<figure>
					<thead>
						<tr><th style="color: white;background-color: grey;">Module : </th></tr>
						<th>check</th>
						<th>libele</th>
						<th>reference</th>
						<th>masse horaire</th>
						<th>niveau</th>
						<th>order</th>
					</thead>
					<tbody>
					<td>
						<fieldset>
						
							
							    <!-- <legend>Choose</legend> -->
							    @foreach($module as $m)
								    <tr>
								    	<td><input type="checkbox" name="module_{{$m->id}}" value="{{$m->id}}"> </td>
								    	<td>{{$m->nomMod}}</td>
									    <td>
										{{$m->refMod}}
										</td>
										<td>{{$m->masHor}}</td>
										<td>{{$m->niveau->intitule}}</td>
										<td>{{$m->order}}</td>
								    </tr>
								@endforeach
							
					
						</fieldset>
					</td>
					</tbody>
				</figure>
				
			</table>
			<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection