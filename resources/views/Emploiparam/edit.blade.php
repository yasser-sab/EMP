@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="d-flex flex-row-reverse">
				<div>
					<a href="{{url('emploiparams')}}" class="btn btn-warning">Returne</a>
				</div>
			</div>
			<form action="{{url('emploiparams/' . $emploiparam->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>affect formateur :</label>
					<select name="afformateur" class="form-control">
						@foreach($afformateur as $af)
						@if($emploiparam->affectformateur->id!=$af->id)
						<option value="{{$af->id}}">
							{{$af->formateur->nomF}} : {{$af->seance->nomSe}} : {{$af->jour->jour}}
						</option>
						@else
						<option selected="" value="{{$af->id}}">
							{{$af->formateur->nomF}} : {{$af->seance->nomSe}} : {{$af->jour->jour}}
						</option>
						@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>affectmodule : </label>
					<select name="afmodule" class="form-control">
						@foreach($afmodule as $am)
						@if($emploiparam->affectmodule->id!=$am->id)
						<option value="{{$am->id}}">
							{{$am->module->refMod}} : {{$am->groupe->nomG}}
						</option>
						@else
						<option selected="" value="{{$am->id}}">
							{{$am->module->refMod}} : {{$am->groupe->nomG}}
						</option>
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