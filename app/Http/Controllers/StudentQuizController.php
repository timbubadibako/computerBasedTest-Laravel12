<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizController extends Controller
{
    // Menampilkan quiz yang tersedia
    public function dashboard()
    {
        $availableQuizzes = Quiz::withCount('questions')->get();
        // dd($availableQuizzes);

        return view('student.dashboard', compact('availableQuizzes'));
    }

    // Verifikasi token dan arahkan ke ruang tunggu
    public function verify(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'token' => 'required|string|max:6',
        ]);

        $quiz = Quiz::where('id', $request->quiz_id)
            ->where('token', $request->token)
            ->first();

        if (!$quiz) {
            return redirect()->back()
                ->with('banner', 'Token quiz salah atau quiz tidak ditemukan!')
                ->with('bannerStyle', 'error');
        }

        // Cek waktu quiz
        if (now()->greaterThan(\Carbon\Carbon::parse($quiz->start_time)->addMinutes($quiz->duration))) {
            return redirect()->back()
                ->with('banner', 'Quiz sudah habis waktunya!')
                ->with('bannerStyle', 'error');
        }

        // Cek apakah user sudah pernah mengerjakan
        $sudah = \App\Models\QuizResult::where('quiz_id', $quiz->id)


            ->where('user_id', auth::id())
            ->exists();
        if ($sudah) {
            return redirect()->back()
                ->with('banner', 'Anda sudah pernah mengerjakan quiz ini.')
                ->with('bannerStyle', 'error');
        }

        // Jika lolos semua, redirect ke halaman quiz
        // Jika lolos semua, redirect ke ruang tunggu dulu
        return redirect()->route('student.quiz.waiting', $quiz->id);

    }

    // Ruang tunggu quiz
    public function waiting(Quiz $quiz)
    {
        return view('student.waiting-room', compact('quiz'));
    }

    public function show($id)
    {
        $quiz = \App\Models\Quiz::with('questions')->findOrFail($id);

        $questions = $quiz->questions->map(function($q) {
            return [
                'id' => $q->id,
                'pertanyaan' => $q->question,
                'opsi' => [
                    'A' => $q->option_a,
                    'B' => $q->option_b,
                    'C' => $q->option_c,
                    'D' => $q->option_d,
                ],
                'jawaban_benar' => $q->correct_answer,
            ];
        })->values();

        // $startTime = Carbon::parse($quiz->start_time);
        // $duration = $quiz->duration; // dalam menit
        // $endTime = $startTime->copy()->addMinutes($duration)

        return view('student.quiz', [
            'quiz' => $quiz,
            'questions' => $questions,
            // 'end_time' => $endTime->timestamp,
        ]);

    }


    public function submit(Request $request, $quizId)
    {
        $quiz = \App\Models\Quiz::with('questions')->findOrFail($quizId);
        $userId = Auth::check() ? Auth::id() : null;
        $answers = $request->input('answers', []);
        $correct = 0;
        $total = $quiz->questions->count();
        $review = [];

        foreach ($quiz->questions as $question) {
            $selected = $answers[$question->id] ?? null;
            $isCorrect = $selected && $selected == $question->correct_answer;
            if ($isCorrect) $correct++;
            $review[] = [
                'question' => $question->question,
                'selected' => $selected,
                'correct' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'options' => [
                    'A' => $question->option_a,
                    'B' => $question->option_b,
                    'C' => $question->option_c,
                    'D' => $question->option_d,
                ],
            ];
        }

        $score = round(($correct / max($total,1)) * 100);

        // Simpan hasil ke DB (misal ke tabel quiz_results)
        \App\Models\QuizResult::updateOrCreate(
            ['quiz_id' => $quizId, 'user_id' => $userId],
            ['score' => $score, 'correct' => $correct, 'wrong' => $total - $correct, 'answers' => json_encode($answers)]
        );

        // Simpan review ke session (atau bisa ke DB jika ingin)
        session([
            'quiz_result.review' => $review,
            'quiz_result.score' => $score,
            'quiz_result.correct' => $correct,
            'quiz_result.wrong' => $total - $correct,
            'quiz_result.total' => $total,
            'quiz_result.quiz_title' => $quiz->title,
        ]);

        return redirect()->route('student.result', $quizId);
    }

    public function result($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Ambil dari session (atau dari DB jika ingin)
        $score = session('quiz_result.score');
        $correct = session('quiz_result.correct');
        $wrong = session('quiz_result.wrong');
        $total = session('quiz_result.total');
        $review = session('quiz_result.review');
        $quizTitle = session('quiz_result.quiz_title');

        return view('student.result', compact('quiz', 'score', 'correct', 'wrong', 'total', 'review', 'quizTitle'));
    }
}
