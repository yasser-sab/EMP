@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('success'))
				<div class="alert alert-success" role="alert">
				  {{session()->get('success')}}
				</div>
				@endif
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
				<h1>Liste des affections stages</h1>
				<div class="col-md-4">
						<form action="{{url('stage_groupe/search')}}" method="get">
							<div class="input-group">
								<input type="search" name="groupe" class="form-control" placeholder="voullez vous enter un groupe " >
								<span class="input-group-form">
									<input value="search" type="submit" class="btn btn-primary" />
								</span>
							</div>
						</form>
				</div>
			</center>
			Total pages : {{$affectstage->total()}}<br>
			current page : {{$affectstage->count()}}
			<div style="float: right;">
				<a href="{{url('stage_groupe/create')}}" class="btn btn-success">Nouveau affectation stage</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>#</th>
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
					 	<td>{{$as->groupe->nomG}}&nbsp;&lt; {{$as->groupe->niveau->intitule}} &gt;</td>
					 	<td>{{$as->stage->dateDebStage}}</td>
					 	<td>{{$as->stage->dateFinStage}}</td>
					 	<td>
					 		<a href="{{url('stage_groupe/' . $as->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('stage_groupe/d' . $as->id)}}" method="post">
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
				{!! $affectstage->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection