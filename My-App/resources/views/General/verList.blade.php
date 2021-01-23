@extends('layouts.adminlte')
@inject('Storage', 'Illuminate\Support\Facades\Storage')
@section('content')
<center>
<div class="card-body table-responsive p-0" style="height: 465px;">
    <table class="table table-head-fixed table-bordered table-hover">  
      <tbody>
@foreach ($Documentos as $doc)
<tr>
    <td>{{$doc->nombre_documento}}</td>
	<td>
        @php
        $ext='_.PDF';
        $nombreBuscar =$Fomope->rfc.'_'.strtoupper($doc->documentos).'_'.$Fomope->apellido_1.'_'.$Fomope->apellido_2.'_'.$Fomope->nombre.'_'.$Fomope->id_movimiento.$ext;
        $busquedaDoc = buscaArchivoDoc_Mov($Fomope->rfc, $doc->documentos, $Fomope->apellido_1, $Fomope->apellido_2, $Fomope->nombre, $Fomope->id_movimiento);
        @endphp 
        @if(!empty($busquedaDoc))
        @foreach ($busquedaDoc as $documentoLoc)  
        @if(!empty($documentoLoc))
        <form action = "{{ route('General.downloadPDF') }}" method="POST">
            @csrf
            <input type="hidden" name="Documento" value="{{$doc->documentos}}">
            <input type="hidden" name="nombreDoc" value="{{$documentoLoc}}">
            <input type="submit" class='btn btn-outline-secondary' value ="Ver">
        </form>
         @else
<button class="btn btn-danger" > X </button>
  @endif
  
    @endforeach
    @endif {{-- fin del if empty --}}
</td></tr>
@endforeach    
      </tbody>
    </table>
  </div>
</center>

@endsection