<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::withCount('registrations')->latest()->get();
        return view('admin.webinars.index', compact('webinars'));
    }

    public function create()
    {
        return view('admin.webinars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'required|string',
            'speaker'              => 'required|string|max:255',
            'scheduled_at'         => 'required|date',
            'quota'                => 'nullable|integer|min:1',
            'status'               => 'required|in:upcoming,live,done',
            'zoom_link'            => 'nullable|url',
            'documentation_url'    => 'nullable',
            'poster'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certificate_template' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'title', 'description', 'speaker', 'scheduled_at',
            'quota', 'status', 'zoom_link', 'documentation_url', 'survey_url', 'materi_url'
        ]);

        $data['cert_name_x']     = $request->cert_name_x ?? 421;
        $data['cert_name_y']     = $request->cert_name_y ?? 297;
        $data['cert_name_size']  = $request->cert_name_size ?? 36;
        $data['cert_name_color'] = ltrim($request->cert_name_color ?? '000000', '#');
        $data['cert_font']       = $request->cert_font ?? 'GreatVibes-Regular.ttf';

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        if ($request->hasFile('certificate_template')) {
            $data['certificate_template_path'] = $request->file('certificate_template')->store('certificates', 'public');
        }

        Webinar::create($data);

        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil ditambahkan!');
    }

    public function edit(Webinar $webinar)
    {
        return view('admin.webinars.edit', compact('webinar'));
    }

    public function update(Request $request, Webinar $webinar)
    {
        $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'required|string',
            'speaker'              => 'required|string|max:255',
            'scheduled_at'         => 'required|date',
            'quota'                => 'nullable|integer|min:1',
            'status'               => 'required|in:upcoming,live,done',
            'zoom_link'            => 'nullable|url',
            'documentation_url'    => 'nullable',
            'poster'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certificate_template' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'title', 'description', 'speaker', 'scheduled_at',
            'quota', 'status', 'zoom_link', 'documentation_url', 'survey_url', 'materi_url'
        ]);

        $data['cert_name_x']     = $request->cert_name_x ?? $webinar->cert_name_x;
        $data['cert_name_y']     = $request->cert_name_y ?? $webinar->cert_name_y;
        $data['cert_name_size']  = $request->cert_name_size ?? $webinar->cert_name_size;
        $data['cert_name_color'] = ltrim($request->cert_name_color ?? $webinar->cert_name_color, '#');
        $data['cert_font']       = $request->cert_font ?? $webinar->cert_font;

        if ($request->hasFile('poster')) {
            if ($webinar->poster_path) Storage::disk('public')->delete($webinar->poster_path);
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        if ($request->hasFile('certificate_template')) {
            if ($webinar->certificate_template_path) Storage::disk('public')->delete($webinar->certificate_template_path);
            $data['certificate_template_path'] = $request->file('certificate_template')->store('certificates', 'public');
        }

        $webinar->update($data);

        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil diperbarui!');
    }

    public function destroy(Webinar $webinar)
    {
        if ($webinar->poster_path) Storage::disk('public')->delete($webinar->poster_path);
        if ($webinar->certificate_template_path) Storage::disk('public')->delete($webinar->certificate_template_path);
        $webinar->delete();
        return redirect()->route('admin.webinars.index')->with('success', 'Webinar berhasil dihapus!');
    }

    public function participants(Webinar $webinar)
    {
        $registrations = Registration::with('user')->where('webinar_id', $webinar->id)->get();
        return view('admin.webinars.participants', compact('webinar', 'registrations'));
    }
}