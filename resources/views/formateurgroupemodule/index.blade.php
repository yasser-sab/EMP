@extends('layouts.master')
@section('content')

<div class="container">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('success'))
				<div class="alert alert-success">
					{{session()->get('success')}}
				</div>
				@endif
				@if(session()->has('fail'))
				<div class="alert alert-danger">
					{{session()->get('fail')}}
				</div>
				@endif
				<h1>Liste des affections modules</h1>
			<div class="col-md-4">
					<form action="{{url('formateur_groupe_module/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="module" class="form-control" placeholder="voulez vous enter un module" >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
			</div>
			</center>
			Total pages : {{$formateurgroupemodule->total()}}<br>
			current page : {{$formateurgroupemodule->count()}}
			<div style="float: right;padding-bottom: 20px;">
				<a href="{{url('formateur_groupe_module/create')}}" class="btn btn-success">Nouveau affectation module</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>formateur</th>
						<th>groupe</th>
						<th>module</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($formateurgroupemodule as $am)
					 <tr>
					 	<td>{{$am->id}}</td>
					 	<td>{{$am->formateur->nomF}}&nbsp;{{$am->formateur->prenomF}}</td>
					 	<td>{{$am->groupe->nomG}} &lt; {{$am->groupe->filier->abrFil}} &gt;</td>
					 	<td>{{$am->module->nomMod}}</td>
					 	<td><!--
					 		"
					 			Swal.fire('<h2 style=\'text-align:right;color:green;\'>{{$am->formateur->nomF}} {{$am->formateur->prenomF}} : {{$am->groupe->nomG}} : {{$am->module->refMod}}</h2> <br/><br/>module progress : {{$am->cumMod}}<br/>absence : {{$am->cumAbs}}')"
					 	 -->
					 		<a style="color: white;" onclick='
					 			Swal.fire("\
					 				<table border=1 cellpadding=10>\
					 				<thead style=font-size:50%>\
					 				<tr>\
					 				<td>Formateur</td>\
					 				<td>Groupe</td>\
					 				<td>Module</td>\
					 				</tr>\
					 				<tr>\
					 				<td>{{$am->formateur->nomF}} - {{$am->formateur->prenomF}}</td>\
					 				<td>{{$am->groupe->nomG}}</td>\
					 				<td>{{$am->module->nomMod}}</td>\
					 				</tr>\
					 				<thead>\
					 				<tr style=color:blue;font-size:70%>\
					 				<td colspan=2>cumule</td>\
					 				<td>value</td>\
					 				</tr>\
					 				<tbody style=color:#221>\
					 				<tr>\
					 				<td colspan=2>module progress : </td>\
					 				<td>{{$am->cumMod}}</td>\
					 				</tr>\
					 				<tr>\
					 				<td colspan=2>absence : </td>\
					 				<td>{{$am->cumAbs}}</td>\
					 				</tr>\
					 				</tbody>\
					 				</table>");
					 			' 
					 		class="btn btn-primary">Details</a>
					 		<a style="background-color: orange;color:white" href="{{url('formateur_groupe_module/' . $am->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('formateur_groupe_module/d' . $am->id)}}" method="post">
					 			{{csrf_field()}}
					 			{{method_field('DELETE')}}
					 			<button type="submit" class="btn btn-danger">Supprimer</button>
					 		</form>
					 	</td>
					 </tr>
					 @endforeach 
				</tbody>
			</table>
			<div style="display:flex;justify-content: center;" class="text-center">
				{!! $formateurgroupemodule->links() !!}
			</div> 
		</div>
	</div>
</div>

@endsection