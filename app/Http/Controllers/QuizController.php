<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        $trashedQuizzes = Quiz::onlyTrashed()->latest()->get();
         // Kita gunakan variabel $quizzes yang sudah ada untuk jumlah kuis aktif
        $totalActiveQuizzes = $quizzes->count();

        return view('admin.dashboard', compact('quizzes', 'trashedQuizzes', 'totalActiveQuizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'token' => 'required|string|size:6|unique:quizzes,token',
            'duration' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'csv' => 'required|mimes:csv,txt|max:2048',
        ]);

        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes((int) $request->duration);

        $quiz = Quiz::create([
            'title' => $request->title,
            'token' => $request->token,
            'duration' => $request->duration,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        $file = $request->file('csv');
        $handle = fopen($file, 'r');
        $isHeader = true;

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            Question::create([
                'quiz_id' => $quiz->id,
                'question' => $data[1],
                'option_a' => $data[2],
                'option_b' => $data[3],
                'option_c' => $data[4],
                'option_d' => $data[5],
                'correct_answer' => $data[6],
            ]);
        }

        fclose($handle);

        return redirect()->back()->with('banner', 'Quiz berhasil dibuat!')->with('bannerStyle', 'success');
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('admin.quizzes', compact('quiz'));
    }

    public function submit(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $questions = $quiz->questions;
        $userId = Auth::check() ? Auth::id() : null;
        $correct = 0;
        $total = $questions->count();

        foreach ($questions as $question) {
            $selected = $answers[$question->id] ?? null;
            if ($selected && $selected === $question->correct_answer) {
                $correct++;
            }
        }

        $score = round(($correct / max($total, 1)) * 100);

        QuizAnswer::updateOrCreate(
            ['quiz_id' => $quizId, 'user_id' => $userId],
            ['score' => $score]
        );

        return redirect()->route('quiz.result', $quizId)->with('success', 'Jawaban berhasil dikirim!');
        // return redirect()->route('student.dashboard')->with('success', "Jawaban berhasil dikirim! Skor kamu: $score");
    }

    public function edit(Quiz $quiz)
    {
        $quiz = Quiz::with('questions')->findOrFail($quiz->id);

// Tambahkan ini
    $totalQuiz = Quiz::count(); // hitung jumlah quiz

    // Kalau ada statistik lain:
    // $activeStudents = User::where('role', 'student')->where('status', 'active')->count();
    // $waitingStudents = StudentQuiz::where('status', 'waiting')->count();
    // $completedStudents = StudentQuiz::where('status', 'completed')->count();


        return view('admin.edit', compact('quiz' ,'totalQuiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        // Validasi data utama quiz
        $request->validate([
            'title' => 'required|string|max:255',
            'token' => 'required|string|size:6|unique:quizzes,token,' . $quiz->id,
            'duration' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'questions.*.question' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|string|in:A,B,C,D',
        ]);

        // Hitung end_time berdasarkan start_time + durasi
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes((int) $request->duration);

        // Update data quiz
        $quiz->update([
            'title' => $request->title,
            'token' => $request->token,
            'duration' => $request->duration,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        // Update setiap soal
        foreach ($request->questions as $questionId => $data) {
            $question = \App\Models\Question::find($questionId);
            if ($question && $question->quiz_id == $quiz->id) {
                $question->update([
                    'question' => $data['question'],
                    'option_a' => $data['option_a'],
                    'option_b' => $data['option_b'],
                    'option_c' => $data['option_c'],
                    'option_d' => $data['option_d'],
                    'correct_answer' => $data['correct_answer'],
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('banner', 'Quiz berhasil diperbarui!');
    }


    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->back()->with('banner', 'Quiz dipindahkan ke Trash!')->with('bannerStyle', 'success');
    }

    public function trash()
    {
        $trashedQuizzes = Quiz::onlyTrashed()->latest()->get();
        $quizzes = Quiz::latest()->get();
        return view('admin.dashboard', compact('quizzes', 'trashedQuizzes'));
    }

    public function restore($id)
    {
        $quiz = Quiz::onlyTrashed()->findOrFail($id);
        $quiz->restore();
        return redirect()->back()->with('banner', 'Quiz berhasil direstore!')->with('bannerStyle', 'success');
    }

    public function forceDelete($id)
    {
        $quiz = Quiz::onlyTrashed()->findOrFail($id);
        $quiz->forceDelete();
        return redirect()->back()->with('banner', 'Quiz dihapus permanen!')->with('bannerStyle', 'success');
    }

    private function generateToken()
    {
        do {
            $token = mt_rand(100000, 999999);
        } while (Quiz::where('token', $token)->exists());

        return $token;
    }

    public function toggleToken(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quiz_id);

        if ($request->status === 'on') {
            if (!$quiz->token) {
                $quiz->token = strtoupper(Str::random(6));
            }
        } else {
            $quiz->token = null;
        }

        $quiz->save();

        return response()->json(['success' => true, 'token' => $quiz->token]);
    }
}
