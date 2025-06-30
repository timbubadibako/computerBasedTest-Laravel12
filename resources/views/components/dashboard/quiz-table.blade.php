<div class="overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Judul Quiz</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Token</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Durasi</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Waktu Mulai</th>
                {{-- <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Peserta</th> --}}
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($quizzes as $quiz)
            <tr>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $quiz->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        {{ $quiz->token }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz->duration }} menit</td>
                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($quiz->start_time)->format('d/m/Y H:i') }}
                </td>
                {{-- <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz['participants'] }}</td> --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-2">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer"
                                   {{ $quiz->token ? 'checked' : '' }}
                                   onchange="toggleQuizStatus({{ $quiz->id }}, this.checked)">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                    <div class="flex space-x-2">
                        {{-- Preview --}}
                        <a href="{{ route('admin.quizzes.show', $quiz->id) }}" class="text-green-600 hover:text-blue-900" title="Lihat Quiz">
                            <i data-lucide="gallery-thumbnails" class="w-5 h-5"></i>
                        </a>
                        {{-- edit --}}
                        <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit Quiz">
                            <i data-lucide="file-pen-line" class="w-5 h-5"></i>
                        </a>

                        {{-- Soft Delete --}}
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Pindahkan ke Trash?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                <i data-lucide="archive" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function toggleQuizStatus(quizId, isChecked) {
        fetch('/admin/quizzes/toggle-token', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({
                quiz_id: quizId,
                status: isChecked ? 'on' : 'off'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Gagal update status');
            }
        });
    }
</script>
