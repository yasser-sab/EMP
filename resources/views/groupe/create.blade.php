@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
				<h1>Nouveau groupe</h1>
			</center>
			<form action="{{url('groupes')}}" method="post">
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
					<label>filier :</label>
					<select name="nomFil" class="form-control">
						@foreach($filier as $f)
						<option value="{{$f->id}}">
							{{$f->abrFil}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>niveau :</label>
					<select name="nomNiveau" class="form-control">
						@foreach($niveau as $n)
						<option value="{{$n->id}}">
							{{$n->intitule}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection