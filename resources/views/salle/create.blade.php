@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('salles')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Enregister" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection