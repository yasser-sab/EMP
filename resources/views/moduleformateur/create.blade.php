@extends('layouts.app')
@section('content')

<div class="container">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script type="text/javascript">
		$(document).ready(function(){
			$('#adr').text($('#formateur').children('option:selected').attr('id').split(";")[0]);
		    $('#sal').text($('#formateur').children('option:selected').attr('id').split(";")[1]);
		    // $('#nom').text($('#module').children('option:selected').attr('id').split(";")[0]);
		    // $('#abr').text($('#module').children('option:selected').attr('id').split(";")[1]);
		    // $('#mh').text($('#module').children('option:selected').attr('id').split(";")[2]);
		    $("#formateur").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#adr').text(res[0]);
		        $('#sal').text(res[1]);
		    });
		    // $("#module").change(function(){
		    //     var res = $(this).children("option:selected").attr('id').split(';');
		    //     $('#nom').text(res[0]);
		    //     $('#abr').text(res[1]);
		    //     $('#mh').text(res[2]);
		    // });
		});
	</script>
	<div class="row">
		<div class="col-md-12">
			<center>
				@if(session()->has('fail'))
				<div class="alert alert-danger" role="alert">
				  {{session()->get('fail')}}
				</div>
				@endif
				<h1>Nouveau affectation</h1>
			</center>
			<form action="{{url('module_formateur')}}" method="post">
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Formateur : </th></tr>
							<tr><th>nom & prenom</th>
							<th>email</th>
							<th>salle</th></tr>
						</thead>
						<tbody>
						<td>
							<select class="form-control" name="formateur" id="formateur">
								<option id=";" value="-1"> select formateur </option>
								@foreach($formateur as $f)
								<option id="{{$f->emailF}};{{$f->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}}&nbsp;{{$f->prenomF}}</option>
								@endforeach
							</select>
						</td>
						<td id="adr"></td>
						<td id="sal"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr><th style="color: white;background-color: grey;">Module : </th></tr>
							<tr><th>check</th>
							<th>nom</th>
							<th>reference</th>
							<th>masse horaire</th>
							<th>niveau</th>
							<th>order</th>
						</tr>
						</thead>
						<tbody id="modules">

						</tbody>
					</figure>
					
				</table>
				<!-- <div class="form-group">
					<h2>Get request</h2>
					<button type="button" class="btn btn-warning" id="getRequest">getRequest</button>
				</div> -->

			<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
  
        
        	var res = $('select[name="formateur"]').on('change',function(e){
        	e.preventDefault();
        	var formateurID = jQuery(this).val();
               if(formateurID)
               {
               	  $.ajax({
			           type:'POST',
			           url:"{{url('module_formateur/getmodules')}}",
			           data:{data:formateurID},
			           // contentType:false,
			           cache:false,
			           // processData:false,
			           // dataType:"json",
			           

			           success:function(data){
			           	console.log(data);
			           	$('tbody[id="modules"]').html(data);
			           }
			        });
               }
        	});
		});
	</script>
</div>
@endsection