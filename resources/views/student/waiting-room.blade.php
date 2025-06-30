@extends('layouts.plain')

@section('content')
<div class="relative w-full max-w-xl p-4">
    {{-- Kartu Dekoratif Belakang (Kiri) --}}
    <div class="absolute top-0 left-0 w-full h-full transform -rotate-6 bg-gradient-to-tr from-indigo-100 to-white rounded-2xl shadow-lg z-10 opacity-70"></div>

    {{-- Kartu Dekoratif Belakang (Kanan) --}}
    <div class="absolute top-0 left-0 w-full h-full transform rotate-6 bg-gradient-to-bl from-indigo-100 to-white rounded-2xl shadow-lg z-10 opacity-70"></div>

    {{-- Kartu Utama (Konten) --}}
    <div id="waiting-view" class="relative w-full p-6 sm:p-8 bg-white rounded-2xl shadow-xl z-20 backdrop-blur-sm bg-opacity-95">
        {{-- Header --}}
        <div class="mb-6 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 mx-auto mb-6 border-4 border-indigo-200 bg-indigo-50 rounded-full">
                <i data-lucide="clock-3" class="w-10 h-10 text-indigo-600"></i>
            </div>
            <h2 class="mb-1 text-4xl font-bold text-slate-900">Ruang Tunggu</h2>
            <p id="quizTitle" class="text-lg text-slate-500">{{ $quiz->title ?? 'Memuat Quiz...' }}</p>
        </div>

        {{-- Countdown --}}
        <div class="mb-8 text-center">
            <p class="mb-2 text-sm text-slate-600">Quiz akan dimulai dalam</p>
            {{-- Menggunakan font-mono untuk tampilan jam digital --}}
            <div id="countdown" class="text-7xl font-mono font-bold text-indigo-600 tracking-wider">--:--</div>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-8 px-4 sm:px-8">
            <div class="flex justify-between mb-2 text-sm font-medium text-slate-600">
                <span>Progress</span>
                <span id="progressPercent">0%</span>
            </div>
            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">
                <div id="progressBar" class="h-3 transition-all duration-1000 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500" style="width: 0%"></div>
            </div>
        </div>

        {{-- Info Quiz --}}
        <div class="grid grid-cols-2 gap-4 mb-8 text-center border-t border-b border-slate-200 py-6">
            <div class="px-4">
                <div id="quizDuration" class="text-3xl font-bold text-slate-900">{{ $quiz->duration ?? '0' }}</div>
                <div class="text-sm text-slate-500">Menit Pengerjaan</div>
            </div>
            <div class="border-l border-slate-200 px-4">
                <div id="quizQuestions" class="text-3xl font-bold text-slate-900">{{ $quiz->questions()->count() ?? '0' }}</div>
                <div class="text-sm text-slate-500">Jumlah Soal</div>
            </div>
        </div>

        {{-- Reminder --}}
        <div class="p-4 rounded-lg bg-amber-50 border border-amber-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-amber-500 mt-0.5 mr-3"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-amber-800">Harap Diperhatikan</h4>
                    <ul class="mt-2 space-y-1 text-sm list-disc list-inside text-amber-700">
                        <li>Pastikan koneksi internet Anda stabil.</li>
                        <li>Jangan menutup atau me-refresh halaman ini.</li>
                        <li>Halaman akan beralih ke soal secara otomatis.</li>
                        <li>Siapkan diri dan tetap fokus!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- SCRIPT TETAP SAMA KARENA SEMUA ID ELEMENT TIDAK DIUBAH --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startTime = new Date("{{ \Carbon\Carbon::parse($quiz->start_time)->format('Y-m-d H:i:s') }}").getTime();
        const now = new Date().getTime();
        let timeLeft = Math.floor((startTime - now) / 1000);

        if (timeLeft <= 0) {
            window.location.href = "{{ route('student.quiz.show', $quiz->id) }}";
            return;
        }

        const countdownElement = document.getElementById('countdown');
        const progressBar = document.getElementById('progressBar');
        const progressPercent = document.getElementById('progressPercent');
        const totalWait = timeLeft;

        const waitingTimer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(waitingTimer);
                countdownElement.textContent = '00:00';
                progressBar.style.width = '100%';
                progressPercent.textContent = '100%';
                // Tambahkan sedikit jeda sebelum redirect untuk efek visual
                setTimeout(() => {
                    window.location.href = "{{ route('student.quiz.show', $quiz->id) }}";
                }, 500);
                return;
            }

            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            const progress = ((totalWait - timeLeft) / totalWait) * 100;
            progressBar.style.width = progress + '%';
            progressPercent.textContent = Math.round(progress) + '%';

            timeLeft--;
        }, 1000);
    });
</script>
@endpush
