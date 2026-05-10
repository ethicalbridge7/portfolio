<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prosper amutah— QA · Dev · Security</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,700;1,400&family=Fragment+Mono&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:         #0b0f0e;
            --bg2:        #111816;
            --surface:    #161d1b;
            --border:     #1f2e2a;
            --green:      #3fffa2;
            --green-dim:  #2bbd78;
            --green-glow: rgba(63,255,162,.18);
            --amber:      #f5a623;
            --red:        #ff5f57;
            --yellow:     #febc2e;
            --blue:       #28c7f5;
            --text:       #c8d8d4;
            --text-dim:   #6a8a82;
            --text-muted: #3a5550;
            --font-mono:  'JetBrains Mono', 'Fragment Mono', monospace;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-mono);
            font-size: 14px;
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Scanline overlay ─────────────────────────── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,.07) 2px,
                rgba(0,0,0,.07) 4px
            );
            pointer-events: none;
            z-index: 9999;
        }

        /* ── Nav ─────────────────────────────────────── */
        nav {
            position: fixed; top: 0; left: 0; right: 0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 48px;
            height: 56px;
            border-bottom: 1px solid var(--border);
            background: rgba(11,15,14,.85);
            backdrop-filter: blur(12px);
            z-index: 100;
        }

        .nav-logo {
            display: flex; align-items: center; gap: 10px;
            color: var(--green);
            font-size: 15px; font-weight: 700; text-decoration: none;
        }
        .nav-logo span.prompt { opacity: .5; font-weight: 300; }
        .nav-logo .version {
            font-size: 11px; color: var(--text-dim);
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 2px 7px; border-radius: 4px;
        }

        .nav-links { display: flex; gap: 32px; }
        .nav-links a {
            color: var(--text-dim); text-decoration: none;
            font-size: 13px; transition: color .2s;
        }
        .nav-links a:hover { color: var(--green); }

        .nav-actions { display: flex; gap: 12px; align-items: center; }
        .btn-ghost {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text-dim);
            font-family: var(--font-mono); font-size: 12px;
            border-radius: 6px; cursor: pointer; text-decoration: none;
            transition: border-color .2s, color .2s;
        }
        .btn-ghost:hover { border-color: var(--green); color: var(--green); }
        .btn-ghost svg { width: 14px; height: 14px; }

        /* ── Hero ─────────────────────────────────────── */
        .hero {
            padding: 140px 48px 80px;
            display: flex; flex-direction: column; align-items: center;
            text-align: center; gap: 0;
            position: relative;
        }

        /* Glow blob behind title */
        .hero::after {
            content: '';
            position: absolute; top: 120px; left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 300px;
            background: radial-gradient(ellipse, var(--green-glow) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-label {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 5px 14px; border-radius: 99px;
            font-size: 12px; color: var(--green-dim);
            margin-bottom: 28px;
        }
        .hero-label::before { content: '●'; font-size: 8px; animation: blink 1.2s step-end infinite; }
        @keyframes blink { 0%,100%{opacity:1}50%{opacity:0} }

        h1 {
            font-size: clamp(56px, 8vw, 96px);
            font-weight: 700; line-height: 1.0;
            color: var(--green);
            letter-spacing: -2px;
            margin-bottom: 20px;
            position: relative; z-index: 1;
        }

        .hero-tagline {
            font-size: clamp(13px, 1.6vw, 16px);
            color: var(--text-dim); letter-spacing: .5px;
            margin-bottom: 40px; max-width: 520px;
        }

        /* Feature pills */
        .hero-features {
            display: flex; flex-wrap: wrap; justify-content: center;
            gap: 12px; margin-bottom: 40px;
        }
        .feature-pill {
            display: flex; align-items: center; gap: 7px;
            color: var(--text-dim); font-size: 13px;
        }
        .feature-pill::before { content: '>'; color: var(--green); }

        /* Install bar */
        .install-bar {
            display: flex; align-items: center; gap: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px; overflow: hidden;
            margin-bottom: 72px;
        }
        .install-label {
            padding: 11px 16px;
            color: var(--text-dim); font-size: 13px;
            border-right: 1px solid var(--border);
        }
        .install-cmd {
            padding: 11px 20px;
            color: var(--green); font-size: 13px;
            letter-spacing: .3px;
        }
        .copy-btn {
            padding: 11px 14px;
            border: none; border-left: 1px solid var(--border);
            background: transparent; color: var(--text-muted);
            cursor: pointer; transition: color .2s, background .2s;
            font-size: 15px;
        }
        .copy-btn:hover { background: var(--border); color: var(--green); }

        /* ── Terminal / Code mockup ───────────────────── */
        .editor-wrap {
            width: 100%; max-width: 900px;
            border-radius: 12px; overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 40px 120px rgba(0,0,0,.6), 0 0 0 1px var(--border);
        }

        .editor-titlebar {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 16px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }
        .dot { width: 12px; height: 12px; border-radius: 50%; }
        .dot.r { background: var(--red); }
        .dot.y { background: var(--yellow); }
        .dot.g { background: #29c842; }
        .editor-title { margin-left: 8px; font-size: 12px; color: var(--text-dim); }

        .editor-body {
            display: grid; grid-template-columns: 220px 1fr;
            height: 400px;
        }

        /* sidebar */
        .editor-sidebar {
            background: var(--bg2);
            border-right: 1px solid var(--border);
            padding: 12px 0; font-size: 12px;
        }
        .sidebar-title {
            padding: 4px 14px 10px;
            color: var(--text-muted); font-size: 11px; letter-spacing: 1px;
            text-transform: uppercase;
        }
        .sidebar-item {
            padding: 3px 14px;
            color: var(--text-dim); cursor: pointer;
            display: flex; align-items: center; justify-content: space-between;
            transition: background .15s;
        }
        .sidebar-item:hover { background: var(--border); }
        .sidebar-item.active { color: var(--green); background: rgba(63,255,162,.06); }
        .sidebar-item .size { color: var(--text-muted); font-size: 11px; }
        .sidebar-folder { padding-left: 20px; }
        .sidebar-chevron { font-size: 10px; color: var(--text-muted); margin-right: 6px; }

        /* code area */
        .editor-code {
            background: var(--bg);
            overflow: auto; padding: 16px 0;
            font-size: 12.5px; line-height: 1.75;
        }
        .code-line {
            display: flex; gap: 0;
            padding: 0 20px;
        }
        .code-line:hover { background: rgba(255,255,255,.02); }
        .ln {
            min-width: 32px; text-align: right;
            color: var(--text-muted); margin-right: 20px;
            user-select: none;
        }
        /* syntax colors */
        .k  { color: #c792ea; } /* keyword */
        .kw { color: var(--blue); } /* special keyword */
        .s  { color: var(--amber); } /* string */
        .c  { color: var(--text-muted); font-style: italic; } /* comment */
        .t  { color: var(--green); } /* type */
        .f  { color: #82aaff; } /* function */
        .p  { color: var(--text); } /* plain */
        .n  { color: #f78c6c; } /* number */
        .g  { color: var(--green-dim); } /* green accent */

        /* ── Sections ─────────────────────────────────── */
        section {
            padding: 100px 48px;
            max-width: 1100px; margin: 0 auto;
        }
        .section-title {
            font-size: 11px; letter-spacing: 2px;
            color: var(--green); text-transform: uppercase;
            margin-bottom: 16px;
        }
        .section-title::before { content: '// '; opacity: .5; }
        h2 {
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 700; color: #e8f5f1;
            margin-bottom: 48px; line-height: 1.2;
        }

        /* Skills grid */
        .skills-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
        }
        @media (max-width: 768px) {
            .skills-grid { grid-template-columns: 1fr; }
            nav { padding: 0 20px; }
            .nav-links { display: none; }
            .hero { padding: 100px 20px 60px; }
            section { padding: 60px 20px; }
            .editor-body { grid-template-columns: 1fr; }
            .editor-sidebar { display: none; }
        }

        .skill-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px; padding: 24px;
            transition: border-color .2s, transform .2s;
            cursor: default;
        }
        .skill-card:hover {
            border-color: var(--green);
            transform: translateY(-3px);
        }
        .skill-card-icon {
            font-size: 22px; margin-bottom: 14px;
        }
        .skill-card h3 {
            font-size: 14px; color: var(--green);
            margin-bottom: 8px;
        }
        .skill-card p { font-size: 12px; color: var(--text-dim); line-height: 1.7; }
        .skill-tags {
            display: flex; flex-wrap: wrap; gap: 6px; margin-top: 16px;
        }
        .tag {
            font-size: 11px; padding: 2px 8px;
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 4px; color: var(--text-dim);
        }

        /* Projects */
        .projects-grid {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;
        }
        @media (max-width: 768px) { .projects-grid { grid-template-columns: 1fr; } }

        .project-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px; padding: 28px;
            position: relative; overflow: hidden;
            transition: border-color .25s;
        }
        .project-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--green), transparent);
            opacity: 0; transition: opacity .25s;
        }
        .project-card:hover { border-color: var(--green-dim); }
        .project-card:hover::before { opacity: 1; }

        .project-card .badge {
            display: inline-block;
            font-size: 10px; padding: 2px 8px;
            border-radius: 4px; margin-bottom: 14px;
            text-transform: uppercase; letter-spacing: 1px;
        }
        .badge.qa { background: rgba(40,199,245,.1); color: var(--blue); border: 1px solid rgba(40,199,245,.2); }
        .badge.dev { background: rgba(63,255,162,.1); color: var(--green); border: 1px solid rgba(63,255,162,.2); }
        .badge.sec { background: rgba(245,166,35,.1); color: var(--amber); border: 1px solid rgba(245,166,35,.2); }

        .project-card.featured {
            grid-column: 1 / -1;
            display: grid; grid-template-columns: 1fr 1.2fr; gap: 28px;
            align-items: stretch;
        }
        @media (max-width: 768px) { .project-card.featured { grid-template-columns: 1fr; } }
        .project-preview {
            position: relative;
            border: 1px solid var(--border);
            border-radius: 8px; overflow: hidden;
            background: var(--bg2);
            min-height: 280px;
        }
        .project-preview { display: block; text-decoration: none; color: inherit; }
        .project-preview img {
            width: 100%; height: auto;
            display: block;
            background: #fff;
        }
        .project-preview iframe {
            width: 100%; height: 100%;
            min-height: 280px;
            border: 0;
            display: block;
            background: #fff;
        }
        .project-preview-bar {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 12px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            font-size: 11px; color: var(--text-dim);
        }
        .project-preview-bar .dot { width: 9px; height: 9px; }
        .project-preview-bar .url {
            margin-left: 8px; color: var(--text-muted);
        }

        .project-card h3 { font-size: 15px; color: #e8f5f1; margin-bottom: 8px; }
        .project-card p  { font-size: 12px; color: var(--text-dim); line-height: 1.7; }
        .project-links {
            display: flex; gap: 16px; margin-top: 20px;
        }
        .project-links a {
            font-size: 12px; color: var(--text-dim);
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            transition: color .2s;
        }
        .project-links a:hover { color: var(--green); }

        /* ── Contact / CTA ─────────────────────────────── */
        .cta {
            text-align: center; padding: 100px 48px;
            border-top: 1px solid var(--border);
        }
        .cta h2 { font-size: clamp(28px,4vw,44px); color: #e8f5f1; margin-bottom: 12px; }
        .cta p  { color: var(--text-dim); margin-bottom: 36px; font-size: 14px; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 28px;
            background: var(--green); color: #0b0f0e;
            font-family: var(--font-mono); font-size: 13px; font-weight: 700;
            border-radius: 7px; text-decoration: none; border: none; cursor: pointer;
            transition: filter .2s, transform .2s;
        }
        .btn-primary:hover { filter: brightness(1.15); transform: translateY(-2px); }

        .social-row {
            display: flex; justify-content: center; gap: 20px; margin-top: 28px;
        }
        .social-row a {
            color: var(--text-muted); text-decoration: none; font-size: 12px;
            transition: color .2s;
        }
        .social-row a:hover { color: var(--green); }

        /* ── Footer ────────────────────────────────────── */
        footer {
            border-top: 1px solid var(--border);
            padding: 24px 48px;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; color: var(--text-muted);
        }

        /* ── Typewriter cursor ─────────────────────────── */
        .cursor {
            display: inline-block; width: 3px; height: 1em;
            background: var(--green);
            vertical-align: middle; margin-left: 2px;
            animation: blink .9s step-end infinite;
        }

        /* ── Animations ────────────────────────────────── */
        .fade-up {
            opacity: 0; transform: translateY(24px);
            animation: fadeUp .6s ease forwards;
        }
        .fade-up:nth-child(2) { animation-delay: .1s; }
        .fade-up:nth-child(3) { animation-delay: .2s; }
        .fade-up:nth-child(4) { animation-delay: .3s; }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- ─── NAV ──────────────────────────────────────────── -->
<nav>
    <a href="#" class="nav-logo">
        <span class="prompt">>_</span> prosper
        <span class="version">v1.0.0</span>
    </a>
    <div class="nav-links">
        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
    </div>
    <div class="nav-actions">
        <a href="https://www.linkedin.com/in/prosper-amutah-667530241" class="btn-ghost" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            LinkedIn
        </a>
        <a href="https://instagram.com/prosper_chidiegwu" class="btn-ghost" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            Instagram
        </a>
    
    </div>
</nav>

<!-- ─── HERO ──────────────────────────────────────────── -->
<main class="hero">
    <div class="hero-label fade-up">Available for work</div>

    <h1 class="fade-up">prosper<span class="cursor"></span></h1>

    <p class="hero-tagline fade-up">
        A software engineer who builds it, breaks it, and secures it.
    </p>

    <div class="hero-features fade-up">
        <span class="feature-pill">QA Engineer</span>
        <span class="feature-pill">Software Developer</span>
        <span class="feature-pill">Cybersecurity</span>
        <span class="feature-pill">Laravel · PHP</span>
        <span class="feature-pill">Penetration Testing</span>
    </div>

    <div class="install-bar fade-up">
        <span class="install-label">Contact:</span>
        <span class="install-cmd">prosperch@proton.me</span>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('prosperch@proton.me');this.textContent='✓'" title="Copy email">⎘</button>
    </div>

    <!-- Code editor mockup -->
    <div class="editor-wrap fade-up">
        <div class="editor-titlebar">
            <div class="dot r"></div>
            <div class="dot y"></div>
            <div class="dot g"></div>
            <span class="editor-title">portfolio.test.ts</span>
        </div>
        <div class="editor-body">
            <div class="editor-sidebar">
                <div class="sidebar-title">Explorer</div>
                <div class="sidebar-item active"><span><span class="sidebar-chevron">▼</span> portfolio</span><span class="size">8 items</span></div>
                <div class="sidebar-item sidebar-folder"><span><span class="sidebar-chevron">▶</span> .tests</span></div>
                <div class="sidebar-item sidebar-folder"><span><span class="sidebar-chevron">▶</span> security</span></div>
                <div class="sidebar-item sidebar-folder"><span><span class="sidebar-chevron">▶</span> src</span></div>
                <div class="sidebar-item sidebar-folder">portfolio.test.ts<span class="size">4.2 KB</span></div>
                <div class="sidebar-item sidebar-folder">README.md<span class="size">1.1 KB</span></div>
            </div>
            <div class="editor-code">
                <div class="code-line"><span class="ln">1</span><span class="c">// QA Engineer · Developer · Security Researcher</span></div>
                <div class="code-line"><span class="ln">2</span></div>
                <div class="code-line"><span class="ln">3</span><span class="k">import</span> <span class="p">{ describe, test, expect } </span><span class="k">from</span> <span class="s">'@testing-library'</span><span class="p">;</span></div>
                <div class="code-line"><span class="ln">4</span><span class="k">import</span> <span class="p">{ </span><span class="t">Developer</span><span class="p"> } </span><span class="k">from</span> <span class="s">'./me'</span><span class="p">;</span></div>
                <div class="code-line"><span class="ln">5</span></div>
                <div class="code-line"><span class="ln">6</span><span class="f">describe</span><span class="p">(</span><span class="s">'prosper'</span><span class="p">, () => {</span></div>
                <div class="code-line"><span class="ln">7</span></div>
                <div class="code-line"><span class="ln">8</span><span class="p">  </span><span class="f">test</span><span class="p">(</span><span class="s">'builds reliable software'</span><span class="p">, () => {</span></div>
                <div class="code-line"><span class="ln">9</span><span class="p">    </span><span class="k">const</span><span class="p"> dev = </span><span class="k">new</span> <span class="t">Developer</span><span class="p">();</span></div>
                <div class="code-line"><span class="ln">10</span><span class="p">    </span><span class="f">expect</span><span class="p">(dev.skills).toContain(</span><span class="s">'Laravel'</span><span class="p">);</span></div>
                <div class="code-line"><span class="ln">11</span><span class="p">    </span><span class="f">expect</span><span class="p">(dev.passion).toBe(</span><span class="kw">true</span><span class="p">);</span></div>
                <div class="code-line"><span class="ln">12</span><span class="p">  });</span></div>
                <div class="code-line"><span class="ln">13</span></div>
                <div class="code-line"><span class="ln">14</span><span class="p">  </span><span class="f">test</span><span class="p">(</span><span class="s">'finds bugs before users do'</span><span class="p">, () => {</span></div>
                <div class="code-line"><span class="ln">15</span><span class="p">    </span><span class="k">const</span><span class="p"> result = dev.</span><span class="f">runQA</span><span class="p">(</span><span class="s">'any system'</span><span class="p">);</span></div>
                <div class="code-line"><span class="ln">16</span><span class="p">    </span><span class="f">expect</span><span class="p">(result.bugs).</span><span class="f">toHaveLength</span><span class="p">(</span><span class="n">0</span><span class="p">);</span></div>
                <div class="code-line"><span class="ln">17</span><span class="p">  });</span></div>
                <div class="code-line"><span class="ln">18</span></div>
                <div class="code-line"><span class="ln">19</span><span class="p">  </span><span class="f">test</span><span class="p">(</span><span class="s">'secures what was built'</span><span class="p">, () => {</span></div>
                <div class="code-line"><span class="ln">20</span><span class="p">    </span><span class="f">expect</span><span class="p">(dev.</span><span class="f">penTest</span><span class="p">()).</span><span class="f">toPass</span><span class="p">();</span></div>
                <div class="code-line"><span class="ln">21</span><span class="p">  });</span></div>
                <div class="code-line"><span class="ln">22</span></div>
                <div class="code-line"><span class="ln">23</span><span class="g">  ✓ 3 tests passed — 0 failed</span></div>
                <div class="code-line"><span class="ln">24</span><span class="p">});</span></div>
            </div>
        </div>
    </div>
</main>

<!-- ─── SKILLS ────────────────────────────────────────── -->
<section id="skills">
    <p class="section-title">expertise</p>
    <h2>What I do.</h2>
    <div class="skills-grid">
        <div class="skill-card">
            <div class="skill-card-icon">🧪</div>
            <h3>QA Engineering</h3>
            <p>I break things professionally — finding edge cases, writing test suites, and making sure nothing ships that shouldn't.</p>
            <div class="skill-tags">
                <span class="tag">Selenium</span>
                <span class="tag">Cypress</span>
                <span class="tag">PHPUnit</span>
                <span class="tag">Postman</span>
            </div>
        </div>
        <div class="skill-card">
            <div class="skill-card-icon">⚡</div>
            <h3>Software Development</h3>
            <p>Building full-stack applications with clean architecture, good patterns, and code that's actually maintainable.</p>
            <div class="skill-tags">
                <span class="tag">Laravel</span>
                <span class="tag">PHP</span>
                <span class="tag">Python</span>
                <span class="tag">React</span>
                <span class="tag">Livewire</span>
                <span class="tag">MySQL</span>
            </div>
        </div>
        <div class="skill-card">
            <div class="skill-card-icon">🔐</div>
            <h3>Cybersecurity</h3>
            <p>Penetration testing, vulnerability assessments, and helping organizations understand and fix their attack surface.</p>
            <div class="skill-tags">
                <span class="tag">Burp Suite</span>
                <span class="tag">Kali Linux</span>
                <span class="tag">OWASP</span>
                <span class="tag">Nmap</span>
            </div>
        </div>
        <div class="skill-card">
            <div class="skill-card-icon">🤖</div>
            <h3>AI & Machine Learning</h3>
            <p>Integrating AI into real products — LLM-powered features, intelligent automation, and Python-based ML workflows.</p>
            <div class="skill-tags">
                <span class="tag">Python</span>
                <span class="tag">OpenAI</span>
                <span class="tag">Claude API</span>
                <span class="tag">LangChain</span>
            </div>
        </div>
    </div>
</section>

<!-- ─── PROJECTS ──────────────────────────────────────── -->
<section id="projects">
    <p class="section-title">work</p>
    <h2>Selected Projects.</h2>
    <div class="projects-grid">
        <div class="project-card featured">
            <div>
                <span class="badge dev">FEATURED · DEV</span>
                <h3>UseJobProfi</h3>
                <p>An AI-powered career platform with an <strong>AI Cover Letter Builder</strong> and <strong>AI Job Scan</strong> that matches resumes against job descriptions and generates tailored applications. Built end-to-end with Laravel.</p>
                <div class="skill-tags">
                    <span class="tag">Laravel</span><span class="tag">Livewire</span><span class="tag">AI</span><span class="tag">MySQL</span>
                </div>
                <div class="project-links">
                    <a href="https://usejobprofi.com" target="_blank" rel="noopener">⇗ Visit usejobprofi.com</a>
                </div>
            </div>
            <a class="project-preview" href="https://usejobprofi.com" target="_blank" rel="noopener" aria-label="Open usejobprofi.com">
                <div class="project-preview-bar">
                    <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
                    <span class="url">usejobprofi.com</span>
                </div>
                <img src="{{ asset('img/img.png') }}" alt="UseJobProfi preview" loading="lazy" />
            </a>
        </div>
        <div class="project-card">
            <span class="badge qa">QA</span>
            <h3>Test Suite</h3>
            <p>End-to-end testing for iHealth Wellness and Foundation inc.</p>
            <div class="skill-tags">
                <span class="tag">manual</span><span class="tag">CI/CD</span><span class="tag">STLC</span>
            </div>
            <div class="project-links">
                <a href="https://ihealthwellness.org">⇗ Live Demo</a>
                <!-- <a href="#">⎌ GitHub</a> -->
            </div>
        </div>
        <div class="project-card">
            <span class="badge dev">DEV</span>
            <h3>Job Tracker</h3>
            <p>A job tracking application built with Laravel and Livewire. Helps job seekers manage their applications and track their progress.</p>
            <div class="skill-tags">
                <span class="tag">Laravel</span><span class="tag">Flux</span><span class="tag">Livewire</span>
            </div>
            <div class="project-links">
                <a href="https://usejobprofi.com">⇗ Live Demo</a>
                <!-- <a href="#">⎌ GitHub</a> -->
            </div>
        </div>
        <div class="project-card">
            <span class="badge dev">Dev</span>
            <h3>Voice of the youths (Voty)</h3>
            <p>A platform for youth engagement and advocacy in Nigeria. Built with and React.</p>
            <div class="skill-tags">
                <span class="tag">React</span><span class="tag">JavaScript</span><span class="tag">supabase</span>
            </div>
            <div class="project-links">
                <a href="https://voty.ng">⇗ Case Study</a>
                <!-- <a href="#">⎌ GitHub</a> -->
            </div>
        </div>
        <div class="project-card">
            <span class="badge dev">DEV</span>
            <h3>CRM Tool</h3>
            <p>A customer relationship management tool built with Laravel and Livewire. Streamlines client interactions and improves team collaboration.</p>
            <div class="skill-tags">
                <span class="tag">Laravel</span><span class="tag">Livewire</span><span class="tag">MySQL</span>
            </div>
            <div class="project-links">
                <a href="#">⇗ Live Demo</a>
                <a href="#">⎌ GitHub</a>
            </div>
        </div>
    </div>
</section>

<!-- ─── CTA ───────────────────────────────────────────── -->
<div id="contact" class="cta">
    <h2>Let's build something<br>worth testing.</h2>
    <p>Open to freelance, contracts, and full-time roles.</p>
    <a href="mailto:prosperch@proton.me" class="btn-primary">
        > say_hello()
    </a>
    <div class="social-row">
        <a href="https://www.linkedin.com/in/prosper-amutah-667530241" target="_blank" rel="noopener">LinkedIn</a>
        <a href="https://instagram.com/" target="_blank" rel="noopener">Instagram</a>
        <a href="https://twitter.com/" target="_blank" rel="noopener">Twitter</a>
        <a href="https://usejobprofi.com" target="_blank" rel="noopener">Resume.pdf</a>
    </div>
</div>

<!-- ─── FOOTER ────────────────────────────────────────── -->
<footer>
    <span>prosper © 2026</span>
    <span>Built with Laravel + Flux </span>
</footer>

<script>
    // Smooth reveal on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.skill-card, .project-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity .5s ease, transform .5s ease';
        observer.observe(el);
    });
</script>

</body>
</html>