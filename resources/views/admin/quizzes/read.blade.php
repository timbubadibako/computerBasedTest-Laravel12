@foreach ($quizzes as $quiz)
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="font-medium text-gray-900">{{ $quiz['judul'] }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
            {{ $quiz['token'] }}
        </span>
    </td>
    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
        {{ $quiz['durasi'] }} menit
    </td>
    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
        {{ \Carbon\Carbon::parse($quiz['waktu_mulai'])->format('d/m/Y H:i') }}
    </td>
    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
        {{ $quiz['participants'] }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center space-x-2">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer"
                    {{ $quiz['status'] === 'active' ? 'checked' : '' }}
                    onchange="toggleQuizStatus({{ $quiz['id'] }})">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $quiz['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $quiz['status'] === 'active' ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
    </td>
    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
        <div class="flex space-x-2">
            <a href="{{ route('quizzes.show', $quiz['id']) }}" class="text-blue-600 hover:text-blue-900">
                <i data-lucide="eye" class="w-4 h-4"></i>
            </a>
            <a href="{{ route('quizzes.download', $quiz['id']) }}" class="text-green-600 hover:text-green-900">
                <i data-lucide="download" class="w-4 h-4"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
