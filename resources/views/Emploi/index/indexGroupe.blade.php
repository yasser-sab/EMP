@extends('layouts.app')
@section('content')
<?php 
// $arrayName = array('Formateur'=>$formateur,'Salle'=>$salle,'Module'=>$module,'Absence'=>['non','oui']);
$arrayName=array('Formateur<br><br>;Salle;Module');
?>
<center>
	<h1>EMPLOI DU TEMPS GROUPE</h1>
	<!-- <div style="float: right;">
		<a href="{{url('emplois/filter/createFilter')}}" class="btn btn-success">Nouveau Emploi</a>
	</div> -->
</center>


	@if(@count($select)>0)
	<!-- <div class="col-md-5" align="right">
		<a target ="_blank" href="{{url('emplois/pdf')}}">PDF</a>
	</div> -->
	@foreach($semaine as $sem)
	<div>
		<button class="pdf">pdf</button>
	</div>
	<div id="res">
	<h4>Emploi valable a partir du : {{$sem->dateDSemaine}}  Au : {{$sem->dateFSemaine}}</h4>
	<table class="table table-bordered table-striped table-hover" width="80%" align="center" id="table" border="1" cellspacing="0" cellpadding="10">
		<thead align="center">
			<tr>
				<td colspan="2" rowspan="3">groupe</td>
				<td colspan="2" rowspan="3">F<br/>S<br/>M</td>
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

		<tbody align="center">
			@foreach($groupe as $g)
				<tr>
					<td colspan="2" rowspan="2">{{$g->nomG}}</td>
				</tr>
				@foreach($arrayName as $value)
				<tr>
					<td colspan="2">
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
							
									<td>
										@foreach($select as $emp)
											@if($emp->semaine_id==$sem->id && $emp->groupe_id==$g->id && $emp->jour_id==$j->id && $emp->seance_id==$s->id)
												<span style="color:blue;">{{$emp->formateur->prenomF}} -{{$emp->formateur->nomF}}</span><hr>
												<span style="color:green;">{{$emp->salle->nomSa}}</span><hr>
												<span style="color:orange;" title="{{$emp->module->nomMod}}">{{$emp->module->refMod}}</span>
											@endif
										@endforeach
									</td>
							
						@endforeach
					@endforeach
				</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
	</div>
	@endforeach
	@else
	<div class="container" style="z-index: 0;">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">information</div>

                            <center>
                                <div style="color: red" class="card-body">
                                occune emplois valide trouver !
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
    </div>
	@endif
	<div id="r"></div>
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});
   
    $('.pdf').click(function(e){
        e.preventDefault();
   
        var res = $("#res").html();
 
        $.ajax({
           type:'POST',
           url:"{{url('emplois/pdf')}}", 
           data:{data:res},
           // contentType:false,
           cache:false,
           // processData:false,
           // dataType:"json",
           

           success:function(data){
              console.log(data);
              $('#r').html(data);
           }
        });
  
	});
		});
		
	</script>
@endsection