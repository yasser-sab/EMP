@extends('layouts.app')

@section('content')



<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('fail'))
			<div class="alert alert-danger" role="alert">
			  {{session()->get('fail')}}
			</div>
			@endif
			<form action="{{url('Formateurs')}}" method="post">
				{{csrf_field()}}
				<div class="form-group has-error">
					<label for="">nom :</label>
					<input type="text" name="nom" class="form-control" value="{{old('nom')}}">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">prenom :</label>
					<input type="text" name="prenom" class="form-control" value="{{old('prenom')}}">
					@if($errors->get('prenom'))
						@foreach($errors->get('prenom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">adresse :</label>
					<input type="text" name="adresse" class="form-control" value="{{old('adresse')}}">
					@if($errors->get('adresse'))
						@foreach($errors->get('adresse') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">email :</label>
					<input type="text" name="email" class="form-control" value="{{old('email')}}">
					@if($errors->get('email'))
						@foreach($errors->get('email') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">telephone :</label>
					<input type="text" name="telephone" class="form-control" value="{{old('telephone')}}">
					@if($errors->get('telephone'))
						@foreach($errors->get('telephone') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group d-inline-block col-md-10">
					<label for="">salle :</label>
					<select name="salle" class="form-control">
						<option value="-1">null</option>
						@foreach($sa as $s)
						<option value="{{$s->id}}">{{$s->nomSa}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group d-inline-block">
					<a href="{{url('salles/create')}}" class="btn btn-success">Nouveau Salle</a>
				</div>
				

				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Enregistrer">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection