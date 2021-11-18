@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des Groupes</h1>
				<div class="col-md-4">
						<form action="{{url('groupes/search')}}" method="get">
							<div class="input-group">
								<input type="search" name="groupe" class="form-control" placeholder="Tous les critères" >
								<span class="input-group-form">
									<input value="search" type="submit" class="btn btn-primary" />
								</span>
							</div>
						</form>
				</div>
			</center>
			Total pages : {{$groupe->total()}}<br>
			current page : {{$groupe->count()}}
			<div style="float: right;">
				<a href="{{url('groupes/create')}}" class="btn btn-success">Nouveau Groupe</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Numero</th>
						<th>Nom</th>
						<th>Filier</th>
						<th>Niveau</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($groupe as $g)
					 <tr>
					 	<td>{{$g->id}}</td>
					 	<td>{{$g->nomG}}</td>
					 	<td>{{$g->filier->abrFil}}</td>
					 	<td>{{$g->niveau->intitule}}</td>
					 	<td>
					 		<a href="{{url('groupes/' . $g->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('groupes/d' . $g->id)}}" method="post">
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
				{!! $groupe->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection