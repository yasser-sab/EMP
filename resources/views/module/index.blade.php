@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des modules</h1>
			<div class="col-md-4">
					<form action="{{url('modules/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="module" class="form-control" placeholder="Tous les critères" >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
				</div>
			</center>
			Total pages : {{$module->total()}}<br>
			current page : {{$module->count()}}
			<div style="float: right;">
				<a href="{{url('modules/create')}}" class="btn btn-success">Nouveau module</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>reference</th>
						<th>abbreviation</th>
						<th>libele</th>
						<th>masse Horaire</th>
						<th>niveau</th>
						<th>filier</th>
						<th>order</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($module as $m)
					 <tr>
					 	<td>{{$m->id}}</td>
					 	<td>{{$m->refMod}}</td>
					 	<td>{{$m->abrMod}}</td>
					 	<td>{{$m->nomMod}}</td>
					 	<td>{{$m->masHor}}</td>
					 	<td>{{$m->niveau->intitule}}</td>
					 	@if($m->filier_id!=null)
					 	<td>{{$m->filier->abrFil}}</td>
					 	@else
					 	<td>null</td>
					 	@endif
					 	<td>{{$m->order}}</td>
					 	<td>
					 		<a href="{{url('modules/' . $m->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('modules/d' . $m->id)}}" method="post">
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
				{!! $module->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection