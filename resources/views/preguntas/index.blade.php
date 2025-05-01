@extends('layouts.app')

@section('content')
    <h2>Crear preguntas</h2>
    <form action="{{ route('preguntas.create') }}">
        <input type="submit" value="Crear pregunta">
    </form>
    <h2>Ver votos</h2>
    <form action="{{ route('preguntas.show',[2]) }}">
        <input type="submit" value="Ver pregunta">
    </form>
@endsection
