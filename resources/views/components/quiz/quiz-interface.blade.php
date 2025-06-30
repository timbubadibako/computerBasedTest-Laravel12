<div id="quiz-view" class="hidden max-w-5xl px-4 py-8 mx-auto">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Soal dan Jawaban --}}
        <div class="p-6 bg-white rounded-lg shadow-lg lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 id="questionTitle" class="text-xl font-semibold text-gray-900">Soal 1</h2>
                <div id="quizTimer" class="px-3 py-1 font-mono text-blue-700 bg-blue-100 rounded-lg">
                    <i data-lucide="clock" class="inline w-4 h-4 mr-1"></i>00:00
                </div>
            </div>

            <div id="questionText" class="mb-6 text-lg text-gray-800">
                Pertanyaan akan muncul di sini
            </div>

            <div id="answerOptions" class="space-y-3">
                {{-- Opsi jawaban akan di-generate via JS --}}
            </div>

            <div class="flex justify-between mt-6">
                <button id="prevBtn" onclick="previousQuestion()" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Sebelumnya</button>
                <button id="nextBtn" onclick="nextQuestion()" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Selanjutnya</button>
                <button id="submitBtn" onclick="submitQuiz()" class="hidden px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Kirim Jawaban</button>
            </div>
        </div>

        {{-- Navigasi Soal --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="mb-3 text-lg font-semibold">Navigasi Soal</h3>
            <div id="questionNav" class="grid grid-cols-5 gap-2 mb-4">
                {{-- Tombol navigasi akan diisi dengan JS --}}
            </div>
            <p class="text-sm text-gray-600">Terjawab: <span id="answeredCount">0</span></p>
            <div class="mt-4">
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div id="quizProgress" class="w-0 h-2 transition-all duration-300 bg-blue-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
