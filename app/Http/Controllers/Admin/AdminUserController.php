<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::withCount('registrations')
                     ->when($search, function ($query) use ($search) {
                         $query->where('name', 'like', "%$search%")
                               ->orWhere('email', 'like', "%$search%");
                     })
                     ->latest()
                     ->paginate(10);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function updateRole(User $user, Request $request)
    {
        // Jangan ubah role diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akun sendiri!');
        }

        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        $label = $request->role === 'admin' ? 'Admin' : 'Peserta';

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$label}!");
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Kamu tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', "Akun {$user->name} berhasil dihapus!");
    }
}