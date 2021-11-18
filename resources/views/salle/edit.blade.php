@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('salles/' . $salle->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" value="{{$salle->nomSa}}" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Modifier" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection