@extends('layouts.app')

@section('content')
    <div class="card-body">
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
        <x-user-creation :permissions="$permissions" />
    </div>
@endsection
