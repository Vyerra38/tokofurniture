<?php

$dir = __DIR__ . '/../../public/images/products';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$svgs = [
    'placeholder-product.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#EAF6FF"/>
      <stop offset="50%" stop-color="#BDE0FE"/>
      <stop offset="100%" stop-color="#FFAFCC"/>
    </linearGradient>
    <filter id="glow">
      <feGaussianBlur stdDeviation="6" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
  </defs>
  <rect width="600" height="600" rx="32" fill="url(#bg)"/>
  <circle cx="300" cy="300" r="140" fill="#ffffff" fill-opacity="0.6" stroke="#ffffff" stroke-width="3" filter="url(#glow)"/>
  <path d="M300 210 L318 268 L376 286 L318 304 L300 362 L282 304 L224 286 L282 268 Z" fill="#CDB4DB"/>
  <text x="300" y="440" font-family="system-ui, sans-serif" font-size="22" font-weight="bold" fill="#6B7280" text-anchor="middle">AuraSpace Studio ✦</text>
</svg>',

    'chrome-bubble-wall-clock.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <radialGradient id="bg" cx="50%" cy="40%" r="60%">
      <stop offset="0%" stop-color="#FFFFFF"/>
      <stop offset="60%" stop-color="#EAF6FF"/>
      <stop offset="100%" stop-color="#BDE0FE"/>
    </radialGradient>
    <linearGradient id="chrome" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#E2E8F0"/>
      <stop offset="30%" stop-color="#94A3B8"/>
      <stop offset="50%" stop-color="#FFFFFF"/>
      <stop offset="70%" stop-color="#64748B"/>
      <stop offset="100%" stop-color="#CBD5E1"/>
    </linearGradient>
    <filter id="bubble-shadow">
      <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#38BDF8" flood-opacity="0.3"/>
    </filter>
  </defs>
  <rect width="600" height="600" rx="32" fill="url(#bg)"/>
  <circle cx="300" cy="300" r="170" fill="url(#chrome)" filter="url(#bubble-shadow)"/>
  <circle cx="300" cy="300" r="145" fill="#F8FAFC" stroke="#E2E8F0" stroke-width="4"/>
  <ellipse cx="250" cy="220" rx="70" ry="35" fill="#FFFFFF" fill-opacity="0.8" transform="rotate(-25 250 220)"/>
  <!-- Clock dots -->
  <circle cx="300" cy="180" r="8" fill="#3B82F6"/>
  <circle cx="420" cy="300" r="8" fill="#3B82F6"/>
  <circle cx="300" cy="420" r="8" fill="#3B82F6"/>
  <circle cx="180" cy="300" r="8" fill="#3B82F6"/>
  <!-- Hands -->
  <line x1="300" y1="300" x2="300" y2="210" stroke="#0F172A" stroke-width="7" stroke-linecap="round"/>
  <line x1="300" y1="300" x2="380" y2="300" stroke="#0F172A" stroke-width="5" stroke-linecap="round"/>
  <circle cx="300" cy="300" r="14" fill="#EC4899"/>
  <!-- Star accents -->
  <path d="M480 140 L488 165 L513 173 L488 181 L480 206 L472 181 L447 173 L472 165 Z" fill="#FFAFCC"/>
  <path d="M120 440 L126 458 L144 464 L126 470 L120 488 L114 470 L96 464 L114 458 Z" fill="#A2D2FF"/>
</svg>',

    'y2k-wave-mirror.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="grad-wave" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FFC8DD"/>
      <stop offset="50%" stop-color="#CDB4DB"/>
      <stop offset="100%" stop-color="#A2D2FF"/>
    </linearGradient>
    <linearGradient id="glass" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.9"/>
      <stop offset="50%" stop-color="#EAF6FF" stop-opacity="0.7"/>
      <stop offset="100%" stop-color="#BDE0FE" stop-opacity="0.85"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#FAF5FF"/>
  <!-- Wave frame -->
  <path d="M220 90 Q170 120 180 180 Q190 240 170 300 Q150 360 175 420 Q200 480 260 490 Q320 500 370 470 Q420 440 410 380 Q400 320 420 260 Q440 200 415 140 Q390 80 320 85 Q260 90 220 90 Z" fill="url(#grad-wave)" stroke="#FFFFFF" stroke-width="8"/>
  <!-- Glass mirror -->
  <path d="M240 130 Q200 160 210 205 Q220 250 205 295 Q190 340 210 385 Q230 430 280 440 Q330 450 360 420 Q390 390 385 345 Q380 300 395 255 Q410 210 390 165 Q370 120 310 125 Z" fill="url(#glass)"/>
  <!-- Gloss shine -->
  <line x1="240" y1="180" x2="350" y2="390" stroke="#FFFFFF" stroke-width="12" stroke-linecap="round" stroke-opacity="0.75"/>
  <!-- Y2K Sparkles -->
  <path d="M140 160 L146 178 L164 184 L146 190 L140 208 L134 190 L116 184 L134 178 Z" fill="#FFC8DD"/>
  <path d="M470 400 L478 422 L500 430 L478 438 L470 460 L462 438 L440 430 L462 422 Z" fill="#A2D2FF"/>
</svg>',

    'cloud-bedside-lamp.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <radialGradient id="lamp-glow" cx="50%" cy="45%" r="50%">
      <stop offset="0%" stop-color="#FFFFFF"/>
      <stop offset="40%" stop-color="#FFFBEB"/>
      <stop offset="80%" stop-color="#FEF08A"/>
      <stop offset="100%" stop-color="#FDE047" stop-opacity="0"/>
    </radialGradient>
    <linearGradient id="cloud-grad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#FFFFFF"/>
      <stop offset="100%" stop-color="#E0F2FE"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#F0FDF4"/>
  <circle cx="300" cy="270" r="190" fill="url(#lamp-glow)"/>
  <!-- Cloud body -->
  <path d="M210 330 Q170 330 165 290 Q160 250 200 240 Q215 190 270 190 Q315 190 335 215 Q375 200 405 230 Q435 260 420 300 Q445 330 410 350 Q380 360 300 360 Q240 360 210 330 Z" fill="url(#cloud-grad)" stroke="#BAE6FD" stroke-width="5"/>
  <!-- Face/cute smile -->
  <circle cx="270" cy="280" r="6" fill="#64748B"/>
  <circle cx="340" cy="280" r="6" fill="#64748B"/>
  <path d="M295 300 Q305 315 315 300" fill="none" stroke="#64748B" stroke-width="4" stroke-linecap="round"/>
  <!-- Blush -->
  <circle cx="250" cy="295" r="10" fill="#FFAFCC" fill-opacity="0.7"/>
  <circle cx="360" cy="295" r="10" fill="#FFAFCC" fill-opacity="0.7"/>
  <!-- Metallic Stand -->
  <rect x="290" y="360" width="20" height="90" rx="10" fill="#94A3B8"/>
  <ellipse cx="300" cy="460" rx="80" ry="22" fill="#CBD5E1" stroke="#94A3B8" stroke-width="3"/>
</svg>',

    'mini-acrylic-shelf.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="acrylic" x1="0%" y1="0%" x2="100%" y2="50%">
      <stop offset="0%" stop-color="#E0E7FF" stop-opacity="0.9"/>
      <stop offset="50%" stop-color="#DDD6FE" stop-opacity="0.7"/>
      <stop offset="100%" stop-color="#FCE7F3" stop-opacity="0.85"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#EFF6FF"/>
  <!-- Shelf panels -->
  <path d="M120 220 L480 220 L450 320 L90 320 Z" fill="url(#acrylic)" stroke="#FFFFFF" stroke-width="4"/>
  <path d="M90 320 L130 420 L490 420 L450 320 Z" fill="url(#acrylic)" fill-opacity="0.6" stroke="#FFFFFF" stroke-width="4"/>
  <rect x="130" y="420" width="360" height="24" rx="8" fill="#C7D2FE" stroke="#818CF8" stroke-width="3"/>
  <!-- Cute small decor items on shelf -->
  <circle cx="210" cy="260" r="28" fill="#F472B6"/>
  <rect x="340" y="240" width="40" height="55" rx="6" fill="#38BDF8"/>
  <circle cx="360" cy="230" r="12" fill="#FDE047"/>
  <!-- Y2K stars -->
  <path d="M480 150 L486 166 L502 172 L486 178 L480 194 L474 178 L458 172 L474 166 Z" fill="#A855F7"/>
</svg>',

    'silver-star-table-lamp.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="silver" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#F8FAFC"/>
      <stop offset="40%" stop-color="#94A3B8"/>
      <stop offset="70%" stop-color="#FFFFFF"/>
      <stop offset="100%" stop-color="#64748B"/>
    </linearGradient>
    <radialGradient id="star-glow" cx="50%" cy="40%" r="55%">
      <stop offset="0%" stop-color="#FEF08A"/>
      <stop offset="60%" stop-color="#BAE6FD" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0"/>
    </radialGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#0F172A"/>
  <circle cx="300" cy="260" r="180" fill="url(#star-glow)"/>
  <!-- Star shape lamp shade -->
  <path d="M300 110 L345 220 L460 230 L370 305 L400 415 L300 355 L200 415 L230 305 L140 230 L255 220 Z" fill="url(#silver)" stroke="#FFFFFF" stroke-width="5"/>
  <circle cx="300" cy="270" r="35" fill="#FEF9C3" stroke="#FACC15" stroke-width="4"/>
  <!-- Base rod -->
  <rect x="292" y="370" width="16" height="110" rx="8" fill="#CBD5E1"/>
  <ellipse cx="300" cy="485" rx="75" ry="20" fill="url(#silver)" stroke="#E2E8F0" stroke-width="3"/>
</svg>',

    'pastel-translucent-storage-box.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="trans-blue" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#A2D2FF" stop-opacity="0.9"/>
      <stop offset="50%" stop-color="#BDE0FE" stop-opacity="0.75"/>
      <stop offset="100%" stop-color="#FFC8DD" stop-opacity="0.85"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#FDF2F8"/>
  <!-- Box lid -->
  <path d="M120 210 L300 140 L480 210 L300 280 Z" fill="#FFAFCC" stroke="#FFFFFF" stroke-width="6"/>
  <!-- Box front left -->
  <path d="M120 210 L300 280 L300 440 L120 370 Z" fill="url(#trans-blue)" stroke="#FFFFFF" stroke-width="4"/>
  <!-- Box front right -->
  <path d="M300 280 L480 210 L480 370 L300 440 Z" fill="#BDE0FE" fill-opacity="0.8" stroke="#FFFFFF" stroke-width="4"/>
  <!-- Side handle cutout -->
  <rect x="180" y="275" width="45" height="15" rx="7" fill="#FFFFFF" fill-opacity="0.85"/>
  <rect x="375" y="275" width="45" height="15" rx="7" fill="#FFFFFF" fill-opacity="0.85"/>
  <!-- Sparkle -->
  <path d="M490 120 L496 136 L512 142 L496 148 L490 164 L484 148 L468 142 L484 136 Z" fill="#F472B6"/>
</svg>',

    'bubble-accent-side-table.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="bubble-pink" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FFAFCC"/>
      <stop offset="50%" stop-color="#FFC8DD"/>
      <stop offset="100%" stop-color="#CDB4DB"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#F8FAFC"/>
  <!-- Table top round disk -->
  <ellipse cx="300" cy="180" rx="160" ry="50" fill="#FFFFFF" stroke="#FFAFCC" stroke-width="8"/>
  <ellipse cx="300" cy="178" rx="145" ry="42" fill="#EAF6FF" fill-opacity="0.7"/>
  <!-- Stacked bubble spheres forming pedestal -->
  <circle cx="300" cy="270" r="55" fill="url(#bubble-pink)"/>
  <circle cx="300" cy="355" r="50" fill="#BDE0FE"/>
  <circle cx="300" cy="430" r="45" fill="#A2D2FF"/>
  <!-- Table base disk -->
  <ellipse cx="300" cy="485" rx="130" ry="35" fill="url(#bubble-pink)" stroke="#FFFFFF" stroke-width="6"/>
  <!-- Gloss reflection -->
  <ellipse cx="280" cy="250" rx="18" ry="10" fill="#FFFFFF" fill-opacity="0.75" transform="rotate(-30 280 250)"/>
  <ellipse cx="285" cy="340" rx="15" ry="8" fill="#FFFFFF" fill-opacity="0.75" transform="rotate(-30 285 340)"/>
</svg>',

    'heart-glow-neon-wall-mirror.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <filter id="neon-glow" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="14" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
    <linearGradient id="heart-glass" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.95"/>
      <stop offset="100%" stop-color="#FFC8DD" stop-opacity="0.6"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#2E1065"/>
  <!-- Neon tube outer glow -->
  <path d="M300 480 C180 370 120 280 120 200 C120 130 180 90 240 100 C275 106 300 135 300 135 C300 135 325 106 360 100 C420 90 480 130 480 200 C480 280 420 370 300 480 Z" fill="none" stroke="#FF4D8D" stroke-width="26" filter="url(#neon-glow)"/>
  <!-- Neon tube inner sharp -->
  <path d="M300 480 C180 370 120 280 120 200 C120 130 180 90 240 100 C275 106 300 135 300 135 C300 135 325 106 360 100 C420 90 480 130 480 200 C480 280 420 370 300 480 Z" fill="url(#heart-glass)" stroke="#FFF" stroke-width="8"/>
  <!-- Mirror shine line -->
  <line x1="220" y1="180" x2="340" y2="380" stroke="#FFFFFF" stroke-width="10" stroke-linecap="round" stroke-opacity="0.75"/>
  <!-- Stars -->
  <path d="M100 120 L108 136 L124 144 L108 152 L100 168 L92 152 L76 144 L92 136 Z" fill="#FFAFCC"/>
</svg>',

    'cyber-metallic-desk-clock.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="metal-grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#E2E8F0"/>
      <stop offset="35%" stop-color="#64748B"/>
      <stop offset="50%" stop-color="#F8FAFC"/>
      <stop offset="70%" stop-color="#475569"/>
      <stop offset="100%" stop-color="#CBD5E1"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#F1F5F9"/>
  <!-- Outer metallic casing -->
  <rect x="130" y="170" width="340" height="260" rx="48" fill="url(#metal-grad)" stroke="#FFFFFF" stroke-width="6"/>
  <!-- Digital display window -->
  <rect x="160" y="205" width="280" height="190" rx="24" fill="#020617"/>
  <!-- Digits -->
  <text x="300" y="325" font-family="Courier New, monospace" font-size="78" font-weight="bold" fill="#38BDF8" text-anchor="middle" letter-spacing="4">02:00</text>
  <text x="300" y="365" font-family="system-ui, sans-serif" font-size="16" font-weight="bold" fill="#F472B6" text-anchor="middle" letter-spacing="8">DIGITAL RETRO</text>
  <!-- Cyber stand legs -->
  <path d="M190 430 L160 480" stroke="#475569" stroke-width="14" stroke-linecap="round"/>
  <path d="M410 430 L440 480" stroke="#475569" stroke-width="14" stroke-linecap="round"/>
</svg>',

    'holographic-acrylic-vase.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="holo" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#F472B6" stop-opacity="0.8"/>
      <stop offset="33%" stop-color="#60A5FA" stop-opacity="0.7"/>
      <stop offset="66%" stop-color="#34D399" stop-opacity="0.6"/>
      <stop offset="100%" stop-color="#FBBF24" stop-opacity="0.8"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#FDF4FF"/>
  <!-- Stem & flower -->
  <path d="M300 240 Q310 160 300 120" stroke="#10B981" stroke-width="6" fill="none"/>
  <circle cx="300" cy="110" r="30" fill="#FFC8DD"/>
  <circle cx="300" cy="110" r="14" fill="#FDE047"/>
  <!-- Vase body: wavy geometric translucent -->
  <path d="M230 220 L370 220 L390 320 L210 320 Z" fill="url(#holo)" stroke="#FFFFFF" stroke-width="4"/>
  <path d="M210 320 L390 320 L350 470 L250 470 Z" fill="url(#holo)" stroke="#FFFFFF" stroke-width="4"/>
  <!-- Glass shine -->
  <line x1="250" y1="230" x2="270" y2="450" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-opacity="0.7"/>
  <circle cx="480" cy="200" r="15" fill="#C084FC" fill-opacity="0.7"/>
</svg>',

    'retro-futuristic-velvet-cushion.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <radialGradient id="velvet" cx="40%" cy="40%" r="60%">
      <stop offset="0%" stop-color="#E879F9"/>
      <stop offset="60%" stop-color="#A855F7"/>
      <stop offset="100%" stop-color="#6B21A8"/>
    </radialGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#F5F3FF"/>
  <!-- Round tufted cushion with metallic center button -->
  <circle cx="300" cy="300" r="180" fill="url(#velvet)" stroke="#F3E8FF" stroke-width="8"/>
  <!-- Crease folds -->
  <path d="M300 300 L300 120 M300 300 L430 170 M300 300 L480 300 M300 300 L430 430 M300 300 L300 480 M300 300 L170 430 M300 300 L120 300 M300 300 L170 170" stroke="#581C87" stroke-width="4" stroke-opacity="0.4"/>
  <!-- Center chrome button -->
  <circle cx="300" cy="300" r="28" fill="#E2E8F0" stroke="#FFFFFF" stroke-width="4"/>
  <circle cx="294" cy="294" r="8" fill="#FFFFFF"/>
</svg>',

    'glossy-pod-swivel-chair.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <radialGradient id="egg-shell" cx="45%" cy="35%" r="60%">
      <stop offset="0%" stop-color="#FFFFFF"/>
      <stop offset="70%" stop-color="#F1F5F9"/>
      <stop offset="100%" stop-color="#CBD5E1"/>
    </radialGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#E0F2FE"/>
  <!-- Pod Shell -->
  <ellipse cx="300" cy="270" rx="160" ry="180" fill="url(#egg-shell)" stroke="#FFFFFF" stroke-width="6"/>
  <!-- Pod Interior -->
  <ellipse cx="300" cy="270" rx="130" ry="150" fill="#FFAFCC"/>
  <!-- Interior Seat cushion -->
  <ellipse cx="300" cy="330" rx="110" ry="70" fill="#FFC8DD"/>
  <!-- Chrome Swivel Base -->
  <rect x="290" y="440" width="20" height="50" fill="#94A3B8"/>
  <ellipse cx="300" cy="495" rx="100" ry="25" fill="#CBD5E1" stroke="#94A3B8" stroke-width="4"/>
  <!-- Reflection on shell -->
  <path d="M190 180 Q170 260 210 350" stroke="#FFFFFF" stroke-width="14" stroke-linecap="round" fill="none" stroke-opacity="0.8"/>
</svg>',

    'chrome-starburst-wall-decor.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="star-chrome" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FFFFFF"/>
      <stop offset="25%" stop-color="#CBD5E1"/>
      <stop offset="50%" stop-color="#64748B"/>
      <stop offset="75%" stop-color="#FFFFFF"/>
      <stop offset="100%" stop-color="#94A3B8"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#1E1B4B"/>
  <!-- Starburst rays -->
  <g stroke="url(#star-chrome)" stroke-width="6" stroke-linecap="round">
    <line x1="300" y1="300" x2="300" y2="100"/>
    <line x1="300" y1="300" x2="300" y2="500"/>
    <line x1="300" y1="300" x2="100" y2="300"/>
    <line x1="300" y1="300" x2="500" y2="300"/>
    <line x1="300" y1="300" x2="160" y2="160"/>
    <line x1="300" y1="300" x2="440" y2="440"/>
    <line x1="300" y1="300" x2="160" y2="440"/>
    <line x1="300" y1="300" x2="440" y2="160"/>
  </g>
  <!-- Chrome spheres on ray tips -->
  <circle cx="300" cy="100" r="16" fill="url(#star-chrome)"/>
  <circle cx="300" cy="500" r="16" fill="url(#star-chrome)"/>
  <circle cx="100" cy="300" r="16" fill="url(#star-chrome)"/>
  <circle cx="500" cy="300" r="16" fill="url(#star-chrome)"/>
  <circle cx="160" cy="160" r="14" fill="url(#star-chrome)"/>
  <circle cx="440" cy="440" r="14" fill="url(#star-chrome)"/>
  <circle cx="160" cy="440" r="14" fill="url(#star-chrome)"/>
  <circle cx="440" cy="160" r="14" fill="url(#star-chrome)"/>
  <!-- Center mirror disk -->
  <circle cx="300" cy="300" r="55" fill="#E2E8F0" stroke="#FFFFFF" stroke-width="4"/>
  <circle cx="285" cy="285" r="14" fill="#FFFFFF"/>
</svg>',

    'pastel-arch-display-bookshelf.svg' => '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="arch-grad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#CDB4DB"/>
      <stop offset="50%" stop-color="#FFC8DD"/>
      <stop offset="100%" stop-color="#BDE0FE"/>
    </linearGradient>
  </defs>
  <rect width="600" height="600" rx="32" fill="#FAF5FF"/>
  <!-- Arch frame -->
  <path d="M160 500 L160 250 A 140 140 0 0 1 440 250 L440 500 Z" fill="none" stroke="url(#arch-grad)" stroke-width="24"/>
  <!-- Shelves -->
  <line x1="165" y1="270" x2="435" y2="270" stroke="url(#arch-grad)" stroke-width="12"/>
  <line x1="165" y1="360" x2="435" y2="360" stroke="url(#arch-grad)" stroke-width="12"/>
  <line x1="165" y1="450" x2="435" y2="450" stroke="url(#arch-grad)" stroke-width="12"/>
  <!-- Decor items on shelves -->
  <rect x="200" y="220" width="25" height="45" rx="4" fill="#38BDF8"/>
  <circle cx="370" cy="245" r="20" fill="#F472B6"/>
  <rect x="250" y="325" width="45" height="30" rx="4" fill="#A855F7"/>
  <ellipse cx="360" cy="335" rx="15" ry="22" fill="#FEF08A"/>
</svg>'
];

foreach ($svgs as $filename => $content) {
    file_put_contents($dir . '/' . $filename, trim($content));
}

echo "All SVG product images created successfully!\n";
