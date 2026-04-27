@extends('admin.layouts.app')

@section('page-title', 'Manajemen User')

@section('content')

<div class="flex justify-between items-start mb-8">
    <div>
        <span class="text-xs font-semibold uppercase tracking-widest text-green-700">User</span>
        <h1 class="text-3xl font-bold text-gray-900 mt-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Manajemen User</h1>
    </div>
    <div class="bg-white border border-gray-100 rounded-xl px-5 py-3 text-center">
        <div class="text-2xl font-bold text-gray-900" style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $users->total() }}</div>
        <div class="text-xs text-gray-400">Total User</div>
    </div>
</div>

{{-- SEARCH --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-3">
        <input type="text" name="search" value="{{ $search }}"
               placeholder="Cari nama atau email..."
               class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition">
        <button type="submit"
                class="text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:opacity-90 transition"
                style="background:#1a4d2e;">
            Cari
        </button>
        @if($search)
            <a href="{{ route('admin.users.index') }}"
               class="border border-gray-200 text-gray-500 px-4 py-2.5 rounded-xl text-sm hover:bg-gray-50 transition">
                Reset
            </a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-left border-b border-gray-100">
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">No</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Role</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Program</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Bergabung</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($users as $i => $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-xs text-gray-300">{{ $users->firstItem() + $i }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0"
                             style="{{ $user->role === 'admin' ? 'background:#1a4d2e; color:white;' : 'background:#f0f7f2; color:#1a4d2e;' }}">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $user->name }}</div>
                            @if($user->id === Auth::id())
                                <div class="text-xs text-green-600">(Akun Anda)</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    @if($user->role === 'admin')
                        <span class="bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold px-2.5 py-1 rounded-full">👑 Admin</span>
                    @else
                        <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full">👤 Peserta</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                    {{ $user->registrations_count }}
                    <span class="text-xs font-normal text-gray-400">program</span>
                </td>
                <td class="px-6 py-4 text-xs text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    @if($user->id !== Auth::id())
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                            @csrf
                            @method('PATCH')
                            @if($user->role === 'admin')
                                <input type="hidden" name="role" value="user">
                                <button onclick="return confirm('Jadikan {{ $user->name }} sebagai Peserta?')"
                                        class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition whitespace-nowrap">
                                    → Peserta
                                </button>
                            @else
                                <input type="hidden" name="role" value="admin">
                                <button onclick="return confirm('Jadikan {{ $user->name }} sebagai Admin?')"
                                        class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-amber-100 text-amber-700 hover:bg-amber-50 transition whitespace-nowrap">
                                    → Admin
                                </button>
                            @endif
                        </form>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus akun {{ $user->name }}?')"
                                    class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-red-100 text-red-500 hover:bg-red-50 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                    @else
                        <span class="text-gray-200 text-xs">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-16 text-center text-gray-400 text-sm">
                    <p class="text-3xl mb-3">👥</p>
                    Tidak ada user ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-50 flex justify-between items-center">
        <p class="text-xs text-gray-400">
            Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} user
        </p>
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection