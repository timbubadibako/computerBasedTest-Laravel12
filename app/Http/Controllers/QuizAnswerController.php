<?php

namespace App\Http\Controllers;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    // QuizAnswerController.php

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|integer',
            'user_id' => 'required|integer',
            'question_id' => 'required|integer',
            'selected_option' => 'nullable|string|max:1', // A/B/C/D
        ]);

        $answer = QuizAnswer::updateOrCreate(
            [
                'quiz_id' => $request->quiz_id,
                'user_id' => $request->user_id,
                'question_id' => $request->question_id,
            ],
            [
                'selected_option' => $request->selected_option,
            ]
        );

        return response()->json(['status' => 'success', 'data' => $answer]);
    }    //
}
