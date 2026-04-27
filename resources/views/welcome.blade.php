@extends('layouts.app')

@section('content')



{{-- HERO --}}
<section class="flex items-center justify-center" style="min-height: 100vh;">
        <div class="text-center max-w-4xl mx-auto">
        <div class="reveal inline-flex items-center gap-2 border border-gray-200 rounded-full px-4 py-1.5 text-xs font-medium text-gray-600 mb-8">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            Platform Webinar Satpol PP Prov. Jawa Timur
        </div>

        <h1 class="reveal font-bold leading-tight text-gray-900 mb-6 delay-100" style="font-family:'Plus Jakarta Sans',sans-serif;">
            <span id="typingWrapper">
                <span id="rotatingText" class="text-5xl md:text-6xl"></span>
            </span>
            <span class="relative inline-block text-5xl md:text-6xl">
                <span class="relative z-10 italic text-glow" style="color:#2ea043;">di Ruang Praja</span>
                <span class="absolute bottom-1 left-0 w-full h-3 rounded" style="background:rgba(46,160,67,0.15); z-index:0;"></span>
            </span>
        </h1>

        <p class="reveal text-lg text-gray-500 leading-relaxed mb-10 max-w-2xl mx-auto delay-200">
            Ikuti webinar <strong class="text-gray-700">Kejarsiroma</strong> dan <strong class="text-gray-700">Diklat</strong> Satuan Polisi Pamong Praja Provinsi Jawa Timur. Belajar, berkembang, dan raih sertifikat resmi dari mana saja.
        </p>

        <div class="reveal flex flex-wrap gap-4 justify-center delay-300">
            @auth
                <a href="/dashboard" class="btn-primary px-7 py-3.5 rounded-xl font-semibold text-sm">Lihat Dashboard →</a>
            @else
                <a href="/register" class="btn-primary px-7 py-3.5 rounded-xl font-semibold text-sm">Daftar Sekarang →</a>
                <a href="/login" class="btn-outline px-7 py-3.5 rounded-xl font-semibold text-sm">Masuk</a>
            @endauth
        </div>

        <div class="reveal flex flex-wrap gap-8 mt-14 pt-10 border-t border-gray-100 justify-center delay-400">
            <div>
                <div class="text-3xl font-bold text-gray-900" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $webinars->count() }}+</div>
                <div class="text-sm text-gray-400 mt-0.5">Program</div>
            </div>
            <div class="w-px bg-gray-100"></div>
            <div>
                <div class="text-3xl font-bold text-gray-900" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $totalPeserta }}+</div>
                <div class="text-sm text-gray-400 mt-0.5">Peserta Terdaftar</div>
            </div>
            <div class="w-px bg-gray-100"></div>
            <div>
                <div class="text-3xl font-bold text-gray-900" style="font-family:'Plus Jakarta Sans',sans-serif;">100%</div>
                <div class="text-sm text-gray-400 mt-0.5">Bersertifikat Resmi</div>
            </div>
        </div>
    </div>
</section>

{{-- KENAPA RUANG PRAJA --}}
<section class="py-20 border-t border-gray-100 -mx-6 px-6" style="background:#fffff;">
    <div class="max-w-6xl mx-auto">

        <div class="reveal mb-3">
            <span class="text-xs font-semibold uppercase tracking-widest text-green-700">Mengapa Ruang Praja?</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <h2 class="reveal text-3xl md:text-4xl font-bold text-gray-900 leading-tight delay-100" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Satu platform untuk semua kebutuhan pembelajaran
            </h2>
            <p class="reveal text-gray-500 leading-relaxed self-end delay-200">
                Dari webinar mingguan Kejarsiroma hingga Diklat resmi — semua tersedia di Ruang Praja. Daftar, ikuti, dan dapatkan sertifikat setelah selesai acara.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">
            <div class="reveal card-hover border border-gray-100 rounded-2xl p-7 bg-white delay-100">
                <div class="w-11 h-11 rounded-xl border border-gray-100 flex items-center justify-center text-xl mb-5">📹</div>
                <h3 class="font-semibold text-gray-900 mb-2 text-lg">Live via Zoom</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Bergabung langsung dengan narasumber melalui link Zoom yang terintegrasi di platform.</p>
            </div>
            <div class="reveal card-hover border border-gray-100 rounded-2xl p-7 bg-white delay-200">
                <div class="w-11 h-11 rounded-xl border border-gray-100 flex items-center justify-center text-xl mb-5">📄</div>
                <h3 class="font-semibold text-gray-900 mb-2 text-lg">Materi & Dokumentasi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Akses materi dan dokumentasi kegiatan kapan saja, bahkan setelah webinar selesai.</p>
            </div>
            <div class="reveal card-hover border border-gray-100 rounded-2xl p-7 bg-white delay-300">
                <div class="w-11 h-11 rounded-xl border border-gray-100 flex items-center justify-center text-xl mb-5">🏆</div>
                <h3 class="font-semibold text-gray-900 mb-2 text-lg">Sertifikat Resmi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Generate dan download sertifikat kehadiran resmi langsung setelah webinar selesai.</p>
            </div>
        </div>

    </div>
</section>

{{-- PROGRAM --}}
<section class="py-16 border-t border-gray-100">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div class="reveal">
            <span class="text-xs font-semibold uppercase tracking-widest text-green-700">Program</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Program Terbaru
            </h2>
        </div>
        <div class="reveal flex gap-2 flex-wrap delay-100">
            <button onclick="filterWebinar('all')" data-filter="all"
                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium border transition"
                    style="background:#1a4d2e; color:white; border-color:#1a4d2e;">Semua</button>
            <button onclick="filterWebinar('upcoming')" data-filter="upcoming"
                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-200 text-gray-600 hover:border-gray-400 transition">Upcoming</button>
            <button onclick="filterWebinar('live')" data-filter="live"
                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-200 text-gray-600 hover:border-gray-400 transition">Live</button>
            <button onclick="filterWebinar('done')" data-filter="done"
                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-200 text-gray-600 hover:border-gray-400 transition">Selesai</button>
        </div>
    </div>

    @if($webinars->isEmpty())
        <div class="reveal text-center py-24 border border-dashed border-gray-200 rounded-2xl">
            <p class="text-4xl mb-4">📭</p>
            <p class="text-gray-400">Belum ada program tersedia.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="webinarGrid">
            @foreach($webinars as $i => $webinar)
            <div class="reveal webinar-card card-hover border border-gray-100 rounded-2xl overflow-hidden bg-white flex flex-col delay-{{ min($i * 100, 400) }}"
                 data-status="{{ $webinar->status }}">

                <div class="relative overflow-hidden bg-gray-50">
                    @if($webinar->poster_path)
                        <img src="{{ asset('storage/' . $webinar->poster_path) }}"
                             alt="{{ $webinar->title }}"
                             class="w-full object-contain transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="w-full h-52 flex items-center justify-center" style="background:#f0f7f2;">
                            <span class="text-5xl opacity-30">🏛️</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        @if($webinar->status == 'upcoming')
                            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold px-3 py-1 rounded-full">🕐 Upcoming</span>
                        @elseif($webinar->status == 'live')
                            <span class="text-xs font-semibold px-3 py-1 rounded-full text-white animate-pulse" style="background:#1a4d2e;">🔴 Live</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 border border-gray-200 text-xs font-semibold px-3 py-1 rounded-full">✅ Selesai</span>
                        @endif
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-semibold text-gray-900 mb-3 leading-snug flex-1"
                        style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;min-height:3.8rem;font-family:'Plus Jakarta Sans',sans-serif;">
                        {{ $webinar->title }}
                    </h3>
                    <div class="flex flex-col gap-1.5 mb-5">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span>👤</span><span class="truncate">{{ $webinar->speaker }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span>📅</span><span>{{ $webinar->scheduled_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        @if($webinar->quota)
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span>👥</span><span>Kuota {{ $webinar->quota }} peserta</span>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('webinars.show', $webinar) }}"
                       class="block text-center btn-outline py-2.5 rounded-xl text-sm font-semibold mt-auto">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div id="noResult" class="hidden text-center py-24 border border-dashed border-gray-200 rounded-2xl mt-6">
            <p class="text-4xl mb-4">🔍</p>
            <p class="text-gray-400">Tidak ada program dengan status ini.</p>
        </div>
    @endif
</section>

{{-- CTA --}}
@guest
<section class="py-16 border-t border-gray-100">
    <div class="reveal-scale rounded-3xl p-12 md:p-16 text-center" style="background:#1a4d2e;">
        <span class="inline-block text-xs font-semibold uppercase tracking-widest text-green-300 mb-4">Bergabung Sekarang</span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif;">
            Siap ikut Kejarsiroma & Diklat?
        </h2>
        <p class="text-green-200 mb-8 max-w-xl mx-auto text-sm leading-relaxed">
            Daftar dan mulai ikuti program pembelajaran di Satpol PP Provinsi Jawa Timur hari ini.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="/register"
               class="bg-white font-bold px-8 py-3.5 rounded-xl text-sm transition hover:bg-gray-100"
               style="color:#1a4d2e;">Daftar Sekarang →</a>
            <a href="/login"
               class="border border-green-500 text-white font-semibold px-8 py-3.5 rounded-xl text-sm transition hover:bg-green-800">
               Sudah punya akun</a>
        </div>
    </div>
</section>
@endguest

<script>
function filterWebinar(status) {
    const cards = document.querySelectorAll('.webinar-card');
    const noResult = document.getElementById('noResult');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(btn => {
        if (btn.dataset.filter === status) {
            btn.style.background = '#1a4d2e';
            btn.style.color = 'white';
            btn.style.borderColor = '#1a4d2e';
        } else {
            btn.style.background = 'white';
            btn.style.color = '#4b5563';
            btn.style.borderColor = '#e5e7eb';
        }
    });

    let visible = 0;
    cards.forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = 'flex';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    if (noResult) noResult.classList.toggle('hidden', visible > 0);
}
// TYPING ANIMATION
const texts = [
    'Kompeten & Profesional',
    'Adaptif & Berintegritas',
    'Pembelajaran Berkelanjutan',
];

let textIndex   = 0;
let charIndex   = 0;
let isDeleting  = false;
const el        = document.getElementById('rotatingText');
const typeSpeed = 60;
const deleteSpeed = 30;
const pauseAfterType = 2000;
const pauseAfterDelete = 400;

function type() {
    const current = texts[textIndex];

    if (!isDeleting) {
        // Mengetik
        el.textContent = current.substring(0, charIndex + 1);
        charIndex++;

        if (charIndex === current.length) {
            // Selesai mengetik — pause lalu mulai hapus
            isDeleting = true;
            setTimeout(type, pauseAfterType);
            return;
        }
        setTimeout(type, typeSpeed);

    } else {
        // Menghapus
        el.textContent = current.substring(0, charIndex - 1);
        charIndex--;

        if (charIndex === 0) {
            // Selesai hapus — ganti teks
            isDeleting = false;
            textIndex = (textIndex + 1) % texts.length;
            setTimeout(type, pauseAfterDelete);
            return;
        }
        setTimeout(type, deleteSpeed);
    }
}

// Mulai setelah 1 detik
setTimeout(type, 1000);
</script>

@endsection