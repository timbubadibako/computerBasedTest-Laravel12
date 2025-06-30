<div id="token-view" class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
        <div class="mb-6 text-center">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
                <i data-lucide="book-open" class="w-8 h-8 text-blue-600"></i>
            </div>
            <h2 class="text-2xl font-bold">Masukkan Token Quiz</h2>
            <p class="text-gray-600">Gunakan token yang diberikan oleh pengajar</p>
        </div>
        <form method="POST" action="{{ route('quiz.verify') }}" class="space-y-4" id="tokenForm">
            @csrf
            <div>
                <label for="tokenInput" class="block mb-1 text-sm font-medium text-gray-700">Token Quiz</label>
                <input type="text" id="tokenInput" name="token" required
                       class="w-full px-3 py-2 font-mono text-lg text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: MATH123">
            </div>
            <div class="flex space-x-2">
                <button type="button" onclick="showDashboard()" class="flex-1 py-3 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50">
                    Kembali
                </button>
                <button type="submit" class="flex-1 py-3 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                    Lanjutkan
                </button>
            </div>
        </form>
    </div>
</div>
