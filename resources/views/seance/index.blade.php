@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Liste des seances :</h1>
			<div class="pull-right">
				<a href="{{url('seances/create')}}" class="btn btn-success">Nouveau Seance</a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>nom</th>
						<th>duree</th>
						<th>période de journee</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($seance as $s)
					 <tr>
					 	<td>{{$s->id}}</td>
					 	<td>{{$s->nomSe}}</td>
					 	<td>{{$s->dureeSe}}</td>
					 	<td>{{$s->periodejournee->periode}}</td>
					 	<td>
					 		<a href="{{url('seances/' . $s->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('seances/d' . $s->id)}}" method="post">
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