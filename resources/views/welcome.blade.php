<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awan Laundry — Bersih, Wangi, Sepenuh Hati</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:   #2563eb;
            --blue2:  #1d4ed8;
            --cyan:   #06b6d4;
            --purple: #7c3aed;
            --white:  #ffffff;
            --dark:   #0f172a;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* ===== KEYFRAMES ===== */
        @keyframes fadeDown   { from{opacity:0;transform:translateY(-24px)} to{opacity:1;transform:translateY(0)} }
        @keyframes fadeUp     { from{opacity:0;transform:translateY(24px)}  to{opacity:1;transform:translateY(0)} }
        @keyframes fadeIn     { from{opacity:0} to{opacity:1} }
        @keyframes scaleIn    { from{opacity:0;transform:scale(.9)} to{opacity:1;transform:scale(1)} }
        @keyframes float      { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        @keyframes shimmer    { 0%{background-position:-400px 0} 100%{background-position:400px 0} }
        @keyframes orb1       { 0%,100%{transform:translate(0,0) scale(1)} 40%{transform:translate(30px,-20px) scale(1.06)} 70%{transform:translate(-20px,14px) scale(.96)} }
        @keyframes orb2       { 0%,100%{transform:translate(0,0) scale(1)} 35%{transform:translate(-28px,18px) scale(1.08)} 70%{transform:translate(20px,-14px) scale(.97)} }
        @keyframes gradShift  { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
        @keyframes ripple     { 0%{transform:translate(-50%,-50%) scale(.5);opacity:.8} 100%{transform:translate(-50%,-50%) scale(1.8);opacity:0} }
        @keyframes slideLeft  { from{opacity:0;transform:translateX(-40px)} to{opacity:1;transform:translateX(0)} }
        @keyframes slideRight { from{opacity:0;transform:translateX(40px)}  to{opacity:1;transform:translateX(0)} }
        @keyframes ticker     { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
        @keyframes countUp    { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @keyframes navIn      { from{opacity:0;transform:translateY(-100%)} to{opacity:1;transform:translateY(0)} }
        @keyframes pulse      { 0%,100%{opacity:1} 50%{opacity:.5} }
        @keyframes spin       { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        @keyframes waveMove   { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
        @keyframes cardSlide  { from{opacity:0;transform:translateY(32px)} to{opacity:1;transform:translateY(0)} }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(37,99,235,.08);
            animation: navIn .5s cubic-bezier(.22,1,.36,1) both;
            transition: box-shadow .3s;
        }
        .navbar.scrolled { box-shadow: 0 4px 24px rgba(37,99,235,.12); }
        .nav-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 0 24px;
            height: 68px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(37,99,235,.35);
            transition: transform .25s, box-shadow .25s;
        }
        .nav-logo:hover .nav-logo-icon { transform: scale(1.1) rotate(-5deg); box-shadow: 0 6px 20px rgba(37,99,235,.45); }
        .nav-logo-icon svg { width: 22px; height: 22px; color: white; }
        .nav-brand { font-size: 20px; font-weight: 900; color: #1e293b; letter-spacing: .5px; }
        .nav-brand span { color: var(--blue); }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .btn-nav-cek {
            display: flex; align-items: center; gap: 7px;
            background: #f0f7ff;
            color: var(--blue);
            font-weight: 700; font-size: 14px;
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            border: 1.5px solid #bfdbfe;
            transition: all .2s;
        }
        .btn-nav-cek:hover { background: var(--blue); color: white; border-color: var(--blue); transform: translateY(-1px); }
        .btn-nav-login {
            display: flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: white;
            font-weight: 700; font-size: 14px;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(37,99,235,.3);
            transition: all .2s;
        }
        .btn-nav-login:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37,99,235,.4); }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 45%, #1e40af 100%);
        }
        .hero-grid {
            position: absolute; inset: 0; opacity: .05;
            background-image:
                linear-gradient(rgba(255,255,255,.2) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.2) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .hero-orb1 {
            position: absolute; border-radius: 50%;
            width: 700px; height: 700px;
            top: -200px; left: -200px;
            background: radial-gradient(circle, rgba(37,99,235,.4) 0%, transparent 65%);
            animation: orb1 12s ease-in-out infinite;
        }
        .hero-orb2 {
            position: absolute; border-radius: 50%;
            width: 500px; height: 500px;
            bottom: -100px; right: -100px;
            background: radial-gradient(circle, rgba(6,182,212,.3) 0%, transparent 65%);
            animation: orb2 15s ease-in-out infinite;
        }
        .hero-orb3 {
            position: absolute; border-radius: 50%;
            width: 300px; height: 300px;
            top: 50%; right: 10%;
            background: radial-gradient(circle, rgba(124,58,237,.25) 0%, transparent 65%);
            animation: orb1 18s ease-in-out infinite reverse;
        }

        /* Stars/particles */
        .hero-stars { position: absolute; inset: 0; pointer-events: none; }

        /* ===== BUBBLES (sama seperti halaman login) ===== */
        .hero-bubbles { position: absolute; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
        .hero-bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(99,179,237,.10);
            border: 1px solid rgba(99,179,237,.20);
            animation: heroBubbleRise linear infinite;
        }
        @keyframes heroBubbleRise {
            0%   { transform: translateY(100%) scale(1); opacity: 0; }
            10%  { opacity: .55; }
            90%  { opacity: .25; }
            100% { transform: translateY(-10vh) scale(1.15); opacity: 0; }
        }
        .star {
            position: absolute;
            width: 2px; height: 2px;
            border-radius: 50%;
            background: rgba(255,255,255,.6);
            animation: pulse 2s ease-in-out infinite;
        }

        .hero-content {
            position: relative; z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 120px 24px 60px;
        }

        .hero-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: #93c5fd;
            letter-spacing: .5px;
            margin-bottom: 24px;
            padding-bottom: 6px;
            border-bottom: 2px solid #60a5fa;
            animation: fadeDown .7s .2s both;
        }

        .hero-title {
            font-size: clamp(38px, 6vw, 72px);
            font-weight: 900;
            color: white;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 20px;
            animation: fadeDown .7s .35s both;
        }
        .hero-title .gradient-word {
            background: linear-gradient(135deg, #67e8f9, #818cf8, #34d399);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradShift 4s ease infinite;
        }

        .hero-desc {
            font-size: clamp(15px, 2vw, 20px);
            color: rgba(147,197,253,.85);
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.7;
            font-weight: 500;
            animation: fadeUp .7s .5s both;
        }

        .hero-buttons {
            display: flex; align-items: center; justify-content: center;
            gap: 14px; flex-wrap: wrap;
            animation: fadeUp .7s .65s both;
        }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 9px;
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: white;
            font-weight: 800; font-size: 16px;
            padding: 15px 30px; border-radius: 14px;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(37,99,235,.45);
            transition: all .25s;
            border: none;
        }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 40px rgba(37,99,235,.55); }

        .btn-hero-secondary {
            display: inline-flex; align-items: center; gap: 9px;
            background: rgba(255,255,255,.1);
            color: white;
            font-weight: 700; font-size: 16px;
            padding: 15px 30px; border-radius: 14px;
            text-decoration: none;
            border: 1.5px solid rgba(255,255,255,.25);
            backdrop-filter: blur(8px);
            transition: all .25s;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,.2); transform: translateY(-3px); }

        /* Hero Floating Cards */

        /* ===== TICKER / MARQUEE ===== */
        .ticker-wrap {
            background: var(--blue);
            overflow: hidden;
            padding: 14px 0;
        }
        .ticker-track {
            display: flex;
            white-space: nowrap;
            animation: ticker 25s linear infinite;
        }
        .ticker-item {
            display: inline-flex; align-items: center; gap: 12px;
            padding: 0 40px;
            font-size: 14px; font-weight: 700; color: rgba(255,255,255,.85);
            letter-spacing: .5px;
        }
        .ticker-dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,.4); }

        /* ===== SECTION SHARED ===== */
        .section { padding: 100px 24px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: var(--blue);
            letter-spacing: .5px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--blue);
        }
        .section-title {
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 900;
            color: #1e293b;
            line-height: 1.15;
            margin-bottom: 14px;
        }
        .section-title span { color: var(--blue); }
        .section-desc { font-size: 17px; color: #64748b; max-width: 560px; line-height: 1.7; }

        /* ===== SERVICES ===== */
        .services-section { background: white; }
        .services-header { text-align: center; margin-bottom: 56px; }
        .services-header .section-desc { margin: 0 auto; }

        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; }

        .service-card {
            position: relative; overflow: hidden;
            border-radius: 20px; padding: 32px 28px;
            cursor: default;
            transition: transform .3s, box-shadow .3s;
            opacity: 0; transform: translateY(32px);
        }
        .service-card.visible { animation: cardSlide .6s ease both; }
        .service-card:hover { transform: translateY(-8px); box-shadow: 0 24px 50px rgba(0,0,0,.12); }
        .service-card::before {
            content: '';
            position: absolute; inset: 0;
            opacity: 0; transition: opacity .3s;
            border-radius: 20px;
        }
        .service-card:hover::before { opacity: 1; }

        .sc-1 { background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #bfdbfe; }
        .sc-1::before { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
        .sc-2 { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0; }
        .sc-2::before { background: linear-gradient(135deg, #dcfce7, #bbf7d0); }
        .sc-3 { background: linear-gradient(135deg, #fdf4ff, #f3e8ff); border: 1px solid #e9d5ff; }
        .sc-3::before { background: linear-gradient(135deg, #f3e8ff, #e9d5ff); }
        .sc-4 { background: linear-gradient(135deg, #fff7ed, #ffedd5); border: 1px solid #fed7aa; }
        .sc-4::before { background: linear-gradient(135deg, #ffedd5, #fed7aa); }

        .service-icon-wrap {
            position: relative;
            width: 80px; height: 80px;
            margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center;
        }
        .service-icon-bg {
            position: absolute;
            width: 52px; height: 52px;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 14px;
            opacity: .18;
            z-index: 0;
        }
        .sc-1 .service-icon-bg { background: #2563eb; }
        .sc-2 .service-icon-bg { background: #059669; }
        .sc-3 .service-icon-bg { background: #7c3aed; }
        .sc-4 .service-icon-bg { background: #ea580c; }
        .service-icon { font-size: 32px; position: relative; z-index: 2; line-height: 1; display: block; }
        .service-icon-svg {
            width: 28px; height: 28px;
            position: relative; z-index: 2;
            display: block; flex-shrink: 0;
        }
        .sc-1 .service-icon-svg { stroke: #2563eb; }
        .sc-2 .service-icon-svg { stroke: #059669; }
        .sc-3 .service-icon-svg { stroke: #7c3aed; }
        .sc-4 .service-icon-svg { stroke: #ea580c; }
        .service-card-title { font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
        .service-card-desc { font-size: 14px; color: #64748b; line-height: 1.65; }

        /* Ripple on service icon */
        .ripple-ring {
            position: absolute;
            width: 80px; height: 80px;
            border-radius: 50%;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) scale(.6);
            opacity: 0;
            animation: ripple 2.5s ease-out infinite;
            z-index: 1;
        }
        .sc-1 .ripple-ring { border: 2px solid rgba(37,99,235,.5); }
        .sc-2 .ripple-ring { border: 2px solid rgba(5,150,105,.5); }
        .sc-3 .ripple-ring { border: 2px solid rgba(124,58,237,.5); }
        .sc-4 .ripple-ring { border: 2px solid rgba(234,88,12,.5); }
        .ripple-ring:nth-child(2) { animation-delay: .9s; }

        /* ===== HOW IT WORKS ===== */
        .how-section { background: #f8fafc; }
        .how-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
        @media(max-width:768px){ .how-grid { grid-template-columns: 1fr; gap: 48px; } }

        .how-steps { display: flex; flex-direction: column; gap: 0; }
        .how-step {
            display: flex; gap: 20px;
            padding: 0 0 32px;
            position: relative;
            opacity: 0;
        }
        .how-step.visible { animation: slideLeft .6s ease both; }
        .how-step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 19px; top: 44px; bottom: 0; width: 2px;
            background: linear-gradient(to bottom, #bfdbfe, transparent);
        }
        .step-num {
            width: 40px; height: 40px; flex-shrink: 0;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 900; color: white;
            box-shadow: 0 4px 14px rgba(37,99,235,.35);
            position: relative; z-index: 1;
        }
        .step-content { padding-top: 6px; }
        .step-title { font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .step-desc { font-size: 14px; color: #64748b; line-height: 1.65; }

        /* Visual side */
        .how-visual {
            position: relative;
            opacity: 0;
        }
        .how-visual.visible { animation: slideRight .6s .3s ease both; }
        .phone-mockup {
            background: white;
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 30px 80px rgba(37,99,235,.15), 0 8px 24px rgba(0,0,0,.08);
            border: 1px solid #e2e8f0;
            animation: float 4s ease-in-out infinite;
        }
        .phone-top-bar {
            height: 4px; border-radius: 4px;
            background: linear-gradient(90deg, var(--blue), var(--cyan));
            margin-bottom: 20px;
        }
        .phone-status { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .phone-nota { font-size: 11px; font-weight: 700; color: #94a3b8; font-family: monospace; }
        .phone-badge { background: #d1fae5; color: #065f46; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 100px; }
        .phone-name { font-size: 18px; font-weight: 900; color: #1e293b; margin-bottom: 4px; }
        .phone-service { font-size: 13px; color: #64748b; margin-bottom: 20px; }

        /* Progress in phone */
        .phone-progress { margin-bottom: 18px; }
        .phone-progress-label { font-size: 10px; font-weight: 800; color: #94a3b8; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 10px; }
        .phone-steps { display: flex; align-items: center; gap: 0; }
        .phone-step { flex: 1; display: flex; flex-direction: column; align-items: center; }
        .phone-step-dot {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 800;
            position: relative; z-index: 1;
            margin-bottom: 5px;
        }
        .phone-step.done .phone-step-dot { background: #10b981; color: white; box-shadow: 0 3px 10px rgba(16,185,129,.4); }
        .phone-step.active .phone-step-dot { background: #2563eb; color: white; box-shadow: 0 3px 10px rgba(37,99,235,.4); animation: pulse 1.5s infinite; }
        .phone-step.todo .phone-step-dot { background: #f1f5f9; color: #94a3b8; }
        .phone-step-line { flex: 1; height: 2px; background: #e2e8f0; }
        .phone-step-line.done { background: #10b981; }
        .phone-step-lbl { font-size: 9px; font-weight: 700; color: #94a3b8; }
        .phone-step.done .phone-step-lbl,
        .phone-step.active .phone-step-lbl { color: #1e293b; }

        /* Total row */
        .phone-total {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-radius: 14px; padding: 14px 16px;
        }
        .phone-total-label { font-size: 11px; color: #64748b; font-weight: 700; }
        .phone-total-amount { font-size: 20px; font-weight: 900; color: #1e293b; font-family: monospace; }

        /* ===== STATS ===== */
        .stats-section {
            background: linear-gradient(135deg, #0f172a, #1e3a5f);
            position: relative; overflow: hidden;
        }
        .stats-section::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2px; position: relative; z-index: 1; }
        .stat-item { text-align: center; padding: 56px 24px; border-right: 1px solid rgba(255,255,255,.06); }
        .stat-item:last-child { border-right: none; }
        .stat-num { font-size: 52px; font-weight: 900; line-height: 1; margin-bottom: 8px; }
        .stat-num.blue   { background: linear-gradient(135deg, #60a5fa, #06b6d4); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-num.green  { background: linear-gradient(135deg, #34d399, #10b981); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-num.purple { background: linear-gradient(135deg, #a78bfa, #c084fc); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-num.yellow { background: linear-gradient(135deg, #fbbf24, #f59e0b); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-lbl { font-size: 14px; font-weight: 600; color: rgba(147,197,253,.6); }

        /* ===== CTA ===== */
        .cta-section { background: white; }
        .cta-box {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #1e3a8a, #1d4ed8, #0369a1);
            background-size: 200% 200%;
            animation: gradShift 8s ease infinite;
            border-radius: 28px; padding: 72px 48px;
            text-align: center;
        }
        .cta-box::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,.06) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(255,255,255,.06) 0%, transparent 50%);
        }
        @media(max-width:640px){ .cta-box { padding: 48px 24px; } }
        .cta-title { font-size: clamp(28px, 4vw, 44px); font-weight: 900; color: white; margin-bottom: 14px; position: relative; z-index: 1; }
        .cta-desc { font-size: 18px; color: rgba(147,197,253,.85); margin-bottom: 36px; position: relative; z-index: 1; }
        .cta-buttons { display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; position: relative; z-index: 1; }

        .btn-cta-primary {
            display: inline-flex; align-items: center; gap: 9px;
            background: white; color: var(--blue);
            font-weight: 800; font-size: 16px;
            padding: 15px 32px; border-radius: 14px;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0,0,0,.2);
            transition: all .25s;
        }
        .btn-cta-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 32px rgba(0,0,0,.25); }

        .btn-cta-secondary {
            display: inline-flex; align-items: center; gap: 9px;
            background: rgba(255,255,255,.12);
            color: white;
            font-weight: 700; font-size: 16px;
            padding: 15px 32px; border-radius: 14px;
            text-decoration: none;
            border: 1.5px solid rgba(255,255,255,.25);
            transition: all .25s;
        }
        .btn-cta-secondary:hover { background: rgba(255,255,255,.22); transform: translateY(-3px); }

        /* ===== FOOTER ===== */
        footer {
            background: #0f172a;
            padding: 60px 24px 36px;
            border-top: 1px solid rgba(255,255,255,.05);
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: flex; justify-content: space-between; align-items: flex-start;
            gap: 40px; flex-wrap: wrap;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: 32px;
        }
        .footer-brand .logo-row { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .footer-brand .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .footer-brand .logo-icon svg { width: 19px; height: 19px; color: white; }
        .footer-brand h2 { font-size: 18px; font-weight: 900; color: white; }
        .footer-brand h2 span { color: #67e8f9; }
        .footer-brand p { font-size: 13px; color: #475569; line-height: 1.6; max-width: 260px; }

        .footer-links h4 { font-size: 12px; font-weight: 800; color: #64748b; letter-spacing: 1.2px; text-transform: uppercase; margin-bottom: 14px; }
        .footer-links a { display: block; font-size: 14px; color: #475569; text-decoration: none; margin-bottom: 10px; font-weight: 500; transition: color .2s; }
        .footer-links a:hover { color: #67e8f9; }

        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .footer-bottom p { font-size: 13px; color: #334155; }
        .footer-bottom .made-with { font-size: 13px; color: #334155; display: flex; align-items: center; gap: 5px; }

        /* ===== HERO STATS ROW ===== */
        /* ===== HERO STATS ROW ===== */
        .hero-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 40px;
            animation: fadeUp .7s .8s both;
        }
        .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 16px;
            padding: 16px 18px;
            backdrop-filter: blur(12px);
            transition: background .25s, transform .25s;
        }
        .hero-stat-item:hover {
            background: rgba(255,255,255,.14);
            transform: translateY(-3px);
        }
        .hero-stat-icon {
            width: 40px; height: 40px; flex-shrink: 0;
            background: rgba(255,255,255,.12);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .hero-stat-icon svg { width: 20px; height: 20px; stroke: #93c5fd; }
        .hero-stat-content { display: flex; flex-direction: column; }
        .hero-stat-num { font-size: 16px; font-weight: 900; color: white; line-height: 1.2; }
        .hero-stat-lbl { font-size: 11px; color: rgba(147,197,253,.7); font-weight: 600; margin-top: 2px; }

        /* ===== PHONE INFO ROW ===== */
        .phone-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 16px;
        }
        .phone-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
        }
        .phone-info-title { font-size: 13px; font-weight: 800; color: #1e293b; }
        .phone-info-desc { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        /* ===== HERO STATS ROW ===== */
        .hero-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 40px;
            animation: fadeUp .7s .8s both;
        }
        .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 16px;
            padding: 16px 18px;
            backdrop-filter: blur(12px);
            transition: background .25s, transform .25s;
        }
        .hero-stat-item:hover {
            background: rgba(255,255,255,.14);
            transform: translateY(-3px);
        }
        .hero-stat-icon {
            width: 40px; height: 40px; flex-shrink: 0;
            background: rgba(255,255,255,.12);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .hero-stat-icon svg { width: 20px; height: 20px; stroke: #93c5fd; }
        .hero-stat-content { display: flex; flex-direction: column; }
        .hero-stat-num { font-size: 16px; font-weight: 900; color: white; line-height: 1.2; }
        .hero-stat-lbl { font-size: 11px; color: rgba(147,197,253,.7); font-weight: 600; margin-top: 2px; }

        /* ===== PHONE INFO ROW ===== */
        .phone-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 16px;
        }
        .phone-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
        }
        .phone-info-icon { display: flex; align-items: center; justify-content: center; color: #2563eb; flex-shrink: 0; }
        .phone-info-title { font-size: 13px; font-weight: 800; color: #1e293b; }
        .phone-info-desc { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        /* ===== DENSITY POLISH ===== */
        .hero { min-height: 100svh; }
        .hero-content {
            width: 100%;
            max-width: 1080px;
            min-height: 100svh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 96px 24px 36px;
        }
        .hero-eyebrow { margin-bottom: 16px; }
        .hero-title { margin-bottom: 16px; }
        .hero-desc { margin-bottom: 28px; line-height: 1.6; }
        .hero-stats-row { margin-top: 26px; }
        .hero-service-strip {
            width: 100%;
            max-width: 880px;
            margin: 22px auto 0;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            animation: fadeUp .7s .72s both;
        }
        .hero-service-pill {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(15,23,42,.22);
            border: 1px solid rgba(255,255,255,.12);
            color: rgba(219,234,254,.9);
            font-size: 13px;
            font-weight: 800;
            backdrop-filter: blur(10px);
        }
        .hero-service-pill svg {
            width: 17px;
            height: 17px;
            stroke: #67e8f9;
            flex-shrink: 0;
        }
        .section { padding: 76px 24px; }
        .services-header { margin-bottom: 38px; }
        .services-grid { gap: 18px; }
        .service-card { border-radius: 18px; padding: 26px 24px; }
        .service-icon-wrap { width: 68px; height: 68px; margin-bottom: 14px; }
        .ripple-ring { width: 68px; height: 68px; }
        .how-grid { gap: 56px; }
        .how-step { padding-bottom: 24px; }
        .phone-mockup { padding: 20px; }
        .phone-info-row { margin-top: 12px; }
        .stats-section.section { padding: 0 24px; }
        .stat-item { padding: 42px 20px; }
        .cta-section { padding-top: 70px; padding-bottom: 70px; }
        .cta-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            text-align: left;
            padding: 48px;
        }
        .cta-copy {
            position: relative;
            z-index: 1;
            max-width: 620px;
        }
        .cta-desc { margin-bottom: 0; }
        .cta-buttons { justify-content: flex-end; }
        footer { padding: 44px 24px 28px; }
        .footer-top { padding-bottom: 28px; margin-bottom: 24px; gap: 32px; }

        /* ===== SCROLL FADE ===== */
        .fade-in-view { opacity: 0; transform: translateY(24px); transition: opacity .7s ease, transform .7s ease; }
        .fade-in-view.in-view { opacity: 1; transform: translateY(0); }

        /* ===== RESPONSIVE ===== */
        @media(max-width:900px) {
            .hero-content { padding-top: 92px; }
            .hero-stats-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .hero-service-strip { grid-template-columns: 1fr; max-width: 520px; }
            .how-grid { gap: 36px; }
            .cta-box { flex-direction: column; text-align: center; align-items: center; }
            .cta-buttons { justify-content: center; }
        }
        @media(max-width:640px) {
            .nav-right .btn-nav-cek { display: none; }
            .nav-inner { height: 62px; padding: 0 18px; }
            .nav-brand { font-size: 17px; }
            .hero-content { padding: 82px 18px 28px; }
            .hero-desc { margin-bottom: 22px; }
            .hero-buttons { gap: 10px; }
            .btn-hero-primary,
            .btn-hero-secondary { width: 100%; justify-content: center; padding: 13px 18px; }
            .hero-stats-row { grid-template-columns: 1fr; margin-top: 20px; }
            .hero-stat-item { padding: 13px 14px; }
            .section { padding: 56px 18px; }
            .services-header { margin-bottom: 28px; }
            .service-card { padding: 22px 20px; }
            .stats-section.section { padding: 0; }
            .stat-item { padding: 30px 14px; }
            .cta-section { padding: 48px 18px; }
            .cta-box { padding: 34px 22px; border-radius: 22px; }
            .cta-desc { font-size: 15px; line-height: 1.6; }
            footer { padding: 36px 18px 24px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .stat-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,.06); }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">
                <div class="nav-logo-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="nav-brand">AWAN<span>-LAUNDRY</span></span>
            </a>
            <div class="nav-right">
                <a href="{{ route('cek.status') }}" class="btn-nav-cek">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cek Status Cucian
                </a>
                @auth
                <a href="{{ route('dashboard') }}" class="btn-nav-login">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-orb1"></div>
        <div class="hero-orb2"></div>
        <div class="hero-orb3"></div>
        <div class="hero-bubbles" id="hero-bubbles"></div>
        <!-- Stars -->
        <div class="hero-stars" id="stars"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">Layanan Laundry Terpercaya Sejak 2020</p>

            <h1 class="hero-title">
                Cucian Bersih,<br>
                <span class="gradient-word">Hati Pun Senang!</span>
            </h1>

            <p class="hero-desc">
                Laundry kiloan & satuan dengan harga terjangkau. Proses cepat, bersih, dan wangi. Antar jemput ke rumah tersedia! 🚀
            </p>

            <div class="hero-buttons">
                <a href="{{ route('cek.status') }}" class="btn-hero-primary">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cek Status Cucian
                </a>
                <a href="#layanan" class="btn-hero-secondary">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                    Lihat Layanan
                </a>
            </div>

            <div class="hero-service-strip" aria-label="Ringkasan layanan">
                <div class="hero-service-pill">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5 5 0 006 0M6 7l3 9m-3-9l6-2m6 2l3-1m-3 1l-3 9a5 5 0 006 0m-3-9l-6-2m0-2v18"/></svg>
                    Kiloan & satuan
                </div>
                <div class="hero-service-pill">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Antar & jemput
                </div>
                <div class="hero-service-pill">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Cek nota online
                </div>
            </div>

            <!-- Stats Row -->
            <div class="hero-stats-row">
                <div class="hero-stat-item">
                    <div class="hero-stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="hero-stat-content">
                        <span class="hero-stat-num">1–3 Hari</span>
                        <span class="hero-stat-lbl">Estimasi Selesai</span>
                    </div>
                </div>
                <div class="hero-stat-item">
                    <div class="hero-stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    </div>
                    <div class="hero-stat-content">
                        <span class="hero-stat-num">Gratis</span>
                        <span class="hero-stat-lbl">Antar Jemput</span>
                    </div>
                </div>
                <div class="hero-stat-item">
                    <div class="hero-stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="hero-stat-content">
                        <span class="hero-stat-num">Real-time</span>
                        <span class="hero-stat-lbl">Cek Status Online</span>
                    </div>
                </div>
                <div class="hero-stat-item">
                    <div class="hero-stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <div class="hero-stat-content">
                        <span class="hero-stat-num">4.9 / 5.0</span>
                        <span class="hero-stat-lbl">Rating Pelanggan</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ===== TICKER ===== -->
    <div class="ticker-wrap">
        <div class="ticker-track">
            @for($i = 0; $i < 2; $i++)
            <span class="ticker-item"><span class="ticker-dot"></span> Laundry Kiloan</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Laundry Satuan</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Cuci Sepatu</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Cuci Tas</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Cuci Karpet</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Setrika Saja</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Antar Jemput</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Express 6 Jam</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Dry Cleaning</span>
            <span class="ticker-item"><span class="ticker-dot"></span> Cuci Boneka</span>
            @endfor
        </div>
    </div>

    <!-- ===== LAYANAN ===== -->
    <section class="section services-section" id="layanan">
        <div class="section-inner">
            <div class="services-header fade-in-view">
                <p class="section-eyebrow">Paket Layanan Kami</p>
                <h2 class="section-title">Layanan <span>Lengkap</span> untuk Semua Kebutuhan</h2>
                <p class="section-desc">Dari kiloan harian sampai cuci khusus premium, semua ada di sini.</p>
            </div>

            <div class="services-grid" id="services-grid">
                <div class="service-card sc-1">
                    <div class="service-icon-wrap">
                        <div class="ripple-ring"></div>
                        <div class="ripple-ring" style="animation-delay:.8s"></div>
                        <div class="service-icon-bg"></div>
                        <svg class="service-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <div class="service-card-title">Laundry Kiloan</div>
                    <div class="service-card-desc">Cuci + setrika per kilogram. Hemat dan praktis untuk kebutuhan harian. Estimasi selesai 1–2 hari.</div>
                </div>
                <div class="service-card sc-2">
                    <div class="service-icon-wrap">
                        <div class="ripple-ring"></div>
                        <div class="ripple-ring" style="animation-delay:.8s"></div>
                        <div class="service-icon-bg"></div>
                        <svg class="service-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </div>
                    <div class="service-card-title">Laundry Satuan</div>
                    <div class="service-card-desc">Dihitung per potong pakaian. Cocok untuk pakaian formal, jas, dan baju pesta.</div>
                </div>
                <div class="service-card sc-3">
                    <div class="service-icon-wrap">
                        <div class="ripple-ring"></div>
                        <div class="ripple-ring" style="animation-delay:.8s"></div>
                        <div class="service-icon-bg"></div>
                        <svg class="service-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <div class="service-card-title">Cuci Sepatu</div>
                    <div class="service-card-desc">Pembersihan menyeluruh dengan bahan khusus. Sepatu kamu kembali bersih dan segar seperti baru.</div>
                </div>
                <div class="service-card sc-4">
                    <div class="service-icon-wrap">
                        <div class="ripple-ring"></div>
                        <div class="ripple-ring" style="animation-delay:.8s"></div>
                        <div class="service-icon-bg"></div>
                        <svg class="service-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="service-card-title">Express 6 Jam</div>
                    <div class="service-card-desc">Butuh cepat? Layanan kilat selesai dalam 6 jam. Baju bersih siap pakai untuk acara mendesak.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="section how-section" id="cara-kerja">
        <div class="section-inner">
            <div class="how-grid">
                <!-- Steps -->
                <div>
                    <div class="fade-in-view" style="margin-bottom:40px;">
                        <p class="section-eyebrow">Cara Kerja</p>
                        <h2 class="section-title">Semudah <span>3 Langkah</span></h2>
                        <p class="section-desc">Proses laundry yang transparan dan mudah dipantau dari mana saja.</p>
                    </div>
                    <div class="how-steps">
                        <div class="how-step" style="animation-delay:.1s">
                            <div class="step-num">1</div>
                            <div class="step-content">
                                <div class="step-title">Antar atau Jemput Cucian</div>
                                <div class="step-desc">Bawa langsung ke toko atau hubungi kami untuk penjemputan ke rumah kamu. Kasir akan membuat nota cucian.</div>
                            </div>
                        </div>
                        <div class="how-step" style="animation-delay:.2s">
                            <div class="step-num">2</div>
                            <div class="step-content">
                                <div class="step-title">Kami Proses dengan Teliti</div>
                                <div class="step-desc">Cucian dipilah, dicuci dengan deterjen berkualitas, disetrika rapi, dan dikemas dengan baik oleh tim kami.</div>
                            </div>
                        </div>
                        <div class="how-step" style="animation-delay:.3s">
                            <div class="step-num">3</div>
                            <div class="step-content">
                                <div class="step-title">Pantau Status & Ambil</div>
                                <div class="step-desc">Cek status cucian real-time lewat website ini menggunakan nomor nota. Ambil sendiri atau kami antar!</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phone Mockup -->
                <div class="how-visual">
                    <div class="phone-mockup">
                        <div class="phone-top-bar"></div>
                        <div class="phone-status">
                            <span class="phone-nota">TRX-20250501-0042</span>
                            <span class="phone-badge">✅ LUNAS</span>
                        </div>
                        <div class="phone-name">Budi Santoso</div>
                        <div class="phone-service">Laundry Kiloan · 3.5 KG</div>

                        <div class="phone-progress">
                            <div class="phone-progress-label">Progress Cucian</div>
                            <div style="display:flex;align-items:center;">
                                <div class="phone-step done">
                                    <div class="phone-step-dot">✓</div>
                                    <div class="phone-step-lbl">Dicuci</div>
                                </div>
                                <div class="phone-step-line done"></div>
                                <div class="phone-step active">
                                    <div class="phone-step-dot">●</div>
                                    <div class="phone-step-lbl">Selesai</div>
                                </div>
                                <div class="phone-step-line"></div>
                                <div class="phone-step todo">
                                    <div class="phone-step-dot">3</div>
                                    <div class="phone-step-lbl">Diambil</div>
                                </div>
                            </div>
                        </div>

                        <div class="phone-total">
                            <div>
                                <div class="phone-total-label">Total Tagihan</div>
                                <div class="phone-total-amount">Rp 17.500</div>
                            </div>
                            <svg fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2" width="28" height="28"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>

                    <!-- Info Row di bawah mockup -->
                    <div class="phone-info-row">
                        <div class="phone-info-item">
                            <div class="phone-info-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg></div>
                            <div>
                                <div class="phone-info-title">Notifikasi Real-time</div>
                                <div class="phone-info-desc">Status selalu update otomatis</div>
                            </div>
                        </div>
                        <div class="phone-info-item">
                            <div class="phone-info-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                            <div>
                                <div class="phone-info-title">Cek dari Mana Saja</div>
                                <div class="phone-info-desc">Tanpa login, langsung cek</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATS ===== -->
    <section class="stats-section section">
        <div class="section-inner">
            <div class="stats-grid">
                <div class="stat-item fade-in-view">
                    <div class="stat-num blue" id="cnt-pelanggan">0+</div>
                    <div class="stat-lbl">Pelanggan Puas</div>
                </div>
                <div class="stat-item fade-in-view">
                    <div class="stat-num green" id="cnt-transaksi">0+</div>
                    <div class="stat-lbl">Transaksi Selesai</div>
                </div>
                <div class="stat-item fade-in-view">
                    <div class="stat-num purple">6 Jam</div>
                    <div class="stat-lbl">Layanan Express</div>
                </div>
                <div class="stat-item fade-in-view">
                    <div class="stat-num yellow">4.9★</div>
                    <div class="stat-lbl">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA ===== -->
    <section class="section cta-section">
        <div class="section-inner">
            <div class="cta-box fade-in-view">
                <div class="cta-copy">
                    <h2 class="cta-title">Sudah Nitip Cucian?</h2>
                    <p class="cta-desc">Langsung cek status cucian kamu sekarang menggunakan nomor nota yang kamu terima dari kasir.</p>
                </div>
                <div class="cta-buttons">
                    <a href="{{ route('cek.status') }}" class="btn-cta-primary">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cek Status Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="logo-row">
                        <div class="logo-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" style="width:18px;height:18px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h2>AWAN<span>-LAUNDRY</span></h2>
                    </div>
                    <p>Layanan laundry terpercaya dengan teknologi modern. Bersih, wangi, dan tepat waktu.</p>
                </div>
                <div class="footer-links">
                    <h4>Menu</h4>
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="#layanan">Layanan</a>
                    <a href="#cara-kerja">Cara Kerja</a>
                    <a href="{{ route('cek.status') }}">Cek Status Cucian</a>
                </div>
                <div class="footer-links">
                    <h4>Pegawai</h4>
                    @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('transaksi.index') }}">Transaksi</a>
                    <a href="{{ route('pelanggan.index') }}">Pelanggan</a>
                    @else
                    <a href="{{ route('login') }}">Login Kasir</a>
                    @endauth
                </div>
                <div class="footer-links">
                    <h4>Kontak</h4>
                    <a href="#">Kab. Indramayu, Jawa Barat</a>
                    <a href="#">📞 0812-3456-7890</a>
                    <a href="#">WhatsApp Kami</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Awan Laundry Express. All rights reserved.</p>
                <div class="made-with">
                    <span>Dibuat dengan</span>
                    <span style="color:#ef4444;font-size:16px;">❤️</span>
                    <span>untuk pelanggan setia kami</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // ===== NAVBAR SCROLL =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });

        // ===== RANDOM STARS =====
        const starsEl = document.getElementById('stars');
        for (let i = 0; i < 60; i++) {
            const s = document.createElement('div');
            s.classList.add('star');
            s.style.cssText = `
                left: ${Math.random()*100}%;
                top: ${Math.random()*100}%;
                animation-delay: ${Math.random()*3}s;
                animation-duration: ${Math.random()*2+1.5}s;
                width: ${Math.random()<.7 ? 2 : 3}px;
                height: ${Math.random()<.7 ? 2 : 3}px;
            `;
            starsEl.appendChild(s);
        }

        // ===== BUBBLES (sama seperti login) =====
        const bubblesEl = document.getElementById('hero-bubbles');
        for (let i = 0; i < 22; i++) {
            const b = document.createElement('div');
            b.classList.add('hero-bubble');
            const size = Math.random() * 80 + 20;
            b.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${Math.random() * 100}%;
                bottom: ${Math.random() * 10}%;
                animation-duration: ${Math.random() * 10 + 8}s;
                animation-delay: ${Math.random() * 8}s;
            `;
            bubblesEl.appendChild(b);
        }

        // ===== INTERSECTION OBSERVER (general fade) =====
        const fadeEls = document.querySelectorAll('.fade-in-view');
        const obsGeneral = new IntersectionObserver((entries) => {
            entries.forEach(el => {
                if (el.isIntersecting) {
                    el.target.classList.add('in-view');
                    obsGeneral.unobserve(el.target);
                }
            });
        }, { threshold: .15 });
        fadeEls.forEach(el => obsGeneral.observe(el));

        // ===== SERVICE CARDS STAGGER =====
        const sCards = document.querySelectorAll('.service-card');
        const obsCards = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const i = Array.from(sCards).indexOf(entry.target);
                    setTimeout(() => entry.target.classList.add('visible'), i * 120);
                    obsCards.unobserve(entry.target);
                }
            });
        }, { threshold: .1 });
        sCards.forEach(c => obsCards.observe(c));

        // ===== HOW STEPS =====
        const hSteps = document.querySelectorAll('.how-step');
        const hVisual = document.querySelector('.how-visual');
        const obsHow = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const i = Array.from(hSteps).indexOf(entry.target);
                    setTimeout(() => entry.target.classList.add('visible'), i * 150);
                    obsHow.unobserve(entry.target);
                }
            });
        }, { threshold: .15 });
        hSteps.forEach(s => obsHow.observe(s));

        const obsVisual = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { hVisual.classList.add('visible'); obsVisual.unobserve(e.target); } });
        }, { threshold: .2 });
        if (hVisual) obsVisual.observe(hVisual);

        //  COUNTER ANIMATION 
        function animCount(el, target, suffix = '+', duration = 2000) {
            if (!el) return;
            const start = performance.now();
            function tick(now) {
                const p = Math.min((now - start) / duration, 1);
                const ease = 1 - Math.pow(1 - p, 4);
                el.textContent = Math.floor(ease * target) + suffix;
                if (p < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        }

        const obsStats = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    animCount(document.getElementById('cnt-pelanggan'), 500, '+');
                    animCount(document.getElementById('cnt-transaksi'), 2000, '+');
                    obsStats.unobserve(e.target);
                }
            });
        }, { threshold: .3 });
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) obsStats.observe(statsSection);
    </script>
</body>
</html>
