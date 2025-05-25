<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
   

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $question->answers()->create(['body' => $request->body, 'user_id' => 1]);

        return back()->with('success', 'Your answer has been submitted');
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Answer $answer)
    {
        return view('answers.edit', compact('question', 'answer'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $answer->update($request->validate([
            'body' => 'required'
        ]));

        return redirect(route('questions.show', $question->slug))->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        
    }
}
