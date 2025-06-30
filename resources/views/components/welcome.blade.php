    <!-- Stats Cards (container sendiri) -->


    <!-- Recent Activity (container sendiri) -->
    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>

        <div class="mt-4">
            {{-- @foreach ($activities as $activity) --}}
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full">
                            <i data-lucide="user" class="w-5 h-5 text-gray-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">0</p>
                            <p class="text-xs text-gray-500">0</p>
                        </div>
                    </div>
                    <div>
                        {{-- @if ($activity->type == 'quiz_completed') --}}
                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                Quiz Completed
                            </span>
                        {{-- @elseif ($activity->type == 'student_joined') --}}
                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                Student Joined
                            </span>
                        {{-- @endif --}}
                    </div>
                </div>
            {{-- @endforeach --}}
        </div>
    </div>
