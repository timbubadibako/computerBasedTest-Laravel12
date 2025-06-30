<nav class="sticky top-0 z-50 bg-white border-b shadow-sm">
    <div class="px-4 py-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4">
            <!-- Kiri: Judul Ujian & Nomor Soal -->
            <div class="flex items-center space-x-4">
                <h1 id="quizHeaderTitle" class="text-xl font-bold text-gray-900">
                    {{ $quiz->title ?? 'Judul Ujian' }}
                </h1>
                <span id="questionCounter" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <span id="questionCounterDisplay">Soal 1 dari {{ count($questions ?? []) }}</span>
                </span>
            </div>

            <!-- Kanan: Terjawab & Timer -->
            <div class="flex items-center space-x-4">
                {{-- <div class="text-sm text-gray-600">
                    Terjawab: <span id="answeredCount">{{ $answered ?? 0 }}</span>/<span id="totalQuestions">{{ $total ?? 20 }}</span>
                </div> --}}
                <div id="quizTimer" class="px-3 py-1 font-mono font-bold text-green-700 bg-green-100 rounded-lg">
                    <i data-lucide="clock" class="inline w-4 h-4 mr-1"></i>
                    <span id="timerText">{{ $time ?? '00:00' }}</span>
                </div>

            </div>
        </div>

        <!-- Countdown Timer dan Bar -->
    </div>
        <div class="flex flex-col w-full">
            <div class="relative w-full h-2 overflow-hidden bg-gray-200 rounded-full">
                <div id="countdownBar" class="absolute top-0 right-0 h-full transition-all duration-100 ease-linear bg-blue-600" style="width: 100%;"></div>
            </div>
        </div>

    <script>

    // Waktu awal (dalam detik)
    let isFormSubmitted = false;
    const durationInMinutes = {{ $quiz->duration ?? 90 }};

    const totalSeconds = durationInMinutes * 60;
    let remainingSeconds = totalSeconds;

    const timerText = document.querySelector('#quizTimer');
    const countdownBar = document.querySelector('#countdownBar');

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function updateCountdown() {
        if (remainingSeconds <= 0) {
            clearInterval(timerInterval);
            alert('Waktu habis! Jawaban akan dikirim otomatis.');
            document.getElementById('quizForm').submit(); // Otomatis kirim form
            return;
        }

        remainingSeconds--;

        // Update text waktu
        timerText.querySelector('span')
        ? timerText.querySelector('span').textContent = formatTime(remainingSeconds)
        : timerText.innerHTML = `<i data-lucide="clock" class="inline w-4 h-4 mr-1"></i> ${formatTime(remainingSeconds)}`;

        // Update progress bar countdown (dari kanan ke kiri)
        const percentage = (remainingSeconds / totalSeconds) * 100;
        countdownBar.style.width = `${percentage}%`;
    }

    const timerInterval = setInterval(updateCountdown, 1000);
    
</script>

</nav>
