@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>creation d'une filier</h1>
			</center>
			<form action="{{url('filiers')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" value="{{old('nom')}}" class="form-control @error('nom') is-invalid @enderror">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>abbreviation :</label>
					<input type="text" name="abr" value="{{old('abr')}}" class="form-control @error('abr') is-invalid @enderror">
					@if($errors->get('abr'))
						@foreach($errors->get('abr') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Enregistrer">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection