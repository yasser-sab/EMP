@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des niveaux</h1>
			</center>
			<div style="float: right;">
				<a href="{{url('niveaux/create')}}" class="btn btn-success">Nouveau niveau</a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>année</th>
						<th>intitulé</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($niveau as $n )
					 <tr>
					 	<td>{{$n->id}}</td>
					 	<td>{{$n->annee}}</td>
					 	<td>{{$n->intitule}}</td>
					 	<td>
					 		<a href="{{url('niveaux/' . $n->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('niveaux/d' . $n->id)}}" method="post">
					 			{{csrf_field()}}
					 			{{method_field('DELETE')}}
					 			<button type="submit" class="btn btn-danger">Supprimer</button>
					 		</form>
					 	</td>
					 </tr>
					 @endforeach 
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection