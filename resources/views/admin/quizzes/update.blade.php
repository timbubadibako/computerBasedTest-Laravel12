{{-- Edit Soal --}}
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Soal</h2>
            @foreach($quiz->questions as $question)
                <div class="mb-6 p-4 bg-gray-50 border border-gray-100 rounded shadow-sm">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="block font-medium text-gray-700">Pertanyaan:</label>
                        <input type="text" name="question" value="{{ $question->question }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1 mb-3 focus:ring focus:ring-blue-200 focus:outline-none">

                        {{-- Opsi dan Jawaban --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Opsi A</label>
                                <input type="text" name="option_a" value="{{ $question->option_a }}" class="w-full mt-1 border rounded px-2 py-1">
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Opsi B</label>
                                <input type="text" name="option_b" value="{{ $question->option_b }}" class="w-full mt-1 border rounded px-2 py-1">
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Opsi C</label>
                                <input type="text" name="option_c" value="{{ $question->option_c }}" class="w-full mt-1 border rounded px-2 py-1">
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600">Opsi D</label>
                                <input type="text" name="option_d" value="{{ $question->option_d }}" class="w-full mt-1 border rounded px-2 py-1">
                            </div>
                            <div class="col-span-2">
                                <label class="text-sm font-semibold text-gray-600">Jawaban Benar</label>
                                <input type="text" name="correct_answer" value="{{ $question->correct_answer }}" class="w-full mt-1 border rounded px-2 py-1">
                            </div>
                        </div>

                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-150">Update</button>
                    </form>
                </div>
            @endforeach
        </div>
