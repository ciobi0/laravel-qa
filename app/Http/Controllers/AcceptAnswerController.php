<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke( Answer $answer)
    {
        // $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

        return back();
    }
}
