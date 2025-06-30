@extends('layouts.plain')

@push('styles')
{{-- CSS Kustom untuk Animasi Goyang --}}
<style>
    @keyframes sway {
        0%, 100% {
            transform: rotate(-3deg);
        }
        50% {
            transform: rotate(3deg);
        }
    }
    .sway-animation {
        animation: sway 4s ease-in-out infinite;
    }
</style>
@endpush

@section('content')
<div class="w-full bg-white text-slate-800">

    <div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-20 text-center overflow-hidden">
        {{-- Subtle background grid pattern --}}
        <div class="absolute inset-0 z-0 opacity-40" style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%239C92AC%22 fill-opacity=%220.1%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

         <div class="relative z-10">
            {{-- TERAPKAN ANIMASI DI SINI --}}
            <div class="inline-flex items-center justify-center w-24 h-24 mx-auto mb-8 bg-white rounded-full shadow-xl sway-animation">
                <i data-lucide="book-marked" class="w-14 h-14 text-indigo-600"></i>
            </div>


            <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 sm:text-6xl md:text-7xl">
                Ini Ujian
            </h1>

            {{-- SLOGAN BARU --}}
            <p class="max-w-xl mx-auto mt-5 text-2xl font-medium text-indigo-700 md:text-3xl">
                Evaluasi Cerdas, Generasi Berkualitas.
            </p>

            {{-- COPYWRITING BARU --}}
            <p class="max-w-3xl mx-auto mt-6 text-lg leading-8 text-slate-600">
                Selamat datang di standar baru penilaian digital Indonesia. **Ini Ujian** memberdayakan para pendidik dengan platform yang aman, intuitif, dan fokus pada kemajuan siswa.
            </p>

            <div class="grid w-full max-w-3xl gap-6 mx-auto mt-16 md:grid-cols-2">
                {{-- Kartu Admin --}}
                <a href="{{ route('login') }}" class="group block p-8 text-center transition-all duration-300 bg-white border border-slate-200 rounded-xl shadow-lg hover:shadow-indigo-100 hover:border-indigo-300 hover:-translate-y-2">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 bg-indigo-100 rounded-full transition-all duration-300 group-hover:scale-110">
                        <i data-lucide="shield-check" class="w-9 h-9 text-indigo-600"></i>
                    </div>
                    <h2 class="mb-3 text-xl font-bold text-slate-900">Untuk Guru & Administrator</h2>
                    <p class="text-slate-600 text-base">Rancang ujian, pantau secara langsung, dan dapatkan analitik mendalam untuk mengukur keberhasilan.</p>
                </a>

                {{-- Kartu Student --}}
                <a href="{{ route('login') }}" class="group block p-8 text-center transition-all duration-300 bg-white border border-slate-200 rounded-xl shadow-lg hover:shadow-indigo-100 hover:border-indigo-300 hover:-translate-y-2">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 bg-indigo-100 rounded-full transition-all duration-300 group-hover:scale-110">
                        <i data-lucide="graduation-cap" class="w-9 h-9 text-indigo-600"></i>
                    </div>
                    <h2 class="mb-3 text-xl font-bold text-slate-900">Untuk Siswa & Peserta Ujian</h2>
                    <p class="text-slate-600 text-base">Ikuti ujian dengan antarmuka yang modern, bebas gangguan, dan lihat hasil Anda secara instan.</p>
                </a>
            </div>
        </div>
    </div>

    <div class="py-24 bg-slate-50">
        <div class="max-w-6xl px-4 mx-auto">
            <div class="text-center">
                <h3 class="text-lg font-semibold tracking-wider uppercase text-indigo-600">Melahirkan Kepercayaan, Mendorong Kemajuan</h3>
                <p class="mt-3 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Digunakan oleh Ratusan Institusi Pendidikan</p>
            </div>
            <div class="grid grid-cols-1 gap-8 mt-16 text-center md:grid-cols-3">
                <div class="p-8 bg-white border rounded-lg border-slate-200">
                    <i data-lucide="school" class="w-12 h-12 mx-auto mb-5 text-indigo-500"></i>
                    <p class="text-5xl font-extrabold text-slate-900">150+</p>
                    <p class="mt-2 text-lg font-medium text-slate-500">Sekolah & Kampus Mitra</p>
                </div>
                <div class="p-8 bg-white border rounded-lg border-slate-200">
                    <i data-lucide="users" class="w-12 h-12 mx-auto mb-5 text-sky-500"></i>
                    <p class="text-5xl font-extrabold text-slate-900">50.000+</p>
                    <p class="mt-2 text-lg font-medium text-slate-500">Siswa Aktif</p>
                </div>
                <div class="p-8 bg-white border rounded-lg border-slate-200">
                    <i data-lucide="file-check-2" class="w-12 h-12 mx-auto mb-5 text-violet-500"></i>
                    <p class="text-5xl font-extrabold text-slate-900">1 Juta+</p>
                    <p class="mt-2 text-lg font-medium text-slate-500">Sesi Ujian Berhasil</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-24 bg-white">
        <div class="max-w-6xl px-4 mx-auto">
            <div class="text-center">
                <h3 class="text-lg font-semibold tracking-wider uppercase text-indigo-600">Solusi Komprehensif</h3>
                <p class="mt-3 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Dirancang untuk Ekosistem Pendidikan Modern</p>
            </div>
            <div class="grid grid-cols-1 gap-x-8 gap-y-12 mt-20 md:grid-cols-2 lg:grid-cols-3">

                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="lock" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Keamanan Berlapis</h4>
                        <p class="mt-2 text-base text-slate-600">Dengan proctoring, token dinamis, dan enkripsi data, kami menjaga integritas setiap sesi ujian.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="bar-chart-3" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Laporan & Analitik Cerdas</h4>
                        <p class="mt-2 text-base text-slate-600">Bukan sekadar skor. Pahami pola jawaban siswa dan kualitas butir soal untuk keputusan yang lebih baik.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="zap" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Efisiensi Maksimal</h4>
                        <p class="mt-2 text-base text-slate-600">Otomatiskan koreksi dan administrasi. Alihkan fokus Anda dari kertas kerja ke pengembangan siswa.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="cloud" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Infrastruktur Cloud Handal</h4>
                        <p class="mt-2 text-base text-slate-600">Akses kapan saja, di mana saja. Tanpa perlu server fisik, update otomatis, dan skalabilitas terjamin.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="type" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Bank Soal Fleksibel</h4>
                        <p class="mt-2 text-base text-slate-600">Mendukung beragam tipe soal (AKM), import massal, dan kategorisasi untuk kemudahan manajemen.</p>
                    </div>
                </div>

                 <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 text-indigo-600 bg-indigo-50 rounded-lg">
                        <i data-lucide="layout-template" class="w-7 h-7"></i>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold">Antarmuka Bebas Gangguan</h4>
                        <p class="mt-2 text-base text-slate-600">Desain minimalis dan intuitif yang membantu siswa fokus penuh pada pengerjaan soal ujian.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="py-16 bg-slate-900 text-slate-400">
        <div class="max-w-6xl px-4 mx-auto text-center">
            <p>&copy; {{ date('Y') }} Ini Ujian. Sebuah Langkah Maju untuk Penilaian Pendidikan Indonesia.</p>
        </div>
    </footer>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection
