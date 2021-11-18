@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('success'))
			<div class="alert alert-success" role="alert">
			  {{session()->get('success')}}
			</div>
			@endif
			<h1>Liste des affections stages :</h1>
			<div class="pull-right">
				<a href="{{url('affectstages/create')}}" class="btn btn-success">Nouveau affectation stage</a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>groupe</th>
						<th>Date debut</th>
						<th>Date fin</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($affectstage as $as )
					 <tr>
					 	<td>{{$as->id}}</td>
					 	<td>{{$as->groupe->nomG}}&nbsp;&lt; {{$as->groupe->niveaugroupe()->intitule}} &gt;</td>
					 	<td>{{$as->stage->dateDebStage}}</td>
					 	<td>{{$as->stage->dateFinStage}}</td>
					 	<td>
					 		<a href="{{url('affectstages/' . $as->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('affectstages/d' . $as->id)}}" method="post">
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