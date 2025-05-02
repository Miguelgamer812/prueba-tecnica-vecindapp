@extends('layouts.app')

@section('content')
    <div class="container">
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
                        @can('can_create_questions')
                            <form action="{{ route('preguntas.index') }}">
                                <input type="submit" value="Crear pregunta">
                            </form>
                        @endcan
                        <form action="{{ route('users.create') }}">
                            <input type="submit" value="Crear usuarios">
                        </form>
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
