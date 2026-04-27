<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            width: 842px;
            height: 595px;
            font-family: 'Georgia', serif;
            background: #fff;
            overflow: hidden;
        }

        .certificate {
            width: 842px;
            height: 595px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #1d4ed8 100%);
        }

        .border-outer {
            position: absolute;
            inset: 12px;
            border: 3px solid rgba(255,255,255,0.4);
            border-radius: 8px;
        }

        .border-inner {
            position: absolute;
            inset: 20px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 6px;
        }

        .content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            padding: 40px;
        }

        .logo {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .platform-name {
            font-size: 14px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            margin-bottom: 24px;
        }

        .cert-title {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 6px;
            color: #fbbf24;
        }

        .cert-subtitle {
            font-size: 12px;
            letter-spacing: 3px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 28px;
            text-transform: uppercase;
        }

        .given-to {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .participant-name {
            font-size: 42px;
            font-style: italic;
            color: #fbbf24;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(251,191,36,0.4);
            padding-bottom: 12px;
            display: inline-block;
            min-width: 400px;
        }

        .webinar-label {
            font-size: 12px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .webinar-title {
            font-size: 20px;
            font-weight: bold;
            color: white;
            margin-bottom: 6px;
        }

        .webinar-date {
            font-size: 12px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 28px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            width: 600px;
            margin: 0 auto;
        }

        .cert-number {
            font-size: 10px;
            color: rgba(255,255,255,0.4);
            text-align: left;
        }

        .signature {
            text-align: center;
        }

        .signature-line {
            width: 140px;
            border-top: 1px solid rgba(255,255,255,0.4);
            margin: 0 auto 4px;
        }

        .signature-name {
            font-size: 12px;
            color: rgba(255,255,255,0.8);
            font-weight: bold;
        }

        .signature-role {
            font-size: 10px;
            color: rgba(255,255,255,0.5);
        }

        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            opacity: 0.3;
        }
        .corner-tl { top: 30px; left: 30px; border-top: 3px solid white; border-left: 3px solid white; }
        .corner-tr { top: 30px; right: 30px; border-top: 3px solid white; border-right: 3px solid white; }
        .corner-bl { bottom: 30px; left: 30px; border-bottom: 3px solid white; border-left: 3px solid white; }
        .corner-br { bottom: 30px; right: 30px; border-bottom: 3px solid white; border-right: 3px solid white; }
    </style>
</head>
<body>
<div class="certificate">

    {{-- BORDER DEKORATIF --}}
    <div class="border-outer"></div>
    <div class="border-inner"></div>
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    {{-- KONTEN --}}
    <div class="content">
        <div class="logo">🎓</div>
        <div class="platform-name">WebinarKu</div>

        <div class="cert-title">Sertifikat</div>
        <div class="cert-subtitle">of Completion</div>

        <div class="given-to">Diberikan kepada</div>
        <div class="participant-name">{{ $name }}</div>

        <div class="webinar-label">atas keikutsertaannya dalam</div>
        <div class="webinar-title">{{ $webinar->title }}</div>
        <div class="webinar-date">{{ $webinar->scheduled_at->format('d F Y') }}</div>

        <div class="footer">
            <div class="cert-number">
                No: {{ $certificateNumber }}<br>
                Diterbitkan: {{ $issuedAt }}
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-name">Admin WebinarKu</div>
                <div class="signature-role">Penyelenggara</div>
            </div>
        </div>
    </div>

</div>
</body>
</html>