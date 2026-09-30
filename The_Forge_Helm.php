<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="512" height="512">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="0.55" y2="1">
      <stop offset="0" stop-color="#161F2B"/>
      <stop offset="0.55" stop-color="#0D141C"/>
      <stop offset="1" stop-color="#070A0E"/>
    </linearGradient>

    <linearGradient id="gold" x1="0.15" y1="0" x2="0.85" y2="1">
      <stop offset="0" stop-color="#FFE9AE"/>
      <stop offset="0.28" stop-color="#FFC64A"/>
      <stop offset="0.6" stop-color="#F0A21A"/>
      <stop offset="1" stop-color="#BE6606"/>
    </linearGradient>

    <radialGradient id="glow" cx="50%" cy="42%" r="60%">
      <stop offset="0" stop-color="#F5B301" stop-opacity="0.30"/>
      <stop offset="0.6" stop-color="#F5B301" stop-opacity="0.07"/>
      <stop offset="1" stop-color="#F5B301" stop-opacity="0"/>
    </radialGradient>

    <radialGradient id="vig" cx="50%" cy="50%" r="72%">
      <stop offset="0.6" stop-color="#000000" stop-opacity="0"/>
      <stop offset="1" stop-color="#000000" stop-opacity="0.55"/>
    </radialGradient>
  </defs>

  <!-- plate -->
  <rect width="512" height="512" rx="114" fill="url(#bg)"/>
  <rect width="512" height="512" rx="114" fill="url(#glow)"/>
  <rect width="512" height="512" rx="114" fill="url(#vig)"/>

  <!-- technical ring -->
  <circle cx="256" cy="256" r="214" fill="none" stroke="#F5B301" stroke-opacity="0.16" stroke-width="2"/>
  <circle cx="256" cy="256" r="200" fill="none" stroke="#F5B301" stroke-opacity="0.08" stroke-width="1"/>

  <!-- cardinal ticks -->
  <g stroke="#F5B301" stroke-opacity="0.35" stroke-width="3" stroke-linecap="round">
    <line x1="256" y1="34"  x2="256" y2="52"/>
    <line x1="256" y1="460" x2="256" y2="478"/>
    <line x1="34"  y1="256" x2="52"  y2="256"/>
    <line x1="460" y1="256" x2="478" y2="256"/>
  </g>

  <!-- the helm -->
  <g transform="translate(256 256) scale(1.16) translate(-256 -256)">
    <!-- dome + beard silhouette -->
    <path fill="url(#gold)"
      d="M146 238
         A110 110 0 0 1 366 238
         L366 272
         C366 318 344 354 314 374
         C296 386 276 392 256 392
         C236 392 216 386 198 374
         C168 354 146 318 146 272
         Z"/>
    <!-- eye slots -->
    <path fill="#0A0F15" d="M172 224 L240 244 L240 266 L178 268 Z"/>
    <path fill="#0A0F15" d="M340 224 L272 244 L272 266 L334 268 Z"/>
  </g>
</svg>