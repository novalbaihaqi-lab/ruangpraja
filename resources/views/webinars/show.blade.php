@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <a href="/" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-700 transition mb-8">
        ← Kembali ke Beranda
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- KIRI: POSTER --}}
        <div class="lg:col-span-1">
            @if($webinar->poster_path)
                <img src="{{ asset('storage/' . $webinar->poster_path) }}"
                     alt="{{ $webinar->title }}"
                     class="w-full rounded-2xl shadow-sm border border-gray-100 object-contain">
            @else
                <div class="w-full aspect-square rounded-2xl flex items-center justify-center border border-dashed border-gray-200" style="background:#f0f7f2;">
                    <span class="text-6xl opacity-20">🏛️</span>
                </div>
            @endif

            {{-- INFO CARD --}}
            <div class="border border-gray-100 rounded-2xl p-5 mt-5 flex flex-col gap-3">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-gray-400">👤</span>
                    <div>
                        <div class="text-xs text-gray-400">Pembicara</div>
                        <div class="font-medium text-gray-800">{{ $webinar->speaker }}</div>
                    </div>
                </div>
                <div class="border-t border-gray-50"></div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-gray-400">📅</span>
                    <div>
                        <div class="text-xs text-gray-400">Jadwal</div>
                        <div class="font-medium text-gray-800">{{ $webinar->scheduled_at->format('d M Y, H:i') }} WIB</div>
                    </div>
                </div>
                @if($webinar->quota)
                <div class="border-t border-gray-50"></div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-gray-400">👥</span>
                    <div>
                        <div class="text-xs text-gray-400">Kuota</div>
                        <div class="font-medium text-gray-800">{{ $webinar->quota }} peserta</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- KANAN: DETAIL --}}
        <div class="lg:col-span-2">

            {{-- BADGE --}}
            @if($webinar->status == 'upcoming')
                <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold px-3 py-1 rounded-full mb-4">🕐 Upcoming</span>
            @elseif($webinar->status == 'live')
                <span class="inline-block text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 animate-pulse" style="background:#1a4d2e;">🔴 Sedang Live</span>
            @else
                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">✅ Selesai</span>
            @endif

            <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-6" style="font-family:'Plus Jakarta Sans',sans-serif;">
                {{ $webinar->title }}
            </h1>

            <div class="prose prose-sm text-gray-500 leading-relaxed mb-8">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Tentang Program</h3>
                <p>{{ $webinar->description }}</p>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="border-t border-gray-100 pt-6">
                @auth
                    @php $registered = $webinar->registrations->where('user_id', Auth::id())->first(); @endphp

                    @if($registered)
                        <div class="border rounded-2xl p-6 mb-4"
                             style="background:var(--green-faint, #f0f7f2); border-color:rgba(26,77,46,0.15);">

                            <div class="flex items-center gap-2 mb-5">
                                <span class="font-semibold text-sm" style="color:var(--green-main, #1a4d2e);">
                                    ✅ Kamu sudah terdaftar di program ini
                                </span>
                            </div>

                            {{-- ZOOM, DOKUMENTASI, MATERI --}}
                            <div class="flex flex-wrap gap-3 mb-5">
                                @if($webinar->zoom_link)
                                    <a href="{{ $webinar->zoom_link }}" target="_blank"
                                       class="flex items-center gap-2 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition hover:opacity-90"
                                       style="background:var(--green-main, #1a4d2e);">
                                        📹 Bergabung via Zoom
                                    </a>
                                @endif

                                @if($webinar->documentation_url)
                                    <a href="{{ $webinar->documentation_url }}" target="_blank"
                                       class="flex items-center gap-2 border text-sm font-semibold px-5 py-2.5 rounded-xl hover:opacity-80 transition"
                                       style="border-color:var(--border-color, #e5e7eb); color:var(--text-primary, #111827);">
                                        📸 Dokumentasi
                                    </a>
                                @endif

                                @if($webinar->materi_url)
                                    <a href="{{ $webinar->materi_url }}" target="_blank"
                                       class="flex items-center gap-2 border text-sm font-semibold px-5 py-2.5 rounded-xl hover:opacity-80 transition"
                                       style="border-color:var(--border-color, #e5e7eb); color:var(--text-primary, #111827);">
                                        📚 Materi
                                    </a>
                                @endif
                            </div>

                            {{-- SERTIFIKAT --}}
                            @if($webinar->status == 'done')
                            <div class="border-t pt-5" style="border-color:var(--border-color, #e5e7eb);">

                                <h4 class="font-semibold text-sm mb-4" style="color:var(--text-primary, #111827);">
                                    🏆 Sertifikat Kehadiran
                                </h4>

                                @if($registered->hasSurveyProof())

                                    <div class="flex items-center gap-2 text-xs mb-4 px-3 py-2.5 rounded-xl"
                                         style="background:var(--green-faint, #f0f7f2); color:var(--green-main, #1a4d2e); border:1px solid rgba(26,77,46,0.2);">
                                        ✅ Survey kepuasan sudah diisi — sertifikat tersedia!
                                    </div>

                                    @if($registered->certificate_number)
                                        <a href="{{ route('certificate.download', $webinar) }}"
                                           class="flex items-center justify-center gap-2 w-full bg-amber-500 text-white text-sm font-semibold px-5 py-3.5 rounded-xl hover:bg-amber-600 transition">
                                            🏆 Download Sertifikat
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('certificate.generate', $webinar) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full bg-amber-500 text-white text-sm font-semibold px-5 py-3.5 rounded-xl hover:bg-amber-600 transition">
                                                🏆 Generate Sertifikat
                                            </button>
                                        </form>
                                    @endif

                                @else

                                    <div class="border rounded-2xl p-5"
                                         style="border-color:var(--border-color, #e5e7eb); background:var(--bg-card, #fff);">

                                        {{-- STEP 1 --}}
                                        <div class="flex items-start gap-3 mb-4">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                                                 style="background:var(--green-main, #1a4d2e);">1</div>
                                            <div>
                                                <p class="text-sm font-semibold" style="color:var(--text-primary, #111827);">
                                                    Isi Survey Kepuasan Masyarakat
                                                </p>
                                                <p class="text-xs mt-0.5 mb-2" style="color:var(--text-muted, #9ca3af);">
                                                    Klik tombol di bawah untuk mengisi survey kepuasan
                                                </p>
                                                @if($webinar->survey_url)
                                                    <a href="{{ $webinar->survey_url }}" target="_blank"
                                                       class="inline-flex items-center gap-1.5 text-xs font-semibold px-4 py-2 rounded-lg transition hover:opacity-80 text-white"
                                                       style="background:var(--green-main, #1a4d2e);">
                                                        📝 Isi Survey Sekarang →
                                                    </a>
                                                @else
                                                    <span class="text-xs px-3 py-1.5 rounded-lg"
                                                          style="background:var(--bg-hover, #f3f4f6); color:var(--text-muted, #9ca3af);">
                                                        Link survey belum tersedia
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-px h-3 ml-3.5 mb-4" style="background:var(--border-color, #e5e7eb);"></div>

                                        {{-- STEP 2 --}}
                                        <div class="flex items-start gap-3 mb-4">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                                                 style="background:var(--bg-hover, #f3f4f6); color:var(--text-muted, #9ca3af);">2</div>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold" style="color:var(--text-primary, #111827);">
                                                    Upload Bukti Pengisian Survey
                                                </p>
                                                <p class="text-xs mt-0.5 mb-3" style="color:var(--text-muted, #9ca3af);">
                                                    Screenshot atau foto bukti pengisian (JPG, PNG, PDF — maks. 5MB)
                                                </p>

                                                <form method="POST" action="{{ route('survey.upload', $webinar) }}"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <div id="surveyDropzone"
                                                         class="border-2 border-dashed rounded-xl p-5 text-center cursor-pointer transition mb-3"
                                                         style="border-color:var(--border-color, #e5e7eb);"
                                                         onclick="document.getElementById('surveyFile').click()"
                                                         ondragover="event.preventDefault(); this.style.borderColor='#1a4d2e';"
                                                         ondragleave="this.style.borderColor='var(--border-color, #e5e7eb)';"
                                                         ondrop="handleDrop(event)">

                                                        <div id="surveyPlaceholder">
                                                            <div class="text-2xl mb-1">📎</div>
                                                            <p class="text-xs font-medium" style="color:var(--text-secondary, #6b7280);">
                                                                Klik atau drag & drop file di sini
                                                            </p>
                                                            <p class="text-xs mt-0.5" style="color:var(--text-muted, #9ca3af);">
                                                                JPG, PNG, PDF — maks. 5MB
                                                            </p>
                                                        </div>

                                                        <div id="surveyPreview" class="hidden">
                                                            <img id="surveyPreviewImg" src="" alt=""
                                                                 class="max-h-32 mx-auto rounded-lg mb-1 object-contain">
                                                            <p id="surveyFileName" class="text-xs font-medium"
                                                               style="color:var(--green-main, #1a4d2e);"></p>
                                                        </div>

                                                        <input type="file" name="survey_proof" id="surveyFile"
                                                               class="hidden"
                                                               accept="image/jpg,image/jpeg,image/png,application/pdf"
                                                               onchange="previewSurvey(this)">
                                                    </div>

                                                    @error('survey_proof')
                                                        <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
                                                    @enderror

                                                    <button type="submit"
                                                            class="w-full text-white text-sm font-semibold px-5 py-3 rounded-xl hover:opacity-90 transition"
                                                            style="background:var(--green-main, #1a4d2e);">
                                                        📤 Upload & Aktifkan Sertifikat
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="w-px h-3 ml-3.5 mb-4" style="background:var(--border-color, #e5e7eb);"></div>

                                        {{-- STEP 3 disabled --}}
                                        <div class="flex items-start gap-3 opacity-40">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                                                 style="background:var(--bg-hover, #f3f4f6); color:var(--text-muted, #9ca3af);">3</div>
                                            <div>
                                                <p class="text-sm font-semibold" style="color:var(--text-primary, #111827);">
                                                    Download Sertifikat
                                                </p>
                                                <p class="text-xs mt-0.5" style="color:var(--text-muted, #9ca3af);">
                                                    Aktif setelah bukti survey diupload
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            </div>
                            @endif

                        </div>

                    @else
                        @if($webinar->status != 'done')
                            <form method="POST" action="{{ route('webinars.register', $webinar) }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-white py-4 rounded-xl font-semibold text-sm transition hover:opacity-90"
                                        style="background:var(--green-main, #1a4d2e);">
                                    Daftar Program Ini →
                                </button>
                            </form>
                        @else
                            <div class="border border-dashed rounded-xl p-4 text-center text-sm"
                                 style="border-color:var(--border-color, #e5e7eb); color:var(--text-muted, #9ca3af);">
                                Pendaftaran sudah ditutup
                            </div>
                        @endif
                    @endif

                @else
                    <a href="/login"
                       class="block text-center text-white py-4 rounded-xl font-semibold text-sm transition hover:opacity-90"
                       style="background:#1a4d2e;">
                        🔐 Masuk untuk Mendaftar →
                    </a>
                    <p class="text-center text-xs text-gray-400 mt-3">
                        Belum punya akun? <a href="/register" class="underline" style="color:#1a4d2e;">Daftar gratis</a>
                    </p>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
function previewSurvey(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById('surveyPlaceholder').classList.add('hidden');
    document.getElementById('surveyPreview').classList.remove('hidden');
    document.getElementById('surveyFileName').textContent = file.name;
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('surveyPreviewImg').src = e.target.result;
            document.getElementById('surveyPreviewImg').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('surveyPreviewImg').classList.add('hidden');
    }
}
function handleDrop(e) {
    e.preventDefault();
    const input = document.getElementById('surveyFile');
    input.files = e.dataTransfer.files;
    previewSurvey(input);
    document.getElementById('surveyDropzone').style.borderColor = 'var(--border-color, #e5e7eb)';
}
</script>

@endsection