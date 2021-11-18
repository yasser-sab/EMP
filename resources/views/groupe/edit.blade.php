@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('groupes/' . $groupe->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{$groupe->nomG}}">
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
						@if($f->id!=$groupe->filier->id)
						<option value="{{$f->id}}">{{$f->abrFil}}</option>
						@else
						<option selected="" value="{{$groupe->filier->id}}">{{$groupe->filier->abrFil}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>niveau :</label>
					<select name="niv" class="form-control">
						@foreach($nvgroupe as $nv)
						@if($nv->id!=$groupe->niveau_id)
						<option value="{{$nv->id}}">{{$nv->intitule}}</option>
						@else
						<option selected="" value="{{$groupe->niveau->id}}">{{$groupe->niveau->intitule}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="Modifier" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection