@extends('admin.layouts.app')

@section('content')

<a href="{{ route('admin.webinars.index') }}" class="text-blue-600 hover:underline text-sm mb-6 inline-block">← Kembali</a>

<h1 class="text-2xl font-bold text-gray-800 mb-2">👥 Peserta Webinar</h1>
<p class="text-gray-500 mb-6">{{ $webinar->title }}</p>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-gray-500 text-left">
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Nama</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Tanggal Daftar</th>
                <th class="px-6 py-4">Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $i => $reg)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $reg->user->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $reg->user->email }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $reg->created_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4">
                    @if($reg->certificate_number)
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">
                            🏆 {{ $reg->certificate_number }}
                        </span>
                    @else
                        <span class="text-gray-400 text-xs">Belum digenerate</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                    Belum ada peserta yang mendaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection