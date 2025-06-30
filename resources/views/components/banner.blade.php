@if (session('banner'))
    @php
        $style = session('bannerStyle', 'success');
        $message = session('banner');
    @endphp

    <div
    x-data="{ show: true, style: '{{ $style }}', message: '{{ $message }}' }"
    x-show="show && message"
    x-init="setTimeout(() => show = false, 5000)"
    x-transition
    class="fixed z-50 w-full max-w-xs rounded-lg shadow-sm top-4 right-4"
    :class="{
        'bg-green-100 text-green-800': style === 'success',
        'bg-red-100 text-red-800': style === 'error' || style === 'danger',
        'bg-yellow-100 text-yellow-800': style === 'warning',
        'bg-blue-100 text-blue-800': !['success', 'error', 'danger', 'warning'].includes(style)
    }"
>
    <div class="flex items-center justify-between p-4">
        <!-- Ikon -->
        <div class="flex items-center">
            <span class="p-2 rounded-full"
                :class="{
                    'bg-green-500': style === 'success',
                    'bg-red-500': style === 'error' || style === 'danger',
                    'bg-yellow-500': style === 'warning',
                    'bg-blue-500': !['success', 'error', 'danger', 'warning'].includes(style)
                }">
                <!-- Lucide Icons -->
                <i data-lucide="circle-check-big" x-show="style === 'success'" class="w-6 h-6 text-white"></i>
                <i data-lucide="circle-x" x-show="style === 'error' || style === 'danger'" class="w-6 h-6 text-white"></i>
                <i data-lucide="alert-triangle" x-show="style === 'warning'" class="w-6 h-6 text-white"></i>
                <i data-lucide="info" x-show="!['success','error','danger','warning'].includes(style)" class="w-6 h-6 text-white"></i>
            </span>

            <!-- Pesan -->
            <p class="ml-3 text-sm font-medium" x-text="message"></p>
        </div>

        <!-- Tombol Tutup -->
        <button @click="show = false"
            class="ml-4 text-xl font-bold text-gray-700 transition hover:text-gray-900">
            &times;
        </button>
    </div>
    </div>
@endif
