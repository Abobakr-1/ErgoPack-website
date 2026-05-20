<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ERGOPACK – Pack It Right! Game</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --navy: #1a2e4a;
    --navy-dark: #0f1e30;
    --navy-mid: #223355;
    --gold: #c8972a;
    --gold-light: #e8b84b;
    --white: #ffffff;
    --light-bg: #f4f7fb;
    --accent: #2196f3;
    --red: #e53935;
    --green: #43a047;
    --shadow: 0 8px 32px rgba(26,46,74,0.18);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'Poppins', sans-serif;
    background: var(--light-bg);
    min-height: 100vh;
    color: var(--navy);
  }

  /* ── NAVBAR ── */
  nav {
    background: var(--navy);
    padding: 0 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 12px rgba(0,0,0,0.25);
  }
  .nav-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
  }
  .nav-logo-icon {
    width: 40px; height: 40px;
    background: var(--gold);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 900; color: var(--navy); font-size: 15px;
    font-family: 'Montserrat', sans-serif;
    border: 2px solid var(--gold-light);
  }
  .nav-logo-text {
    color: var(--white);
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 20px;
    letter-spacing: 1px;
  }
  .nav-links { display: flex; gap: 28px; list-style: none; }
  .nav-links a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    font-family: 'Montserrat', sans-serif;
    transition: color 0.2s;
  }
  .nav-links a:hover { color: var(--gold-light); }

  /* ── BANNER ── */
  .banner {
    background: var(--navy-mid);
    color: var(--white);
    text-align: center;
    padding: 10px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
  }
  .banner span { color: var(--gold-light); }

  /* ── HERO ── */
  .hero {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 60%, #1e3a5f 100%);
    padding: 40px 32px 32px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(200,151,42,0.12) 0%, transparent 70%);
  }
  .hero-title {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(22px, 4vw, 38px);
    font-weight: 900;
    color: var(--white);
    letter-spacing: 1px;
    position: relative;
  }
  .hero-title span { color: var(--gold-light); }
  .hero-sub {
    color: rgba(255,255,255,0.75);
    font-size: 15px;
    margin-top: 8px;
    position: relative;
  }

  /* ── GAME WRAPPER ── */
  #game-wrapper {
    max-width: 820px;
    margin: 32px auto;
    padding: 0 16px 40px;
  }

  /* ── SCREENS ── */
  .screen { display: none; }
  .screen.active { display: block; }

  /* ── START SCREEN ── */
  #start-screen {
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
    text-align: center;
  }
  .start-top {
    background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 100%);
    padding: 40px 32px 32px;
  }
  .bag-icon-big {
    font-size: 80px;
    display: block;
    margin-bottom: 12px;
    animation: float 3s ease-in-out infinite;
  }
  @keyframes float {
    0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)}
  }
  .start-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 32px; font-weight: 900;
    color: var(--white);
  }
  .start-title span { color: var(--gold-light); }
  .start-body { padding: 32px; }
  .start-desc {
    font-size: 15px; color: #555;
    line-height: 1.7; margin-bottom: 24px;
  }
  .mode-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
  }
  .mode-card {
    background: var(--light-bg);
    border: 2px solid transparent;
    border-radius: 14px;
    padding: 20px 16px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
  }
  .mode-card:hover, .mode-card.selected {
    border-color: var(--gold);
    background: #fff8ec;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(200,151,42,0.2);
  }
  .mode-card .mode-icon { font-size: 36px; margin-bottom: 8px; }
  .mode-card .mode-name {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700; font-size: 15px; color: var(--navy);
  }
  .mode-card .mode-desc { font-size: 12px; color: #777; margin-top: 4px; }

  .btn-start {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
    color: var(--navy-dark);
    border: none;
    border-radius: 50px;
    padding: 16px 48px;
    font-family: 'Montserrat', sans-serif;
    font-size: 17px; font-weight: 800;
    cursor: pointer;
    letter-spacing: 0.5px;
    box-shadow: 0 6px 20px rgba(200,151,42,0.35);
    transition: all 0.2s;
  }
  .btn-start:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(200,151,42,0.45);
  }
  .btn-start:active { transform: translateY(0); }

  /* ── HUD ── */
  .hud {
    background: var(--navy);
    border-radius: 16px;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    box-shadow: var(--shadow);
    flex-wrap: wrap;
    gap: 12px;
  }
  .hud-item { text-align: center; }
  .hud-label { font-size: 11px; color: rgba(255,255,255,0.6); font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
  .hud-value { font-family: 'Montserrat', sans-serif; font-size: 22px; font-weight: 800; color: var(--gold-light); }
  .hud-divider { width: 1px; height: 36px; background: rgba(255,255,255,0.15); }

  /* ── GAME AREA ── */
  .game-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  .game-card-header {
    background: linear-gradient(90deg, var(--navy) 0%, var(--navy-mid) 100%);
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .q-badge {
    background: var(--gold);
    color: var(--navy-dark);
    border-radius: 20px;
    padding: 4px 14px;
    font-family: 'Montserrat', sans-serif;
    font-size: 13px; font-weight: 700;
  }
  .q-category {
    color: rgba(255,255,255,0.75);
    font-size: 13px;
    display: flex; align-items: center; gap: 6px;
  }

  /* Progress bar */
  .progress-wrap {
    background: rgba(255,255,255,0.1);
    border-radius: 0;
    height: 5px;
  }
  .progress-fill {
    height: 5px;
    background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 100%);
    transition: width 0.5s ease;
    border-radius: 0 3px 3px 0;
  }

  .game-body { padding: 32px 28px; }

  .question-text {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(16px, 2.5vw, 21px);
    font-weight: 700;
    color: var(--navy-dark);
    line-height: 1.45;
    margin-bottom: 8px;
  }
  .question-emoji { font-size: 36px; margin-bottom: 12px; display: block; }

  /* Timer ring */
  .timer-wrap {
    display: flex; justify-content: center; margin: 20px 0 24px;
  }
  .timer-ring-container { position: relative; width: 80px; height: 80px; }
  .timer-ring-container svg { transform: rotate(-90deg); }
  .timer-ring-bg { fill: none; stroke: #e8f0fe; stroke-width: 6; }
  .timer-ring-fg { fill: none; stroke: var(--gold); stroke-width: 6; stroke-linecap: round; transition: stroke-dashoffset 1s linear, stroke 0.3s; }
  .timer-number {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
    font-family: 'Montserrat', sans-serif; font-size: 22px; font-weight: 800; color: var(--navy);
  }

  /* Options */
  .options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 20px;
  }
  @media(max-width:520px){ .options-grid { grid-template-columns: 1fr; } }

  .option-btn {
    background: var(--light-bg);
    border: 2.5px solid #dde4ef;
    border-radius: 14px;
    padding: 16px 18px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px; font-weight: 500;
    color: var(--navy);
    cursor: pointer;
    text-align: left;
    display: flex; align-items: center; gap: 12px;
    transition: all 0.18s;
    position: relative;
    overflow: hidden;
  }
  .option-btn::before {
    content: '';
    position: absolute; left: 0; top: 0;
    width: 4px; height: 100%;
    background: var(--gold);
    opacity: 0;
    transition: opacity 0.2s;
  }
  .option-btn:hover:not(:disabled) {
    border-color: var(--gold);
    background: #fff8ec;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(200,151,42,0.18);
  }
  .option-btn:hover:not(:disabled)::before { opacity: 1; }
  .option-btn .opt-letter {
    background: var(--navy);
    color: var(--white);
    border-radius: 8px;
    width: 28px; height: 28px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700; font-size: 13px;
    flex-shrink: 0;
    transition: background 0.2s;
  }
  .option-btn.correct {
    background: #e8f5e9; border-color: var(--green);
    animation: correctPop 0.4s ease;
  }
  .option-btn.correct .opt-letter { background: var(--green); }
  .option-btn.wrong {
    background: #ffebee; border-color: var(--red);
    animation: shake 0.4s ease;
  }
  .option-btn.wrong .opt-letter { background: var(--red); }
  .option-btn:disabled { cursor: default; }

  @keyframes correctPop {
    0%{transform:scale(1)} 40%{transform:scale(1.04)} 100%{transform:scale(1)}
  }
  @keyframes shake {
    0%,100%{transform:translateX(0)} 25%{transform:translateX(-6px)} 75%{transform:translateX(6px)}
  }

  /* Feedback */
  .feedback-bar {
    border-radius: 10px; padding: 12px 18px;
    font-weight: 600; font-size: 14px;
    display: none; align-items: center; gap: 10px;
    margin-bottom: 16px;
  }
  .feedback-bar.show { display: flex; animation: fadeIn 0.3s ease; }
  .feedback-bar.correct-fb { background: #e8f5e9; color: #2e7d32; border: 1.5px solid #a5d6a7; }
  .feedback-bar.wrong-fb { background: #ffebee; color: #c62828; border: 1.5px solid #ef9a9a; }
  @keyframes fadeIn { from{opacity:0;transform:translateY(6px)} to{opacity:1;transform:translateY(0)} }

  .btn-next {
    width: 100%;
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
    color: var(--white);
    border: none; border-radius: 12px;
    padding: 15px;
    font-family: 'Montserrat', sans-serif;
    font-size: 15px; font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.5px;
    display: none;
    transition: all 0.2s;
  }
  .btn-next.show { display: block; animation: fadeIn 0.3s ease; }
  .btn-next:hover { background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%); color: var(--navy-dark); }

  /* ── RESULT SCREEN ── */
  #result-screen { text-align: center; }
  .result-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  .result-top {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 100%);
    padding: 44px 32px 32px;
    position: relative;
  }
  .result-trophy { font-size: 72px; animation: float 3s ease-in-out infinite; display: block; }
  .result-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 28px; font-weight: 900;
    color: var(--white); margin-top: 12px;
  }
  .result-sub { color: rgba(255,255,255,0.75); font-size: 15px; margin-top: 6px; }
  .result-body { padding: 36px 28px; }

  .score-circle {
    width: 140px; height: 140px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    margin: 0 auto 28px;
    box-shadow: 0 8px 28px rgba(200,151,42,0.35);
  }
  .score-num {
    font-family: 'Montserrat', sans-serif;
    font-size: 42px; font-weight: 900; color: var(--navy-dark);
    line-height: 1;
  }
  .score-label { font-size: 12px; font-weight: 600; color: var(--navy); opacity: 0.7; }

  .stats-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 14px; margin-bottom: 28px;
  }
  .stat-box {
    background: var(--light-bg);
    border-radius: 12px; padding: 16px 10px; text-align: center;
  }
  .stat-box .stat-icon { font-size: 22px; }
  .stat-box .stat-val {
    font-family: 'Montserrat', sans-serif;
    font-size: 20px; font-weight: 800; color: var(--navy);
  }
  .stat-box .stat-lbl { font-size: 11px; color: #888; font-weight: 500; }

  .grade-badge {
    display: inline-block;
    padding: 8px 24px;
    border-radius: 30px;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px; font-weight: 800;
    margin-bottom: 24px;
    letter-spacing: 0.5px;
  }

  .result-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
  .btn-replay {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
    color: var(--navy-dark);
    border: none; border-radius: 50px;
    padding: 14px 36px;
    font-family: 'Montserrat', sans-serif;
    font-size: 15px; font-weight: 800;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(200,151,42,0.3);
    transition: all 0.2s;
  }
  .btn-replay:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(200,151,42,0.4); }
  .btn-share {
    background: var(--navy);
    color: var(--white);
    border: none; border-radius: 50px;
    padding: 14px 36px;
    font-family: 'Montserrat', sans-serif;
    font-size: 15px; font-weight: 800;
    cursor: pointer;
    transition: all 0.2s;
  }
  .btn-share:hover { background: var(--navy-mid); transform: translateY(-2px); }

  /* Confetti canvas */
  #confetti-canvas {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    pointer-events: none; z-index: 999;
  }

  /* Streak indicator */
  .streak-pop {
    position: fixed; top: 80px; right: 24px;
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    color: var(--navy-dark);
    padding: 10px 20px;
    border-radius: 50px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; font-size: 15px;
    box-shadow: 0 4px 20px rgba(200,151,42,0.4);
    display: none; z-index: 200;
    animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }
  @keyframes popIn {
    from{transform:scale(0.5) translateY(-20px);opacity:0}
    to{transform:scale(1) translateY(0);opacity:1}
  }

  /* Leaderboard strip */
  .leaderboard-strip {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 20px 24px;
    margin-top: 24px;
  }
  .lb-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; font-size: 16px; color: var(--navy);
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
  }
  .lb-row {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 0; border-bottom: 1px solid #f0f0f0;
  }
  .lb-row:last-child { border-bottom: none; }
  .lb-rank {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--light-bg);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 13px;
    color: var(--navy);
    flex-shrink: 0;
  }
  .lb-rank.gold { background: var(--gold); color: var(--navy-dark); }
  .lb-rank.silver { background: #b0bec5; color: var(--white); }
  .lb-rank.bronze { background: #a1887f; color: var(--white); }
  .lb-name { flex: 1; font-weight: 600; font-size: 14px; }
  .lb-score {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; color: var(--navy);
    font-size: 15px;
  }
  .lb-you { color: var(--gold); }

  /* Footer */
  footer {
    background: var(--navy-dark);
    color: rgba(255,255,255,0.6);
    text-align: center;
    padding: 18px;
    font-size: 13px;
    margin-top: 32px;
  }
  footer span { color: var(--gold-light); }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <a class="nav-logo" href="#">
    <div class="nav-logo-icon">EP</div>
    <span class="nav-logo-text">ERGOPACK</span>
  </a>
  <ul class="nav-links">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Shop</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>

<!-- BANNER -->
<div class="banner">
  🔥 <span>LIMITED TIME DEAL:</span> 1 BAG + 2 CHARMS = GET <span>40% OFF</span> — Play & Win Discount Codes!
</div>

<!-- HERO -->
<div class="hero">
  <h1 class="hero-title">🎒 <span>ERGOPACK</span> Challenge</h1>
  <p class="hero-sub">Test your ergonomic knowledge & win exclusive rewards!</p>
</div>

<!-- GAME WRAPPER -->
<div id="game-wrapper">

  <!-- START SCREEN -->
  <div id="start-screen" class="screen active">
    <div class="start-top">
      <span class="bag-icon-big">🎒</span>
      <div class="start-title">Pack It <span>Right!</span></div>
      <p style="color:rgba(255,255,255,0.75);margin-top:8px;font-size:14px;">The Ultimate Ergonomic Bag Quiz</p>
    </div>
    <div class="start-body">
      <p class="start-desc">
        Answer 10 questions about ergonomic bags, posture & smart packing.<br>
        Earn points, beat the clock, and unlock <strong>ERGOPACK discount codes!</strong>
      </p>
      <div class="mode-cards">
        <div class="mode-card selected" onclick="selectMode(this,'easy')">
          <div class="mode-icon">🌱</div>
          <div class="mode-name">Easy</div>
          <div class="mode-desc">20 sec per question</div>
        </div>
        <div class="mode-card" onclick="selectMode(this,'medium')">
          <div class="mode-icon">⚡</div>
          <div class="mode-name">Medium</div>
          <div class="mode-desc">15 sec per question</div>
        </div>
        <div class="mode-card" onclick="selectMode(this,'hard')">
          <div class="mode-icon">🔥</div>
          <div class="mode-name">Hard</div>
          <div class="mode-desc">10 sec per question</div>
        </div>
      </div>
      <button class="btn-start" onclick="startGame()">🚀 START CHALLENGE</button>
    </div>
  </div>

  <!-- GAME SCREEN -->
  <div id="game-screen" class="screen">
    <!-- HUD -->
    <div class="hud">
      <div class="hud-item">
        <div class="hud-label">Score</div>
        <div class="hud-value" id="hud-score">0</div>
      </div>
      <div class="hud-divider"></div>
      <div class="hud-item">
        <div class="hud-label">Question</div>
        <div class="hud-value" id="hud-q">1/10</div>
      </div>
      <div class="hud-divider"></div>
      <div class="hud-item">
        <div class="hud-label">Streak 🔥</div>
        <div class="hud-value" id="hud-streak">0</div>
      </div>
      <div class="hud-divider"></div>
      <div class="hud-item">
        <div class="hud-label">Correct</div>
        <div class="hud-value" id="hud-correct">0</div>
      </div>
    </div>

    <!-- GAME CARD -->
    <div class="game-card">
      <div class="game-card-header">
        <span class="q-badge" id="q-badge">Q1</span>
        <span class="q-category" id="q-cat">🎒 Category</span>
      </div>
      <div class="progress-wrap">
        <div class="progress-fill" id="progress-fill" style="width:10%"></div>
      </div>
      <div class="game-body">
        <span class="question-emoji" id="q-emoji">🎒</span>
        <div class="question-text" id="question-text">Loading question...</div>

        <div class="timer-wrap">
          <div class="timer-ring-container">
            <svg width="80" height="80" viewBox="0 0 80 80">
              <circle class="timer-ring-bg" cx="40" cy="40" r="32"/>
              <circle class="timer-ring-fg" id="timer-ring" cx="40" cy="40" r="32"
                stroke-dasharray="201" stroke-dashoffset="0"/>
            </svg>
            <div class="timer-number" id="timer-num">15</div>
          </div>
        </div>

        <div class="options-grid" id="options-grid"></div>

        <div class="feedback-bar" id="feedback-bar">
          <span id="feedback-icon">✅</span>
          <span id="feedback-text">Correct!</span>
        </div>

        <button class="btn-next" id="btn-next" onclick="nextQuestion()">
          Next Question →
        </button>
      </div>
    </div>
  </div>

  <!-- RESULT SCREEN -->
  <div id="result-screen" class="screen">
    <div class="result-card">
      <div class="result-top">
        <span class="result-trophy" id="result-trophy">🏆</span>
        <div class="result-title" id="result-title">Well Done!</div>
        <div class="result-sub" id="result-sub">You're an ergonomics expert!</div>
      </div>
      <div class="result-body">
        <div class="score-circle">
          <div class="score-num" id="final-score">0</div>
          <div class="score-label">POINTS</div>
        </div>
        <div id="grade-badge-wrap"></div>
        <div class="stats-grid">
          <div class="stat-box">
            <div class="stat-icon">✅</div>
            <div class="stat-val" id="stat-correct">0</div>
            <div class="stat-lbl">Correct</div>
          </div>
          <div class="stat-box">
            <div class="stat-icon">❌</div>
            <div class="stat-val" id="stat-wrong">0</div>
            <div class="stat-lbl">Wrong</div>
          </div>
          <div class="stat-box">
            <div class="stat-icon">🔥</div>
            <div class="stat-val" id="stat-streak">0</div>
            <div class="stat-lbl">Best Streak</div>
          </div>
        </div>
        <div id="coupon-box" style="display:none;background:#fff8ec;border:2px dashed var(--gold);border-radius:14px;padding:18px;margin-bottom:22px;text-align:center;">
          <div style="font-size:13px;color:#888;margin-bottom:4px;">🎉 YOUR REWARD CODE</div>
          <div id="coupon-code" style="font-family:'Montserrat',sans-serif;font-size:26px;font-weight:900;color:var(--navy);letter-spacing:4px;"></div>
          <div style="font-size:12px;color:#888;margin-top:6px;">Use at checkout on ergopack.com</div>
        </div>
        <div class="result-btns">
          <button class="btn-replay" onclick="restartGame()">🔄 Play Again</button>
          <button class="btn-share" onclick="shareScore()">📤 Share Score</button>
        </div>
      </div>
    </div>

    <!-- LEADERBOARD -->
    <div class="leaderboard-strip">
      <div class="lb-title">🏅 Today's Leaderboard</div>
      <div id="leaderboard-list"></div>
    </div>
  </div>

</div>

<!-- STREAK POPUP -->
<div class="streak-pop" id="streak-pop">🔥 Streak x<span id="streak-val">2</span>!</div>

<!-- CONFETTI CANVAS -->
<canvas id="confetti-canvas"></canvas>

<!-- FOOTER -->
<footer>
  © 2025 <span>ERGOPACK</span> — Stylish Together. More Items, More Value. Made for Each Other.
</footer>

<script>
// ─────────────────────────────────────────────
//  QUESTIONS DATABASE
// ─────────────────────────────────────────────
const ALL_QUESTIONS = [
  {
    emoji: '⚖️', category: 'Weight & Load',
    q: 'What is the recommended maximum weight for a school or work backpack relative to body weight?',
    opts: ['5% of body weight','10% of body weight','20% of body weight','30% of body weight'],
    ans: 1,
    exp: '10% of your body weight is the ergonomic guideline to prevent back strain and posture problems.'
  },
  {
    emoji: '📍', category: 'Bag Positioning',
    q: 'Where should a backpack ideally sit on your back for best ergonomic support?',
    opts: ['Low near the hips','High near the neck','Between shoulders and waist','On one shoulder only'],
    ans: 2,
    exp: 'Sitting between shoulders and waist keeps the weight close to your center of gravity, reducing strain.'
  },
  {
    emoji: '🎒', category: 'Strap Usage',
    q: 'Why should you always use BOTH shoulder straps on a backpack?',
    opts: ['It looks more stylish','It distributes weight evenly across both shoulders','It makes the bag easier to remove','It keeps the bag lower'],
    ans: 1,
    exp: 'Using both straps evenly distributes the load, preventing muscle imbalance and spinal curvature.'
  },
  {
    emoji: '📦', category: 'Smart Packing',
    q: 'Where should the HEAVIEST items be placed inside an ergonomic backpack?',
    opts: ['In the front outer pocket','At the very bottom','Closest to your back, in the center','At the top of the bag'],
    ans: 2,
    exp: 'Heavy items close to your back and centered keep the weight near your spine, reducing forward pull.'
  },
  {
    emoji: '🔧', category: 'Bag Features',
    q: 'Which feature is MOST important in an ergonomic backpack to reduce shoulder pressure?',
    opts: ['Bright color','Waterproof material','Wide padded shoulder straps','Many external pockets'],
    ans: 2,
    exp: 'Wide padded straps spread the load across a larger area, dramatically reducing pressure points.'
  },
  {
    emoji: '🧍', category: 'Posture & Health',
    q: 'Carrying a heavy bag on one shoulder regularly can cause:',
    opts: ['Better posture over time','Muscle imbalance and spinal curvature','Stronger arm muscles','No health effects'],
    ans: 1,
    exp: 'One-sided carrying forces the spine to curve to compensate, leading to chronic pain and imbalance.'
  },
  {
    emoji: '📏', category: 'Sizing & Fit',
    q: 'An ergonomic backpack should NOT hang below:',
    opts: ['The shoulders','The shoulder blades','4 inches below the waist','The chest'],
    ans: 2,
    exp: 'Bags hanging more than 4 inches below the waist shift the center of gravity and strain the lower back.'
  },
  {
    emoji: '💡', category: 'Ergonomic Tips',
    q: 'A chest strap (sternum strap) on a backpack helps by:',
    opts: ['Adding storage space','Stabilizing the bag and reducing shoulder sway','Making the bag look sporty','Waterproofing the bag'],
    ans: 1,
    exp: 'The sternum strap connects the shoulder straps across the chest, stabilizing the bag and reducing movement.'
  },
  {
    emoji: '🪑', category: 'Laptop Bags',
    q: 'For a laptop bag carried daily, which type is most ergonomically recommended?',
    opts: ['Single-handle briefcase','Single-strap messenger bag','Dual-strap backpack with padded back panel','Rolling trolley only'],
    ans: 2,
    exp: 'A dual-strap backpack with padding distributes weight evenly and supports the spine for daily commuting.'
  },
  {
    emoji: '🔄', category: 'Habits',
    q: 'If you must carry a heavy bag, what is the best healthy habit?',
    opts: ['Carry it on the same strong side every day','Lean forward to balance the weight','Switch shoulders regularly and take breaks','Run faster to reduce carry time'],
    ans: 2,
    exp: 'Switching sides prevents muscle imbalance. Taking breaks allows your muscles to recover from sustained load.'
  },
  {
    emoji: '🎽', category: 'Waist Straps',
    q: 'What is the purpose of a hip/waist strap on a hiking or travel backpack?',
    opts: ['Fashion accessory','Transfer weight from shoulders to stronger hip muscles','Keep the bag closed','Store small items'],
    ans: 1,
    exp: 'Hip straps transfer up to 80% of the bag weight to the hips and legs, the strongest muscles in the body.'
  },
  {
    emoji: '📐', category: 'Back Panel',
    q: 'A contoured/curved back panel on an ergonomic bag is designed to:',
    opts: ['Look more expensive','Match the natural curve of the spine for better support','Make the bag lighter','Create more interior space'],
    ans: 1,
    exp: 'Contouring matches the spine\'s natural S-curve, ensuring the bag maintains proper posture alignment.'
  },
  {
    emoji: '🌡️', category: 'Bag Features',
    q: 'What does a ventilated back panel (airflow channel) on a backpack primarily help with?',
    opts: ['Keeping the bag waterproof','Reducing back sweat and improving comfort during wear','Adding extra pockets','Making the bag lighter'],
    ans: 1,
    exp: 'Ventilated channels allow air circulation between your back and the bag, reducing heat and moisture buildup.'
  },
  {
    emoji: '👶', category: 'Children\'s Health',
    q: 'For children, a loaded school bag should ideally weigh no more than:',
    opts: ['15% of their body weight','5% of their body weight','10% of their body weight','20% of their body weight'],
    ans: 2,
    exp: 'Children\'s spines are still developing. The 10% rule is critical to prevent early-onset back problems.'
  },
  {
    emoji: '🏃', category: 'Activity',
    q: 'When jogging or running with a bag, which type is most ergonomic?',
    opts: ['Large hiking pack','Single-shoulder sling bag','Compact running vest or hydration pack','Rolling suitcase'],
    ans: 2,
    exp: 'Running vests and hydration packs hug the body closely, minimizing bounce and keeping load stable during movement.'
  }
];

// ─────────────────────────────────────────────
//  GAME STATE
// ─────────────────────────────────────────────
let questions = [];
let currentQ = 0;
let score = 0;
let streak = 0;
let bestStreak = 0;
let correct = 0;
let timerSec = 15;
let timerInterval = null;
let answered = false;
let mode = 'easy';
let timeLimits = { easy: 20, medium: 15, hard: 10 };

const CIRCUMFERENCE = 2 * Math.PI * 32; // 201

function selectMode(el, m) {
  document.querySelectorAll('.mode-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  mode = m;
}

function shuffle(arr) {
  const a = [...arr];
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

function startGame() {
  questions = shuffle(ALL_QUESTIONS).slice(0, 10);
  currentQ = 0; score = 0; streak = 0; bestStreak = 0; correct = 0;
  showScreen('game-screen');
  loadQuestion();
}

function showScreen(id) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function loadQuestion() {
  answered = false;
  const q = questions[currentQ];
  const timeLimit = timeLimits[mode];

  // Update HUD
  document.getElementById('hud-score').textContent = score;
  document.getElementById('hud-q').textContent = (currentQ + 1) + '/10';
  document.getElementById('hud-streak').textContent = streak;
  document.getElementById('hud-correct').textContent = correct;

  // Progress
  document.getElementById('progress-fill').style.width = ((currentQ + 1) / 10 * 100) + '%';

  // Question
  document.getElementById('q-badge').textContent = 'Q' + (currentQ + 1);
  document.getElementById('q-cat').textContent = q.emoji + ' ' + q.category;
  document.getElementById('q-emoji').textContent = q.emoji;
  document.getElementById('question-text').textContent = q.q;

  // Options
  const grid = document.getElementById('options-grid');
  grid.innerHTML = '';
  const letters = ['A', 'B', 'C', 'D'];
  q.opts.forEach((opt, i) => {
    const btn = document.createElement('button');
    btn.className = 'option-btn';
    btn.innerHTML = `<span class="opt-letter">${letters[i]}</span><span>${opt}</span>`;
    btn.onclick = () => selectAnswer(i, btn);
    grid.appendChild(btn);
  });

  // Reset feedback
  const fb = document.getElementById('feedback-bar');
  fb.className = 'feedback-bar';
  document.getElementById('btn-next').className = 'btn-next';

  // Timer
  clearInterval(timerInterval);
  timerSec = timeLimit;
  updateTimerRing(timerSec, timeLimit);
  document.getElementById('timer-num').textContent = timerSec;

  timerInterval = setInterval(() => {
    timerSec--;
    updateTimerRing(timerSec, timeLimit);
    document.getElementById('timer-num').textContent = timerSec;

    const ring = document.getElementById('timer-ring');
    if (timerSec <= 5) {
      ring.style.stroke = '#e53935';
      document.getElementById('timer-num').style.color = '#e53935';
    } else if (timerSec <= Math.floor(timeLimit * 0.4)) {
      ring.style.stroke = '#ff9800';
      document.getElementById('timer-num').style.color = '#ff9800';
    }

    if (timerSec <= 0) {
      clearInterval(timerInterval);
      timeUp();
    }
  }, 1000);
}

function updateTimerRing(current, max) {
  const pct = current / max;
  const offset = CIRCUMFERENCE * (1 - pct);
  document.getElementById('timer-ring').style.strokeDashoffset = offset;
}

function selectAnswer(idx, btn) {
  if (answered) return;
  answered = true;
  clearInterval(timerInterval);

  const q = questions[currentQ];
  const allBtns = document.querySelectorAll('.option-btn');
  allBtns.forEach(b => b.disabled = true);

  const fb = document.getElementById('feedback-bar');

  if (idx === q.ans) {
    btn.classList.add('correct');
    correct++;
    const bonus = Math.max(0, timerSec) * (mode === 'hard' ? 3 : mode === 'medium' ? 2 : 1);
    const points = 100 + bonus;
    score += points;
    streak++;
    if (streak > bestStreak) bestStreak = streak;

    fb.className = 'feedback-bar correct-fb show';
    document.getElementById('feedback-icon').textContent = '✅';
    document.getElementById('feedback-text').textContent = `+${points} pts! ${q.exp}`;

    if (streak >= 2) showStreakPop(streak);
  } else {
    btn.classList.add('wrong');
    allBtns[q.ans].classList.add('correct');
    streak = 0;

    fb.className = 'feedback-bar wrong-fb show';
    document.getElementById('feedback-icon').textContent = '❌';
    document.getElementById('feedback-text').textContent = `Correct answer: ${q.opts[q.ans]}. ${q.exp}`;
  }

  document.getElementById('hud-score').textContent = score;
  document.getElementById('hud-streak').textContent = streak;
  document.getElementById('hud-correct').textContent = correct;

  document.getElementById('btn-next').className = 'btn-next show';
  document.getElementById('btn-next').textContent =
    currentQ < 9 ? 'Next Question →' : '🏁 See Results';
}

function timeUp() {
  if (answered) return;
  answered = true;
  const q = questions[currentQ];
  const allBtns = document.querySelectorAll('.option-btn');
  allBtns.forEach(b => b.disabled = true);
  allBtns[q.ans].classList.add('correct');
  streak = 0;

  const fb = document.getElementById('feedback-bar');
  fb.className = 'feedback-bar wrong-fb show';
  document.getElementById('feedback-icon').textContent = '⏰';
  document.getElementById('feedback-text').textContent = `Time's up! Correct: ${q.opts[q.ans]}`;

  document.getElementById('hud-streak').textContent = streak;
  document.getElementById('btn-next').className = 'btn-next show';
  document.getElementById('btn-next').textContent =
    currentQ < 9 ? 'Next Question →' : '🏁 See Results';
}

function nextQuestion() {
  currentQ++;
  if (currentQ >= 10) {
    showResults();
  } else {
    const ring = document.getElementById('timer-ring');
    ring.style.stroke = 'var(--gold)';
    document.getElementById('timer-num').style.color = 'var(--navy)';
    loadQuestion();
  }
}

function showStreakPop(s) {
  const pop = document.getElementById('streak-pop');
  document.getElementById('streak-val').textContent = s;
  pop.style.display = 'block';
  setTimeout(() => { pop.style.display = 'none'; }, 2000);
}

// ─────────────────────────────────────────────
//  RESULTS
// ─────────────────────────────────────────────
const LEADERBOARD = [
  { name: 'Ahmed K.', score: 1240 },
  { name: 'Sara M.', score: 1180 },
  { name: 'Omar T.', score: 1050 },
  { name: 'Nour A.', score: 920 },
  { name: 'Lina R.', score: 870 },
];

function showResults() {
  clearInterval(timerInterval);
  showScreen('result-screen');

  document.getElementById('final-score').textContent = score;
  document.getElementById('stat-correct').textContent = correct;
  document.getElementById('stat-wrong').textContent = 10 - correct;
  document.getElementById('stat-streak').textContent = bestStreak;

  const pct = (correct / 10) * 100;
  let trophy, title, sub, grade, gradeColor;

  if (pct === 100) {
    trophy = '🏆'; title = 'PERFECT SCORE!'; sub = 'You are an Ergonomics Master!';
    grade = '⭐ S RANK — LEGENDARY'; gradeColor = '#c8972a';
  } else if (pct >= 80) {
    trophy = '🥇'; title = 'Excellent!'; sub = 'You\'re an Ergonomics Expert!';
    grade = '🥇 A RANK — EXPERT'; gradeColor = '#43a047';
  } else if (pct >= 60) {
    trophy = '🥈'; title = 'Well Done!'; sub = 'Good ergonomic knowledge!';
    grade = '🥈 B RANK — GOOD'; gradeColor = '#1976d2';
  } else if (pct >= 40) {
    trophy = '🥉'; title = 'Keep Going!'; sub = 'You\'re learning the basics!';
    grade = '🥉 C RANK — LEARNING'; gradeColor = '#f57c00';
  } else {
    trophy = '📚'; title = 'Keep Practicing!'; sub = 'Explore more about ergonomics!';
    grade = '📚 D RANK — BEGINNER'; gradeColor = '#e53935';
  }

  document.getElementById('result-trophy').textContent = trophy;
  document.getElementById('result-title').textContent = title;
  document.getElementById('result-sub').textContent = sub;

  const gb = document.getElementById('grade-badge-wrap');
  gb.innerHTML = `<div class="grade-badge" style="background:${gradeColor}22;color:${gradeColor};border:2px solid ${gradeColor}44;">${grade}</div>`;

  // Coupon
  if (pct >= 60) {
    const codes = ['ERGO10OFF', 'PACK20SAVE', 'ERGO15VIP', 'BACK25DEAL'];
    document.getElementById('coupon-code').textContent = codes[Math.floor(Math.random() * codes.length)];
    document.getElementById('coupon-box').style.display = 'block';
  } else {
    document.getElementById('coupon-box').style.display = 'none';
  }

  // Leaderboard
  const allEntries = [...LEADERBOARD, { name: 'You 🎒', score, isYou: true }]
    .sort((a, b) => b.score - a.score)
    .slice(0, 6);

  const lb = document.getElementById('leaderboard-list');
  lb.innerHTML = '';
  const rankClasses = ['gold', 'silver', 'bronze'];
  allEntries.forEach((e, i) => {
    const row = document.createElement('div');
    row.className = 'lb-row';
    row.innerHTML = `
      <div class="lb-rank ${rankClasses[i] || ''}">${i + 1}</div>
      <div class="lb-name ${e.isYou ? 'lb-you' : ''}">${e.name}</div>
      <div class="lb-score ${e.isYou ? 'lb-you' : ''}">${e.score} pts</div>
    `;
    lb.appendChild(row);
  });

  if (pct >= 80) launchConfetti();
}

function restartGame() {
  stopConfetti();
  showScreen('start-screen');
}

function shareScore() {
  const text = `🎒 I scored ${score} points in the ERGOPACK Ergonomic Challenge! Can you beat me? Try at ergopack.com`;
  if (navigator.share) {
    navigator.share({ title: 'ERGOPACK Challenge', text });
  } else {
    navigator.clipboard.writeText(text).then(() => alert('Score copied to clipboard! Share it! 🎒'));
  }
}

// ─────────────────────────────────────────────
//  CONFETTI
// ─────────────────────────────────────────────
let confettiAnimId = null;
let confettiParticles = [];

function launchConfetti() {
  const canvas = document.getElementById('confetti-canvas');
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors = ['#c8972a', '#e8b84b', '#1a2e4a', '#2196f3', '#43a047', '#ff9800'];
  confettiParticles = Array.from({ length: 120 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * -canvas.height,
    w: Math.random() * 10 + 6,
    h: Math.random() * 6 + 3,
    color: colors[Math.floor(Math.random() * colors.length)],
    speed: Math.random() * 3 + 2,
    angle: Math.random() * 360,
    spin: (Math.random() - 0.5) * 6,
    drift: (Math.random() - 0.5) * 2
  }));

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    confettiParticles.forEach(p => {
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.angle * Math.PI / 180);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
      ctx.restore();
      p.y += p.speed;
      p.x += p.drift;
      p.angle += p.spin;
      if (p.y > canvas.height) { p.y = -20; p.x = Math.random() * canvas.width; }
    });
    confettiAnimId = requestAnimationFrame(draw);
  }
  draw();
  setTimeout(stopConfetti, 5000);
}

function stopConfetti() {
  if (confettiAnimId) {
    cancelAnimationFrame(confettiAnimId);
    confettiAnimId = null;
    const canvas = document.getElementById('confetti-canvas');
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
  }
}
</script>
</body>
</html>