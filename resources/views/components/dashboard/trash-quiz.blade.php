{{-- @if ($trashedQuizzes->count()) --}}
<div class="mt-0">
        <table class="min-w-full bg-white divide-y divide-gray-200">
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
            <tbody class="divide-y divide-gray-200">
                @forelse ($trashedQuizzes as $quiz)
                <tr>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $quiz->title ?? 0 }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        {{ $quiz->token ??0}}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz->duration ?? 0}} menit</td>
                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($quiz->start_time ?? 0)->format('d/m/Y H:i') }}
                </td>
                {{-- <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz['participants'] }}</td> --}}
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-2">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer"
                                   {{ $quiz->token ?? 0 }}
                                   {{-- 'checked' : '' --}}
                                   onchange="toggleQuizStatus({{ $quiz->id ?? 0}}, this.checked)" disabled>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                    <div class="flex space-x-2">
                        {{-- Preview --}}
                        <a href="{{ route('admin.quizzes.show', $quiz->id) }}"
                        class="text-green-600 hover:text-green-900"
                        title="Lihat Quiz">
                            <i data-lucide="gallery-thumbnails" class="w-5 h-5"></i>
                        </a>

                        {{-- Restore --}}
                        <form action="{{ route('admin.quizzes.restore', $quiz->id ?? 0) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Yakin ingin memulihkan quiz ini?')">
                            @csrf
                            <button type="submit"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="Pulihkan">
                                <i data-lucide="archive-restore" class="w-5 h-5"></i>
                            </button>
                        </form>

                        {{-- Permanently Delete --}}
                        <form action="{{ route('admin.quizzes.forceDelete', $quiz->id ?? 0) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800"
                                    title="Hapus Permanen">
                                <i data-lucide="file-x" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Tidak ada quiz di trash.</td>
                </tr>
                @endforelse
                {{-- <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz->title ?? 0}}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $quiz->token ?? 0}}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">


                        </td>
                    </tr> --}}
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
{{-- @endif --}}
