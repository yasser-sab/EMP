@extends('layouts.app')
@section('content')

<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#email').text($("#formateur").children("option:selected").attr('id').split(";")[1]);
		    $('#sa').text($("#formateur").children("option:selected").attr('id').split(";")[0]);
		   	$('#tel').text($("#formateur").children("option:selected").attr('id').split(";")[2]);
		    $('#fil').text($("#groupe").children("option:selected").attr('id').split(';')[0]);
		    $('#niv').text($("#groupe").children("option:selected").attr('id').split(';')[1]);
		    $('#nom').text($("#module").children("option:selected").attr('id').split(";")[0]);
		    $('#abrmod').text($("#module").children("option:selected").attr('id').split(";")[1]);
		    $('#mh').text($("#module").children("option:selected").attr('id').split(";")[2]);
		    $('#nv').text($("#module").children("option:selected").attr('id').split(";")[3]);
		    $('#ord').text($("#module").children("option:selected").attr('id').split(";")[4]);
		    $("#formateur").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#email').text(res[1]);
		        $('#sa').text(res[0]);
		        $('#tel').text(res[2]);
		    });
		     
		    $("#groupe").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(";");
		        $('#fil').text(res[0]);
		        $('#niv').text(res[1])
		    });
		     // $('#abrmod').text($("#module").children("option:selected").attr('id').split(";")[1]);
		     // $('#mh').text($("#module").children("option:selected").attr('id').split(";")[2]);
		    $("#module").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#nom').text(res[0]);
		        $('#abrmod').text(res[1]);
		        $('#mh').text(res[2]);
		        $('#nv').text(res[3]);
		       	$('#ord').text(res[4]);
		    });
		});
	</script>
	<div class="row">
		<div class="col-md-12">
			<center>
					<h1>Edit effectation module</h1>
					@if(session()->has('fail'))
				<div class="alert alert-danger">
					{{session()->get('fail')}}
				</div>
				@endif</center>
			<form action="{{url('formateur_groupe_module/' . $afmodule->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT"/>
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Formateur : </th>
							</tr>
						<th>nom & prenom</th>
						<th>email</th>
						<th>salle</th>
						<th>telephone</th>
						</thead>
						<tbody>
						<td>
							<select class="form-control" name="formateur" id="formateur">
							@foreach($formateur as $f)
							@if($afmodule->formateur_id!=$f->id)
							<option id="{{$f->salle->nomSa}};{{$f->emailF}};{{$f->telF}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
							@else
							<option selected="" id="{{$f->salle->nomSa}};{{$f->adrF}};{{$f->telF}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
							@endif
							@endforeach
							</select>
						</td>
						<td id="email"></td>
						<td id="sa"></td>
						<td id="tel"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Module : </th>
							</tr>
						<th>Reference</th>
						<th>nom</th>
						<th>Abbreviation</th>
						<th>Masse Horaire</th>
						<th>niveau</th>
						<th>order</th>
						</thead>
						<tbody>
						<td>
						
						<select class="form-control" name="module" id="module">
						@foreach($module as $m)
						@if($m->id!=$afmodule->module_id)
						<option id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}};{{$m->niveau->intitule}};{{$m->order}}" value="{{$m->id}}">{{$m->refMod}}</option>
						@else
						<option selected="" id="{{$m->nomMod}};{{$m->abrMod}};{{$m->masHor}};{{$m->niveau->intitule}};{{$m->order}}" value="{{$m->id}}">{{$m->refMod}}</option>
						@endif
						@endforeach
						</select>
						</td>
						<td id="nom"></td>
						<td id="abrmod"></td>
						<td id="mh"></td>
						<td id="nv"></td>
						<td id="ord"></td>
						</tbody>
					</figure>
					
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Groupe : </th>
							</tr>
						<th>nom</th>
						<th>Filier</th>
						<th>niveau</th>
						</thead>
						<tbody>
						<td>
						<select class="form-control" name="groupe" id="groupe">
						@foreach($groupe as $g)
						@if($afmodule->groupe_id!=$g->id)
						<option id="{{$g->filier->nomFil}};{{$g->niveau->intitule}}" value="{{$g->id}}">{{$g->nomG}}</option>
						@else
						<option selected="" id="{{$g->filier->nomFil}};{{$g->niveau->intitule}}" value="{{$g->id}}">{{$g->nomG}}</option>
						@endif
						@endforeach
						</select>
						</td>
						<td id="fil" width="20%"></td>
						<td id="niv" width="20%"></td>
						</tbody>
					</figure>
					
				</table>
			<input type="submit" value="Modifier" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
</div>
@endsection