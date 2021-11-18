@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif
			<h1>Liste des semaines :</h1>
			<table class="table">
				<thead>
					<tr>
						<th>numero</th>
						<th>date debut semaine</th>
						<th>date fin semaine</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($semaines as $s )
					 <tr>
					 	<td>{{$s->id}}</td>
					 	<td>{{$s->dateDSemaine}}</td>
					 	<td>{{$s->dateFSemaine}}</td>
					 	<td>
					 		<!-- <a href="#" class="btn btn-primary">Details</a> -->
					 		<!-- <a href="{{url('semaines/' . $s->id . '/edit')}}" class="btn btn-primary">Editer</a> -->
					 		<form style="display: inline;" action="{{url('semaines/d' . $s->id)}}" method="post">
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