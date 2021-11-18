@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Edit niveau</h1>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
			</center>
			<form action="{{url('niveaux/' . $niveau->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>année :</label>
					<input type="text" name="annee" class="form-control" value="{{$niveau->annee}}">
				</div>
				<div class="form-group">
					<label>intitulé :</label>
					<input type="text" name="intitule" class="form-control" value="{{$niveau->intitule}}">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Modifier">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection