<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuestionController;

// ===================
// Public Routes
// ===================

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login page (admin & student)
Route::get('/login-admin', function () {
    return view('auth.login-admin');
})->name('login-admin');

Route::get('/login-student', function () {
    return view('auth.login-student');
})->name('login-student');

// Login POST (semua user)
Route::post('/login', [LoginController::class, 'store']);


// ===================
// Authenticated Routes (Admin & Student)
// ===================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Universal dashboard redirect (role-based)
    Route::get('/dashboard', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::user()->role === 'student') {
            return redirect()->route('student.dashboard');
        }
        abort(403);
    });

    // ===================
    // Admin Routes
    // ===================

    // Admin dashboard (quiz management)
    Route::get('/admin/dashboard', [QuizController::class, 'index'])->name('admin.dashboard');

    // Quiz resource (CRUD, soft delete, restore, force delete)
    Route::resource('quizzes', QuizController::class);

    // Restore quiz from trash
    Route::post('/quizzes/{id}/restore', [QuizController::class, 'restore'])->name('quizzes.restore');

    // Permanently delete quiz from trash
    Route::delete('/quizzes/{id}/force-delete', [QuizController::class, 'forceDelete'])->name('quizzes.forceDelete');

    // Toggle quiz token (aktif/nonaktif)
    Route::post('/admin/quizzes/toggle-token', [QuizController::class, 'toggleToken']);

    // Quiz result (admin view)
    Route::get('/quiz/{quiz}/result', [QuizController::class, 'result'])->name('quiz.result');

    // Show single quiz for admin
    Route::get('/admin/quizzes/{id}', [QuizController::class, 'show'])->name('admin.quizzes.show');

    // Edit quiz (admin)
    Route::get('/admin/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('admin.quizzes.edit');

    // ===================
    // Student Routes
    // ===================

    // Student dashboard
    Route::get('/student/dashboard', [StudentQuizController::class, 'dashboard'])->name('student.dashboard');

    // Verifikasi token quiz (student)
    Route::post('/student/quiz/verify', [StudentQuizController::class, 'verify'])->name('student.quiz.verify');

    // Ruang tunggu quiz (student)
    Route::get('/student/quiz/{quiz}/waiting', [StudentQuizController::class, 'waiting'])->name('student.quiz.waiting');
    // Show quiz (student)
    Route::get('/student/quiz/{quiz}', [StudentQuizController::class, 'show'])->name('student.quiz.show');

    // Submit quiz (student)
    Route::post('/student/quiz/{quiz}/submit', [StudentQuizController::class, 'submit'])->name('student.quiz.submit');

    // Lihat hasil quiz (student)
    Route::get('/student/result/{quiz}', [StudentQuizController::class, 'result'])->name('student.result');
});


// ===================
// Quiz Answer (AJAX Save Jawaban Sementara)
// ===================

// Submit/save jawaban quiz (AJAX, biasanya dipakai autosave)
Route::post('/quiz/answer/save', [QuizAnswerController::class, 'save'])->name('quiz.answer.save');

// Update question
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
