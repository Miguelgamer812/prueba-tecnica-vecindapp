@extends('layouts.app')

@section('content')
    <form action="{{ route('preguntas.create') }}">
        <input type="submit" value="Crear pregunta">
    </form>
@endsection
