<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4096 2304" width="4096" height="2304">
  <defs>
    <!-- Deep midnight plate -->
    <linearGradient id="bg" x1="0" y1="0" x2="0.7" y2="1">
      <stop offset="0"   stop-color="#1A2432"/>
      <stop offset="0.45" stop-color="#0D141C"/>
      <stop offset="1"   stop-color="#05080B"/>
    </linearGradient>

    <!-- Forge glow behind the shield -->
    <radialGradient id="forge" cx="0.26" cy="0.5" r="0.55">
      <stop offset="0"   stop-color="#F5B301" stop-opacity="0.38"/>
      <stop offset="0.45" stop-color="#F5B301" stop-opacity="0.10"/>
      <stop offset="1"   stop-color="#F5B301" stop-opacity="0"/>
    </radialGradient>

    <!-- Gold gradient (matches the icon exactly) -->
    <linearGradient id="gold" x1="0.15" y1="0" x2="0.85" y2="1">
      <stop offset="0"    stop-color="#FFE9AE"/>
      <stop offset="0.28" stop-color="#FFC64A"/>
      <stop offset="0.6"  stop-color="#F0A21A"/>
      <stop offset="1"    stop-color="#BE6606"/>
    </linearGradient>

    <!-- Gold gradient for horizontal text -->
    <linearGradient id="goldH" x1="0" y1="0" x2="1" y2="0">
      <stop offset="0"   stop-color="#FFE9AE"/>
      <stop offset="0.5" stop-color="#FFC64A"/>
      <stop offset="1"   stop-color="#F0A21A"/>
    </linearGradient>

    <!-- Vignette -->
    <radialGradient id="vig" cx="0.5" cy="0.5" r="0.78">
      <stop offset="0.55" stop-color="#000000" stop-opacity="0"/>
      <stop offset="1"    stop-color="#000000" stop-opacity="0.6"/>
    </radialGradient>
  </defs>

  <!-- ── BACKGROUND ────────────────────────────────────────────── -->
  <rect width="4096" height="2304" fill="url(#bg)"/>
  <rect width="4096" height="2304" fill="url(#forge)"/>

  <!-- Subtle grid, barely visible -->
  <g stroke="#F5B301" stroke-opacity="0.045" stroke-width="1">
    <line x1="0"    y1="576"  x2="4096" y2="576"/>
    <line x1="0"    y1="1152" x2="4096" y2="1152"/>
    <line x1="0"    y1="1728" x2="4096" y2="1728"/>
    <line x1="1024" y1="0"    x2="1024" y2="2304"/>
    <line x1="2048" y1="0"    x2="2048" y2="2304"/>
    <line x1="3072" y1="0"    x2="3072" y2="2304"/>
  </g>

  <!-- ── TECHNICAL RINGS behind shield ─────────────────────────── -->
  <g fill="none" stroke="#F5B301">
    <circle cx="1050" cy="1152" r="820" stroke-opacity="0.16" stroke-width="3"/>
    <circle cx="1050" cy="1152" r="920" stroke-opacity="0.07" stroke-width="2"/>
    <circle cx="1050" cy="1152" r="1010" stroke-opacity="0.04" stroke-width="1"/>
  </g>

  <!-- Cardinal ticks -->
  <g stroke="#F5B301" stroke-opacity="0.5" stroke-width="6" stroke-linecap="round">
    <line x1="1050" y1="286"  x2="1050" y2="336"/>
    <line x1="1050" y1="1968" x2="1050" y2="2018"/>
    <line x1="184"  y1="1152" x2="234"  y2="1152"/>
    <line x1="1866" y1="1152" x2="1916" y2="1152"/>
  </g>

  <!-- Diagonal tick ring (every 30°, radius 820) -->
  <g stroke="#F5B301" stroke-opacity="0.28" stroke-width="4" stroke-linecap="round">
    <line x1="1340" y1="444"  x2="1360" y2="480"/>
    <line x1="760"  y1="444"  x2="740"  y2="480"/>
    <line x1="1340" y1="1860" x2="1360" y2="1824"/>
    <line x1="760"  y1="1860" x2="740"  y2="1824"/>
  </g>

  <!-- ── BJARKAN SHIELD ───────────────────────────────────────── -->
  <g transform="translate(1050 1152) scale(3.4) translate(-256 -256)">
    <!-- Soft outer glow -->
    <path fill="url(#gold)" fill-opacity="0.25"
      d="M256 68 L412 128 L412 268 C412 348 344 408 256 444
         C168 408 100 348 100 268 L100 128 Z"
      transform="scale(1.06) translate(-15 -15)"/>

    <!-- Shield body -->
    <path fill="url(#gold)" stroke="#FFE9AE" stroke-width="1.5" stroke-opacity="0.5"
      d="M256 68 L412 128 L412 268 C412 348 344 408 256 444
         C168 408 100 348 100 268 L100 128 Z"/>

    <!-- Bjarkan rune carved in -->
    <g fill="#070A0E">
      <rect x="228" y="150" width="22" height="212" rx="4"/>
      <path d="M250 158 L318 202 L250 246 Z"/>
      <path d="M250 266 L318 310 L250 354 Z"/>
    </g>
  </g>

  <!-- ── WORDMARK ─────────────────────────────────────────────── -->
  <g font-family="'Arial Black','Helvetica Neue',Helvetica,sans-serif"
     font-weight="900" fill="url(#goldH)">
    <text x="2160" y="1010" font-size="248" letter-spacing="8">BEARDED</text>
    <text x="2160" y="1260" font-size="248" letter-spacing="8">VIKING</text>
  </g>

  <g font-family="'Arial','Helvetica Neue',Helvetica,sans-serif"
     font-weight="700" fill="#FFE9AE" fill-opacity="0.9">
    <text x="2164" y="1430" font-size="96" letter-spacing="30">SECURITY  FORGE</text>
  </g>

  <!-- Divider rule -->
  <line x1="2160" y1="1530" x2="3840" y2="1530"
        stroke="#F5B301" stroke-opacity="0.55" stroke-width="3"/>

  <!-- Keyword strip -->
  <g font-family="'Arial','Helvetica Neue',Helvetica,sans-serif"
     font-weight="600" fill="#FFC64A" font-size="52" letter-spacing="12">
    <text x="2160" y="1610">PENTEST</text>
    <text x="2560" y="1610" fill-opacity="0.35">//</text>
    <text x="2660" y="1610">BUG BOUNTY</text>
    <text x="3300" y="1610" fill-opacity="0.35">//</text>
    <text x="3400" y="1610">RESEARCH</text>
  </g>

  <!-- Tagline -->
  <g font-family="'Arial','Helvetica Neue',Helvetica,sans-serif"
     fill="#FFE9AE" fill-opacity="0.65" font-size="46" letter-spacing="3">
    <text x="2160" y="1730">
      Open-source encrypted platform · OSCP · CEH · Hack-N-Seek
    </text>
  </g>

  <!-- ── CORNER MARKS ─────────────────────────────────────────── -->
  <g font-family="'Courier New',Courier,monospace"
     fill="#FFC64A" fill-opacity="0.7" font-size="38" letter-spacing="8">
    <text x="2160" y="2130">BVSEC.LOL</text>
    <text x="2670" y="2130" fill-opacity="0.35">·</text>
    <text x="2780" y="2130">PGP 0xBEARD3D</text>
  </g>

  <!-- Rune row, top-right -->
  <g font-family="'Arial','Helvetica Neue',Helvetica,sans-serif"
     fill="#F5B301" fill-opacity="0.35" font-size="46" letter-spacing="18">
    <text x="3300" y="220">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</text>
  </g>

  <!-- Bottom gold strip -->
  <rect x="0" y="2270" width="4096" height="34"
        fill="url(#goldH)" fill-opacity="0.22"/>

  <!-- Vignette on top -->
  <rect width="4096" height="2304" fill="url(#vig)"/>
</svg>