<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Ruang Praja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        :root {
            --bg-primary:     #ffffff;
            --bg-secondary:   #f9fafb;
            --bg-card:        #ffffff;
            --bg-hover:       #f3f4f6;
            --bg-sidebar:     #ffffff;
            --text-primary:   #111827;
            --text-secondary: #6b7280;
            --text-muted:     #9ca3af;
            --border-color:   #f3f4f6;
            --green-main:     #1a4d2e;
            --green-faint:    #f0f7f2;
            --shadow:         rgba(0,0,0,0.06);
        }

        html.dark {
            --bg-primary:     #0f1117;
            --bg-secondary:   #161b22;
            --bg-card:        #1c2128;
            --bg-hover:       #21262d;
            --bg-sidebar:     #13171f;
            --text-primary:   #e6edf3;
            --text-secondary: #8b949e;
            --text-muted:     #6e7681;
            --border-color:   #30363d;
            --green-main:     #2ea043;
            --green-faint:    #0d2b17;
            --shadow:         rgba(0,0,0,0.3);
        }

        body {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* SIDEBAR */
        .sidebar-base {
            background-color: var(--bg-sidebar);
            border-right-color: var(--border-color);
        }
        .sidebar-link {
            color: var(--text-secondary);
            transition: all 0.2s ease;
            border-radius: 0.75rem;
        }
        .sidebar-link:hover {
            background-color: var(--green-faint);
            color: var(--green-main);
        }
        .sidebar-link.active {
            background-color: var(--green-faint);
            color: var(--green-main);
            font-weight: 600;
        }

        /* TOPBAR */
        .topbar-base {
            background-color: var(--bg-card);
            border-bottom-color: var(--border-color);
        }

        /* CARDS & TABLES */
        html.dark .bg-white  { background-color: var(--bg-card)      !important; }
        html.dark .bg-gray-50 { background-color: var(--bg-secondary) !important; }
        html.dark .bg-gray-100 { background-color: var(--bg-hover)   !important; }
        html.dark .text-gray-900 { color: var(--text-primary)    !important; }
        html.dark .text-gray-800 { color: var(--text-primary)    !important; }
        html.dark .text-gray-700 { color: var(--text-secondary)  !important; }
        html.dark .text-gray-600 { color: var(--text-secondary)  !important; }
        html.dark .text-gray-500 { color: var(--text-muted)      !important; }
        html.dark .text-gray-400 { color: var(--text-muted)      !important; }
        html.dark .text-gray-300 { color: var(--text-muted)      !important; }
        html.dark .border-gray-50  { border-color: var(--border-color) !important; }
        html.dark .border-gray-100 { border-color: var(--border-color) !important; }
        html.dark .border-gray-200 { border-color: var(--border-color) !important; }
        html.dark .divide-gray-50 > * + *  { border-color: var(--border-color) !important; }
        html.dark .divide-gray-100 > * + * { border-color: var(--border-color) !important; }
        html.dark .hover\:bg-gray-50:hover  { background-color: var(--bg-hover) !important; }
        html.dark .hover\:bg-gray-100:hover { background-color: var(--bg-hover) !important; }

        /* INPUTS DARK */
        html.dark input,
        html.dark textarea,
        html.dark select {
            background-color: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }

        /* DARK MODE TOGGLE */
        #darkToggle {
            cursor: pointer;
            width: 40px; height: 22px;
            background: var(--border-color);
            border-radius: 999px;
            position: relative;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }
        #darkToggle .toggle-thumb {
            position: absolute;
            top: 3px; left: 3px;
            width: 16px; height: 16px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
        html.dark #darkToggle { background: var(--green-main); }
        html.dark #darkToggle .toggle-thumb { transform: translateX(18px); }

        .card-hover { transition: all 0.25s ease; }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--shadow);
        }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar-base w-64 min-h-screen flex flex-col fixed left-0 top-0 z-40 border-r"
           style="background-color:var(--bg-sidebar); border-color:var(--border-color);">

        <div class="p-6 border-b" style="border-color:var(--border-color);">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                     class="h-9 w-9 object-contain" onerror="this.style.display='none'">
                <div>
                    <div class="font-bold text-base" style="color:var(--text-primary);">Ruang Praja</div>
                    <div class="text-xs" style="color:var(--text-muted);">Panel Admin</div>
                </div>
            </a>
        </div>

        <div class="px-4 py-4 border-b" style="border-color:var(--border-color);">
            <div class="flex items-center gap-3 rounded-xl px-3 py-3" style="background:var(--bg-hover);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                     style="background:var(--green-main);">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="text-sm font-semibold truncate" style="color:var(--text-primary);">{{ Auth::user()->name }}</div>
                    <div class="text-xs" style="color:var(--text-muted);">Administrator</div>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 flex flex-col gap-1 overflow-y-auto">
            <p class="text-xs font-semibold uppercase tracking-widest px-3 mb-2" style="color:var(--text-muted);">Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="w-5 text-center">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.webinars.index') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm {{ request()->routeIs('admin.webinars.index') ? 'active' : '' }}">
                <span class="w-5 text-center">🎓</span> Kelola Program
            </a>
            <a href="{{ route('admin.webinars.create') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm {{ request()->routeIs('admin.webinars.create') ? 'active' : '' }}">
                <span class="w-5 text-center">➕</span> Tambah Program
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <span class="w-5 text-center">👥</span> Manajemen User
            </a>

            <div class="border-t my-3" style="border-color:var(--border-color);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest px-3 mb-2" style="color:var(--text-muted);">Lainnya</p>

            <a href="/" target="_blank"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm">
                <span class="w-5 text-center">🌐</span> Lihat Website
            </a>

            {{-- DARK MODE TOGGLE DI SIDEBAR --}}
            <div class="flex items-center gap-3 px-3 py-2.5">
                <span class="w-5 text-center text-sm" id="sidebarThemeIcon">🌙</span>
                <span class="text-sm flex-1" style="color:var(--text-secondary);">Dark Mode</span>
                <div id="darkToggle">
                    <div class="toggle-thumb"></div>
                </div>
            </div>
        </nav>

        <div class="p-4 border-t" style="border-color:var(--border-color);">
            <form method="POST" action="/logout">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 text-sm font-medium py-2.5 rounded-xl border transition hover:opacity-80"
                        style="color:#ef4444; border-color:#fecaca;">
                    🚪 Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <header class="topbar-base border-b px-8 py-4 flex justify-between items-center sticky top-0 z-30"
                style="background-color:var(--bg-card); border-color:var(--border-color);">
            <div>
                <h2 class="font-bold text-base" style="color:var(--text-primary); font-family:'Plus Jakarta Sans',sans-serif;">
                    @yield('page-title', 'Dashboard')
                </h2>
                <p class="text-xs mt-0.5" style="color:var(--text-muted);">Satpol PP Provinsi Jawa Timur</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <div class="text-sm font-medium" style="color:var(--text-primary);">{{ Auth::user()->name }}</div>
                    <div class="text-xs" style="color:var(--text-muted);">{{ now()->format('d M Y') }}</div>
                </div>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white text-sm font-bold"
                     style="background:var(--green-main);">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        @if(session('success') || session('error'))
        <div class="px-8 pt-5">
            @if(session('success'))
                <div class="flex items-center gap-3 border px-4 py-3 rounded-xl text-sm mb-1"
                     style="background:var(--green-faint); border-color:var(--green-main); color:var(--green-main);">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl text-sm mb-1">
                    ❌ {{ session('error') }}
                </div>
            @endif
        </div>
        @endif

        <main class="flex-1 px-8 py-7 pb-12">
            @yield('content')
        </main>

        <footer class="border-t text-center text-xs py-4"
                style="background-color:var(--bg-card); border-color:var(--border-color); color:var(--text-muted);">
            © {{ date('Y') }} Ruang Praja — Satpol PP Prov. Jawa Timur
        </footer>
    </div>

    <script>
        // DARK MODE
        const html             = document.documentElement;
        const toggle           = document.getElementById('darkToggle');
        const sidebarThemeIcon = document.getElementById('sidebarThemeIcon');

        function applyTheme(theme) {
            if (theme === 'dark') {
                html.classList.add('dark');
                html.classList.remove('light');
                if (sidebarThemeIcon) sidebarThemeIcon.textContent = '☀️';
            } else {
                html.classList.remove('dark');
                html.classList.add('light');
                if (sidebarThemeIcon) sidebarThemeIcon.textContent = '🌙';
            }
            localStorage.setItem('theme', theme);
        }

        applyTheme(localStorage.getItem('theme') || 'light');

        if (toggle) {
            toggle.addEventListener('click', () => {
                applyTheme(html.classList.contains('dark') ? 'light' : 'dark');
            });
        }
    </script>

</body>
</html>