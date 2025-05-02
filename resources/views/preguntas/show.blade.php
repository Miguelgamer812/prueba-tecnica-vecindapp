@extends('layouts.app')

@section('content')
    @can('can_see_results')
        <h2>{{ $question->text }}</h2>

        <ul>
            @foreach ($question->options as $option)
                <li>
                    <form method="POST" action="{{ route('questions.vote', $option) }}">
                        @csrf
                        <button type="submit">{{ $option->text }}</button>
                    </form>
                    <small>{{ $option->votes->count() }} votos</small>
                </li>
            @endforeach
        </ul>

        <!-- Estadísticas en porcentaje -->
        <h3>Estadísticas:</h3>
        @php
            $totalVotes = $question->options->sum(fn($opt) => $opt->votes->count());
        @endphp
        @foreach ($question->options as $option)
            @php
                $count = $option->votes->count();
                $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 2) : 0;
            @endphp
            <p>{{ $option->text }}: {{ $percent }}% ({{ $count }} votos)</p>
        @endforeach
    @endcan
@endsection
