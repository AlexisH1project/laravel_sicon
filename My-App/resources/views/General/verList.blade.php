@extends('layouts.adminlte')

@section('content')
<center>
<div class="card-body table-responsive p-0" style="height: 465px;">
    <table class="table table-head-fixed table-bordered table-hover">  
      <tbody>
@foreach ($Documentos as $doc)
<tr>
    <td>{{$doc->nombre_documento}}</td>
	<td><button class="btn btn-danger" > X </button></td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>
</center>

@endsection