@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('seances/' . $seance->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control" value="{{$seance->nomSe}}">
				</div>
				<div class="form-group">
					<label>duree :</label>
					<input type="text" name="duree" class="form-control" value="{{$seance->dureeSe}}">
				</div>
				<div class="form-group ">
					<label>période de journée :</label>
					<select name="periode" class="form-control">
						@foreach($periode as $p)
						@if($p->id!=$seance->periodejournee_id)
						<option value="{{$p->id}}">{{$p->periode}}</option>
						@else
						<option selected="" value="{{$p->id}}">{{$p->periode}}</option>
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