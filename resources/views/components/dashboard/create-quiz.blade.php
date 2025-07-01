{{-- resources/views/components/dashboard/create-quiz.blade.php --}}
<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    {{-- Form Create Quiz --}}
    <div class="p-6 bg-white border rounded-lg">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
            <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
            Buat Quiz Baru
        </h3>
        <form id="createQuizForm" action="{{ route('admin.quizzes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Quiz</label>
                <input type="text" id="title" name="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Masukkan judul quiz">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="token" class="block mb-1 text-sm font-medium text-gray-700">Token</label>
                    <div class="flex space-x-2">
                        <input type="text" id="token" name="token" required
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="TOKEN123">
                        <button type="button" onclick="generateToken()"
                                class="px-4 py-2 transition-colors border border-blue-600 rounded-lg hover:bg-gray-50">
                            <i data-lucide="refresh-cw" class="w-5 h-5 text-blue-600"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="duration" class="block mb-1 text-sm font-medium text-gray-700">Durasi (menit)</label>
                    <input type="number" id="duration" name="duration" value="60" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label for="start_time" class="block mb-1 text-sm font-medium text-gray-700">Waktu Mulai</label>
                <select id="start_time" name="start_time" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="{{ now()->addMinutes(5)->format('Y-m-d H:i') }}">5 menit dari sekarang ({{ now()->addMinutes(5)->format('H:i') }})</option>
                    <option value="{{ now()->addMinutes(10)->format('Y-m-d H:i') }}">10 menit dari sekarang ({{ now()->addMinutes(10)->format('H:i') }})</option>
                    <option value="{{ now()->addMinutes(30)->format('Y-m-d H:i') }}">30 menit dari sekarang ({{ now()->addMinutes(30)->format('H:i') }})</option>
                </select>
            </div>

            <div>
                <label for="csv" class="block mb-1 text-sm font-medium text-gray-700">Upload Soal (CSV)</label>
                <div class="mt-2">
                    <input type="file" id="csv" name="csv" accept=".csv"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">
                        Format: no,pertanyaan,opsi_a,opsi_b,opsi_c,opsi_d,jawaban_benar
                    </p>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 font-semibold text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                <i data-lucide="plus" class="inline w-4 h-4 mr-2"></i>
                Buat Quiz
            </button>
        </form>
    </div>

    {{-- Preview Format CSV --}}
    <div class="p-6 bg-white border rounded-lg">
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Preview Format CSV</h3>
        <div class="p-4 font-mono text-sm rounded-lg bg-gray-50">
            <div class="mb-2 text-gray-600">Contoh format file CSV:</div>
            <div class="space-y-1 text-xs">
                <div>no,pertanyaan,opsi_a,opsi_b,opsi_c,opsi_d,jawaban</div>
                <div>1,"Berapa 2+2?","3","4","5","6","B"</div>
                <div>2,"Ibu kota Indonesia?","Jakarta","Bandung","Surabaya","Medan","A"</div>
            </div>
        </div>
        <div class="mt-4 space-y-2 text-sm">
            <div class="flex items-center text-green-600">
                <span class="w-2 h-2 mr-2 bg-green-400 rounded-full"></span>
                Gunakan tanda kutip untuk teks
            </div>
            <div class="flex items-center text-blue-600">
                <span class="w-2 h-2 mr-2 bg-blue-400 rounded-full"></span>
                Jawaban: A, B, C, atau D
            </div>
            <div class="flex items-center text-purple-600">
                <span class="w-2 h-2 mr-2 bg-purple-400 rounded-full"></span>
                Maksimal 100 soal per quiz
            </div>
        </div>
        {{-- Preview Soal yang Diunggah --}}
        <div class="mt-6">
            <h3 class="mb-2 font-semibold text-gray-800 text-md">Preview Soal</h3>
            <div id="preview-container" class="p-4 space-y-2 overflow-y-auto text-sm bg-gray-100 border border-gray-300 rounded-lg max-h-40">
                <p class="text-gray-500">Belum ada file yang diunggah...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function generateToken() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let token = '';
        for (let i = 0; i < 6; i++) {
            token += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('token').value = token;
    }
</script>
