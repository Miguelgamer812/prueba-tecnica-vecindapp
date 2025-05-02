@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostrar mensaje de error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($preguntas as $pregunta)
            <h1>{{ $pregunta->text }}</h1>
            <form action="{{ route('voto.store', $pregunta->id) }}" method="POST">
                @csrf
                @foreach ($opciones as $opcion)
                    @if ($opcion->pregunta_id == $pregunta->id)
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="opcion{{ $opcion->id }}" name="opcion"
                                value="{{ $opcion->id }}">
                            <label class="form-check-label" for="opcion{{ $opcion->id }}">
                                {{ $opcion->text }}
                            </label>
                        </div>
                    @endif
                @endforeach

                <button type="submit" class="btn btn-primary">Votar</button>
            </form>

            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        @endforeach
    </div>
@endsection
