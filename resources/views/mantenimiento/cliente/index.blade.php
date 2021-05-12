@extends('template.layout')

@section('css')

<link href="{{asset('css/principal.css')}}" rel="stylesheet"> 

@endsection

@section('contenido')
    
    


    <cliente-list :categorias_prop="{{json_encode($categorias)}}" :clasecliente_prop="{{json_encode($categorias)}}" :documentos_prop="{{json_encode($documentos)}}" :ecivil_prop="{{json_encode($ecivil)}}" :ocupacion_prop="{{json_encode($ocupacion)}}" :paises_prop="{{json_encode($paises)}}" :departamentos_prop="{{json_encode($departamentos)}}" :empresauser_prop="{{json_encode($empresa_user)}}"></cliente-list>

   

 
@endsection


@section('js')


@endsection