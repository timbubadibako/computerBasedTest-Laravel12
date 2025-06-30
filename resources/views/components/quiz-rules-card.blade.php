{{-- File: resources/views/components/quiz-rules-card.blade.php --}}

<div class="p-6 bg-white border-t-4 border-red-600 rounded-b-lg rounded-t-sm shadow-lg">
    <div class="flex items-center mb-5">
        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-4 text-red-600 bg-red-100 rounded-full">
            <i data-lucide="shield-alert" class="w-7 h-7"></i>
        </div>
        <div>
            <h3 class="text-xl font-bold text-slate-900">Tata Tertib & Larangan Ujian</h3>
            <p class="text-sm text-slate-500">Harap patuhi semua peraturan untuk kelancaran ujian.</p>
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-start">
            <i data-lucide="x-circle" class="w-5 h-5 mt-1 mr-3 text-red-500 flex-shrink-0"></i>
            <div>
                <h4 class="font-semibold text-slate-800">Dilarang Keluar Halaman</h4>
                <p class="text-sm text-slate-600">Meninggalkan halaman ujian (menutup tab, refresh, atau klik tombol kembali) sebelum menyelesaikan ujian dapat dianggap sebagai pelanggaran.</p>
            </div>
        </div>

        <div class="flex items-start">
            <i data-lucide="x-circle" class="w-5 h-5 mt-1 mr-3 text-red-500 flex-shrink-0"></i>
            <div>
                <h4 class="font-semibold text-slate-800">Dilarang Membuka Aplikasi Lain</h4>
                <p class="text-sm text-slate-600">Fokus pada pengerjaan ujian. Membuka tab baru atau aplikasi lain dapat terdeteksi oleh sistem pengawas.</p>
            </div>
        </div>

        <div class="flex items-start">
            <i data-lucide="x-circle" class="w-5 h-5 mt-1 mr-3 text-red-500 flex-shrink-0"></i>
            <div>
                <h4 class="font-semibold text-slate-800">Dilarang Bekerja Sama</h4>
                <p class="text-sm text-slate-600">Segala bentuk kerja sama, diskusi, atau mencontek akan mengakibatkan sesi ujian Anda dihentikan dan dianulir.</p>
            </div>
        </div>

        <div class="pt-3 mt-4 text-xs text-center text-red-700 border-t border-red-200">
            <strong>Peringatan:</strong> Pelanggaran terhadap tata tertib di atas dapat mengakibatkan diskualifikasi.
        </div>
    </div>
</div>
