@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{url('semaines/' . $semaine->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>date Debut :</label>
					<input type="date" name="dateD" class="form-control" value="{{$semaine->dateDSemaine}}">
				</div>
				<div class="form-group">
					<label>date Fin :</label>
					<input type="date" name="dateF" class="form-control" value="{{$semaine->dateFSemaine}}">
				</div>
				<div class="form-group">
					<input type="submit" value="Modifier" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>
@endsection