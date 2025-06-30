{{-- @php
View::share('total', count($questions));
View::share('answered', 0);
View::share('time', $quiz->duration . ':00');
View::share('progress', '0%');
View::share('current', 1);
@endphp --}}

@php
View::share('questions', $questions); // <- tambahkan ini!
    View::share('quiz', $quiz);
    $remainingSeconds = \Carbon\Carbon::parse($quiz->end_time)->diffInSeconds(now(), false);
    $remainingSeconds = $remainingSeconds > 0 ? $remainingSeconds : 0;
    View::share('remainingSeconds', $remainingSeconds);
@endphp


@extends('layouts.focus')
@section('content')

<div id="quiz-view" class="max-w-7xl px-4 py-8 mx-auto mt-10">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Soal dan Jawaban --}}
        <div class="p-6 bg-white rounded-lg shadow-lg lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
            </div>

            <form id="quizForm" method="POST" action="{{ route('student.quiz.submit', $quiz->id) }}">
                @csrf
                @foreach ($questions as $i => $q)
                <div class="question-block {{ $i === 0 ? '' : 'hidden' }}" data-index="{{ $i }}">
                    {{-- <div class="mb-4 font-medium text-gray-700" id="questionCounter">Soal {{ $i+1 }} dari {{ count($questions) }}</div> --}}
                    <div class="mb-6 text-xl font-bold gray-800 text-" id="questionText">{{ $q['pertanyaan'] }}</div>
                    <div class="space-y-3" id="answerOptions">
                        @foreach ($q['opsi'] as $key => $val)
                        <label class="block p-3 border rounded-lg cursor-pointer hover:bg-blue-50">
                            <input type="radio" name="answers[{{ $q['id'] }}]" value="{{ $key }}" class="mr-2">
                            <span class="mr-2 font-bold">{{ $key }}.</span> {{ $val }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="flex justify-between mt-6">
                    <button type="button" id="prevBtn" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100" disabled>Sebelumnya</button>
                    <button type="button" id="nextBtn" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Selanjutnya</button>
                    <button type="submit" id="submitBtn" class="hidden px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Kirim Jawaban</button>
                </div>
            </form>
        </div>

        {{-- Navigasi Soal --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="mb-3 text-lg font-semibold">Navigasi Soal</h3>

            <!-- Di-generate oleh JavaScript -->
            <div id="questionNav" class="grid grid-cols-5 gap-2 mb-4">
                <!-- Tombol navigasi soal akan diisi lewat JS -->
            </div>

            <p class="text-sm text-gray-600">
                Terjawab: <span id="answeredCountEl">0</span>/<span id="totalQuestions">{{ count($questions) }}</span>
            </p>

            <div class="mt-4">
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div id="quizProgress" class="w-0 h-2 transition-all duration-300 bg-blue-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan di Blade layout -->
<div id="quiz-data" data-total="{{ count($questions) }}"></div>
{{-- <pre id="answerPreview" class="mt-4 bg-gray-100 p-2 rounded text-sm text-gray-700"></pre> --}}
{{-- <script>
document.querySelectorAll('input[type="radio"]').forEach(input => {
    input.addEventListener('change', function () {
        const questionId = this.name.match(/\d+/)[0];
        const selectedOption = this.value;

        const preview = document.getElementById('answerPreview');
        console.log('preview element:', preview); // test
        preview.textContent = `Soal ID: ${questionId}\nJawaban: ${selectedOption}`;
    });
});
</script> --}}


<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalQuestions = {{ count($questions) }};
    let currentQuestionIndex = 0;

    const questionNav = document.getElementById('questionNav');
    const answeredCountEl = document.getElementById('answeredCountEl');
    const quizProgress = document.getElementById('quizProgress');

    const QUIZ_ID = {{ $quiz->id }};
    const USER_ID = {{ auth()->id() }};

    // Buat tombol navigasi soal secara dinamis
    for (let i = 0; i < totalQuestions; i++) {
        const btn = document.createElement('button');
        btn.textContent = i + 1;
        btn.className = 'w-8 h-8 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors';
        btn.onclick = () => goToQuestion(i);
        questionNav.appendChild(btn);
    }

    function showQuestion(idx) {
        document.querySelectorAll('.question-block').forEach((el, i) => {
            el.classList.toggle('hidden', i !== idx);
        });

        // Optional: kalau ingin tampilkan counter soal
        document.getElementById('questionCounterDisplay').textContent = `Soal ${idx + 1} dari ${totalQuestions}`;

        document.getElementById('prevBtn').disabled = idx === 0;
        document.getElementById('nextBtn').classList.toggle('hidden', idx === totalQuestions - 1);
        document.getElementById('submitBtn').classList.toggle('hidden', idx !== totalQuestions - 1);

        updateNav(idx);
        updateProgress();
    }

    function goToQuestion(idx) {
        currentQuestionIndex = idx;
        showQuestion(idx);
    }

    function updateNav(idx) {
        document.querySelectorAll('#questionNav button').forEach((btn, i) => {
            btn.className = 'w-8 h-8 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors';

            const isAnswered = document.querySelector(`.question-block[data-index="${i}"] input[type="radio"]:checked`);
            if (isAnswered) {
                btn.classList.add('bg-green-400', 'border-green-400', 'text-green-700');
            }

            if (i === idx) {
                btn.classList.add('bg-blue-600', 'text-white');
            }
        });
    }

    function updateProgress() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        answeredCountEl.textContent = answered;
        quizProgress.style.width = (answered / totalQuestions * 100) + '%';
    }

    // Navigasi soal
    document.getElementById('prevBtn').onclick = () => {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    };

    document.getElementById('nextBtn').onclick = () => {
        if (currentQuestionIndex < totalQuestions - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        }
    };

    // Deteksi perubahan jawaban
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', () => {
            updateProgress();
            updateNav(currentQuestionIndex);
        });
    });

    // Inisialisasi tampilan soal pertama
    showQuestion(currentQuestionIndex);

// document.querySelectorAll('input[type="radio"]').forEach(input => {
    input.addEventListener('change', function () {
        const questionId = this.name.match(/\d+/)[0]; // "answers[5]" -> 5
        const selectedOption = this.value;

        // Tampilkan di <pre>
        const preview = document.getElementById('answerPreview');
        preview.textContent = `Soal ID: ${questionId}\nJawaban: ${selectedOption}`;

        fetch('/quiz/answer/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                quiz_id: QUIZ_ID,
                user_id: USER_ID,
                question_id: questionId,
                selected_option: selectedOption
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log('✅ Jawaban disimpan:', data);
        })
        .catch(err => {
            console.error('❌ Gagal simpan:', err);
        });
    });
});



</script>
@endsection
