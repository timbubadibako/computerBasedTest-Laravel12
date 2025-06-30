@if ($errors->any())
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 7000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        {{-- Perubahan Warna ada di baris ini --}}
        class="fixed top-5 right-5 w-full max-w-sm bg-red-50 border border-red-400 rounded-xl shadow-lg z-[100]"
        role="alert"
    >
        <div class="flex items-start p-4">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center w-8 h-8 text-red-600 bg-red-100 rounded-full">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
                {{-- Perubahan Warna Teks Judul --}}
                <p class="text-base font-bold text-red-900">{{ __('Whoops! Terjadi Kesalahan') }}</p>
                {{-- Perubahan Warna Teks List Error --}}
                <ul class="mt-2 text-sm list-disc list-inside text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="flex flex-shrink-0 ml-4">
                {{-- Perubahan Warna Tombol Tutup --}}
                <button @click="show = false" class="inline-flex text-red-400 rounded-md hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <span class="sr-only">Tutup</span>
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Script untuk render ikon Lucide jika ditambahkan secara dinamis --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    @endpush
@endif
