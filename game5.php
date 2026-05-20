<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ergopack Spin Game</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Nunito', sans-serif;
      background: #f0f4f8;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .game-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 460px;
      gap: 1.2rem;
    }

    .game-label {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #1e3a5f;
      opacity: 0.5;
    }

    .game-heading {
      font-size: 28px;
      font-weight: 900;
      color: #1e3a5f;
      text-align: center;
      margin-top: -4px;
    }

    .wheel-outer {
      position: relative;
      width: 340px;
      height: 340px;
    }

    .pointer {
      position: absolute;
      top: -14px;
      left: 50%;
      transform: translateX(-50%);
      width: 0; height: 0;
      border-left: 13px solid transparent;
      border-right: 13px solid transparent;
      border-top: 26px solid #1e3a5f;
      z-index: 10;
      filter: drop-shadow(0 2px 5px rgba(0,0,0,0.3));
    }

    #wheelSvg { width: 340px; height: 340px; display: block; }

    .spin-btn {
      background: #1e3a5f;
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 14px 56px;
      font-size: 18px;
      font-weight: 900;
      font-family: 'Nunito', sans-serif;
      cursor: pointer;
      letter-spacing: 1.5px;
      box-shadow: 0 4px 18px rgba(30,58,95,0.28);
      transition: background 0.2s, transform 0.1s;
    }
    .spin-btn:hover   { background: #2d5480; }
    .spin-btn:active  { transform: scale(0.97); }
    .spin-btn:disabled { background: #8faac4; cursor: not-allowed; }

    .legend {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      justify-content: center;
      max-width: 380px;
    }
    .leg-pill {
      background: #fff;
      border: 1.5px solid #b8ccdf;
      border-radius: 50px;
      padding: 5px 14px;
      font-size: 11.5px;
      font-weight: 700;
      color: #1e3a5f;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .leg-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    .result-card {
      background: #fff;
      border: 2.5px solid #1e3a5f;
      border-radius: 20px;
      padding: 1.6rem 2rem;
      text-align: center;
      width: 100%;
      max-width: 340px;
      animation: popIn 0.45s cubic-bezier(.36,1.4,.6,1) both;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(0.75) translateY(12px); }
      to   { opacity: 1; transform: scale(1)    translateY(0);    }
    }
    .result-emoji   { font-size: 44px; display: block; margin-bottom: 10px; }
    .result-tag     { font-size: 11px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #1e3a5f; opacity: 0.45; margin-bottom: 8px; }
    .result-name    { font-size: 24px; font-weight: 900; line-height: 1.2; margin-bottom: 10px; }
    .result-desc    { font-size: 14px; color: #4a6a8a; line-height: 1.6; }
    .result-divider { border: none; border-top: 1px solid #dce8f0; margin: 10px 0; }
  </style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="game-wrap">
  <p class="game-label">Ergopack</p>
  <h1 class="game-heading">Spin &amp; Play 🎡</h1>

  <div class="wheel-outer">
    <div class="pointer"></div>
    <svg id="wheelSvg" viewBox="0 0 340 340" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <clipPath id="cc"><circle cx="170" cy="170" r="160"/></clipPath>
      </defs>
      <g id="wheelG" clip-path="url(#cc)"></g>
      <circle cx="170" cy="170" r="32" fill="#fff" stroke="#1e3a5f" stroke-width="3.5"/>
      <text x="170" y="174" text-anchor="middle" dominant-baseline="middle"
            font-family="Nunito,sans-serif" font-size="13" font-weight="900" fill="#1e3a5f">EP</text>
    </svg>
  </div>

  <div class="legend" id="legend"></div>
  <button class="spin-btn" id="spinBtn" onclick="spinWheel()">SPIN!</button>
  <div id="resultBox"></div>
</div>

<script>
  const segments = [
    {
      name:  'Own Your Look',
      emoji: '👜',
      color: '#1e3a5f',
      line1: 'Own Your',
      line2: 'Look',
      desc:  'Show off your personal style — let your bag do the talking!'
    },
    {
      name:  'Flip the Card',
      emoji: '🃏',
      color: '#2d6a9f',
      line1: 'Flip the',
      line2: 'Card',
      desc:  'Flip a card and discover a fun challenge or surprise!'
    },
    {
      name:  'Guess the Bag',
      emoji: '🎒',
      color: '#4a90c4',
      line1: 'Guess the',
      line2: 'Bag',
      desc:  'Match the personality to the perfect bag — do you know your style?'
    },
    {
      name:  'Backpack Confessions',
      emoji: '📝',
      color: '#1a5276',
      line1: 'Backpack',
      line2: 'Confessions',
      desc:  'Spill the secrets hiding in your backpack!'
    },
  ];

  /* Legend */
  const legendEl = document.getElementById('legend');
  segments.forEach(s => {
    legendEl.innerHTML += `
      <div class="leg-pill">
        <span class="leg-dot" style="background:${s.color}"></span>${s.name}
      </div>`;
  });

  /* Draw wheel */
  const CX = 170, CY = 170, R = 160;
  const N   = segments.length;           // 4
  const SEG = (2 * Math.PI) / N;        // 90° each
  const wheelG = document.getElementById('wheelG');

  function mkText(content, y, size, weight) {
    const t = document.createElementNS('http://www.w3.org/2000/svg', 'text');
    t.setAttribute('text-anchor',       'middle');
    t.setAttribute('dominant-baseline', 'middle');
    t.setAttribute('font-family',       'Nunito,sans-serif');
    t.setAttribute('font-size',          size);
    t.setAttribute('font-weight',        weight);
    t.setAttribute('fill',               '#ffffff');
    t.setAttribute('y',                  y);
    t.textContent = content;
    return t;
  }

  function buildWheel(rotation) {
    wheelG.innerHTML = '';
    segments.forEach((seg, i) => {
      const startA = rotation + i * SEG - Math.PI / 2;
      const endA   = startA + SEG;
      const midA   = startA + SEG / 2;

      const x1 = CX + R * Math.cos(startA), y1 = CY + R * Math.sin(startA);
      const x2 = CX + R * Math.cos(endA),   y2 = CY + R * Math.sin(endA);

      /* slice */
      const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('d', `M${CX},${CY} L${x1},${y1} A${R},${R} 0 0,1 ${x2},${y2} Z`);
      path.setAttribute('fill',         seg.color);
      path.setAttribute('stroke',       '#fff');
      path.setAttribute('stroke-width', '3');
      wheelG.appendChild(path);

      /* text group — rotated so text reads outward */
      const tR  = R * 0.58;
      const tx  = CX + tR * Math.cos(midA);
      const ty  = CY + tR * Math.sin(midA);
      const deg = midA * 180 / Math.PI + 90;

      const g = document.createElementNS('http://www.w3.org/2000/svg', 'g');
      g.setAttribute('transform', `translate(${tx},${ty}) rotate(${deg})`);

      g.appendChild(mkText(seg.emoji, '-30', '26', '400'));
      g.appendChild(mkText(seg.line1,   '4', '13', '800'));
      if (seg.line2) g.appendChild(mkText(seg.line2, '20', '13', '800'));

      wheelG.appendChild(g);
    });
  }

  buildWheel(0);

  /* Spin */
  let currentAngle = 0;
  let isSpinning   = false;

  function spinWheel() {
    if (isSpinning) return;
    isSpinning = true;
    document.getElementById('spinBtn').disabled = true;
    document.getElementById('resultBox').innerHTML = '';

    const targetIdx   = Math.floor(Math.random() * N);
    const extraSpins  = (6 + Math.floor(Math.random() * 4)) * 2 * Math.PI;
    const segMidAngle = targetIdx * SEG + SEG / 2;
    const landAngle   = -segMidAngle - Math.PI / 2;
    let   delta       = (landAngle - currentAngle) % (2 * Math.PI);
    if (delta > 0) delta -= 2 * Math.PI;
    const totalTarget = currentAngle + extraSpins + delta + 2 * Math.PI;

    const duration = 4400;
    const t0 = performance.now();
    const a0 = currentAngle;

    function ease(t) { return 1 - Math.pow(1 - t, 4); }

    function frame(now) {
      const p = Math.min((now - t0) / duration, 1);
      buildWheel(a0 + (totalTarget - a0) * ease(p));
      if (p < 1) { requestAnimationFrame(frame); return; }
      currentAngle = totalTarget % (2 * Math.PI);
      isSpinning   = false;
      document.getElementById('spinBtn').disabled = false;
      showResult(targetIdx);
    }

    requestAnimationFrame(frame);
  }

//   function showResult(idx) {
//     const s = segments[idx];
//     document.getElementById('resultBox').innerHTML = `
//       <div class="result-card">
//         <span class="result-emoji">${s.emoji}</span>
//         <div class="result-tag">You landed on</div>
//         <hr class="result-divider"/>
//         <div class="result-name" style="color:${s.color}">${s.name}</div>
//         <div class="result-desc">${s.desc}</div>
//       </div>`;
//   }
</script>
</body>
</html>