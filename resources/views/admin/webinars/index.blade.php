@extends('admin.layouts.app')

@section('page-title', 'Kelola Program')

@section('content')

<div class="flex justify-between items-start mb-8">
    <div>
        <span class="text-xs font-semibold uppercase tracking-widest text-green-700">Program</span>
        <h1 class="text-3xl font-bold text-gray-900 mt-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Kelola Program</h1>
    </div>
    <a href="{{ route('admin.webinars.create') }}"
       class="text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition hover:opacity-90"
       style="background:#1a4d2e;">
        + Tambah Program
    </a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-left border-b border-gray-100">
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Program</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Peserta</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($webinars as $webinar)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-800 max-w-xs" style="font-family:'Plus Jakarta Sans',sans-serif;">
                        {{ Str::limit($webinar->title, 50) }}
                    </div>
                    <div class="text-xs text-gray-400 mt-0.5">👤 {{ $webinar->speaker }}</div>
                </td>
                <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">
                    {{ $webinar->scheduled_at->format('d M Y') }}<br>
                    <span class="text-gray-300">{{ $webinar->scheduled_at->format('H:i') }} WIB</span>
                </td>
                <td class="px-6 py-4">
                    @if($webinar->status == 'upcoming')
                        <span class="bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold px-2.5 py-1 rounded-full">🕐 Upcoming</span>
                    @elseif($webinar->status == 'live')
                        <span class="text-white text-xs font-semibold px-2.5 py-1 rounded-full" style="background:#1a4d2e;">🔴 Live</span>
                    @else
                        <span class="bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">✅ Selesai</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                    {{ $webinar->registrations_count }}
                    <span class="text-xs font-normal text-gray-400">orang</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.webinars.edit', $webinar) }}"
                           class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Edit
                        </a>
                        <a href="{{ route('admin.webinars.participants', $webinar) }}"
                           class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Peserta
                        </a>
                        <form method="POST" action="{{ route('admin.webinars.destroy', $webinar) }}"
                              onsubmit="return confirm('Yakin hapus program ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-red-100 text-red-500 hover:bg-red-50 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center text-gray-400 text-sm">
                    <p class="text-3xl mb-3">📭</p>
                    Belum ada program. <a href="{{ route('admin.webinars.create') }}" class="underline" style="color:#1a4d2e;">Tambah sekarang →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection