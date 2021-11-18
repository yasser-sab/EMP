@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Liste des Filiers</h1>
			<div class="pull-right">
				<a href="{{url('filiers/create')}}" class="btn btn-success">Nouveau Filier</a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>nom</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($filier as $fil )
					 <tr>
					 	<td>{{$fil->id}}</td>
					 	<td>{{$fil->abrFil}}</td>
					 	<td>
					 		<a href="{{url('filiers/' . $fil->id . '/edit')}}" class="btn btn-default">Editer</a>
					 		<form style="display: inline;" action="{{url('filiers/d' . $fil->id)}}" method="post">
					 			{{csrf_field()}}
					 			{{method_field('DELETE')}}
					 			<button type="submit" class="btn btn-danger">Supprimer</button>
					 		</form>
					 	</td>
					 </tr>
					 @endforeach 
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function(){
		console.log("hello");
	});
</script>

@endsection