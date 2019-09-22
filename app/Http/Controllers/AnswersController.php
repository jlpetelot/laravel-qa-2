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
    public function edit (Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy (Answer $answer)
    {
        //
    }
}
