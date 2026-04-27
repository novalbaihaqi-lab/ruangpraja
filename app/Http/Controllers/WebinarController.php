<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars     = Webinar::latest()->get();
        $totalPeserta = \App\Models\Registration::distinct('user_id')->count('user_id');
        return view('welcome', compact('webinars', 'totalPeserta'));
    }

    public function show(Webinar $webinar)
    {
        $webinar->load('registrations');
        return view('webinars.show', compact('webinar'));
    }
}