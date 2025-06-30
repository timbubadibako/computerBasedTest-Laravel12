<div class="p-6 border-b border-blue-600">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Detail Quiz: {{ $quiz->title }}</h1>
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-700">
            <div>
                <span class="font-medium">Token:</span>
                <span class="inline-block px-2 py-1 text-blue-700 bg-blue-100 rounded-full font-mono">
                    {{ $quiz->token }}
                </span>
            </div>
            <div>
                <span class="font-medium">Durasi:</span>
                <span class="inline-block px-2 py-1 text-green-700 bg-green-100 rounded-full font-mono">
                    {{ $quiz->duration }} menit
                </span>
            </div>
        <div>
            <span class="font-medium">Waktu Mulai:</span>
            <span class="inline-block px-2 py-1 text-gray-700 bg-yellow-100 rounded-full font-mono">
                {{ \Carbon\Carbon::parse($quiz->start_time)->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>
</div>
