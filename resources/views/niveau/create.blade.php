@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Nouveau niveau</h1>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
			</center>
			<form action="{{url('niveaux')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>année :</label>
					<input type="text" name="annee" value="{{old('annee')}}" class="form-control @error('nom') is-invalid @enderror">
					@if($errors->get('annee'))
						@foreach($errors->get('annee') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>intitulé :</label>
					<input type="text" name="intitule" value="{{old('intitule')}}" class="form-control @error('nom') is-invalid @enderror">
					@if($errors->get('intitule'))
						@foreach($errors->get('intitule') as $ms)
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