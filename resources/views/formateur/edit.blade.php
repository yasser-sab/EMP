@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('fail'))
			<div class="alert alert-danger">
			  {{session()->get('fail')}}
			</div>
			@endif
			<form action="{{url('Formateurs/' . $formateur->id )}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label for="">nom :</label>
					<input type="text" name="nom" class="form-control" value="{{$formateur->nomF}}">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">prenom :</label>
					<input type="text" name="prenom" class="form-control" value="{{$formateur->prenomF}}">
					@if($errors->get('prenom'))
						@foreach($errors->get('prenom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">adresse :</label>
					<input type="text" name="adresse" class="form-control" value="{{$formateur->adrF}}">
					@if($errors->get('adresse'))
						@foreach($errors->get('adresse') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">email :</label>
					<input type="text" name="email" class="form-control" value="{{$formateur->emailF}}">
					@if($errors->get('email'))
						@foreach($errors->get('email') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">telephone :</label>
					<input type="text" name="telephone" class="form-control" value="{{$formateur->telF}}">
					@if($errors->get('telephone'))
						@foreach($errors->get('telephone') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>

				<div class="form-group">
					<label for="">salle :</label>
					<select name="salle" class="form-control">
						<option value="-1">delete salle</option>
						@foreach($salle as $s)
						@if($s->id!=$formateur->salle_id)
						<option value="{{$s->id}}">{{$s->nomSa}}</option>
						@else
						<option selected="" value="{{$formateur->salle_id}}">{{$formateur->salle->nomSa}}</option>
						@endif
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Modifier">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection