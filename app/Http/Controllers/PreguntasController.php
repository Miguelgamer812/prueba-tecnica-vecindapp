<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use App\Models\Pregunta;
use App\Models\Voto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // public function vote(Opcion $option) Deprecated
    // {
    //     $option->votes()->create();
    //     return back()->with('success', '¡Gracias por tu voto!');
    // }
    public function vote(Request $request, Opcion $option)
    {
        $user = Auth::user();
        $preguntaId = $option->pregunta_id ?? $option->question_id;

        // Verifica si ya votó por esa pregunta
        $yaVoto = Voto::where('user_id', $user->id)
            ->whereHas('option', function ($q) use ($preguntaId) {
                $q->where('pregunta_id', $preguntaId);
            })
            ->exists();

        if ($yaVoto) {
            return back()->with('error', 'Ya has votado en esta pregunta.');
        }

        // Registrar el voto
        $option->votes()->create([
            'user_id' => $user->id
        ]);

        return back()->with('success', '¡Gracias por votar!');
    }


    public function show(Pregunta $question)
    {
        $question->load('options.votes');
        return view('preguntas.show', compact('question'));
    }
}
