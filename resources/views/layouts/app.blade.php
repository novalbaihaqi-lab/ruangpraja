<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Praja — Satpol PP Provinsi Jawa Timur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, .serif { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ============================================
           DARK MODE VARIABLES
        ============================================ */
        :root {
            --bg-primary:     #ffffff;
            --bg-secondary:   #f5f5f3;
            --bg-card:        #ffffff;
            --bg-hover:       #f9fafb;
            --text-primary:   #111827;
            --text-secondary: #6b7280;
            --text-muted:     #9ca3af;
            --border-color:   #f3f4f6;
            --border-input:   #e5e7eb;
            --navbar-bg:      rgba(255,255,255,0.85);
            --green-main:     #1a4d2e;
            --green-light:    #d4edda;
            --green-faint:    #f0f7f2;
            --shadow:         rgba(0,0,0,0.08);
        }

        html.dark {
            --bg-primary:     #0f1117;
            --bg-secondary:   #161b22;
            --bg-card:        #1c2128;
            --bg-hover:       #21262d;
            --text-primary:   #e6edf3;
            --text-secondary: #8b949e;
            --text-muted:     #6e7681;
            --border-color:   #30363d;
            --border-input:   #30363d;
            --navbar-bg:      rgba(15,17,23,0.85);
            --green-main:     #2ea043;
            --green-light:    #0d2b17;
            --green-faint:    #0d2b17;
            --shadow:         rgba(0,0,0,0.3);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* NAVBAR */
        .navbar-base {
            background-color: var(--bg-primary);
            border-bottom-color: var(--border-color);
            transition: all 0.3s ease;
        }
        #mainNavbar.scrolled {
            background: var(--navbar-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 4px 24px var(--shadow);
            border-bottom: none !important;
        }

        /* TOPBAR */
        .topbar-base {
            background-color: var(--bg-primary);
            border-bottom-color: var(--border-color);
        }

        /* CARDS */
        .card-base {
            background-color: var(--bg-card);
            border-color: var(--border-color);
        }
        .card-hover {
            transition: all 0.25s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px var(--shadow);
        }

        /* SECTION BG */
        .section-secondary {
            background-color: var(--bg-secondary);
        }

        /* TEXT */
        .text-base-primary   { color: var(--text-primary); }
        .text-base-secondary { color: var(--text-secondary); }
        .text-base-muted     { color: var(--text-muted); }

        /* BORDER */
        .border-base { border-color: var(--border-color); }

        /* INPUTS */
        .input-base {
            background-color: var(--bg-secondary);
            border-color: var(--border-input);
            color: var(--text-primary);
        }
        .input-base:focus {
            background-color: var(--bg-card);
            outline: none;
            ring: 2px solid var(--green-main);
        }
        .input-base::placeholder { color: var(--text-muted); }

        /* FOOTER */
        .footer-base {
            border-top-color: var(--border-color);
        }

        /* BUTTONS */
        .btn-primary {
            background: var(--green-main);
            color: white;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px var(--shadow);
        }
        .btn-outline {
            border: 1.5px solid var(--green-main);
            color: var(--green-main);
            transition: all 0.2s ease;
        }
        .btn-outline:hover {
            background: var(--green-main);
            color: white;
        }

        /* NAV LINK */
        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: var(--green-main);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* RUNNING TEXT */
        .running-text-wrapper { display: flex; width: max-content; }
        .running-text-track {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding-right: 2rem;
            animation: marquee 30s linear infinite;
            white-space: nowrap;
            flex-shrink: 0;
        }
        @keyframes marquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .running-text-wrapper:hover .running-text-track {
            animation-play-state: paused;
        }

        /* ANIMASI SCROLL */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal-scale.visible { opacity: 1; transform: scale(1); }
        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }
        .delay-500 { transition-delay: 0.5s; }

        /* NAVBAR SCROLL */
        #mainNavbar { transition: all 0.3s ease; }
        #mainNavbar.scrolled {
            background: var(--navbar-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 1px 20px var(--shadow);
            border-bottom-color: transparent !important;
        }

        /* TYPING */
        #typingWrapper { display: block; min-height: 1.3em; overflow: visible; }
        #rotatingText {
            display: inline;
            white-space: normal;
            word-break: break-word;
            border-right: 3px solid var(--green-main);
            animation: blink 0.7s step-end infinite;
        }
        @keyframes blink {
            0%, 100% { border-color: var(--green-main); }
            50%       { border-color: transparent; }
        }

        /* DARK MODE TOGGLE */
        #darkToggle {
            cursor: pointer;
            width: 40px;
            height: 22px;
            background: var(--border-input);
            border-radius: 999px;
            position: relative;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }
        #darkToggle .toggle-thumb {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 16px;
            height: 16px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease, background 0.3s ease;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
        html.dark #darkToggle {
            background: var(--green-main);
        }
        html.dark #darkToggle .toggle-thumb {
            transform: translateX(18px);
        }

        /* CUSTOM CURSOR */
        #cursor {
            position: fixed;
            width: 10px; height: 10px;
            background: var(--green-main);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
            transform: translate(-50%, -50%);
        }
        #cursorFollower {
            position: fixed;
            width: 36px; height: 36px;
            border: 1.5px solid var(--green-main);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            opacity: 0.5;
            transition: transform 0.15s ease, width 0.3s ease, height 0.3s ease, opacity 0.3s ease, background 0.3s ease;
            transform: translate(-50%, -50%);
        }

        /* DARK: override specific Tailwind colors */
        html.dark .bg-white { background-color: var(--bg-card) !important; }
        html.dark .bg-gray-50 { background-color: var(--bg-secondary) !important; }
        html.dark .bg-gray-100 { background-color: var(--bg-hover) !important; }
        html.dark .text-gray-900 { color: var(--text-primary) !important; }
        html.dark .text-gray-800 { color: var(--text-primary) !important; }
        html.dark .text-gray-700 { color: var(--text-secondary) !important; }
        html.dark .text-gray-600 { color: var(--text-secondary) !important; }
        html.dark .text-gray-500 { color: var(--text-muted) !important; }
        html.dark .text-gray-400 { color: var(--text-muted) !important; }
        html.dark .border-gray-100 { border-color: var(--border-color) !important; }
        html.dark .border-gray-200 { border-color: var(--border-color) !important; }
        html.dark .divide-gray-50 > * + * { border-color: var(--border-color) !important; }
        html.dark .divide-gray-100 > * + * { border-color: var(--border-color) !important; }
        html.dark .hover\:bg-gray-50:hover { background-color: var(--bg-hover) !important; }
        html.dark .hover\:bg-gray-100:hover { background-color: var(--bg-hover) !important; }


    </style>

    {{-- Cegah flash saat load --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="min-h-screen" style="background-color: var(--bg-primary); color: var(--text-primary);">

    {{-- TOPBAR --}}
    <div class="border-b border-gray-100 bg-white">
       {{-- RUNNING TEXT --}}
        <div class="overflow-hidden py-3 border-b" style="background:var(--bg-secondary); border-color:var(--border-color);">
            <div class="running-text-wrapper flex whitespace-nowrap">
                @for($i = 0; $i < 3; $i++)
                <div class="running-text-track flex items-center gap-8 px-4 animate-marquee">
                    <span class="flex items-center gap-2 text-sm font-medium" style="color:var(--text-secondary);">
                        <span style="color:var(--green-main);">●</span>
                        Tingkatkan kompetensi bersama <strong style="color:var(--text-primary);">Satpol PP Prov. Jawa Timur</strong>
                    </span>
                    <span style="color:var(--border-color);">|</span>
                    <span class="flex items-center gap-2 text-sm font-medium" style="color:var(--text-secondary);">
                        <span style="color:var(--green-main);">●</span>
                        Akses materi & dokumentasi webinar <strong style="color:var(--text-primary);">kapan saja</strong>
                    </span>
                    <span style="color:var(--border-color);">|</span>
                    <span class="flex items-center gap-2 text-sm font-medium" style="color:var(--text-secondary);">
                        <span style="color:var(--green-main);">●</span>
                        Ikuti Webinar Mingguan <strong style="color:var(--text-primary);">Kejarsiroma</strong> setiap Jumat pukul 13.00 WIB
                    </span>
                    <span style="color:var(--border-color);">|</span>
                    <span class="flex items-center gap-2 text-sm font-medium" style="color:var(--text-secondary);">
                        <span style="color:var(--green-main);">●</span>
                        Daftar sekarang dan dapatkan <strong style="color:var(--text-primary);">sertifikat resmi</strong> secara gratis
                    </span>
                    <span style="color:var(--border-color);">|</span>
                </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav id="mainNavbar" class="sticky top-0 z-50 border-b"
         style="background-color:var(--bg-primary); border-color:var(--border-color);">
        <div class="nav-inner max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Satpol PP"
                     class="h-10 w-10 object-contain" onerror="this.style.display='none'">
                <div>
                    <div class="font-bold text-xl" style="color:var(--text-primary);">Ruang Praja</div>
                    <div class="text-xs -mt-0.5" style="color:var(--text-muted);">Satpol PP Prov. Jawa Timur</div>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="nav-link text-sm font-medium transition" style="color:var(--text-secondary);">Beranda</a>
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="/admin/dashboard" class="nav-link text-sm font-medium transition" style="color:var(--text-secondary);">Panel Admin</a>
                    @else
                        <a href="/dashboard" class="nav-link text-sm font-medium transition" style="color:var(--text-secondary);">Dashboard</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center gap-3">
                {{-- DARK MODE TOGGLE --}}
                <div id="darkToggle" title="Toggle Dark Mode">
                    <div class="toggle-thumb"></div>
                </div>
                <span class="text-sm hidden md:block" style="color:var(--text-muted);">
                    <span id="themeIcon">🌙</span>
                </span>

                @auth
                    <span class="text-sm hidden md:block" style="color:var(--text-muted);">{{ Auth::user()->name }}</span>
                    <a href="{{ route('profile.edit') }}"
                    class="hidden md:flex items-center gap-2 text-sm font-medium transition hover:opacity-80"
                    style="color:var(--text-secondary);">
                        👤 Profil
                    </a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn-outline text-sm px-4 py-2 rounded-lg font-medium">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-medium transition" style="color:var(--text-secondary);">Masuk</a>
                    <a href="/register" class="btn-primary text-sm px-5 py-2.5 rounded-lg font-medium">Daftar →</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGE --}}
    @if(session('success') || session('error'))
    <div class="max-w-6xl mx-auto px-6 pt-4">
        @if(session('success'))
            <div class="flex items-center gap-3 border px-4 py-3 rounded-xl text-sm"
                 style="background:var(--green-faint); border-color:var(--green-main); color:var(--green-main);">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>
    @endif

    {{-- KONTEN --}}
    <main class="max-w-6xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="border-t mt-20" style="border-color:var(--border-color);">
        <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain" onerror="this.style.display='none'">
                    <div class="font-bold text-lg" style="color:var(--text-primary);">Ruang Praja</div>
                </div>
                <p class="text-sm leading-relaxed" style="color:var(--text-muted);">
                    Platform pembelajaran digital Satpol PP Provinsi Jawa Timur untuk webinar Kejarsiroma dan Diklat.
                </p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider" style="color:var(--text-primary);">Navigasi</h4>
                <ul class="flex flex-col gap-2 text-sm" style="color:var(--text-muted);">
                    <li><a href="/" class="hover:opacity-80 transition">Beranda</a></li>
                    <li><a href="/login" class="hover:opacity-80 transition">Masuk</a></li>
                    <li><a href="/register" class="hover:opacity-80 transition">Daftar Akun</a></li>
                    <li><a href="/dashboard" class="hover:opacity-80 transition">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider" style="color:var(--text-primary);">Kontak</h4>
                <ul class="flex flex-col gap-2 text-sm" style="color:var(--text-muted);">
                    <li>📍 Jl. Jagir Wonokromo No. 352, Surabaya</li>
                    <li>📧 jks.satpolpp@jatimprov.go.id</li>
                    <li>📞 +62 811 3516 499 (Call Sigap)</li>
                </ul>
            </div>
        </div>
        <div class="border-t text-center text-xs py-5" style="border-color:var(--border-color); color:var(--text-muted);">
            © {{ date('Y') }} Ruang Praja — Satuan Polisi Pamong Praja Provinsi Jawa Timur
        </div>
    </footer>

    {{-- CUSTOM CURSOR --}}
    <div id="cursor"></div>
    <div id="cursorFollower"></div>

    <script>
        // ============ DARK MODE ============
        const html      = document.documentElement;
        const toggle    = document.getElementById('darkToggle');
        const themeIcon = document.getElementById('themeIcon');

        function applyTheme(theme) {
            if (theme === 'dark') {
                html.classList.add('dark');
                html.classList.remove('light');
                if (themeIcon) themeIcon.textContent = '☀️';
            } else {
                html.classList.remove('dark');
                html.classList.add('light');
                if (themeIcon) themeIcon.textContent = '🌙';
            }
            localStorage.setItem('theme', theme);
        }

        // Load saved theme
        applyTheme(localStorage.getItem('theme') || 'light');

        // Toggle click
        if (toggle) {
            toggle.addEventListener('click', () => {
                const isDark = html.classList.contains('dark');
                applyTheme(isDark ? 'light' : 'dark');
            });
        }

        // ============ SCROLL REVEAL ============
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
            observer.observe(el);
        });

        // ============ NAVBAR BLUR ON SCROLL ============
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ============ CUSTOM CURSOR ============
        const cursor         = document.getElementById('cursor');
        const cursorFollower = document.getElementById('cursorFollower');
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top  = mouseY + 'px';
        });

        function animateFollower() {
            followerX += (mouseX - followerX) * 0.12;
            followerY += (mouseY - followerY) * 0.12;
            cursorFollower.style.left = followerX + 'px';
            cursorFollower.style.top  = followerY + 'px';
            requestAnimationFrame(animateFollower);
        }
        animateFollower();

        document.querySelectorAll('a, button, [onclick], input, textarea, select, label').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform          = 'translate(-50%, -50%) scale(0)';
                cursorFollower.style.width      = '56px';
                cursorFollower.style.height     = '56px';
                cursorFollower.style.opacity    = '0.15';
                cursorFollower.style.background = 'var(--green-main)';
            });
            el.addEventListener('mouseleave', () => {
                cursor.style.transform          = 'translate(-50%, -50%) scale(1)';
                cursorFollower.style.width      = '36px';
                cursorFollower.style.height     = '36px';
                cursorFollower.style.opacity    = '0.5';
                cursorFollower.style.background = 'transparent';
            });
        });

        document.addEventListener('mousedown', () => {
            cursor.style.transform         = 'translate(-50%, -50%) scale(0.6)';
            cursorFollower.style.transform = 'translate(-50%, -50%) scale(0.8)';
        });
        document.addEventListener('mouseup', () => {
            cursor.style.transform         = 'translate(-50%, -50%) scale(1)';
            cursorFollower.style.transform = 'translate(-50%, -50%) scale(1)';
        });

        document.body.style.cursor = 'none';
        document.querySelectorAll('a, button, input, textarea, select').forEach(el => {
            el.style.cursor = 'none';
        });
    </script>

</body>
</html>