@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ══════════════════════════════════════════════════════
   TOKENS
══════════════════════════════════════════════════════ */
:root {
    --ink:        #0d0d0d;
    --ink-2:      #1c1c1c;
    --ink-3:      #2e2e2e;
    --mist:       #f7f6f3;
    --mist-2:     #efede8;
    --border:     #e3e0d8;
    --border-dk:  #2e2e2e;
    --gold:       #c9a84c;
    --gold-light: #e8c96a;
    --gold-soft:  #f5edd8;
    --white:      #ffffff;
    --text-body:  #4a4742;
    --text-muted: #8c8882;
    --success:    #2d7a5f;
    --error:      #c0392b;

    --f-display: 'Fraunces', Georgia, serif;
    --f-body:    'DM Sans', sans-serif;

    --r-sm: 4px;
    --r-md: 8px;
    --r-lg: 14px;
    --r-xl: 20px;

    --shadow-card: 0 2px 12px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
    --shadow-lift: 0 12px 40px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.06);
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

html { scroll-behavior: smooth; }

body {
    background: var(--mist);
    color: var(--ink);
    font-family: var(--f-body);
    line-height: 1.55;
    -webkit-font-smoothing: antialiased;
}

.wrap {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ══════════════════════════════════════════════════════
   HERO
══════════════════════════════════════════════════════ */
.hero {
    background: var(--ink);
    padding: 90px 0 0;
    position: relative;
    overflow: hidden;
}

/* Subtle dot grid texture */
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.07) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

/* Gold accent line top */
.hero::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.hero-inner {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 80px;
    align-items: end;
    position: relative;
    z-index: 1;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--f-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 28px;
}

.hero-label::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.hero-title {
    font-family: var(--f-display);
    font-size: clamp(52px, 6vw, 80px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
    margin-bottom: 28px;
}

.hero-title em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.hero-sub {
    font-size: 17px;
    color: rgba(255,255,255,0.55);
    line-height: 1.65;
    max-width: 480px;
    margin-bottom: 44px;
}

/* Hero search */
.hero-search {
    display: flex;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--r-md);
    overflow: hidden;
    transition: border-color 0.2s;
    backdrop-filter: blur(6px);
}

.hero-search:focus-within {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
}

.hero-search input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 16px 22px;
    font-family: var(--f-body);
    font-size: 15px;
    color: var(--white);
    outline: none;
}

.hero-search input::placeholder { color: rgba(255,255,255,0.35); }

.hero-search button {
    background: var(--gold);
    border: none;
    padding: 14px 28px;
    font-family: var(--f-body);
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
}

.hero-search button:hover { background: var(--gold-light); }

/* Hero stats */
.hero-stats {
    display: flex;
    gap: 44px;
    margin-top: 56px;
    padding-top: 44px;
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-bottom: 56px;
}

.hero-stat-num {
    font-family: var(--f-display);
    font-size: 36px;
    font-weight: 600;
    color: var(--white);
    line-height: 1;
    margin-bottom: 4px;
}

.hero-stat-label {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.04em;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
}

/* Hero right panel — featured event teaser */
.hero-panel {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--r-xl) var(--r-xl) 0 0;
    padding: 36px 32px;
    position: relative;
    align-self: stretch;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.hero-panel-tag {
    position: absolute;
    top: 24px; left: 32px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
    display: flex;
    align-items: center;
    gap: 6px;
}

.hero-panel-tag::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gold);
    animation: pulse 1.8s ease infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.3); }
}

.hero-panel-event {
    font-family: var(--f-display);
    font-size: 26px;
    font-weight: 600;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 20px;
}

.hero-panel-meta {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 28px;
}

.hero-panel-meta-row {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: rgba(255,255,255,0.5);
}

.hero-panel-meta-row i { color: var(--gold); font-size: 13px; }

.hero-panel-price {
    font-family: var(--f-display);
    font-size: 32px;
    font-weight: 600;
    color: var(--gold);
    margin-bottom: 18px;
}

.hero-panel-price span {
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 400;
    color: rgba(255,255,255,0.4);
    margin-left: 6px;
}

.btn-gold {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: var(--gold);
    color: var(--ink);
    font-family: var(--f-body);
    font-size: 14px;
    font-weight: 600;
    padding: 14px 24px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    width: 100%;
    letter-spacing: 0.01em;
}

.btn-gold:hover {
    background: var(--gold-light);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.3);
    color: var(--ink);
}

/* ══════════════════════════════════════════════════════
   SECTION COMMONS
══════════════════════════════════════════════════════ */
.section { padding: 80px 0; }

.section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 48px;
}

.section-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-label::before {
    content: '';
    display: block;
    width: 18px;
    height: 1px;
    background: var(--gold);
}

.section-title {
    font-family: var(--f-display);
    font-size: 36px;
    font-weight: 600;
    letter-spacing: -0.025em;
    color: var(--ink);
    line-height: 1.1;
}

.section-desc {
    font-size: 15px;
    color: var(--text-muted);
    margin-top: 8px;
}

.link-all {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    text-decoration: none;
    padding-bottom: 2px;
    border-bottom: 1px solid var(--ink);
    transition: all 0.2s;
    white-space: nowrap;
}

.link-all:hover {
    color: var(--gold);
    border-bottom-color: var(--gold);
    gap: 12px;
}

/* ══════════════════════════════════════════════════════
   EVENTS — FEATURED ROW + GRID
══════════════════════════════════════════════════════ */
.events-section { background: var(--mist); }

/* Featured card (first event) */
.featured-card {
    display: grid;
    grid-template-columns: 1fr 320px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    margin-bottom: 28px;
    transition: box-shadow 0.25s, transform 0.25s;
}

.featured-card:hover {
    box-shadow: var(--shadow-lift);
    transform: translateY(-2px);
}

.featured-card-body {
    padding: 44px 48px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.featured-card-top {}

.featured-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--gold-soft);
    color: #8a6a1a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 20px;
}

.featured-pill i { font-size: 11px; }

.featured-title {
    font-family: var(--f-display);
    font-size: 38px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.1;
    letter-spacing: -0.025em;
    margin-bottom: 18px;
    max-width: 520px;
}

.featured-desc {
    font-size: 15px;
    color: var(--text-body);
    line-height: 1.65;
    margin-bottom: 32px;
    max-width: 480px;
}

.featured-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 36px;
}

.featured-meta-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: var(--text-body);
}

.featured-meta-chip i {
    color: var(--gold);
    font-size: 15px;
}

.featured-card-actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-dark {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--ink);
    color: var(--white);
    font-family: var(--f-body);
    font-size: 14px;
    font-weight: 600;
    padding: 14px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
    letter-spacing: 0.01em;
}

.btn-dark:hover {
    background: var(--ink-3);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    color: var(--white);
}

.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    color: var(--text-body);
    font-size: 14px;
    font-weight: 500;
    padding: 14px 20px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid var(--border);
    transition: all 0.2s;
}

.btn-ghost:hover {
    border-color: var(--ink);
    color: var(--ink);
    background: var(--mist);
}

/* Featured card sidebar */
.featured-card-side {
    background: var(--ink);
    padding: 44px 36px;
    display: flex;
    flex-direction: column;
    gap: 32px;
    position: relative;
    overflow: hidden;
}

.featured-card-side::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.15), transparent 70%);
}

.fcs-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    margin-bottom: 6px;
}

.fcs-value {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--white);
    line-height: 1.1;
}

.fcs-value.gold { color: var(--gold); }

.fcs-divider {
    height: 1px;
    background: rgba(255,255,255,0.08);
}

.fcs-category {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 100px;
    padding: 8px 16px;
    font-size: 13px;
    color: rgba(255,255,255,0.7);
    width: fit-content;
}

.fcs-category i { color: var(--gold); }

.fcs-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: rgba(255,255,255,0.5);
    margin-top: auto;
}

.fcs-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #4ade80;
    animation: pulse 1.8s ease infinite;
}

/* Regular event cards grid */
.events-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.event-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    transition: box-shadow 0.25s, transform 0.25s;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    box-shadow: var(--shadow-lift);
    transform: translateY(-3px);
}

/* Top color strip per category */
.event-card-strip {
    height: 4px;
    width: 100%;
}

.event-card-body {
    padding: 26px 28px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.event-card-tags {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 4px;
}

.tag-category {
    background: var(--gold-soft);
    color: #8a6a1a;
}

.tag-status-upcoming  { background: #dbeafe; color: #1d4ed8; }
.tag-status-ongoing   { background: #d1fae5; color: #065f46; }
.tag-status-completed { background: #f3f4f6; color: #4b5563; }

.event-card-title {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.25;
    letter-spacing: -0.02em;
    margin-bottom: 14px;
}

.event-card-meta {
    display: flex;
    flex-direction: column;
    gap: 7px;
    margin-bottom: 16px;
}

.event-card-meta-row {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 13px;
    color: var(--text-muted);
}

.event-card-meta-row i {
    color: var(--gold);
    font-size: 13px;
    width: 14px;
}

.event-card-desc {
    font-size: 13px;
    color: var(--text-body);
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
}

.event-card-footer {
    border-top: 1px solid var(--border);
    padding-top: 18px;
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.event-card-price-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 2px;
}

.event-card-price-value {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1;
}

.event-card-price-free {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--success);
}

.btn-sm-dark {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--ink);
    color: var(--white);
    font-size: 13px;
    font-weight: 600;
    padding: 10px 18px;
    border-radius: var(--r-sm);
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.btn-sm-dark:hover {
    background: var(--ink-3);
    color: var(--white);
    transform: translateY(-1px);
}

/* No events */
.empty-box {
    text-align: center;
    padding: 80px 40px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
}

.empty-box i {
    font-size: 44px;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: block;
    opacity: 0.5;
}

.empty-box h3 {
    font-family: var(--f-display);
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 10px;
}

.empty-box p { color: var(--text-muted); margin-bottom: 28px; font-size: 15px; }

/* ══════════════════════════════════════════════════════
   STATS STRIP
══════════════════════════════════════════════════════ */
.stats-strip {
    background: var(--ink);
    padding: 56px 0;
}

.stats-strip-inner {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: rgba(255,255,255,0.08);
}

.stat-cell {
    background: var(--ink);
    padding: 36px 40px;
    text-align: center;
}

.stat-cell-num {
    font-family: var(--f-display);
    font-size: 44px;
    font-weight: 600;
    color: var(--gold);
    line-height: 1;
    margin-bottom: 8px;
}

.stat-cell-label {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
}

/* ══════════════════════════════════════════════════════
   CATEGORIES
══════════════════════════════════════════════════════ */
.categories-section { background: var(--mist-2); }

.cat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.cat-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 32px 28px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: all 0.25s;
    position: relative;
    overflow: hidden;
}

.cat-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--gold);
    transform: scaleX(0);
    transition: transform 0.25s;
}

.cat-card:hover {
    border-color: transparent;
    box-shadow: var(--shadow-lift);
    transform: translateY(-3px);
}

.cat-card:hover::after { transform: scaleX(1); }

.cat-icon-wrap {
    width: 52px; height: 52px;
    border-radius: var(--r-md);
    background: var(--gold-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #8a6a1a;
    transition: all 0.25s;
}

.cat-card:hover .cat-icon-wrap {
    background: var(--ink);
    color: var(--gold);
}

.cat-name {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    letter-spacing: -0.015em;
}

.cat-desc { font-size: 13px; color: var(--text-muted); }

.cat-arrow {
    margin-top: auto;
    font-size: 18px;
    color: var(--border);
    transition: all 0.25s;
}

.cat-card:hover .cat-arrow {
    color: var(--gold);
    transform: translateX(4px);
}

/* ══════════════════════════════════════════════════════
   NEWSLETTER
══════════════════════════════════════════════════════ */
.newsletter-section { background: var(--mist); padding-bottom: 100px; }

.newsletter-box {
    background: var(--ink);
    border-radius: var(--r-xl);
    padding: 80px;
    position: relative;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.newsletter-box::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 80% 50%, rgba(201,168,76,0.12), transparent 60%);
}

.newsletter-left { position: relative; z-index: 1; }

.nl-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
}

.nl-label::before {
    content: '';
    width: 18px; height: 1px;
    background: var(--gold);
}

.nl-title {
    font-family: var(--f-display);
    font-size: 42px;
    font-weight: 600;
    color: var(--white);
    line-height: 1.1;
    letter-spacing: -0.025em;
    margin-bottom: 16px;
}

.nl-title em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.nl-desc { font-size: 15px; color: rgba(255,255,255,0.5); line-height: 1.65; }

.newsletter-right { position: relative; z-index: 1; }

.nl-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.nl-input {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--r-md);
    padding: 16px 20px;
    font-family: var(--f-body);
    font-size: 15px;
    color: var(--white);
    outline: none;
    transition: border-color 0.2s;
}

.nl-input::placeholder { color: rgba(255,255,255,0.3); }
.nl-input:focus { border-color: var(--gold); }

.nl-btn {
    background: var(--gold);
    color: var(--ink);
    border: none;
    border-radius: var(--r-md);
    padding: 16px 28px;
    font-family: var(--f-body);
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.nl-btn:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.3);
}

.nl-note { font-size: 12px; color: rgba(255,255,255,0.3); margin-top: 8px; }

/* ══════════════════════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fade-up {
    opacity: 0;
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* ══════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════ */
@media (max-width: 1100px) {
    .hero-inner { grid-template-columns: 1fr; gap: 0; }
    .hero-panel { display: none; }
    .events-grid { grid-template-columns: repeat(2, 1fr); }
    .cat-grid { grid-template-columns: repeat(2, 1fr); }
    .stats-strip-inner { grid-template-columns: repeat(2, 1fr); }
    .newsletter-box { grid-template-columns: 1fr; gap: 48px; padding: 56px; }
    .featured-card { grid-template-columns: 1fr; }
    .featured-card-side { display: none; }
}

@media (max-width: 768px) {
    .wrap { padding: 0 20px; }
    .hero { padding: 60px 0 0; }
    .hero-title { font-size: 44px; }
    .hero-stats { gap: 28px; flex-wrap: wrap; }
    .section { padding: 60px 0; }
    .section-head { flex-direction: column; align-items: flex-start; gap: 20px; }
    .events-grid { grid-template-columns: 1fr; }
    .cat-grid { grid-template-columns: 1fr; }
    .stats-strip-inner { grid-template-columns: repeat(2, 1fr); }
    .newsletter-box { padding: 40px 28px; }
    .featured-card-body { padding: 28px 24px; }
    .featured-title { font-size: 26px; }
}
</style>
@endpush

@section('content')

{{-- ══ HERO ══════════════════════════════════════════════ --}}
<section class="hero">
    <div class="wrap">
        <div class="hero-inner">

            {{-- Left: copy + search --}}
            <div class="hero-content">
                <div class="hero-label">Live Events Platform</div>
                <h1 class="hero-title">
                    The best events,<br>
                    <em>curated for you</em>
                </h1>
                <p class="hero-sub">
                    Concerts, festivals, sports, culture. Book tickets instantly — no hidden fees, no hassle.
                </p>

                <form action="{{ route('events.index') }}" method="GET" class="hero-search">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by name, location, or category..."
                        value="{{ request('search') }}"
                        autocomplete="off">
                    <button type="submit">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </form>

                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-num">500+</div>
                        <div class="hero-stat-label">Active Events</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">50k+</div>
                        <div class="hero-stat-label">Tickets Sold</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">100+</div>
                        <div class="hero-stat-label">Cities</div>
                    </div>
                </div>
            </div>

            {{-- Right: Featured event preview panel --}}
            @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
            @php $featured = $upcomingEvents->first(); @endphp
            <div class="hero-panel">
                <div class="hero-panel-tag">Featured tonight</div>

                <div>
                    <div class="hero-panel-event">{{ Str::limit($featured->name, 48) }}</div>

                    <div class="hero-panel-meta">
                        <div class="hero-panel-meta-row">
                            <i class="bi bi-calendar3"></i>
                            {{ $featured->formatted_date }}
                        </div>
                        <div class="hero-panel-meta-row">
                            <i class="bi bi-clock"></i>
                            {{ $featured->formatted_time }}
                        </div>
                        <div class="hero-panel-meta-row">
                            <i class="bi bi-geo-alt"></i>
                            {{ Str::limit($featured->location, 40) }}
                        </div>
                    </div>

                    @if($featured->tickets->isNotEmpty())
                        @if($featured->min_price !== null)
                            <div class="hero-panel-price">
                                ${{ number_format($featured->min_price, 2) }}
                                <span>starting price</span>
                            </div>
                        @else
                            <div class="hero-panel-price">Free <span>admission</span></div>
                        @endif
                        <a href="{{ route('events.show', $featured) }}" class="btn-gold">
                            Get Tickets <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <div class="hero-panel-price" style="font-size:16px; color:rgba(255,255,255,0.4);">
                            Tickets unavailable
                        </div>
                        <a href="{{ route('events.show', $featured) }}" class="btn-gold" style="opacity:0.5; pointer-events:none; cursor:not-allowed;">
                            Not Available
                        </a>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- ══ UPCOMING EVENTS ═══════════════════════════════════ --}}
<section class="section events-section">
    <div class="wrap">

        <div class="section-head fade-up">
            <div>
                <div class="section-label">Upcoming Events</div>
                <h2 class="section-title">Hand-picked for you</h2>
                <p class="section-desc">Don't miss the events everyone's talking about</p>
            </div>
            <a href="{{ route('events.index') }}" class="link-all">
                View all events <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())

            {{-- Featured card (first event) --}}
            @php $featured = $upcomingEvents->first(); @endphp
            <div class="featured-card fade-up" data-event-id="{{ $featured->id }}">

                <div class="featured-card-body">
                    <div class="featured-card-top">
                        <div class="featured-pill">
                            <i class="bi bi-star-fill"></i>
                            Editor's Pick
                        </div>

                        <h3 class="featured-title">{{ $featured->name }}</h3>

                        <p class="featured-desc">{{ Str::limit($featured->description, 180) }}</p>

                        <div class="featured-meta">
                            <div class="featured-meta-chip">
                                <i class="bi bi-calendar3"></i>
                                {{ $featured->formatted_date }}
                            </div>
                            <div class="featured-meta-chip">
                                <i class="bi bi-clock"></i>
                                {{ $featured->formatted_time }}
                            </div>
                            <div class="featured-meta-chip">
                                <i class="bi bi-geo-alt"></i>
                                {{ $featured->location }}
                            </div>
                            @if($featured->category)
                            <div class="featured-meta-chip">
                                <i class="{{ $featured->category_icon }}"></i>
                                {{ $featured->category }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="featured-card-actions">
                        @if($featured->tickets->isNotEmpty())
                            <a href="{{ route('events.show', $featured) }}" class="btn-dark">
                                Get Tickets <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <span class="btn-dark" style="opacity:0.45; cursor:not-allowed; pointer-events:none;">
                                Tickets Unavailable
                            </span>
                        @endif
                        <a href="{{ route('events.show', $featured) }}" class="btn-ghost">
                            View Details
                        </a>
                    </div>
                </div>

                <div class="featured-card-side">
                    <div>
                        <div class="fcs-label">Date</div>
                        <div class="fcs-value">{{ $featured->formatted_date }}</div>
                    </div>

                    <div class="fcs-divider"></div>

                    <div>
                        <div class="fcs-label">Time</div>
                        <div class="fcs-value">{{ $featured->formatted_time }}</div>
                    </div>

                    <div class="fcs-divider"></div>

                    <div>
                        <div class="fcs-label">Starting from</div>
                        @if($featured->tickets->isNotEmpty())
                            @if($featured->min_price !== null)
                                <div class="fcs-value gold">${{ number_format($featured->min_price, 2) }}</div>
                            @else
                                <div class="fcs-value gold">Free</div>
                            @endif
                        @else
                            <div class="fcs-value" style="font-size:14px; color:rgba(255,255,255,0.35);">Not available</div>
                        @endif
                    </div>

                    @if($featured->category)
                    <div>
                        <div class="fcs-category">
                            <i class="{{ $featured->category_icon }}"></i>
                            {{ $featured->category }}
                        </div>
                    </div>
                    @endif

                    <div class="fcs-status" data-status="{{ $featured->live_status }}">
                        <span class="fcs-dot"></span>
                        <span class="fcs-status-label">{{ ucfirst($featured->live_status) }}</span>
                    </div>
                </div>

            </div>

            {{-- Remaining events grid --}}
            @if($upcomingEvents->count() > 1)
            <div class="events-grid">
                @foreach($upcomingEvents->skip(1) as $event)
                @php
                    $stripColor = $event->category_color;
                    $delay      = $loop->index * 0.08;
                @endphp
                <div class="event-card fade-up"
                     data-event-id="{{ $event->id }}"
                     style="animation-delay: {{ $delay }}s">

                    <div class="event-card-strip" style="background: {{ $stripColor }};"></div>

                    <div class="event-card-body">

                        <div class="event-card-tags">
                            @if($event->category)
                                <span class="tag tag-category">
                                    <i class="{{ $event->category_icon }}"></i>
                                    {{ $event->category }}
                                </span>
                            @endif
                            <span class="tag tag-status-{{ $event->live_status }}"
                                  data-status="{{ $event->live_status }}">
                                {{ ucfirst($event->live_status) }}
                            </span>
                        </div>

                        <h3 class="event-card-title">{{ $event->name }}</h3>

                        <div class="event-card-meta">
                            <div class="event-card-meta-row">
                                <i class="bi bi-calendar3"></i>
                                {{ $event->formatted_date }}
                            </div>
                            <div class="event-card-meta-row">
                                <i class="bi bi-clock"></i>
                                {{ $event->formatted_time }}
                            </div>
                            <div class="event-card-meta-row">
                                <i class="bi bi-geo-alt"></i>
                                {{ Str::limit($event->location, 38) }}
                            </div>
                        </div>

                        <p class="event-card-desc">{{ Str::limit($event->description, 90) }}</p>

                        <div class="event-card-footer">
                            <div>
                                @if($event->tickets->isNotEmpty())
                                    <div class="event-card-price-label">
                                        {{ $event->min_price !== null ? 'From' : 'Admission' }}
                                    </div>
                                    @if($event->min_price !== null)
                                        <div class="event-card-price-value">${{ number_format($event->min_price, 2) }}</div>
                                    @else
                                        <div class="event-card-price-free">Free</div>
                                    @endif
                                @else
                                    <div class="event-card-price-label">Tickets</div>
                                    <div style="font-size:13px; color:#8c8882; font-style:italic;">Not available</div>
                                @endif
                            </div>

                            <a href="{{ route('events.show', $event) }}" class="btn-sm-dark">
                                Details <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        @else
            <div class="empty-box fade-up">
                <i class="bi bi-calendar-x"></i>
                <h3>No upcoming events</h3>
                <p>New events are added daily — check back soon.</p>
                <a href="{{ route('events.index') }}" class="btn-dark" style="display:inline-flex; width:auto; margin: 0 auto;">
                    Browse All Events <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @endif

    </div>
</section>

{{-- ══ STATS STRIP ═══════════════════════════════════════ --}}
<div class="stats-strip">
    <div class="wrap">
        <div class="stats-strip-inner">
            <div class="stat-cell">
                <div class="stat-cell-num">500+</div>
                <div class="stat-cell-label">Events Hosted</div>
            </div>
            <div class="stat-cell">
                <div class="stat-cell-num">50k+</div>
                <div class="stat-cell-label">Tickets Sold</div>
            </div>
            <div class="stat-cell">
                <div class="stat-cell-num">100+</div>
                <div class="stat-cell-label">Cities Covered</div>
            </div>
            <div class="stat-cell">
                <div class="stat-cell-num">24/7</div>
                <div class="stat-cell-label">Support</div>
            </div>
        </div>
    </div>
</div>

{{-- ══ CATEGORIES ════════════════════════════════════════ --}}
<section class="section categories-section">
    <div class="wrap">
        <div class="section-head fade-up">
            <div>
                <div class="section-label">Browse by Category</div>
                <h2 class="section-title">Find your scene</h2>
                <p class="section-desc">Filter events by what you love most</p>
            </div>
        </div>

        <div class="cat-grid">
            @foreach(App\Models\Event::categories() as $name => $config)
            @php $delay = $loop->index * 0.07; @endphp
            <a href="{{ route('events.index', ['category' => $name]) }}"
               class="cat-card fade-up"
               style="animation-delay: {{ $delay }}s">
                <div class="cat-icon-wrap">
                    <i class="{{ $config['icon'] }}"></i>
                </div>
                <div>
                    <div class="cat-name">{{ $name }}</div>
                    <div class="cat-desc">{{ $config['emoji'] }} Explore events</div>
                </div>
                <i class="bi bi-arrow-right cat-arrow"></i>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ NEWSLETTER ═════════════════════════════════════════ --}}
<section class="section newsletter-section">
    <div class="wrap">
        <div class="newsletter-box fade-up">
            <div class="newsletter-left">
                <div class="nl-label">Stay in the loop</div>
                <h2 class="nl-title">Never miss an<br><em>amazing event</em></h2>
                <p class="nl-desc">
                    Weekly picks, exclusive pre-sales, and the best events in your city — straight to your inbox.
                </p>
            </div>
            <div class="newsletter-right">
                <form class="nl-form">
                    <input type="email" class="nl-input" placeholder="Your email address" required>
                    <button type="submit" class="nl-btn">
                        Subscribe Now <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
                <p class="nl-note">No spam. Unsubscribe anytime. We respect your privacy.</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Intersection Observer — staggered fade-up on scroll
const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            io.unobserve(entry.target);
        }
    });
}, { threshold: 0.07, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.fade-up').forEach(el => {
    el.style.animationPlayState = 'paused';
    io.observe(el);
});
</script>

<script>
(function () {
    const INTERVAL = 15000;

    const STATUS_CONFIG = {
        upcoming: { label: 'Upcoming', icon: 'bi-clock',              cls: 'upcoming' },
        ongoing:  { label: 'Ongoing',  icon: 'bi-record-circle-fill', cls: 'ongoing'  },
    };

    // Tag classes used on the home page grid cards
    const TAG_CLASS = {
        upcoming: 'tag tag-status-upcoming',
        ongoing:  'tag tag-status-ongoing',
    };

    function flash(el) {
        el.style.transition = 'none';
        el.style.outline    = '2px solid var(--gold)';
        setTimeout(() => {
            el.style.transition = 'outline 0.6s ease';
            el.style.outline    = '2px solid transparent';
        }, 600);
    }

    async function pollStatuses() {
        try {
            const res  = await fetch('/events/status/poll');
            if (!res.ok) return;
            const data = await res.json();

            Object.entries(data).forEach(([id, status]) => {
                const config = STATUS_CONFIG[status];
                if (!config) return;

                const card = document.querySelector(`[data-event-id="${id}"]`);
                if (!card) return;

                // ── Home grid cards use .tag with data-status ──
                const tag = card.querySelector('[data-status]');
                if (tag && tag.dataset.status !== status) {
                    tag.dataset.status = status;

                    // Grid card tag (tag-status-*)
                    if (tag.classList.contains('tag')) {
                        tag.className  = TAG_CLASS[status] || tag.className;
                        tag.innerHTML  = `<i class="bi ${config.icon}"></i> ${config.label}`;
                    }

                    // Featured sidebar status (fcs-status)
                    if (tag.classList.contains('fcs-status')) {
                        const dot   = tag.querySelector('.fcs-dot');
                        const label = tag.querySelector('.fcs-status-label');
                        if (label) label.textContent = config.label;
                    }

                    flash(tag);
                }
            });
        } catch (e) {}
    }

    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) pollStatuses();
    });

    pollStatuses();
    setInterval(pollStatuses, INTERVAL);
})();
</script>

@endpush