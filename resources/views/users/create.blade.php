@extends('layouts.app')

@section('content')
    <div class="card-body">
        <x-user-creation :permissions="$permissions" />
    </div>
@endsection
