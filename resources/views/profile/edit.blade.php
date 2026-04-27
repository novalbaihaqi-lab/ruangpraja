@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--green-main, #1a4d2e);">Akun</span>
        <h1 class="text-3xl font-bold mt-1" style="color:var(--text-primary); font-family:'Plus Jakarta Sans',sans-serif;">
            Edit Profil
        </h1>
        <p class="text-sm mt-1" style="color:var(--text-muted);">Perbarui informasi profil dan data instansi kamu</p>
    </div>

    {{-- AVATAR & INFO --}}
    <div class="border rounded-2xl p-6 mb-5 flex items-center gap-5"
         style="background:var(--bg-card); border-color:var(--border-color);">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white flex-shrink-0"
             style="background:var(--green-main, #1a4d2e);">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <div class="font-bold text-lg" style="color:var(--text-primary);">{{ $user->name }}</div>
            <div class="text-sm" style="color:var(--text-muted);">{{ $user->email }}</div>
            @if($user->instansi)
                <div class="text-xs mt-1 px-2 py-0.5 rounded-full inline-block"
                     style="background:var(--green-faint, #f0f7f2); color:var(--green-main, #1a4d2e);">
                    🏛️ {{ $user->instansi }}
                </div>
            @endif
        </div>
    </div>

    {{-- FORM PROFIL --}}
    <div class="border rounded-2xl p-6 mb-5"
         style="background:var(--bg-card); border-color:var(--border-color);">

        <h2 class="font-bold mb-5 pb-4 border-b" style="color:var(--text-primary); border-color:var(--border-color); font-family:'Plus Jakarta Sans',sans-serif;">
            Informasi Profil
        </h2>

        <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Nama Lengkap <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="Nama lengkap kamu">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Email <span class="text-red-400">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="email@contoh.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Asal Instansi
                </label>
                <input type="text" name="instansi" value="{{ old('instansi', $user->instansi) }}"
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="Contoh: Satpol PP Kab. Sidoarjo">
                @error('instansi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full text-white py-3.5 rounded-xl font-semibold text-sm transition hover:opacity-90"
                    style="background:var(--green-main, #1a4d2e);">
                Simpan Perubahan →
            </button>
        </form>
    </div>

    {{-- FORM GANTI PASSWORD --}}
    <div class="border rounded-2xl p-6"
         style="background:var(--bg-card); border-color:var(--border-color);">

        <h2 class="font-bold mb-5 pb-4 border-b" style="color:var(--text-primary); border-color:var(--border-color); font-family:'Plus Jakarta Sans',sans-serif;">
            Ganti Password
        </h2>

        <form method="POST" action="{{ route('profile.password') }}" class="flex flex-col gap-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Password Lama <span class="text-red-400">*</span>
                </label>
                <input type="password" name="current_password" required
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="••••••••">
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Password Baru <span class="text-red-400">*</span>
                </label>
                <input type="password" name="password" required
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:var(--text-secondary);">
                    Konfirmasi Password Baru <span class="text-red-400">*</span>
                </label>
                <input type="password" name="password_confirmation" required
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition"
                       style="background:var(--bg-secondary); border-color:var(--border-input); color:var(--text-primary);"
                       placeholder="Ulangi password baru">
            </div>

            <button type="submit"
                    class="w-full text-white py-3.5 rounded-xl font-semibold text-sm transition hover:opacity-90"
                    style="background:var(--green-main, #1a4d2e);">
                Ganti Password 🔐
            </button>
        </form>
    </div>

</div>

@endsection