@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des competences formateurs</h1>
			<div class="col-md-4">
					<form action="{{url('module_formateur/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="ModuleFormateur" class="form-control" placeholder="voulez vous entrer un formateur " >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
			</div>
			</center>
			Total pages : {{$competence->total()}}<br>
			current page : {{$competence->count()}}
			<div style="float: right;">
				<a href="{{url('module_formateur/create')}}" class="btn btn-success">Nouveau competance</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>formateur</th>
						<th>module</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($competence as $c)
					 <tr>
					 	<td>{{$c->id}}</td>
					 	<td>{{$c->formateur->prenomF}}&nbsp;{{$c->formateur->nomF}}</td>
					 	<td>{{$c->module->nomMod}} &lt; {{$c->module->abrMod}} &gt;</td>
					 	<td>
					 		<a href="{{url('module_formateur/' . $c->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('module_formateur/d' . $c->id)}}" method="post">
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
				{!! $competence->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection