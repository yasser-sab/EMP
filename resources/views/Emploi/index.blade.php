@extends('layouts.master')

@section('content')
<?php 
    $arrayName = array('Formateur;Salle;Module;Presence');
    $jour=App\Jour::all();
    $seance=App\Seance::all();
    $semaine=App\Semaine::join('emplois','emplois.semaine_id','=','semaines.id')->where('emplois.isvalide','=','oui')->select('semaines.*')->distinct()->get()->last();
    if($semaine!=null){
    $emplois=App\Emploi::where([['isvalide','oui'],['semaine_id',$semaine->id]])->get();
    $groupe=App\Groupe::whereIn('id',$emplois->pluck(['groupe_id']))->get();
    $filier=App\Filier::whereIn('id',$groupe->pluck(['filier_id']))->get();
    }
?>
    <center>
        @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif
                @if(session()->has('fail'))
                <div class="alert alert-danger">
                    {{session()->get('fail')}}
                </div>
        @endif
             <h1>Emploi Globale</h1>
    </centsser>
    @if($semaine!=null)
  <h6 style="color:red;">cet emploi du temps est valable à partir du {{$semaine->dateDSemaine}} au {{$semaine->dateFSemaine}}</h6>
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
                                    @if(count($emplois->where('groupe_id',$g->id)->where('jour_id',$j->id)->where('semaine_id',$semaine->id)->where('seance_id',$s->id))>0)
                                    <td >
                                       @foreach($emplois as $emp)
                                            @if($emp->jour_id==$j->id && $emp->seance_id==$s->id && $emp->groupe_id==$g->id)
                                                <span style="color: blue;">{{$emp->formateur->nomF}} {{$emp->formateur->prenomF}}</span><hr>
                                                <span style="color: green">{{$emp->salle->nomSa}}</span><hr>
                                                <span style="color: orange" title="{{$emp->module->nomMod}}">{{$emp->module->refMod}}</span><hr>
                                                <span style="color:#BA55D3;">{{$emp->presence}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    @else
                                    <td style="background-color: indianred"></td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
            </table>
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
@endsection