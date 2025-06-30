<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-banner />

    <div class="py-6">
        <x-dashboard-card /> <!-- 4 card statistik, container sendiri -->
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <x-dashboard-card
                :total-active-quizzes="$totalActiveQuizzes"
                :total-students="$totalStudents"
                :waiting-room-count="$waitingRoomCount"
                :completed-count="$completedCount"
                /> <!-- 4 card statistik, container sendiri -->
                <x-welcome /> <!-- Recent Activity, container sendiri -->
            </div>
        </div>
    </div>
</x-app-layout>
