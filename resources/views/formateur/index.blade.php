@extends('layouts.master')
@section('content')

<div class="container">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
	<div class="row">
		<div class="col-md-12 ">
			
				
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
				<h1>Liste des Formateur</h1><br>
				 <div class="col-md-4">
					<form action="{{url('Formateurs/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="formateur" class="form-control" placeholder="Tous les critères" >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
				</div>
			</center>
			Total pages : {{$formateur->total()}}<br>
			current page : {{$formateur->count()}}
			<div style="float: right" class="pull-right">
				<a href="{{url('Formateurs/create')}}" class="btn btn-success">Nouveau Formateur</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>nom</th>
						<th>prenom</th>
						<th>telephone</th>
						<th>salle</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($formateur as $f )
					 <tr>
					 	<td>{{$f->id}}</td>
					 	<td>{{$f->nomF}}</td>
					 	<td>{{$f->prenomF}}</td>
					 	<td>{{$f->telF}}</td>
					 	@if($f->salle_id!=null)
					 	<td>{{$f->salle->nomSa}}</td>
					 	@else
					 	<td>null</td>
					 	@endif
					 	<td>
					 		<a onclick='
					 			Swal.fire("\
					 				<table border=1 cellpadding=10>\
					 				<thead>\
					 				<tr>\
					 					<th style=color:blue colspan=3 ><h1>{{$f->nomF}} {{$f->prenomF}}</h1><th>\
					 				</tr>\
					 				<tr style=color:green>\
					 					<th><h3>Cumule</h3><th>\
					 					<th><h3>valeur</h3><th>\
					 				</tr>\
					 				</thead>\
					 				<tbody>\
					 				<tr>\
					 					<td><h5>Absence  </h5><td>\
					 					<td>{{$f->cumAbsGlo}}<td>\
					 				</tr>\
					 				<tr>\
					 					<td><h5>Enseignement  </h5><td>\
					 					<td>{{$f->cumEnsGlo}}<td>\
					 				</tr>\
					 				<tr>\
					 					<td><h5>Autorisation  </h5><td>\
					 					<td>{{$f->cumAut}}<td>\
					 				</tr>\
					 				<tr>\
					 					<td><h5>CM  </h5><td>\
					 					<td>{{$f->cumCm}}<td>\
					 				</tr>\
					 				<tr>\
					 					<td><h5>Mission  </h5><td>\
					 					<td>{{$f->cumMiss}}<td>\
					 				</tr>\
					 				<tr>\
					 					<td><h5>Rettrapage  </h5><td>\
					 					<td>{{$f->cumRat}}<td>\
					 				</tr>\
					 				</tbody>\
					 				</table>");
					 			' 
					 			class="btn btn-primary">Details</a>
					 		<a href="{{url('Formateurs/' . $f->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('Formateurs/d' . $f->id)}}" method="post">
					 			{{csrf_field()}}
					 			{{method_field('DELETE')}}
					 			<button type="submit" class="btn btn-danger">Supprimer</button>
					 		</form>
					 	</td>
					 </tr>
					 @endforeach 
				</tbody>
			</table>
			<div class="text-center">
				{!! $formateur->links() !!}
			</div> 
		</div>
	</div>
</div>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$('table').DataTable();
	});
</script> -->
@endsection