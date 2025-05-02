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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @can('can_create_questions', 'can_see_results')
                            <form action="{{ route('preguntas.index') }}">
                                <input type="submit" value="preguntas">
                            </form>
                        @endcan

                        @can('can_create_users')
                            <form action="{{ route('users.create') }}">
                                <input type="submit" value="Crear usuarios">
                            </form>
                        @endcan

                        @can('can_vote')
                            <form action="{{ route('voto.user') }}">
                                <input type="submit" value="Votar">
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    const form = document.queryselector("#form-preguntas");
    form.stopDefAction("submit")
    form.addEventListener("submit")

    function stopDefAction(evt) {
        evt.preventDefault();
    }
</script>
