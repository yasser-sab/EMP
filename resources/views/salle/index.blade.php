@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Liste des salles :</h1>
			<div class="pull-right">
				<a href="{{url('salles/create')}}" class="btn btn-success">Nouveau Salle</a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>nom</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($salle as $s )
					 <tr>
					 	<td>{{$s->id}}</td>
					 	<td>{{$s->nomSa}}</td>
					 	<td>
					 		<a href="{{url('salles/' . $s->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('salles/d' . $s->id)}}" method="post">
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