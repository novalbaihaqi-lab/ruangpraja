<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Ruang Praja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>* { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gray-50 flex">

    {{-- KIRI --}}
    <div class="hidden lg:flex w-1/2 flex-col justify-between p-12" style="background: #1a4d2e;">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
            <span class="font-bold text-white text-lg" style="font-family:'Plus Jakarta Sans',sans-serif;">Ruang Praja</span>
        </div>

        <div>
            <h2 class="text-4xl font-bold text-white leading-tight mb-6" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Bergabung &<br>
                <span class="italic text-green-300">mulai belajar hari ini.</span>
            </h2>
            <p class="text-green-200 text-sm leading-relaxed mb-10">
                Daftar gratis dan ikuti program Kejarsiroma & Diklat Satpol PP Provinsi Jawa Timur.
            </p>

            <div class="flex flex-col gap-4">
                @foreach(['✅ Akses semua webinar Kejarsiroma', '📄 Materi & dokumentasi lengkap', '🏆 Sertifikat resmi bisa didownload', '📹 Link Zoom terintegrasi'] as $item)
                <div class="flex items-center gap-3 text-green-100 text-sm">
                    <span>{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <p class="text-green-600 text-xs">© {{ date('Y') }} Ruang Praja — Satpol PP Prov. Jawa Timur</p>
    </div>

    {{-- KANAN --}}
    <div class="flex-1 flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <div class="flex items-center gap-3 mb-10 lg:hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain" onerror="this.style.display='none'">
                <span class="font-bold text-gray-900 text-lg" style="font-family:'Plus Jakarta Sans',sans-serif;">Ruang Praja</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Buat akun baru
            </h1>
            <p class="text-gray-400 text-sm mb-8">Isi data di bawah untuk mulai bergabung.</p>

            <form method="POST" action="/register" class="flex flex-col gap-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('name') border-red-300 @enderror"
                           placeholder="Nama lengkap kamu">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('email') border-red-300 @enderror"
                           placeholder="nama@email.com">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('password') border-red-300 @enderror"
                           placeholder="Minimal 8 karakter">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition"
                           placeholder="Ulangi password kamu">
                </div>

                <button type="submit"
                        class="w-full text-white py-3.5 rounded-xl font-semibold text-sm transition hover:opacity-90 mt-1"
                        style="background: #1a4d2e;">
                    Buat Akun →
                </button>
        {{-- DIVIDER --}}
        <div class="flex items-center gap-3 my-6">
            <div class="flex-1 h-px" style="background:var(--border-color, #e5e7eb);"></div>
            <span class="text-xs" style="color:#9ca3af;">atau daftar dengan</span>
            <div class="flex-1 h-px" style="background:var(--border-color, #e5e7eb);"></div>
        </div>

        {{-- GOOGLE REGISTER --}}
        <a href="{{ route('auth.google') }}"
        class="w-full flex items-center justify-center gap-3 border py-3 rounded-xl text-sm font-semibold transition hover:bg-gray-50"
        style="border-color:#e5e7eb; color:#374151;">
            <svg width="18" height="18" viewBox="0 0 48 48" fill="none">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                <path fill="none" d="M0 0h48v48H0z"/>
            </svg>
            Daftar dengan Google
        </a>  
            </form>

            <p class="text-center text-sm text-gray-400 mt-8">
                Sudah punya akun?
                <a href="/login" class="font-semibold hover:underline" style="color:#1a4d2e;">Masuk di sini</a>
            </p>
        </div>
    </div>

</body>
</html>