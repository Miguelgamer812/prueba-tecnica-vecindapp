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

    public function userVote(Opcion $option)
    {
        $preguntas = Pregunta::get();
        $opciones = Opcion::get();
        return view('votar.index', ['preguntas' => $preguntas, 'opciones' => $opciones]);
    }
    public function vote(Request $request, Opcion $option, $id)
    {
        $user = Auth::user();
        $preguntaId = $id;

        // Validar que el usuario no haya votado ya por esta pregunta
        $yaVoto = Voto::where('user_id', $user->id)
            ->where('pregunta_id', $preguntaId)
            ->exists();

        if ($yaVoto) {
            return back()->with('error', 'Ya has votado en esta pregunta.');
        }

        $request->validate([
            'opcion' => 'required|exists:opcions,id',
        ]);

        // Registrar el voto
        Voto::create([
            'option_id' => $request->opcion,
            'user_id' => $user->id,
            'pregunta_id' => $preguntaId,
        ]);

        return redirect()->route('home')->with('message', 'Tu voto ha sido registrado.');
    }



    public function show()
    {
        $preguntas = Pregunta::with('opciones.votes')->get();

        return view('preguntas.show', compact('preguntas'));
    }
}
