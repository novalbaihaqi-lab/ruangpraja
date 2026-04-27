@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="mb-8">
    <span class="text-xs font-semibold uppercase tracking-widest text-green-700">Overview</span>
    <h1 class="text-3xl font-bold text-gray-900 mt-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
        Selamat datang, {{ Auth::user()->name }}
    </h1>
    <p class="text-gray-400 text-sm mt-1">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <div class="card-hover bg-white border border-gray-100 rounded-2xl p-6">
        <div class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-3">Total Program</div>
        <div class="text-4xl font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $totalWebinar }}</div>
        <div class="text-xs text-gray-400">program terdaftar</div>
    </div>

    <div class="card-hover bg-white border border-gray-100 rounded-2xl p-6">
        <div class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-3">Total Peserta</div>
        <div class="text-4xl font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $totalPeserta }}</div>
        <div class="text-xs text-gray-400">peserta terdaftar</div>
    </div>

    <div class="card-hover bg-white border border-gray-100 rounded-2xl p-6">
        <div class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-3">Upcoming</div>
        <div class="text-4xl font-bold text-amber-500 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $webinarUpcoming }}</div>
        <div class="text-xs text-gray-400">program mendatang</div>
    </div>

    <div class="card-hover bg-white border border-gray-100 rounded-2xl p-6">
        <div class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-3">Live Sekarang</div>
        <div class="text-4xl font-bold mb-1" style="font-family:'Plus Jakarta Sans',sans-serif; color:#1a4d2e;">{{ $webinarLive }}</div>
        <div class="text-xs text-gray-400">sedang berlangsung</div>
    </div>

</div>

{{-- KONTEN UTAMA --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- TABEL PROGRAM --}}
    <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="flex justify-between items-center px-6 py-5 border-b border-gray-100">
            <div>
                <h3 class="font-bold text-gray-900" style="font-family:'Plus Jakarta Sans',sans-serif;">Program Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">5 program terakhir ditambahkan</p>
            </div>
            <a href="{{ route('admin.webinars.create') }}"
               class="text-white text-xs font-semibold px-4 py-2 rounded-lg transition hover:opacity-90"
               style="background:#1a4d2e;">
                + Tambah
            </a>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Program</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($webinarTerbaru as $webinar)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800 truncate max-w-xs" style="font-family:'Plus Jakarta Sans',sans-serif;">
                            {{ $webinar->title }}
                        </div>
                        <div class="text-xs text-gray-400 mt-0.5">👤 {{ $webinar->speaker }}</div>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">
                        {{ $webinar->scheduled_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($webinar->status == 'upcoming')
                            <span class="bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold px-2.5 py-1 rounded-full">Upcoming</span>
                        @elseif($webinar->status == 'live')
                            <span class="text-white text-xs font-semibold px-2.5 py-1 rounded-full" style="background:#1a4d2e;">Live</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">Selesai</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.webinars.edit', $webinar) }}"
                           class="text-xs font-medium hover:underline" style="color:#1a4d2e;">
                            Edit →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm">
                        Belum ada program.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-gray-50">
            <a href="{{ route('admin.webinars.index') }}"
               class="text-xs font-semibold hover:underline" style="color:#1a4d2e;">
                Lihat semua program →
            </a>
        </div>
    </div>

    {{-- PANEL KANAN --}}
    <div class="flex flex-col gap-5">

        {{-- RINGKASAN STATUS --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h3 class="font-bold text-gray-900 mb-5" style="font-family:'Plus Jakarta Sans',sans-serif;">Ringkasan Status</h3>

            <div class="flex flex-col gap-4">
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <span class="text-xs text-gray-500">Upcoming</span>
                        <span class="text-xs font-bold text-amber-600">{{ $webinarUpcoming }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        @php $pct = $totalWebinar > 0 ? ($webinarUpcoming / $totalWebinar) * 100 : 0; @endphp
                        <div class="bg-amber-400 h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <span class="text-xs text-gray-500">Live</span>
                        <span class="text-xs font-bold" style="color:#1a4d2e;">{{ $webinarLive }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        @php $pct = $totalWebinar > 0 ? ($webinarLive / $totalWebinar) * 100 : 0; @endphp
                        <div class="h-1.5 rounded-full" style="width:{{ $pct }}%; background:#1a4d2e;"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <span class="text-xs text-gray-500">Selesai</span>
                        <span class="text-xs font-bold text-gray-500">{{ $webinarDone }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        @php $pct = $totalWebinar > 0 ? ($webinarDone / $totalWebinar) * 100 : 0; @endphp
                        <div class="bg-gray-400 h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- AKSI CEPAT --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h3 class="font-bold text-gray-900 mb-4" style="font-family:'Plus Jakarta Sans',sans-serif;">Aksi Cepat</h3>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.webinars.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-white transition hover:opacity-90"
                   style="background:#1a4d2e;">
                    ➕ Tambah Program Baru
                </a>
                <a href="{{ route('admin.webinars.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 border border-gray-100 hover:bg-gray-50 transition">
                    📋 Kelola Semua Program
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 border border-gray-100 hover:bg-gray-50 transition">
                    👥 Manajemen User
                </a>
            </div>
        </div>

        {{-- INFO INSTANSI --}}
        <div class="rounded-2xl p-6" style="background:#1a4d2e;">
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                     class="h-8 w-8 object-contain opacity-80"
                     onerror="this.style.display='none'">
                <div class="text-white font-bold text-sm" style="font-family:'Plus Jakarta Sans',sans-serif;">Ruang Praja</div>
            </div>
            <p class="text-green-200 text-xs leading-relaxed">
                Platform resmi Satuan Polisi Pamong Praja Provinsi Jawa Timur untuk Webinar Kejarsiroma & Diklat.
            </p>
        </div>

    </div>
</div>

@endsection