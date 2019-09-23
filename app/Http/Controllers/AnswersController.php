<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Question $question, Request $request)
    {
//        $question->answers()->create($request->validate([
//            'body' => 'required'
//        ]) + ['user_id' => \Auth::id()]);

        $request->validate([
            'body' => [function ($attribute, $value, $fail) {
                // Si l'internaute n'est pas logué, message d'erreur envoyé via dans la validation
                if (! \Auth::check()) {
                    return $fail("Vous ne pouvez poster aucune réponse sans être identifié.");
                }
            }, 'required']
        ]);

        $question->answers()->create([
            'body' => $request->body,
            'user_id' => \Auth::id()
        ]);

        return back()->with('success', "votre réponse a été envoyée avec succès.");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit (Question $question, Answer $answer)
    {
        // On s'assure que celui qui édite la réponse est le user logué
        $this->authorize('update', $answer);

        // On retourne sur la vue answers.edit avec answer comme variable
        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Question $question, Answer $answer)
    {
        // On s'assure que celui qui édite la réponse est le user logué
        $this->authorize('update', $answer);

        // On valide la question et on update en même temps
        $answer->update($request->validate([
            'body' => 'required',
        ]));

        // On se redirige sur la vue questions.show avec $question->slug comme variable (la vue a besoin du slug) et message de session succès.
        return redirect()->route('questions.show', $question->slug)->with('success', 'Votre réponse a été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy (Question $question, Answer $answer)
    {
        // On s'assure que celui qui update la réponse est le user logué
        $this->authorize('delete', $answer);

        // On efface la question de la BDD
        $answer->delete();

        return back()->with('success', 'votre réponse a été supprimée.');
    }
}
