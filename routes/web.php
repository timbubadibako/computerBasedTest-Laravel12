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
Route::get('/', fn () => view('welcome'))->name('welcome');
Route::get('/login-admin', fn () => view('auth.login-admin'))->name('login-admin');
Route::get('/login-student', fn () => view('auth.login-student'))->name('login-student');
Route::post('/login', [LoginController::class, 'store']);

// ===================
// Authenticated Routes
// ===================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Pengalihan dashboard universal
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($role === 'student') {
            return redirect()->route('student.dashboard');
        }
        abort(403, 'Role tidak valid.');
    })->name('dashboard');

    // ===================
    // Grup Rute Admin (Dilindungi oleh middleware 'role:admin')
    // ===================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [QuizController::class, 'index'])->name('dashboard');

        // Route::resource akan menangani create, store, show, edit, update, destroy
        Route::resource('quizzes', QuizController::class);

        // Rute tambahan untuk quiz
        Route::post('quizzes/{id}/restore', [QuizController::class, 'restore'])->name('quizzes.restore');
        Route::delete('quizzes/{id}/force-delete', [QuizController::class, 'forceDelete'])->name('quizzes.forceDelete');
        Route::post('quizzes/toggle-token', [QuizController::class, 'toggleToken'])->name('quizzes.toggleToken');
        Route::get('quiz/{quiz}/result', [QuizController::class, 'result'])->name('quiz.result');

        // Rute untuk update pertanyaan, logisnya ini adalah aksi admin
        Route::put('questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    });

    // ===================
    // Grup Rute Student (Dilindungi oleh middleware 'role:student')
    // ===================
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentQuizController::class, 'dashboard'])->name('dashboard');

        // Rute untuk alur pengerjaan quiz
        Route::post('quiz/verify', [StudentQuizController::class, 'verify'])->name('quiz.verify');
        Route::get('quiz/{quiz}/waiting', [StudentQuizController::class, 'waiting'])->name('quiz.waiting');
        Route::get('quiz/{quiz}', [StudentQuizController::class, 'show'])->name('quiz.show');
        Route::post('quiz/{quiz}/submit', [StudentQuizController::class, 'submit'])->name('quiz.submit');
        Route::get('result/{quiz}', [StudentQuizController::class, 'result'])->name('result');

        // Rute untuk menyimpan jawaban sementara, ini adalah aksi student
        Route::post('quiz/answer/save', [QuizAnswerController::class, 'save'])->name('quiz.answer.save');
    });
});
