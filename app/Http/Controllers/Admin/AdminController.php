<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Webinar;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalWebinar   = Webinar::count();
        $totalPeserta   = Registration::distinct('user_id')->count('user_id');
        $webinarUpcoming = Webinar::where('status', 'upcoming')->count();
        $webinarLive    = Webinar::where('status', 'live')->count();
        $webinarDone    = Webinar::where('status', 'done')->count();
        $webinarTerbaru = Webinar::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalWebinar', 'totalPeserta', 'webinarUpcoming',
            'webinarLive', 'webinarDone', 'webinarTerbaru'
        ));
    }
}