@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('filiers/' . $filier->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{$filier->nomFil}}">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>abbreviation :</label>
					<input type="text" name="abr" class="form-control @error('abr') is-invalid @enderror" value="{{$filier->abrFil}}">
					@if($errors->get('abr'))
						@foreach($errors->get('abr') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Modifier">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection