<x-app-layout>

    {{-- Main Content --}}
    <div id="dashboard-view" class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Welcome Section --}}
        <div class="mb-8">
            <h2 class="mb-2 text-3xl font-bold text-gray-900">Selamat Datang!</h2>
            <p class="text-lg text-gray-600">Pilih quiz yang tersedia atau masukkan token untuk mengikuti ujian.</p>
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
            <div class="p-6 transition-shadow bg-white rounded-lg shadow cursor-pointer hover:shadow-lg" onclick="showTokenInput()">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i data-lucide="book-open" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Masukkan Token Quiz</h3>
                        <p class="text-gray-600">Gunakan token yang diberikan oleh pengajar</p>
                    </div>
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-auto text-gray-400"></i>
                </div>
            </div>
            <div class="p-6 transition-shadow bg-white rounded-lg shadow cursor-pointer hover:shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i data-lucide="trophy" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Riwayat Hasil</h3>
                        <p class="text-gray-600">Lihat hasil quiz yang telah dikerjakan</p>
                    </div>
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-auto text-gray-400"></i>
                </div>
            </div>
        </div>

        {{-- Available Quizzes --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="flex items-center text-lg font-semibold text-gray-900">
                    <i data-lucide="users" class="w-5 h-5 mr-2"></i>
                    Quiz Tersedia
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {{-- Loop quiz, dummy dulu --}}
                    @foreach ($availableQuizzes ?? [] as $quiz)
                    <div class="p-4 transition-shadow bg-white border rounded-lg shadow hover:shadow-md">
                        <div class="flex items-start justify-between mb-3">
                            <h4 class="font-semibold text-gray-900">{{ $quiz->title }}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $quiz->token }}
                            </span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                <span>{{ $quiz->duration }} menit</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="book-open" class="w-4 h-4 mr-2"></i>
                                <span>{{ $quiz->questions_count }} soal</span>
                            </div>
                        </div>
                        <form action="{{ route('student.quiz.verify') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            <input type="text" name="token" class="w-full px-3 py-2 mb-2 font-mono text-lg text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan token quiz" required>
                            <button type="submit" class="w-full py-2 font-semibold text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                Ikuti Quiz
                            </button>
                        </form>
                    </div>
                    @endforeach
                    {{-- Jika belum ada data, tampilkan dummy --}}
                    @if(empty($availableQuizzes))
                        <div class="text-center text-gray-400 col-span-full">Belum ada quiz tersedia.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
