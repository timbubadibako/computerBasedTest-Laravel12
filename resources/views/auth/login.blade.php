@extends('layouts.plain')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-50 to-white">

    {{-- Judul Halaman --}}

    {{-- Konten Utama --}}
    <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">

        <div class="relative w-full md:w-[60%] lg:w-[450px]">
             <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop"
                 alt="Gambar ilustrasi ujian"
                 class="object-cover w-full h-full rounded-l-2xl" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent rounded-l-2xl"></div>
            <div class="absolute bottom-0 p-8 text-white">
                <h2 class="text-4xl font-extrabold">Ini Ujian</h2>
                <p class="mt-2 text-lg leading-relaxed text-indigo-100/80">"Evaluasi Cerdas, Generasi Berkualitas."</p>
            </div>
        </div>

        <div class="flex flex-col justify-center p-8 md:p-14 w-full md:w-[40%] lg:w-[480px]">
            <div class="text-center md:text-left">
                <div class="flex items-center justify-center mb-5 md:justify-start">
                    <div class="flex items-center justify-center w-12 h-12 mr-4 text-indigo-600 bg-indigo-50 rounded-full">
                        <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Student Sign In</h2>
                </div>
                <p class="mb-8 text-base text-slate-600">
                    Selamat datang! Silakan masuk untuk memulai ujian.
                </p>
            </div>

            <x-validation-errors2 class="mb-4" />

            <form method="post" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="role" value="student">

                <div>
                    <label for="nim" class="block mb-2 text-sm font-medium text-slate-700">{{ __('NIM (Nomor Induk Mahasiswa)') }}</label>
                    <input id="nim"
                           type="text"
                           name="email" {{-- Nama tetap 'email' agar controller tidak perlu diubah --}}
                           value="{{ old('email') }}"
                           placeholder="Masukkan Nomor Induk Mahasiswa Anda"
                           required autofocus
                           class="w-full px-4 py-3 border rounded-lg bg-slate-50 border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-slate-700">{{ __('Password') }}</label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Masukkan password Anda"
                           class="w-full px-4 py-3 border rounded-lg bg-slate-50 border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="remember_me" class="ml-2 text-sm text-slate-600">{{ __('Ingat saya') }}</label>
                </div>

                <button type="submit" class="w-full py-3 font-semibold text-white transition-transform duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 active:scale-95">
                    Sign In
                </button>

                <div class="text-center">
                    <a href="{{ route('welcome') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                        &larr; Kembali ke halaman utama
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
