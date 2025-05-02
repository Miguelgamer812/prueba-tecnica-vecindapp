@extends('layouts.app')

@section('content')
    @can('can_see_results')
    <div class="m-5 p-5">
        <h1>Preguntas</h1>
        @foreach ($preguntas as $pregunta)
            <h2>{{ $pregunta->text }}</h2>

            @php
                $totalVotes = $pregunta->opciones->sum(fn($opt) => $opt->votes->count());
            @endphp

            @foreach ($pregunta->opciones as $opcion)
                @php
                    $count = $opcion->votes->count();
                    $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 2) : 0;
                @endphp
                <p>{{ $opcion->text }}: {{ $percent }}% ({{ $count }} votos)</p>
            @endforeach

            <hr>
        @endforeach
    @endcan
</div>
@endsection
