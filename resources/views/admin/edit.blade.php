<x-app-layout>
    <x-banner />

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow">
                <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 border-b border-blue-600">
                        <h1 class="text-2xl font-bold text-blue-700 mb-4">Edit Header Quiz</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Judul Quiz</label>
                                <input type="text" name="title" value="{{ $quiz->title }}" class="w-full mt-1 border-gray-300 rounded px-3 py-2 focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Token</label>
                                <div class="flex gap-2">
                                    <input type="text" name="token" id="token" value="{{ $quiz->token }}" class="w-full mt-1 border-gray-300 rounded px-3 py-2 focus:ring-blue-200">
                                    <button type="button" onclick="generateToken()"
                                            class="px-4 py-2 transition-colors border border-blue-600 rounded-lg hover:bg-gray-50">
                                        <i data-lucide="refresh-cw" class="w-5 h-5 text-blue-600"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Durasi (menit)</label>
                                <input type="number" name="duration" value="{{ $quiz->duration }}" class="w-full mt-1 border-gray-300 rounded px-3 py-2 focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Waktu Mulai</label>
                                <input type="datetime-local" name="start_time" value="{{ \Carbon\Carbon::parse($quiz->start_time)->format('Y-m-d\TH:i') }}" class="w-full mt-1 border-gray-300 rounded px-3 py-2 focus:ring-blue-200">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 max-h-[600px] overflow-y-auto">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Soal</h2>
                        @foreach($quiz->questions as $question)
                            <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded shadow-sm">
                                <input type="hidden" name="questions[{{ $question->id }}][id]" value="{{ $question->id }}">
                                <label class="block font-medium text-gray-700">Pertanyaan:</label>
                                <input type="text" name="questions[{{ $question->id }}][question]" value="{{ $question->question }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1 mb-3 focus:ring focus:ring-blue-200 focus:outline-none">

                                {{-- Opsi --}}
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach(['a','b','c','d'] as $opt)
                                        <div>
                                            <label class="text-sm font-semibold text-gray-600">Opsi {{ strtoupper($opt) }}</label>
                                            <input type="text" name="questions[{{ $question->id }}][option_{{ $opt }}]" value="{{ $question->{'option_'.$opt} }}" class="w-full mt-1 border rounded px-2 py-1">
                                        </div>
                                    @endforeach
                                    <div class="col-span-2">
                                        <label class="text-sm font-semibold text-gray-600">Jawaban Benar (A/B/C/D)</label>
                                        <input type="text" name="questions[{{ $question->id }}][correct_answer]" value="{{ $question->correct_answer }}" class="w-full mt-1 border rounded px-2 py-1">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                <div class="px-6 py-4 border-t bg-gray-50 text-right flex justify-between items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 transition">
                        ← Kembali ke Beranda
                    </a>

                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                        Simpan Semua Perubahan
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function generateToken() {
            const token = Math.random().toString(36).substring(2, 8).toUpperCase();
            document.getElementById('token').value = token;
        }
    </script>
</x-app-layout>
