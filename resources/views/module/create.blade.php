@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>Nouveau module</h1>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
			</center>
			<form action="{{url('modules')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>reference :</label>
					<input type="text" name="ref" value="{{old('ref')}}" class="form-control @error('ref') is-invalid @enderror">
					@if($errors->get('ref'))
						@foreach($errors->get('ref') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" value="{{old('nom')}}" class="form-control @error('nom') is-invalid @enderror">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>abbreviation :</label>
					<input type="text" name="abr" value="{{old('abr')}}" class="form-control @error('abr') is-invalid @enderror">
					@if($errors->get('abr'))
						@foreach($errors->get('abr') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>Masse Horaire :</label>
					<input type="text" name="masse" value="{{old('masse')}}" class="form-control @error('masse') is-invalid @enderror">
					@if($errors->get('masse'))
						@foreach($errors->get('masse') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>niveau :</label>
					<select name="niveau" class="form-control @error('niveau') is-invalid @enderror">
						@foreach($niveaux as $nv)
							<option value="{{$nv->id}}">{{$nv->intitule}}</option>
						@endforeach
					</select>
					@if($errors->get('niveau'))
						@foreach($errors->get('niveau') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>filier :</label>
					<select name="filier" class="form-control @error('filier') is-invalid @enderror">
						@foreach($filier as $fl)
							<option value="{{$fl->id}}">{{$fl->abrFil}}</option>
						@endforeach
					</select>
					@if($errors->get('filier'))
						@foreach($errors->get('filier') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>order :</label>
					<select name="order" class="form-control">
						@for($i=1;$i<=30;$i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-primary" value="Enregistrer">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection