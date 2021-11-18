@extends('layouts.app')
@section('content')
<?php 
$arrayName = array('formateur;module'=>$affectmodule);
?>
<center>
	@if(session()->has('fail'))
	<div class="alert alert-danger" role="alert">
		{{session()->get('fail')}}
	</div>
	@endif
	<h1>Nouveau parametrage</h1>
</center>
@if(@count(App\Emploi::All())>0)
			<div class="container" style="z-index: 0;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">information</div>

                            <center>
                                <div style="color: red" class="card-body">
                                emplois déja generer !
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
           @else
<form action="{{url('emploiparams')}}" method="post">
	{{csrf_field()}}
	<table class="table table-bordered table-striped table-hover"  id="table" border="1" >
		<thead align="center">
			<tr>
				<td rowspan="3">filier</td>
				<td rowspan="3">groupe</td>
				<td rowspan="3">F <br>G<br/>M</td>
				@foreach($jour as $j)
				<td colspan="4">{{$j->jour}}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($jour as $j)
					@foreach($periode as $p)
					<td colspan="2">{{$p->periode}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($jour as $j)
					@foreach($periode as $p)
						@foreach($seance as $s)
							@if($s->periodejournee_id==$p->id)
								<td>{{$s->nomSe}}</td>
							@endif
						@endforeach
					@endforeach
				@endforeach
				{{--@foreach($jour as $j)
					@foreach($seance as $s)
					<td>{{$s->nomSe}}</td>
					@endforeach
				@endforeach--}}
			</tr>
		</thead>
		<tbody>
			@foreach($filier as $f)
				<tr>
					<td rowspan=<?php echo (count($groupe->where('filier_id','=',$f->id)))*2+1; ?>>{{$f->abrFil}}</td>
				</tr>
				@foreach($groupe->where('filier_id','=',$f->id) as $g)
					<tr>
						<td rowspan="2">{{$g->nomG}}</td>
					</tr>
					@foreach($arrayName as $key => $value)
					<tr>
						<td>
						<?php $res=explode(';',$key);
							echo $res[0] . "<br>" . $res[1]; 
						 ?>
						 </td>
						@foreach($jour as $j)
							@foreach($seance as $s)
								
									<td style="color:blue">
										<select name="{{$j->id}},{{$s->id}},{{$g->id}},f">
											<option value="-1">select formateur / module</option>
										@foreach($value as $v)
											
											@if($v->groupe_id==$g->id)
												
													<option title="{{$v->module->nomMod}}" value="{{$v->id}}">
													{{$v->formateur->prenomF}} - {{$v->formateur->nomF}} ( {{$v->module->refMod}} )
													</option>
												
											@endif
											
											
										@endforeach
										</select>
									</td>
								
								
							@endforeach
						@endforeach
					</tr>
					@endforeach
				@endforeach
			@endforeach

		</tbody>
	</table>
	<input type="submit" value="Ajouter" class="form-control btn btn-primary">
</form>
@endif

@endsection