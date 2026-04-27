<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Webinar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function store(Webinar $webinar)
    {
        $sudahDaftar = Registration::where('user_id', Auth::id())
                                   ->where('webinar_id', $webinar->id)
                                   ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Kamu sudah terdaftar di webinar ini!');
        }

        if ($webinar->quota && $webinar->registrations()->count() >= $webinar->quota) {
            return back()->with('error', 'Maaf, kuota webinar sudah penuh!');
        }

        Registration::create([
            'user_id'    => Auth::id(),
            'webinar_id' => $webinar->id,
        ]);

        return back()->with('success', 'Berhasil mendaftar webinar! Selamat bergabung 🎉');
    }

    public function generateCertificate(Webinar $webinar)
    {
        $registration = Registration::where('user_id', Auth::id())
                                    ->where('webinar_id', $webinar->id)
                                    ->firstOrFail();

        if ($webinar->status != 'done') {
            return back()->with('error', 'Sertifikat hanya bisa digenerate setelah webinar selesai.');
        }

        if (!$webinar->certificate_template_path) {
            return back()->with('error', 'Template sertifikat belum diupload oleh admin.');
        }

        if (!$registration->certificate_number) {
            $registration->update([
                'certificate_number'       => 'CERT-' . strtoupper(uniqid()),
                'certificate_generated_at' => now(),
            ]);
        }

        return redirect()->route('certificate.download', $webinar)
                         ->with('success', 'Sertifikat berhasil digenerate! 🏆');
    }

    public function downloadCertificate(Webinar $webinar)
    {
        $registration = Registration::where('user_id', Auth::id())
                                    ->where('webinar_id', $webinar->id)
                                    ->firstOrFail();

        if (!$registration->certificate_number) {
            return redirect()->route('certificate.generate', $webinar);
        }

        $templatePath = Storage::disk('public')->path($webinar->certificate_template_path);
        $image        = \Image::make($templatePath);

        // Mapping font
        $fontMap = [
            'GreatVibes-Regular.ttf'      => 'GreatVibes-Regular.ttf',
            'Poppins-Regular.ttf'         => 'Poppins-Regular.ttf',
            'PlayfairDisplay-Regular.ttf' => 'PlayfairDisplay-Regular.ttf',
            'DancingScript-Regular.ttf'   => 'DancingScript-Regular.ttf',
            'Montserrat-Regular.ttf'      => 'Montserrat-Regular.ttf',
            'PlusJakartaSans-Regular.ttf' => 'PlusJakartaSans-Regular.ttf',
        ];

        $fontFile = $fontMap[$webinar->cert_font] ?? 'Poppins-Regular.ttf';
        $fontPath = public_path('fonts/' . $fontFile);

        if (!file_exists($fontPath)) {
            $fontPath = public_path('fonts/Poppins-Regular.ttf');
        }

        $fontSize  = (int) $webinar->cert_name_size;
        $color     = '#' . ltrim($webinar->cert_name_color, '#');
        $name      = Auth::user()->name;
        $x         = (int) $webinar->cert_name_x;
        $y         = (int) $webinar->cert_name_y;

        $image->text($name, $x, $y, function ($font) use ($fontPath, $fontSize, $color) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->align('center');
            $font->valign('middle');
            $font->color($color);
        });

        $filename = 'Sertifikat-' . str_replace(' ', '-', $name) . '.png';

        return $image->response('png')->withHeaders([
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function dashboard()
    {
        $registrations = Registration::with('webinar')
                                     ->where('user_id', Auth::id())
                                     ->latest()
                                     ->get();

        return view('dashboard', compact('registrations'));
    }
}