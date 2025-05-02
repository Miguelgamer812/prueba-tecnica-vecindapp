@extends('layouts.app')

@section('content')
    @can('can_create_questions')
        <h2>Crear preguntas</h2>
        <form action="{{ route('preguntas.create') }}">
            <input type="submit" value="Crear pregunta">
        </form>
    @endcan
    @can('can_see_results')
        <h2>Ver votos</h2>
        <form action="{{ route('preguntas.show', [2]) }}">
            <input type="submit" value="Ver respuestas">
        </form>
    @endcan
@endsection
