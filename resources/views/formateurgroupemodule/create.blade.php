@extends('layouts.app')
@section('content')

<div class="container">
<script type="text/javascript">
		$(document).ready(function(){
			// $('#email').text($("#formateur").children("option:selected").attr('id').split(";")[1]);
		 //    $('#sa').text($("#formateur").children("option:selected").attr('id').split(";")[0]);
		 //    $('#tel').text($("#formateur").children("option:selected").attr('id').split(";")[2]);
		 //    // $('#fil').text($("#groupe").children("option:selected").attr('id').split(';')[0]);
		 //    // $('#niv').text($("#groupe").children("option:selected").attr('id').split(';')[1]);
		 //    $('#nom').text($("#module").children("option:selected").attr('id').split(";")[0]);
		 //    $('#abrmod').text($("#module").children("option:selected").attr('id').split(";")[1]);
		 //    $('#mh').text($("#module").children("option:selected").attr('id').split(";")[2]);
		 //    $('#nv').text($("#module").children("option:selected").attr('id').split(";")[3]);
		 //    $('#ord').text($("#module").children("option:selected").attr('id').split(";")[4]);

		    $("#formateur").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#email').text(res[1]);
		        $('#sa').text(res[0]);
		       	$('#tel').text(res[2]);
		    });
		    $("#filier").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#abrFil').text(res[0]);
		    });
		     
		    // $("#groupe").change(function(){
		    //     var res = $(this).children("option:selected").attr('id').split(";");
		    //     $('#fil').text(res[0]);
		    //     $('#niv').text(res[1])
		    // });
		     // $('#abrmod').text($("#module").children("option:selected").attr('id').split(";")[1]);
		     // $('#mh').text($("#module").children("option:selected").attr('id').split(";")[2]);
		    $("#module").change(function(){
		        var res = $(this).children("option:selected").attr('id').split(';');
		        $('#nom').text(res[0]);
		        $('#abrmod').text(res[1]);
		        $('#mh').text(res[2]);
		        $('#nv').text(res[3]);
		        $('#ord').text(res[4]);
		    });
		});
	</script> 
	<div class="row">
		<div class="col-md-12">
				<center>
					<h1>Nouveau effectation module</h1>
					@if(session()->has('fail'))
				<div class="alert alert-danger">
					{{session()->get('fail')}}
				</div>
				@endif</center>
			<form action="{{url('formateur_groupe_module')}}" method="post">
				{{csrf_field()}}
				<table class="table">
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Filier : </th>
							</tr>
						<th>libele</th>
						</thead>
						<tbody>
						<td>
							<select class="form-control" name="filier" id="filier">
								<option id=';' value="-1"> select filier </option>
							@foreach($filier as $fil)
							<option id="{{$fil->nomFil}}" value="{{$fil->id}}">{{$fil->abrFil}}</option>
							@endforeach
							</select>
						</td>
						<td id="abrFil"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Formateur : </th>
							</tr>
						<th>nom & prenom</th>
						<th>email</th>
						<th>salle</th>
						<th>telephone</th>
						</thead>
						<tbody>
						<td>
							<select class="form-control" name="formateur" id="formateur">
								<option id=";" value="-1"> select formateur</option>
							</select>
						</td>
						<td id="email"></td>
						<td id="sa"></td>
						<td id="tel"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Module : </th>
							</tr>
						<th>Reference</th>
						<th>nom</th>
						<th>Abbreviation</th>
						<th>Masse Horaire</th>
						<th>niveau</th>
						<th>order</th>
						</thead>
						<tbody>
						<td>
						<select class="form-control" name="module" id="module">
							<option id=";" value="-1"> select module </option>
						</select>
						
						</td>
						<td id="nom"></td>
						<td id="abrmod"></td>
						<td id="mh"></td>
						<td id="nv"></td>
						<td id="ord"></td>
						</tbody>
					</figure>
					<figure>
						<thead>
							<tr>
								<th style="color: white;background-color: grey">Groupes : </th>
							</tr>
							<tr>
								<th>check</th>
								<th>nom</th>
								<th>Filier</th>
								<th>niveau</th>
							</tr>
						</thead>
						<tbody id="groupes">
						
							
						</tbody>
					</figure>
					
				</table>
			<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
			</form>
		</div>
	</div>









	{{--<div class="row">
		<div class="col-md-12">
				<table class="table">
					<select name="filier">
						@foreach($filier as $f)
							<option value="{{$f->id}}">{{$f->abrFil}}</option>
						@endforeach
					</select><br>
					<select name="formateur">
							<option>-- formateurs --</option>
					</select>
				</table>
		</div>
	</div>--}}
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
  
        
        	var res = $('select[name="filier"]').on('change',function(e){
        	e.preventDefault();
        	var filierID = jQuery(this).val();
               if(filierID)
               {
               	  $.ajax({
			           type:'POST',
			           url:"{{url('formateur_groupe_module/getformateurs')}}",
			           data:{data:filierID},
			           // contentType:false,
			           cache:false,
			           // processData:false,
			           // dataType:"json",
			           

			           success:function(data){
			           	// console.log(data);
			           	$('select[name="formateur"]').html(data);
			           }
			        });
               }
        	});

        	var res = $('select[name="formateur"]').on('change',function(e){
        	e.preventDefault();
        	var formateurID = jQuery(this).val();
               if(formateurID)
               {
               	  $.ajax({
			           type:'POST',
			           url:"{{url('formateur_groupe_module/getmodules')}}",
			           data:{data:formateurID},
			           // contentType:false,
			           cache:false,
			           // processData:false,
			           // dataType:"json",
			           

			           success:function(data){
			           	// console.log(data);
			           	$('select[name="module"]').html(data);
			           }
			        });
               }
        	});
        	var res = $('select[name="module"]').on('change',function(e){
        	e.preventDefault();
        	var moduleID = jQuery(this).val();
               if(moduleID)
               {
               	  $.ajax({
			           type:'POST',
			           url:"{{url('formateur_groupe_module/getgroupes')}}",
			           data:{data:moduleID},
			           // contentType:false,
			           cache:false,
			           // processData:false,
			           // dataType:"json",
			           

			           success:function(data){
			           	// console.log(data);
			           	$('tbody[id="groupes"]').html(data);
			           }
			        });
               }
        	});
 
      
		});
		
	</script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->



</div>
@endsection