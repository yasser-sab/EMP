@extends('layouts.app')
@section('content')
<!-- <?php 
// $arrayName = array('Formateur'=>$formateur,'Salle'=>$salle,'Module'=>$module,'Absence'=>['non','oui']);
	$arrayName = array('Formateur;Module;Absence')
?> -->
<center>@if(session()->has('success'))
        <div class="alert alert-success">
          {{session()->get('success')}}
        </div>
        @endif</center>
         <center>@if(session()->has('fail'))
        <div class="alert alert-danger">
          {{session()->get('fail')}}
        </div>
        @endif
        <h1>Ajouter emplois</h1>
</center>
<form action="{{url('emplois')}}" method="post">
	{{csrf_field()}}
	@foreach($semaine as $sem)
	<h6>Semaine : ( {{$sem->dateDSemaine}} -> {{$sem->dateFSemaine}} )</h6>
	<table class="table table-bordered table-striped table-hover" id="table" border="1">
		<thead align="center">
			<tr>
				<td colspan="2" rowspan="3">groupe</td>
				<td colspan="2" rowspan="3">F<br/>S<br/>M<br/>A</td>
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
							@if(count($select->where('groupe_id',$g->id)->where('semaine_id',$sem->id)->where('jour_id',$j->id)->where('seance_id',$s->id))>0)
								<td style="background-color: #DC143C;color: white">
									@foreach($select as $emp)
									@if($emp->semaine_id==$sem->id && $emp->groupe_id==$g->id && $emp->jour_id==$j->id && $emp->seance_id==$s->id)
										<h6 style="background-color: white;color: #DC143C">( déjà occupé )</h6>
										<p title="{{$emp->formateur->salle->nomSa}}">{{$emp->formateur->prenomF}} - {{$emp->formateur->nomF}}</p><hr>
										<p title="{{$emp->module->nomMod}}">{{$emp->module->refMod}}</p><hr>
										@if($emp->absence_id!=null)
											<p>oui</p>
										@else
										<p>non</p>
										@endif
									@endif
									@endforeach
								</td>
								@else
								<td style="background-color: #4682B4;color: white">
									
									<h6 style="color: green;background-color: white">( disponible )</h6>
									<span>
										<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},f" style="background-color: red;color:white;">
												<option value="-1">select formateur</option>
												@foreach($formateur as $f)
												<option title="{{$emp->formateur->salle->nomSa}}" value="{{$f->id}}">{{$f->nomF}} - {{$f->prenomF}}</option>
												@endforeach
										</select>
									</span><hr>

									<span>
										<select name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},m" style="background-color:blue;color:white;">
													<option value="-1">select module</option>
													@foreach($module as $m)
														<option title="{{$emp->module->nomMod}}" value="{{$m->id}}">{{$m->refMod}}</option>
													@endforeach
										</select>
									</span><hr>

									{{--<span>
										<select id="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}}ab" name="{{$sem->id}},{{$j->id}},{{$s->id}},{{$g->id}},abs" style="background-color:yellow;">
													@foreach($value as $abs)
														<option value="{{$abs}}">{{$abs}}</option>
													@endforeach
										</select>
										<script type="text/javascript">
											$(document).ready(function(){
												('#{{$j->id}}{{$s->id}}{{$g->id}}absence').change(function(){
														 var res=prompt('Absence','{{$j->jour}} ; {{$s->nomSe}} ; {{$g->nomG}}');
															if(res==null){
																$("#{{$j->jour}}{{$s->nomSe}}{{$g->nomG}}abs").attr('checked','true');
															}
														});
													});
										</script>
									</span>--}}
										
									</td>
							@endif
						@endforeach
					@endforeach
				</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
	@endforeach
	<input type="submit" value="Ajouter" class="form-control btn btn-primary">
</form>
<script>

// table head

{{--table=document.getElementById("table");
header=function(jour,seance){
var jr=document.createElement("tr"),
	lmr=document.createElement("tr"),
	ser=document.createElement("tr"),
	fg=['Groupe',""],
	lm=['matin','apres midi'],
	thead=document.createElement("thead");
	for(let l=0;l<fg.length;l++){
		text=document.createTextNode(fg[l]);
			th=document.createElement("th");
			th.appendChild(text);
			th.setAttribute('colspan','4');
			th.setAttribute('rowspan','3');
			jr.appendChild(th);
	}
	for(let i=0;i<jour.length;i++){

		for(let j=0;j<lm.length;j++){
			text=document.createTextNode(lm[j]);
			th=document.createElement("th");
			th.appendChild(text);
			th.setAttribute('colspan','2');
			lmr.appendChild(th);
		}
		text=document.createTextNode(jour[i].jour);
		th=document.createElement("th");
		th.appendChild(text);
		th.setAttribute('colspan','4');
		jr.appendChild(th);

		for(let k=0;k<seance.length;k++){
			text=document.createTextNode(seance[k].nomSe);
			th=document.createElement("th");
			th.appendChild(text);
			ser.appendChild(th);
		}
	}
	thead.setAttribute('align','center');
	thead.appendChild(jr);
	thead.appendChild(lmr);
	thead.appendChild(ser);
	table.appendChild(thead);
};

var jour=JSON.parse({!! json_encode($jour->toJson()) !!}),
	seance=JSON.parse({!! json_encode($seance->toJson()) !!});
// jour=['lundi','mardi','mercredi','jeurdi','samedi','dimanche'];
// seance=['s1','s2','s3','s4'];
header(jour,seance);


// table body

t=document.getElementById('table');
content=function(groupe){
var fgm=["Formateur","Salle","Module"],
	tbody=document.createElement("tbody"),
	formateurs=JSON.parse({!! json_encode($formateur->toJson()) !!}),
	salles=JSON.parse({!! json_encode($salle->toJson()) !!}),
	modules=JSON.parse({!! json_encode($module->toJson()) !!}),
	jour=JSON.parse({!! json_encode($jour->toJson()) !!}),
	seance=JSON.parse({!! json_encode($seance->toJson()) !!});

for(let l=0;l<groupe.length;l++){
trg=document.createElement("tr");
td=document.createElement("td");
td.setAttribute('colspan','4');
td.setAttribute('rowspan','3');
text=document.createTextNode(groupe[l].nomG);
td.appendChild(text);
trg.appendChild(td);
td=document.createElement("td");
td.setAttribute('colspan','4');
text=document.createTextNode(fgm[0]);
td.appendChild(text);
trg.appendChild(td);
for(let i=0;i<jour.length;i++){
			for(let j=0;j<seance.length;j++){
				td=document.createElement('td');
				s=document.createElement('select');
				s.setAttribute('style','background-color:red;color:white;');
				s.setAttribute('name','frm');
				o2=document.createElement('option');
				text=document.createTextNode("select formateur");
				o2.appendChild(text);
				o2.setAttribute('value','-1');
				s.appendChild(o2);
				for(let m=0;m<formateurs.length;m++){
					o=document.createElement('option');
					o.setAttribute('value',jour[i].jour+";"+seance[j].nomSe+";"+groupe[l].nomG+";formateur="+formateurs[m].id);
					text=document.createTextNode(formateurs[m].prenomF+"-"+formateurs[m].nomF);
					o.appendChild(text);
					s.appendChild(o);
				}
				td.appendChild(s);
				trg.appendChild(td);
			}
		}
// for(let i=0;i<select().length;i++){
// 	trg.appendChild(select()[i]);
// }
tbody.appendChild(trg);
for(let p=1;p<fgm.length;p++){
	tr=document.createElement("tr");
	td=document.createElement("td");
	td.setAttribute('colspan','4');
	text=document.createTextNode(fgm[p]);
	td.appendChild(text);
	tr.appendChild(td);
	for(let i=0;i<jour.length;i++){
			for(let j=0;j<seance.length;j++){
				td=document.createElement('td');
				
				if(fgm[p]=="Salle"){
					s=document.createElement('select');
					s.setAttribute('style','background-color:green;color:white;');
					s.setAttribute('name','salle');
					o2=document.createElement('option');
					text=document.createTextNode("select salle");
					o2.appendChild(text);
					o2.setAttribute('value','-1');
					s.appendChild(o2);
					for(let m=0;m<salles.length;m++){
					o=document.createElement('option');
					o.setAttribute('value',jour[i].jour+";"+seance[j].nomSe+";"+groupe[l].nomG+";salle="+salles[m].id);
					text=document.createTextNode(salles[m].nomSa);
					o.appendChild(text);
					s.appendChild(o);
				}
				}
				else{
					s=document.createElement('select');
					s.setAttribute('style','background-color:blue;color:white;');
					s.setAttribute('name','module');
					o2=document.createElement('option');
					text=document.createTextNode("select module");
					o2.appendChild(text);
					o2.setAttribute('value','-1');
					s.appendChild(o2);
					for(let m=0;m<modules.length;m++){
					o=document.createElement('option');
					o.setAttribute('value',jour[i].jour+";"+seance[j].nomSe+";"+groupe[l].nomG+";module="+modules[m].id);
					text=document.createTextNode(modules[m].refMod);
					o.appendChild(text);
					s.appendChild(o);
				}
				}
				td.appendChild(s);
				tr.appendChild(td);
			}
		}
	// for(let k=0;k<select().length;k++){
	// 	tr.appendChild(select()[k]);
	// }
	tbody.appendChild(tr);
}


}
t.appendChild(tbody);
return t;
};
select=function(){
	dtt=[];
		for(let i=0;i<jour.length;i++){
			for(let j=0;j<seance.length;j++){
				td=document.createElement('td');
				o=document.createElement('option');
				s=document.createElement('select');
				s.appendChild(o);
				td.appendChild(s);
				dtt.push(td);
			}
		}
		return dtt;
}
groupes=JSON.parse({!! json_encode($groupe->toJson()) !!});
content(groupes);--}}

</script>
@endsection