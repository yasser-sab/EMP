@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Liste des affectations filiers</h1>
			<div class="col-md-4">
					<form action="{{url('filier_formateur/search')}}" method="get">
						<div class="input-group">
							<input type="search" name="filier" class="form-control" placeholder="voulez vous entrez un filier" >
							<span class="input-group-form">
								<input value="search" type="submit" class="btn btn-primary" />
							</span>
						</div>
					</form>
			</div>
			</center>
			Total pages : {{$filierformateur->total()}}<br>
			current page : {{$filierformateur->count()}}
			<div style="float: right;">
				<a href="{{url('filier_formateur/create')}}" class="btn btn-success">Nouveau affectation filier</a>
			</div>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>numero</th>
						<th>formateur</th>
						<th>filier</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($filierformateur as $af )
					 <tr>
					 	<td>{{$af->id}}</td>
					 	<td>{{$af->formateur->prenomF}}&nbsp;{{$af->formateur->nomF}}</td>
					 	<td>{{$af->filier->abrFil}}</td>
					 	<td>
					 		<a href="{{url('filier_formateur/' . $af->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('filier_formateur/d' . $af->id)}}" method="post">
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
				{!! $filierformateur->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection