@extends('layouts.app')
@section('content')

<?php $arrayName = array('Formateur;Salle;Module');?>
	<center><h1>Emplois parametrable</h1></center>
		@if(@count(App\Emploi::all())>0)
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
			<div style="float: right;">
				<a href="{{url('emploiparams/create')}}" class="btn btn-success">parametrage</a>
			</div>
			<table class="table table-bordered table-striped table-hover" align="center" id="table" border="1" cellspacing="0" cellpadding="10">
			<thead>
				<tr>
	                <td rowspan="3">Filier</td>
	                <td rowspan="3">Groupe</td>
	                <td rowspan="3">F<br/>S<br/>M</td>
	                @foreach($jour as $j)
	                <td colspan="4">{{$j->jour}}</td>
	                @endforeach
            	</tr>
	            <tr>
	                @foreach($jour as $j)
		                <td colspan="2">matin</td>
		                <td colspan="2">apres midi</td>
	                @endforeach
	            </tr>
	            <tr>
	                @foreach($jour as $j)
	                    @foreach($seance as $s)
	                    <td>{{$s->nomSe}}</td>
	                    @endforeach
	                @endforeach
	            </tr>
			</thead>
			<tbody>
				@foreach($filier as $fi)
	                <tr>
	                    <td rowspan=<?php echo (count($groupe->where('filier_id','=',$fi->id))*(count($arrayName)+1))+1; ?>>
	                        {{$fi->abrFil}}
	                    </td>
	                </tr>
	                @foreach($groupe->where('filier_id','=',$fi->id) as $g)
	                    <tr>
	                        <td rowspan=<?php echo count($arrayName)+1; ?> >{{$g->nomG}}</td>
	                    </tr>
	                    @foreach($arrayName as $value)
	                    <tr>
	                        <td>
	                        	<?php
	                        		$res=explode(';', $value);
									foreach ($res as $key => $value) {
										echo "</p>" . $value . "<p>";
										if(count($res)-1 != $key)
										{
											echo "<hr>";
										}
									}
	                        	 ?>
	                        </td>
	                        @foreach($jour as $j)
	                            @foreach($seance as $s)
	                                
	                                <td >
	                                   @foreach($emplois as $emp)
	                                   		@if($emp->jour_id==$j->id && $emp->seance_id==$s->id && $emp->formateur_groupe_module->groupe_id==$g->id)
	                                   			<span style="color: blue;">{{$emp->formateur_groupe_module->formateur->nomF}} {{$emp->formateur_groupe_module->formateur->prenomF}}</span><hr>
	                                   			<span style="color: green">{{$emp->formateur_groupe_module->formateur->salle->nomSa}}</span><hr>
	                                   			<span style="color: orange" title="{{$emp->formateur_groupe_module->module->nomMod}}">{{$emp->formateur_groupe_module->module->refMod}}</span>
	                                   		@endif
										@endforeach
	                                </td>
	                                
	                            @endforeach
	                        @endforeach
	                    </tr>
	                    @endforeach
	                @endforeach
            	@endforeach
			</tbody>
			</table>
		@endif
@endsection