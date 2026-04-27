@extends('admin.layouts.app')

@section('page-title', 'Edit Program')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.webinars.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-700 transition mb-4">
        ← Kembali
    </a>
    <span class="block text-xs font-semibold uppercase tracking-widest text-green-700">Edit Program</span>
    <h1 class="text-3xl font-bold text-gray-900 mt-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
        {{ Str::limit($webinar->title, 50) }}
    </h1>
</div>

<form method="POST" action="{{ route('admin.webinars.update', $webinar) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- KOLOM KIRI --}}
    <div class="lg:col-span-2 flex flex-col gap-5">

        {{-- INFO DASAR --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-5 pb-4 border-b border-gray-50" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Informasi Program
            </h2>
            <div class="flex flex-col gap-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Program <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $webinar->title) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('title') border-red-300 @enderror">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Pembicara <span class="text-red-400">*</span></label>
                    <input type="text" name="speaker" value="{{ old('speaker', $webinar->speaker) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('speaker') border-red-300 @enderror">
                    @error('speaker')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="5" required
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('description') border-red-300 @enderror">{{ old('description', $webinar->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal & Jam <span class="text-red-400">*</span></label>
                        <input type="datetime-local" name="scheduled_at" required
                               value="{{ old('scheduled_at', $webinar->scheduled_at->format('Y-m-d\TH:i')) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kuota Peserta</label>
                        <input type="number" name="quota" value="{{ old('quota', $webinar->quota) }}" min="1"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition"
                               placeholder="Kosongkan = tak terbatas">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status <span class="text-red-400">*</span></label>
                    <select name="status" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition">
                        <option value="upcoming" {{ old('status', $webinar->status) == 'upcoming' ? 'selected' : '' }}>🕐 Upcoming</option>
                        <option value="live"     {{ old('status', $webinar->status) == 'live'     ? 'selected' : '' }}>🔴 Live</option>
                        <option value="done"     {{ old('status', $webinar->status) == 'done'     ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                </div>

            </div>
        </div>

        {{-- LINK --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-5 pb-4 border-b border-gray-50" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Tautan
            </h2>
            <div class="flex flex-col gap-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Zoom</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📹</span>
                        <input type="url" name="zoom_link" value="{{ old('zoom_link', $webinar->zoom_link) }}"
                               class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                               placeholder="https://zoom.us/j/...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Dokumentasi</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📄</span>
                        <input type="text" name="documentation_url" value="{{ old('documentation_url', $webinar->documentation_url) }}"
                               class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                               placeholder="https://drive.google.com/...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Materi</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📚</span>
                        <input type="text" name="materi_url" value="{{ old('materi_url', $webinar->materi_url) }}"
                            class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                            placeholder="https://drive.google.com/... atau URL materi lainnya">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Survey Kepuasan</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📝</span>
                        <input type="url" name="survey_url" value="{{ old('survey_url', $webinar->survey_url) }}"
                            class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                            placeholder="https://link-survey-kepuasan.com">
                    </div>
                </div>

            </div>
        </div>

        {{-- EDITOR SERTIFIKAT --}}
        <div id="certEditorSection" class="bg-white border border-gray-100 rounded-2xl p-6 {{ !$webinar->certificate_template_path ? 'hidden' : '' }}">
            <h2 class="font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Editor Posisi Nama Sertifikat</h2>
            <p class="text-xs text-gray-400 mb-5">Klik pada preview sertifikat untuk menentukan posisi nama peserta</p>

            @if($webinar->certificate_template_path)
            <div class="border border-dashed border-gray-200 rounded-xl overflow-hidden cursor-crosshair mb-4 relative"
                 id="previewContainer">
                <img src="{{ asset('storage/' . $webinar->certificate_template_path) }}"
                     id="certPreview" class="w-full block" alt="Template">
                <div id="nameMarker"
                     style="position:absolute; transform:translate(-50%,-50%); pointer-events:none;
                            left:{{ $webinar->cert_name_x }}px; top:{{ $webinar->cert_name_y }}px;">
                    <div style="background:rgba(26,77,46,0.1); border:2px dashed #1a4d2e; border-radius:6px; padding:2px 10px; white-space:nowrap;">
                        <span id="namePreviewText"
                              style="font-family:serif; color:#{{ $webinar->cert_name_color }};
                                     font-size:{{ $webinar->cert_name_size * 0.5 }}px;">
                            Nama Peserta
                        </span>
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-400 mb-5">👆 Klik di atas template untuk memindahkan posisi nama</p>
            @else
            <div class="border border-dashed border-gray-200 rounded-xl p-10 text-center text-gray-400 mb-4">
                <p class="text-3xl mb-2">🖼️</p>
                <p class="text-xs">Upload template sertifikat dulu di kolom kanan</p>
            </div>
            @endif

            <input type="hidden" name="cert_name_x" id="inputX" value="{{ old('cert_name_x', $webinar->cert_name_x) }}">
            <input type="hidden" name="cert_name_y" id="inputY" value="{{ old('cert_name_y', $webinar->cert_name_y) }}">

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Posisi X</label>
                    <input type="number" id="manualX" value="{{ old('cert_name_x', $webinar->cert_name_x) }}"
                           class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Posisi Y</label>
                    <input type="number" id="manualY" value="{{ old('cert_name_y', $webinar->cert_name_y) }}"
                           class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Ukuran Font</label>
                    <input type="number" name="cert_name_size" id="fontSize"
                           value="{{ old('cert_name_size', $webinar->cert_name_size) }}"
                           class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white"
                           min="10" max="150">
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Warna Teks Nama</label>
                <div class="flex items-center gap-3">
                    <input type="color" id="colorPicker" value="#{{ $webinar->cert_name_color }}"
                           class="w-10 h-10 border border-gray-200 rounded-lg cursor-pointer">
                    <input type="hidden" name="cert_name_color" id="colorValue" value="{{ $webinar->cert_name_color }}">
                    <span class="text-xs text-gray-400">Pilih warna teks nama peserta</span>
                </div>
            </div>

            {{-- PILIHAN FONT --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-3">Pilih Font</label>
                <div class="flex flex-col gap-2">
                    @php
                    $fonts = [
                        ['file' => 'GreatVibes-Regular.ttf',     'label' => 'Great Vibes',      'style' => 'italic'],
                        ['file' => 'Poppins-Regular.ttf',         'label' => 'Poppins',           'style' => 'normal'],
                        ['file' => 'PlayfairDisplay-Regular.ttf', 'label' => 'Plus Jakarta Sans',  'style' => 'normal'],
                        ['file' => 'DancingScript-Regular.ttf',   'label' => 'Dancing Script',    'style' => 'italic'],
                        ['file' => 'Montserrat-Regular.ttf',      'label' => 'Montserrat',        'style' => 'normal'],
                        ['file' => 'PlusJakartaSans-Regular.ttf',  'label' => 'Plus Jakarta Sans', 'style' => 'normal'],
                    ];
                    @endphp
                    @foreach($fonts as $font)
                    <label class="flex items-center justify-between border rounded-xl px-4 py-2.5 cursor-pointer hover:border-green-400 hover:bg-green-50 transition
                                  {{ old('cert_font', $webinar->cert_font) == $font['file'] ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="cert_font" value="{{ $font['file'] }}"
                                   class="text-green-700"
                                   {{ old('cert_font', $webinar->cert_font) == $font['file'] ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $font['label'] }}</span>
                        </div>
                        <span class="text-sm text-gray-400" style="font-style:{{ $font['style'] }};">Nama Peserta</span>
                    </label>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    {{-- KOLOM KANAN --}}
    <div class="flex flex-col gap-5">

        {{-- POSTER --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Poster</h2>
            <p class="text-xs text-gray-400 mb-4">JPG / PNG, maks. 2MB</p>

            @if($webinar->poster_path)
                <img src="{{ asset('storage/' . $webinar->poster_path) }}"
                     id="posterCurrentImg"
                     class="w-full rounded-xl object-contain mb-3 border border-gray-100">
                <p class="text-xs text-gray-400 mb-3">Upload baru untuk mengganti poster lama</p>
            @endif

            <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-green-400 transition cursor-pointer"
                 onclick="document.getElementById('posterInput').click()">
                <div id="posterPreview" class="hidden mb-3">
                    <img id="posterImg" src="" alt="Preview" class="max-h-40 mx-auto rounded-lg object-contain">
                </div>
                <div id="posterPlaceholder">
                    <div class="text-2xl mb-1">🖼️</div>
                    <p class="text-xs text-gray-400">Klik untuk upload poster baru</p>
                </div>
                <input type="file" name="poster" id="posterInput" accept="image/jpg,image/jpeg,image/png"
                       class="hidden" onchange="previewImage(this, 'posterImg', 'posterPreview', 'posterPlaceholder')">
            </div>
            @error('poster')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
        </div>

        {{-- TEMPLATE SERTIFIKAT --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Template Sertifikat</h2>
            <p class="text-xs text-gray-400 mb-4">PNG / JPG, maks. 5MB</p>

            @if($webinar->certificate_template_path)
                <div class="flex items-center gap-2 bg-green-50 border border-green-100 rounded-xl px-3 py-2 mb-3">
                    <span class="text-green-600 text-xs">✅ Template sudah diupload</span>
                </div>
            @endif

            <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-green-400 transition cursor-pointer"
                 onclick="document.getElementById('certInput').click()">
                <div id="certPreviewBox" class="hidden mb-3">
                    <img id="certImg" src="" alt="Preview" class="max-h-40 mx-auto rounded-lg object-contain">
                </div>
                <div id="certPlaceholder">
                    <div class="text-2xl mb-1">🏆</div>
                    <p class="text-xs text-gray-400">
                        {{ $webinar->certificate_template_path ? 'Upload baru untuk mengganti' : 'Klik untuk upload template' }}
                    </p>
                </div>
                <input type="file" name="certificate_template" id="certInput"
                    accept="image/png,image/jpeg,image/jpg"
                    class="hidden"
                    onchange="handleNewCertUpload(this)">
            </div>
        </div>

        {{-- TOMBOL --}}
        <button type="submit"
                class="w-full text-white py-4 rounded-xl font-semibold text-sm transition hover:opacity-90"
                style="background:#1a4d2e;">
            Simpan Perubahan →
        </button>

        <a href="{{ route('admin.webinars.index') }}"
           class="block text-center border border-gray-200 text-gray-500 py-3 rounded-xl text-sm hover:bg-gray-50 transition">
            Batal
        </a>

    </div>
</div>

</form>

<script>
// Preview gambar sebelum upload
function previewImage(input, imgId, previewId, placeholderId) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById(imgId).src = e.target.result;
        document.getElementById(previewId).classList.remove('hidden');
        document.getElementById(placeholderId).classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

// Update preview template sertifikat di editor
function updateCertPreview(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('certPreview');
        if (preview) preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

// Klik pada gambar untuk pindah posisi marker
const container = document.getElementById('previewContainer');
const marker    = document.getElementById('nameMarker');
const inputX    = document.getElementById('inputX');
const inputY    = document.getElementById('inputY');
const manualX   = document.getElementById('manualX');
const manualY   = document.getElementById('manualY');

if (container) {
    container.addEventListener('click', function(e) {
        const rect   = container.getBoundingClientRect();
        const img    = document.getElementById('certPreview');
        const scaleX = img.naturalWidth  / img.offsetWidth;
        const scaleY = img.naturalHeight / img.offsetHeight;

        const clickX = Math.round((e.clientX - rect.left) * scaleX);
        const clickY = Math.round((e.clientY - rect.top)  * scaleY);

        inputX.value  = clickX;
        inputY.value  = clickY;
        manualX.value = clickX;
        manualY.value = clickY;

        marker.style.left = (e.clientX - rect.left) + 'px';
        marker.style.top  = (e.clientY - rect.top)  + 'px';
    });
}

// Input manual X/Y
if (manualX) manualX.addEventListener('input', function() {
    inputX.value = this.value;
    updateMarkerFromInputs();
});
if (manualY) manualY.addEventListener('input', function() {
    inputY.value = this.value;
    updateMarkerFromInputs();
});

function updateMarkerFromInputs() {
    if (!container || !marker) return;
    const img    = document.getElementById('certPreview');
    const scaleX = img.offsetWidth  / img.naturalWidth;
    const scaleY = img.offsetHeight / img.naturalHeight;
    marker.style.left = (manualX.value * scaleX) + 'px';
    marker.style.top  = (manualY.value * scaleY) + 'px';
}

// Ukuran font
const fontSize = document.getElementById('fontSize');
if (fontSize) fontSize.addEventListener('input', function() {
    const nameText = document.getElementById('namePreviewText');
    if (nameText) nameText.style.fontSize = (this.value * 0.5) + 'px';
});

// Warna
const colorPicker = document.getElementById('colorPicker');
const colorValue  = document.getElementById('colorValue');
if (colorPicker) colorPicker.addEventListener('input', function() {
    colorValue.value = this.value.replace('#', '');
    const nameText = document.getElementById('namePreviewText');
    if (nameText) nameText.style.color = this.value;
});

// Handle upload template baru di halaman edit
function handleNewCertUpload(input) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        // Update preview di card upload
        document.getElementById('certImg').src = e.target.result;
        document.getElementById('certPreviewBox').classList.remove('hidden');
        document.getElementById('certPlaceholder').classList.add('hidden');

        // Update preview di editor
        const certPreview = document.getElementById('certPreview');
        if (certPreview) {
            certPreview.src = e.target.result;
        }

        // Tampilkan editor kalau sebelumnya tersembunyi
        const editor = document.getElementById('certEditorSection');
        if (editor) editor.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

</script>

@endsection