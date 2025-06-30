<x-app-layout>
    <x-banner />

    <div class="py-6 bg-gray-50" >
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow">
                {{-- HEADER QUIZ --}}
                <div class="p-6 border-b border-blue-600">
                    <h1 class="text-2xl font-bold text-blue-700 mb-4">Hasil Quiz</h1>
                    <p class="text-gray-600">Berikut adalah hasil dari quiz yang telah Anda kerjakan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="results-view" class="min-h-screen bg-gray-50 py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-xl w-full">

                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-t-lg p-8 text-center">
                    <div class="mx-auto w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="trophy" class="h-10 w-10 text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-2">Quiz Selesai!</h2>
                    <p id="resultsQuizTitle" class="text-green-100">{{ $quizTitle }}</p>
                </div>

                {{-- CONTENT --}}
                <div class="p-8 grid grid-cols-[2fr_1fr] gap-8">
                    {{-- LEFT: SCORE + STATS --}}
                    <div class="space-y-8">
                        <div class="text-center">
                            <div id="finalScore" class="text-6xl font-bold text-green-600 mb-4">{{ $score }}</div>
                            <p class="text-xl text-gray-600">Skor Anda</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <div id="correctAnswers" class="text-2xl font-bold text-green-600">{{ $correct }}</div>
                                <div class="text-sm text-gray-600">Jawaban Benar</div>
                            </div>
                            <div class="text-center p-4 bg-red-50 rounded-lg">
                                <div id="wrongAnswers" class="text-2xl font-bold text-red-600">{{ $wrong }}</div>
                                <div class="text-sm text-gray-600">Jawaban Salah</div>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <div id="totalQuestionsResult" class="text-2xl font-bold text-blue-600">{{ $total }}</div>
                                <div class="text-sm text-gray-600">Total Soal</div>
                            </div>
                        </div>

                        {{-- MOTIVATION CARD --}}
                        <div class="p-6 bg-yellow-50 border-l-4 border-yellow-400 rounded shadow">
                            <div class="flex items-center">
                                <i data-lucide="smile" class="w-6 h-6 text-yellow-600 mr-3"></i>
                                <div>
                                    <p class="font-semibold text-yellow-700">Terima kasih sudah mengerjakan dengan jujur 🎉</p>
                                    <p class="text-sm text-yellow-800 mt-1">Tetap semangat belajar! Quiz berikutnya menanti kamu 💪</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-blue-50 border-l-4 border-blue-400 rounded shadow">
                            <div class="flex items-center">
                                <i data-lucide="book-open-check" class="w-6 h-6 text-blue-600 mr-3"></i>
                                <div>
                                    <p class="font-semibold text-blue-700">Setiap soal adalah latihan untuk hari esok 📘</p>
                                    <p class="text-sm text-blue-800 mt-1">Jangan berhenti di sini. Belajar hari ini adalah investasi masa depanmu.</p>
                                </div>
                            </div>
                        </div>


                        {{-- BUTTON --}}
                        <div class="flex space-x-4 pt-4">
                            <a href="{{ route('student.dashboard') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition-colors text-center">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>

                    {{-- RIGHT: REVIEW ANSWERS --}}
                    <div class="space-y-4 max-h-[430px] overflow-y-auto pr-1">
                        <h3 class="text-lg font-bold text-gray-900">Review Jawaban</h3>
                        @foreach($review as $item)
                            <div class="p-3 border rounded {{ $item['is_correct'] ? 'bg-green-50' : 'bg-red-50' }}">
                                <div class="font-medium mb-1">{{ $loop->iteration }}. {{ $item['question'] }}</div>
                                <div class="mb-1">
                                    @foreach($item['options'] as $key => $val)
                                        <span class="inline-block mr-2 px-2 py-1 rounded {{ $item['selected'] == $key ? ($item['is_correct'] ? 'bg-green-200' : 'bg-red-200') : 'bg-gray-100' }}">
                                            <b>{{ $key }}.</b> {{ $val }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="text-sm">
                                    Jawaban Anda: <b>{{ $item['selected'] ?? '-' }}</b> | Kunci Jawaban: <b>{{ $item['correct'] }}</b>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</x-app-layout>
