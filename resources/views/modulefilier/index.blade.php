@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des modules par filiers</h1>
			<div class="col-md-4">
					<form action="{{url('module_filier/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="ModuleFilier" class="form-control" placeholder="Tous les critères" >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
				</div>
			</center>
			Total pages : {{$mfilier->total()}}<br>
			current page : {{$mfilier->count()}}
			<div style="float: right;">
				<a href="{{url('module_filier/create')}}" class="btn btn-success">Nouveau affectation</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>module</th>
						<th>filier</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($mfilier as $mf )
					 <tr>
					 	<td>{{$mf->id}}</td>
					 	<td><ul style="padding: 0px;margin: 0px; list-style-type: circle;">
					 		<li>{{$mf->module->refMod}} &lt; {{$mf->module->masHor}} h &gt;</li>
					 		<li>{{$mf->module->nomMod}}</li>
					 	</ul></td>
					 	<td>{{$mf->filier->abrFil}}</td>
					 	<td>
					 		<a href="{{url('module_filier/' . $mf->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('module_filier/d' . $mf->id)}}" method="post">
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
				{!! $mfilier->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection