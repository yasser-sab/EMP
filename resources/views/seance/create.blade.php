@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('seances')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control">
				</div>
				<div class="form-group">
					<label>duree :</label>
					<input type="text" name="duree" class="form-control">
				</div>
				<div class="form-group ">
					<label>période de journée :</label>
					<select name="periode" class="form-control">
						@foreach($periode as $p)
						<option value="{{$p->id}}">{{$p->periode}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Generer">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection