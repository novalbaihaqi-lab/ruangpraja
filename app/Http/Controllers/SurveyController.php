<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    public function upload(Request $request, Webinar $webinar)
    {
        $request->validate([
            'survey_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'survey_proof.required' => 'Bukti survey wajib diupload.',
            'survey_proof.mimes'    => 'Format file harus JPG, PNG, atau PDF.',
            'survey_proof.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $registration = Registration::where('user_id', Auth::id())
                                    ->where('webinar_id', $webinar->id)
                                    ->firstOrFail();

        if ($registration->survey_proof_path) {
            Storage::disk('public')->delete($registration->survey_proof_path);
        }

        $path = $request->file('survey_proof')->store('survey-proofs', 'public');

        $registration->update([
            'survey_proof_path' => $path,
        ]);

        return back()->with('success', 'Bukti survey berhasil diupload! Sertifikat sudah bisa digenerate. 🏆');
    }
}