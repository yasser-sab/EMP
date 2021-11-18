@extends('layouts.master')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>@if(session()->has('success'))
        <div class="alert alert-success">
          {{session()->get('success')}}
        </div>
        @endif</center>
         <center>@if(session()->has('fail'))
        <div class="alert alert-danger">
          {{session()->get('fail')}}
        </div>
        @endif</center>
      <form action="{{url('emplois/indexGroupe')}}" method="post">
        {{csrf_field()}}
         <table class="table">
           <thead>
              <!-- <th>Formateur</th> -->
              <th>Semaine</th>
              <!-- <th>Salle</th> -->
              <!-- <th>Seance</th> -->
              <!-- <th>Jour</th> -->
              <th>Filier</th>
             <th>Groupe</th>
             <!-- <th>Module</th> -->
           </thead>
           <tbody>
             <tr>
               {{--<!-- <td>
                <select name="frm" class="form-control">
                  <option value="-1">select formateur</option>
                  @foreach($formateur as $f)
                  <option value="{{$f->id}}">{{$f->nomF}} - {{$f->prenomF}}</option>
                  @endforeach
                </select>
                
              </td> -->
              <!-- <td>
                <select name="sal" class="form-control">
                  <option value="-1">select salle</option>
                  @foreach($salle as $sa)
                  <option value="{{$sa->id}}">{{$sa->nomSa}}</option>
                  @endforeach
                </select>
              </td> -->
              <!-- <td>
                <select name="sea" class="form-control">
                  <option value="-1">select seance</option>
                  @foreach($seance as $sea)
                  <option value="{{$sea->id}}">{{$sea->nomSe}}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="jour" class="form-control">
                  <option value="-1">select jour</option>
                  @foreach($jour as $j)
                  <option value="{{$j->id}}">{{$j->jour}}</option>
                  @endforeach
                </select>
              </td> -->--}}
              <td>
                <select name="smn" class="form-control">
                  <option value="-1">select semaine</option>
                  @foreach($semaine as $s)
                  <option value= "{{$s->id}}">{{$s->dateDSemaine}} -> {{$s->dateFSemaine}}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="filier" class="form-control">
                  <option value="-1">select filier</option>
                  @foreach($filier as $fil)
                  <option value="{{$fil->groupes()->get('id')}}">{{$fil->abrFil}}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="groupe" class="form-control">
                  <option value="-1">select groupe</option>
                  @foreach($groupe as $gr)
                  <option value="{{$gr->id}}">{{$gr->nomG}}</option>
                  @endforeach
                </select>
              </td>
             </tr>
             <tr><td colspan="3"><center><input value="filter" type="submit" class="form-control btn btn-primary col-md-2"></center></td></tr>
           </tbody>
         </table>
      </form>
    </div>
  </div>
</div>
@endsection