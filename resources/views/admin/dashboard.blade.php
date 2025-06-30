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
                            <p class="text-2xl font-bold text-gray-900">{{ $totalActiveQuizzes }}</p>
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

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-blue-600">
                    <nav class="flex px-6 -mb-px space-x-8">
                        <a href="#" onclick="showTab('dashboard')" class="px-1 py-4 text-sm font-medium text-blue-600 border-b-2 border-blue-500 tab-btn active">
                            Dashboard
                        </a>
                        <a href="#create" onclick="showTab('create')" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent tab-btn hover:text-gray-700 hover:border-gray-300">
                            Buat Quiz
                        </a>
                        <a href="#trash" onclick="showTab('trash')" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent tab-btn hover:text-gray-700 hover:border-gray-300">
                            Trash
                        </a>
                        <a href="#monitor" onclick="showTab('monitor')" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent tab-btn hover:text-gray-700 hover:border-gray-300">
                            Monitor
                        </a>
                        <a href="#reports" onclick="showTab('reports')" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent tab-btn hover:text-gray-700 hover:border-gray-300">
                            Laporan
                        </a>
                    </nav>
                </div>

                <div id="dashboard-tab" class="p-6 tab-content">
                    <x-dashboard.quiz-table :quizzes="$quizzes" />
                </div>
                <div id="create-tab" class="hidden p-6 tab-content">
                    <x-dashboard.create-quiz />
                </div>
                <div id="monitor-tab" class="hidden p-6 tab-content">
                    {{-- <x-dashboard-monitor :students="$students ?? []" :quizzes="$quizzes ?? []" /> --}}
                    <div class="text-gray-500">[Monitoring Placeholder]</div>
                </div>
                <div id="reports-tab" class="hidden p-6 tab-content">
                    {{-- <x-dashboard-reports :students="$students ?? []" :quizzes="$quizzes ?? []" /> --}}
                    <div class="text-gray-500">[Laporan Placeholder]</div>
                </div>
                <div id="trash-tab" class="hidden p-6 tab-content">
                    <x-dashboard.trash-quiz :trashedQuizzes="$trashedQuizzes" />
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-800 bg-red-100 rounded">
            <ul class="ml-4 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('text-gray-500', 'border-transparent');
            });
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            event.currentTarget.classList.add('active', 'border-blue-500', 'text-blue-600');
        }
    </script>
</x-app-layout>
