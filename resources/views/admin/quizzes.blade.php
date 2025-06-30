<x-app-layout>
    <x-banner />

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Quiz</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalQuiz ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Students</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $activeStudents ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <i data-lucide="clock" class="w-6 h-6 text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Waiting Room</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $waitingStudents ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <i data-lucide="activity" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Completed</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $completedStudents ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow">
            <x-header-tab :quiz="$quiz" />
            <div class="p-6 max-h-[600px] overflow-y-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Preview Soal</h2>
                @foreach($quiz->questions as $question)
                    <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="text-lg font-medium text-gray-800 mb-2">
                            {{ $loop->iteration }}. {{ $question->question }}
                        </div>
                        <ul class="grid gap-2 pl-4 list-none text-gray-700">
                            <li><span class="font-semibold">A.</span> {{ $question->option_a }}</li>
                            <li><span class="font-semibold">B.</span> {{ $question->option_b }}</li>
                            <li><span class="font-semibold">C.</span> {{ $question->option_c }}</li>
                            <li><span class="font-semibold">D.</span> {{ $question->option_d }}</li>
                        </ul>
                        <div class="mt-3 text-sm text-green-600 font-semibold">
                            Jawaban Benar: {{ $question->correct_answer }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-6 py-4 border-t bg-gray-50 text-right flex justify-between items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
