@extends('template.layout')

@section('css')


<link href="{{asset('css/principal.css')}}" rel="stylesheet"> 

@endsection

@section('contenido')
    
    

   <usuario-list :empresauser_prop="{{json_encode($empresa_user)}}" :cargos_prop="{{json_encode($cargos)}}" ></usuario-list>

   

 
@endsection


@section('js')


@endsection