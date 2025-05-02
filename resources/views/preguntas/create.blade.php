@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('preguntas.store') }}">
    @csrf

    <label>Pregunta:</label>
    <input type="text" name="text" required>

    <div id="options-container">
        <label>Opción:</label>
        <input type="text" name="options[]" required>
    </div>

    <button type="button" onclick="addOption()">Agregar otra opción</button>

    <button type="submit">Guardar</button>
</form>
@endsection
<script>
    function addOption() {
        const container = document.querySelector('#options-container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'options[]';
        input.required = true;
        container.appendChild(document.createElement('br'));
        container.appendChild(input);
    }
</script>