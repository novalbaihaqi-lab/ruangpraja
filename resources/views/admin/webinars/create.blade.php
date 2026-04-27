@extends('admin.layouts.app')

@section('page-title', 'Tambah Program')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.webinars.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-700 transition mb-4">
        ← Kembali
    </a>
    <span class="block text-xs font-semibold uppercase tracking-widest text-green-700">Program Baru</span>
    <h1 class="text-3xl font-bold text-gray-900 mt-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
        Tambah Program
    </h1>
</div>

<form method="POST" action="{{ route('admin.webinars.store') }}" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- KOLOM KIRI: INFO UTAMA --}}
    <div class="lg:col-span-2 flex flex-col gap-5">

        {{-- INFO DASAR --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-5 pb-4 border-b border-gray-50" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Informasi Program
            </h2>
            <div class="flex flex-col gap-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Program <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('title') border-red-300 @enderror"
                           placeholder="Contoh: Kejarsiroma Seri 12 — Tema Webinar">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Pembicara / Narasumber <span class="text-red-400">*</span></label>
                    <input type="text" name="speaker" value="{{ old('speaker') }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('speaker') border-red-300 @enderror"
                           placeholder="Nama lengkap dan gelar pembicara">
                    @error('speaker')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="5" required
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('description') border-red-300 @enderror"
                              placeholder="Deskripsi singkat tentang program ini...">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal & Jam <span class="text-red-400">*</span></label>
                        <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition @error('scheduled_at') border-red-300 @enderror">
                        @error('scheduled_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kuota Peserta</label>
                        <input type="number" name="quota" value="{{ old('quota') }}" min="1"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition"
                               placeholder="Kosongkan = tak terbatas">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status <span class="text-red-400">*</span></label>
                    <select name="status" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white transition">
                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>🕐 Upcoming</option>
                        <option value="live"     {{ old('status') == 'live'     ? 'selected' : '' }}>🔴 Live</option>
                        <option value="done"     {{ old('status') == 'done'     ? 'selected' : '' }}>✅ Selesai</option>
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
                        <input type="url" name="zoom_link" value="{{ old('zoom_link') }}"
                               class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                               placeholder="https://zoom.us/j/...">
                    </div>
                    @error('zoom_link')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Dokumentasi</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📸</span>
                        <input type="text" name="documentation_url" value="{{ old('documentation_url') }}"
                               class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                               placeholder="https://drive.google.com/... atau URL lainnya">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Materi</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📚</span>
                        <input type="text" name="materi_url" value="{{ old('materi_url') }}"
                            class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                            placeholder="https://drive.google.com/... atau URL materi lainnya">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Survey Kepuasan</label>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-xl bg-gray-50 focus-within:ring-2 focus-within:ring-green-700 focus-within:bg-white transition overflow-hidden">
                        <span class="pl-4 text-gray-400 text-sm">📝</span>
                        <input type="url" name="survey_url" value="{{ old('survey_url') }}"
                            class="flex-1 px-3 py-3 text-sm bg-transparent focus:outline-none"
                            placeholder="https://link-survey-kepuasan.com">
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- KOLOM KANAN: UPLOAD --}}
    <div class="flex flex-col gap-5">

        {{-- POSTER --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">Poster</h2>
            <p class="text-xs text-gray-400 mb-5">JPG / PNG, maks. 2MB</p>

            <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-green-400 transition cursor-pointer"
                 onclick="document.getElementById('posterInput').click()">
                <div id="posterPreview" class="hidden mb-3">
                    <img id="posterImg" src="" alt="Preview" class="max-h-48 mx-auto rounded-lg object-contain">
                </div>
                <div id="posterPlaceholder">
                    <div class="text-3xl mb-2">🖼️</div>
                    <p class="text-xs text-gray-400">Klik untuk upload poster</p>
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

    <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-green-400 transition cursor-pointer"
         onclick="document.getElementById('certInput').click()">
        <div id="certPreviewBox" class="hidden mb-3">
            <img id="certImg" src="" alt="Preview" class="max-h-48 mx-auto rounded-lg object-contain">
        </div>
        <div id="certPlaceholder">
            <div class="text-2xl mb-1">🏆</div>
            <p class="text-xs text-gray-400">Klik untuk upload template sertifikat</p>
        </div>
        <input type="file" name="certificate_template" id="certInput"
               accept="image/png,image/jpeg,image/jpg"
               class="hidden"
               onchange="handleCertUpload(this)">
    </div>
</div>

{{-- EDITOR POSISI NAMA (muncul setelah upload) --}}
<div id="certEditor" class="bg-white border border-gray-100 rounded-2xl p-6 hidden">
    <h2 class="font-bold text-gray-900 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
        Editor Posisi Nama
    </h2>
    <p class="text-xs text-gray-400 mb-4">Klik pada preview untuk menentukan posisi nama peserta</p>

    <div class="border border-dashed border-gray-200 rounded-xl overflow-hidden cursor-crosshair mb-3 relative"
         id="previewContainer">
        <img id="certPreview" src="" class="w-full block" alt="Preview Sertifikat">
        <div id="nameMarker" style="position:absolute; transform:translate(-50%,-50%); pointer-events:none; left:50%; top:50%;">
            <div style="background:rgba(26,77,46,0.1); border:2px dashed #1a4d2e; border-radius:6px; padding:2px 10px; white-space:nowrap;">
                <span id="namePreviewText" style="font-family:serif; color:#000000; font-size:18px;">
                    Nama Peserta
                </span>
            </div>
        </div>
    </div>
    <p class="text-xs text-gray-400 mb-4">👆 Klik di atas template untuk memindahkan posisi nama</p>

    <input type="hidden" name="cert_name_x" id="inputX" value="421">
    <input type="hidden" name="cert_name_y" id="inputY" value="297">

    <div class="grid grid-cols-3 gap-3 mb-4">
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1.5">Posisi X</label>
            <input type="number" id="manualX" value="421"
                   class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1.5">Posisi Y</label>
            <input type="number" id="manualY" value="297"
                   class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1.5">Ukuran Font</label>
            <input type="number" name="cert_name_size" id="fontSize" value="36"
                   class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:bg-white"
                   min="10" max="150">
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-xs font-medium text-gray-500 mb-1.5">Warna Teks Nama</label>
        <div class="flex items-center gap-3">
            <input type="color" id="colorPicker" value="#000000"
                   class="w-10 h-10 border border-gray-200 rounded-lg cursor-pointer">
            <input type="hidden" name="cert_name_color" id="colorValue" value="000000">
            <span class="text-xs text-gray-400">Pilih warna teks nama peserta</span>
        </div>
    </div>

    {{-- PILIHAN FONT --}}
    <div>
        <label class="block text-xs font-medium text-gray-500 mb-3">Pilih Font</label>
        <div class="flex flex-col gap-2">
            @php
            $fonts = [
                ['file' => 'GreatVibes-Regular.ttf',     'label' => 'Great Vibes',     'style' => 'italic'],
                ['file' => 'Poppins-Regular.ttf',         'label' => 'Poppins',          'style' => 'normal'],
                ['file' => 'PlayfairDisplay-Regular.ttf', 'label' => 'Playfair Display', 'style' => 'normal'],
                ['file' => 'DancingScript-Regular.ttf',   'label' => 'Dancing Script',   'style' => 'italic'],
                ['file' => 'Montserrat-Regular.ttf',      'label' => 'Montserrat',       'style' => 'normal'],
            ];
            @endphp
            @foreach($fonts as $font)
            <label class="flex items-center justify-between border rounded-xl px-4 py-2.5 cursor-pointer hover:border-green-400 hover:bg-green-50 transition
                          {{ $loop->first ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                <div class="flex items-center gap-3">
                    <input type="radio" name="cert_font" value="{{ $font['file'] }}"
                           class="text-green-700"
                           {{ $loop->first ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">{{ $font['label'] }}</span>
                </div>
                <span class="text-sm text-gray-400" style="font-style:{{ $font['style'] }};">Nama Peserta</span>
            </label>
            @endforeach
        </div>
    </div>
</div>

        {{-- TOMBOL SIMPAN --}}
        <button type="submit"
                class="w-full text-white py-4 rounded-xl font-semibold text-sm transition hover:opacity-90"
                style="background:#1a4d2e;">
            Simpan Program →
        </button>

        <a href="{{ route('admin.webinars.index') }}"
           class="block text-center border border-gray-200 text-gray-500 py-3 rounded-xl text-sm hover:bg-gray-50 transition">
            Batal
        </a>

    </div>
</div>

</form>

<script>
// Preview gambar poster
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

// Handle upload template sertifikat
function handleCertUpload(input) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        // Tampilkan preview di card upload
        document.getElementById('certImg').src = e.target.result;
        document.getElementById('certPreviewBox').classList.remove('hidden');
        document.getElementById('certPlaceholder').classList.add('hidden');

        // Tampilkan preview di editor
        document.getElementById('certPreview').src = e.target.result;

        // Tampilkan editor
        document.getElementById('certEditor').classList.remove('hidden');

        // Reset marker ke tengah setelah gambar load
        const img = document.getElementById('certPreview');
        img.onload = function() {
            const container = document.getElementById('previewContainer');
            const cx = container.offsetWidth / 2;
            const cy = container.offsetHeight / 2;
            document.getElementById('nameMarker').style.left = cx + 'px';
            document.getElementById('nameMarker').style.top  = cy + 'px';
        };
    };
    reader.readAsDataURL(file);
}

// Klik pada preview untuk pindah posisi
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
</script>

@endsection