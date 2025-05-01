<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    public function create()
    {
        return view('preguntas.create');
    }

    public function index()
    {
        return view('preguntas.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string'
        ]);

        $pregunta = Pregunta::create(['text' => $request->text]);

        foreach ($request->options as $optionText) {
            $pregunta->options()->create(['text' => $optionText]);
        }

        return redirect()->route('preguntas.index')->with('success', 'Pregunta creada.');
    }

    public function vote(Opcion $option)
    {
        $option->votes()->create();
        return back()->with('success', '¡Gracias por tu voto!');
    }

    public function show(Pregunta $question)
    {
        $question->load('options.votes');
        return view('preguntas.show', compact('question'));
    }
}
