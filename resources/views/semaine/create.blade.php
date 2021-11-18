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
			<form action="{{url('semaines')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>date Debut :</label>
					<input type="date" name="dateD" class="form-control" value="<?php echo date("Y-m-d", mktime(0, 0, 0, 9, 15, date("Y",time())));?>">
				</div>
				<div class="form-group">
					<label>date Fin :</label>
					<input type="date" name="dateF" class="form-control" value="<?php echo date("Y-m-d", mktime(0, 0, 0, 6, 15, date("Y",time()+(12*30*24*60*60))));?>">
				</div>
				<div class="form-group">
					<input type="submit" value="Generer" class="form-control btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>
@endsection