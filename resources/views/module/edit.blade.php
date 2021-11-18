@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
				<h1>edit module</h1>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
			</center>
			<form action="{{url('modules/' . $module->id)}}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label>reference :</label>
					<input type="text" name="ref" class="form-control @error('ref') is-invalid @enderror" value="{{$module->refMod}}">
					@if($errors->get('ref'))
						@foreach($errors->get('ref') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>nom :</label>
					<input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{$module->nomMod}}">
					@if($errors->get('nom'))
						@foreach($errors->get('nom') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>abbreviation :</label>
					<input type="text" name="abr" class="form-control @error('abr') is-invalid @enderror" value="{{$module->abrMod}}">
					@if($errors->get('abr'))
						@foreach($errors->get('abr') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>Masse Horaire :</label>
					<input type="text" name="masse" class="form-control @error('masse') is-invalid @enderror" value="{{$module->masHor}}">
					@if($errors->get('masse'))
						@foreach($errors->get('masse') as $ms)
							<li>{{$ms}}</li>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<label>niveau :</label>
					<select class="form-control" name="niveau">
						@foreach($niveaux as $nv)
							@if($nv->id==$module->niveau_id)
								<option value="{{$nv->id}}" selected="">{{$nv->intitule}}</option>
							@else
								<option value="{{$nv->id}}">{{$nv->intitule}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>filier :</label>
					<select class="form-control" name="filier">
						@foreach($filier as $fl)
							@if($fl->id==$module->filier_id)
								<option value="{{$fl->id}}" selected="">{{$fl->abrFil}}</option>
							@else
								<option value="{{$fl->id}}">{{$fl->abrFil}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>order :</label>
					<select name="order" class="form-control">
						@for($i=1;$i<=30;$i++)
							@if($module->order!=$i)
								<option value="{{$i}}">{{$i}}</option>
							@else
								<option selected="" value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
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