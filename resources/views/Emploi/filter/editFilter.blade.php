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
      <form action="{{url('emplois/edit')}}" method="post">
        {{csrf_field()}}
         <table class="table">
           <thead>
              <th>Semaine</th>
              <th>Filier</th>
             <th>Groupe</th>
           </thead>
           <tbody>
             <tr>
              <td>
                <select name="smn" class="form-control">
                  <option value="-1">select semaine</option>
                  @foreach($semaine as $s)
                  <option value= "{{$s->id}}">{{$s->dateDSemaine}} -> {{$s->dateFSemaine}}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="fl" class="form-control">
                  <option value="-1">select filier</option>
                  @foreach($filier as $fil)
                  <option value="{{$fil->groupes()->get('id')}}">{{$fil->abrFil}}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="gr" class="form-control">
                  <option value="-1">select groupe</option>
                  @foreach($groupe as $g)
                  <option value="{{$g->id}}">{{$g->nomG}}</option>
                  @endforeach
                </select>
              </td>
             </tr>
             <tr><td colspan="8"><input type="submit" class="form-control btn btn-primary"></td></tr>
           </tbody>
         </table>
      </form>
    </div>
  </div>
</div>
@endsection