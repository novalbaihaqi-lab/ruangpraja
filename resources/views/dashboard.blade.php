@extends('layouts.app')

@section('content')

<div class="mb-10">
    <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--green-main, #1a4d2e);">Dashboard</span>
    <h1 class="text-3xl font-bold text-gray-900 mt-2" style="font-family:'Plus Jakarta Sans',sans-serif;">
        Halo, {{ Auth::user()->name }}! 👋
    </h1>
    <div class="flex items-center gap-3 mt-2">
        @if(Auth::user()->instansi)
            <span class="text-xs px-3 py-1 rounded-full"
                  style="background:var(--green-faint, #f0f7f2); color:var(--green-main, #1a4d2e);">
                🏛️ {{ Auth::user()->instansi }}
            </span>
        @endif
        <a href="{{ route('profile.edit') }}"
           class="text-xs font-medium hover:underline"
           style="color:var(--text-muted);">
            ✏️ Edit Profil
        </a>
    </div>
    <p class="text-sm mt-2" style="color:var(--text-muted);">Berikut program yang sudah kamu ikuti.</p>
</div>

@if($registrations->isEmpty())
    <div class="text-center py-24 border border-dashed border-gray-200 rounded-2xl">
        <p class="text-5xl mb-5">📭</p>
        <h3 class="font-semibold text-gray-700 mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;">Belum ada program</h3>
        <p class="text-sm text-gray-400 mb-6">Kamu belum mengikuti program apapun.</p>
        <a href="/" class="inline-block text-white text-sm font-semibold px-6 py-3 rounded-xl transition hover:opacity-90"
           style="background:#1a4d2e;">
            Lihat Program →
        </a>
    </div>
@else
    <div class="flex flex-col gap-4">
        @foreach($registrations as $reg)
        <div class="border border-gray-100 rounded-2xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-5 hover:border-gray-200 transition bg-white">

            <div class="flex items-start gap-5">
                {{-- POSTER MINI --}}
                @if($reg->webinar->poster_path)
                    <img src="{{ asset('storage/' . $reg->webinar->poster_path) }}"
                         alt="{{ $reg->webinar->title }}"
                         class="w-20 h-20 object-cover rounded-xl border border-gray-100 flex-shrink-0">
                @else
                    <div class="w-20 h-20 rounded-xl flex items-center justify-center flex-shrink-0 border border-dashed border-gray-200" style="background:#f0f7f2;">
                        <span class="text-2xl opacity-30">🏛️</span>
                    </div>
                @endif

                <div>
                    {{-- STATUS --}}
                    <div class="mb-2">
                        @if($reg->webinar->status == 'upcoming')
                            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold px-2.5 py-1 rounded-full">🕐 Upcoming</span>
                        @elseif($reg->webinar->status == 'live')
                            <span class="text-white text-xs font-semibold px-2.5 py-1 rounded-full animate-pulse" style="background:#1a4d2e;">🔴 Live</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full">✅ Selesai</span>
                        @endif
                    </div>

                    <h3 class="font-semibold text-gray-900 leading-snug mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
                        {{ $reg->webinar->title }}
                    </h3>
                    <div class="flex flex-wrap gap-3 text-xs text-gray-400">
                        <span>👤 {{ $reg->webinar->speaker }}</span>
                        <span>📅 {{ $reg->webinar->scheduled_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="flex flex-wrap gap-2 flex-shrink-0">

                @if($reg->webinar->zoom_link)
                    <a href="{{ $reg->webinar->zoom_link }}" target="_blank"
                       class="text-white text-xs font-semibold px-4 py-2 rounded-lg transition hover:opacity-90"
                       style="background:#1a4d2e;">📹 Zoom</a>
                @endif

                @if($reg->webinar->documentation_url)
                    <a href="{{ $reg->webinar->documentation_url }}" target="_blank"
                       class="border border-gray-200 text-gray-600 text-xs font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                        📸 Dokumentasi
                    </a>
                @endif

                @if($reg->webinar->materi_url)
                    <a href="{{ $reg->webinar->materi_url }}" target="_blank"
                       class="border border-gray-200 text-gray-600 text-xs font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                        📚 Materi
                    </a>
                @endif

                @if($reg->webinar->status == 'done')
                    @if($reg->hasSurveyProof())
                        @if($reg->certificate_number)
                            <a href="{{ route('certificate.download', $reg->webinar) }}"
                               class="bg-amber-500 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                                🏆 Sertifikat
                            </a>
                        @else
                            <form method="POST" action="{{ route('certificate.generate', $reg->webinar) }}">
                                @csrf
                                <button type="submit"
                                        class="bg-amber-500 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                                    🏆 Generate
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('webinars.show', $reg->webinar) }}"
                           class="text-xs font-semibold px-4 py-2 rounded-lg border transition hover:opacity-80"
                           style="border-color:#f59e0b; color:#b45309; background:#fef3c7;">
                            📝 Isi Survey
                        </a>
                    @endif
                @endif

                <a href="{{ route('webinars.show', $reg->webinar) }}"
                   class="border border-gray-200 text-gray-400 text-xs font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                    Detail →
                </a>

            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection