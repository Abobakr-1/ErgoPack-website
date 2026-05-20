<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>ERGOPACK – Spin & Win!</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>

:root{
  --primary-blue:#264e80;
  --secondary-blue:#1c4e7a;
  --navy-dark:#0f1e30;
  --gold:#FFD700;
  --gold-light:#FFEC8B;
  --white:#ffffff;
  --light-bg:#f4f7fb;
  --red:#e53935;
  --green:#43a047;
  --shadow:0 8px 32px rgba(28,78,122,.2);

  --card-bg:#ffffff;
  --body-bg:#f4f7fb;
  --text-main:#1c4e7a;
  --text-muted:#555;
  --border-light:#dde4ef;
}

body.dark{
  --card-bg:#10243a;
  --body-bg:#081423;
  --text-main:#e8f0fe;
  --text-muted:#9fb4ce;
  --border-light:#294566;
  --light-bg:#10243a;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  font-family:'Poppins',sans-serif;
  background:var(--body-bg);
  color:var(--text-main);
  overflow-x:hidden;
  transition:.3s;
}

/* CURSOR */

.dot{
  width:10px;
  height:10px;
  background:var(--gold);
  border-radius:50%;
  position:fixed;
  transform:translate(-50%,-50%);
  pointer-events:none;
  z-index:9999;
}

.ring{
  width:40px;
  height:40px;
  border:2px solid var(--gold);
  border-radius:50%;
  position:fixed;
  transform:translate(-50%,-50%);
  pointer-events:none;
  z-index:9998;
  transition:.12s;
}

/* NAVBAR */

nav{
  height:70px;
  padding:0 30px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  background:linear-gradient(90deg,var(--secondary-blue),var(--primary-blue));
  position:sticky;
  top:0;
  z-index:100;
}

.nav-logo{
  display:flex;
  align-items:center;
  gap:12px;
}

.logo-circle{
  width:42px;
  height:42px;
  border-radius:50%;
  background:white;
  color:var(--primary-blue);
  font-weight:900;
  display:flex;
  align-items:center;
  justify-content:center;
  border:2px solid var(--gold);
}

.brand{
  color:white;
  font-size:22px;
  font-family:'Montserrat',sans-serif;
  font-weight:900;
}

.nav-right{
  display:flex;
  align-items:center;
  gap:20px;
}

.nav-right a{
  text-decoration:none;
  color:white;
  font-weight:600;
}

#darkBtn{
  border:none;
  background:var(--gold);
  color:var(--primary-blue);
  padding:8px 14px;
  border-radius:10px;
  cursor:pointer;
  font-weight:800;
}

/* HERO */

.hero{
  background:linear-gradient(135deg,var(--navy-dark),var(--secondary-blue),var(--primary-blue));
  padding:50px 20px;
  text-align:center;
}

.hero h1{
  color:white;
  font-size:clamp(28px,5vw,48px);
  font-family:'Montserrat',sans-serif;
  font-weight:900;
}

.hero h1 span{
  color:var(--gold);
}

.hero p{
  color:rgba(255,255,255,.8);
  margin-top:12px;
}

/* WRAPPER */

#game-wrapper{
  max-width:850px;
  margin:40px auto;
  padding:0 20px 50px;
}

.screen{
  display:none;
}

.screen.active{
  display:block;
}

/* START SCREEN */

#start-screen{
  background:var(--card-bg);
  border-radius:24px;
  overflow:hidden;
  box-shadow:var(--shadow);
}

.start-top{
  padding:40px;
  text-align:center;
  background:linear-gradient(135deg,var(--secondary-blue),var(--primary-blue));
}

.big-bag{
  font-size:80px;
  display:block;
  animation:float 3s ease-in-out infinite;
}

@keyframes float{
  0%,100%{transform:translateY(0)}
  50%{transform:translateY(-10px)}
}

.start-title{
  color:white;
  font-size:36px;
  font-weight:900;
  font-family:'Montserrat',sans-serif;
}

.start-title span{
  color:var(--gold);
}

.start-body{
  padding:35px;
  text-align:center;
}

.start-desc{
  color:var(--text-muted);
  line-height:1.8;
  margin-bottom:28px;
}

.btn-start{
  border:none;
  background:linear-gradient(135deg,var(--gold),var(--gold-light));
  color:var(--primary-blue);
  padding:16px 40px;
  border-radius:50px;
  font-size:18px;
  font-weight:900;
  cursor:pointer;
  transition:.2s;
}

.btn-start:hover{
  transform:translateY(-3px);
}

/* SPIN SCREEN */

.spin-container{
  display:flex;
  flex-direction:column;
  align-items:center;
}

.wheel-box{
  width:420px;
  height:420px;
  position:relative;
}

canvas{
  width:100%;
  height:100%;
  border-radius:50%;
  border:10px solid var(--primary-blue);
  box-shadow:0 10px 30px rgba(0,0,0,.2);
}

.arrow{
  position:absolute;
  top:-18px;
  left:50%;
  transform:translateX(-50%);
  width:0;
  height:0;
  border-left:22px solid transparent;
  border-right:22px solid transparent;
  border-top:42px solid var(--gold);
  z-index:5;
}

.spin-btn{
  margin-top:30px;
  border:none;
  background:linear-gradient(90deg,var(--secondary-blue),var(--primary-blue));
  color:white;
  padding:16px 40px;
  border-radius:40px;
  font-size:22px;
  font-weight:900;
  cursor:pointer;
}

.spin-btn:disabled{
  opacity:.6;
  cursor:not-allowed;
}

/* QUESTION SCREEN */

.game-card{
  background:var(--card-bg);
  border-radius:24px;
  overflow:hidden;
  box-shadow:var(--shadow);
}

.game-card-header{
  padding:18px 24px;
  background:linear-gradient(90deg,var(--secondary-blue),var(--primary-blue));
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.q-badge{
  background:var(--gold);
  color:var(--primary-blue);
  padding:6px 14px;
  border-radius:30px;
  font-weight:900;
}

.q-category{
  color:white;
  font-weight:700;
}

.game-body{
  padding:32px;
}

.question-text{
  font-size:24px;
  margin-bottom:24px;
  font-family:'Montserrat',sans-serif;
}

.options-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
}

.option-btn{
  border:2px solid var(--border-light);
  background:var(--light-bg);
  border-radius:16px;
  padding:18px;
  cursor:pointer;
  text-align:left;
  display:flex;
  align-items:center;
  gap:12px;
  transition:.2s;
  color:var(--text-main);
  font-weight:700;
}

.option-btn:hover{
  transform:translateY(-2px);
}

.opt-letter{
  width:30px;
  height:30px;
  border-radius:8px;
  background:white;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:900;
  color:var(--primary-blue);
}

.correct{
  background:#d4edda !important;
  border-color:var(--green) !important;
  color:#155724 !important;
}

.wrong{
  background:#f8d7da !important;
  border-color:var(--red) !important;
  color:#721c24 !important;
}

.feedback-bar{
  margin-top:20px;
  padding:16px;
  border-radius:12px;
  display:none;
}

.feedback-bar.show{
  display:flex;
  gap:10px;
  align-items:center;
}

.correct-fb{
  background:#e8f5e9;
  color:#2e7d32;
}

.wrong-fb{
  background:#ffebee;
  color:#c62828;
}

.btn-next{
  width:100%;
  margin-top:20px;
  border:none;
  background:var(--primary-blue);
  color:white;
  padding:16px;
  border-radius:50px;
  font-size:16px;
  font-weight:900;
  cursor:pointer;
  display:none;
}

.btn-next.show{
  display:block;
}

/* RESULT */

.result-card{
  background:var(--card-bg);
  padding:40px;
  border-radius:24px;
  box-shadow:var(--shadow);
  text-align:center;
}

.result-trophy{
  font-size:90px;
}

.coupon-box{
  margin:28px 0;
  border:2px dashed var(--gold);
  background:#fff8e7;
  padding:24px;
  border-radius:18px;
}

.coupon-code{
  font-size:34px;
  font-weight:900;
  letter-spacing:4px;
  color:var(--primary-blue);
  font-family:'Montserrat',sans-serif;
}

.btn-replay{
  border:none;
  background:var(--gold);
  color:var(--primary-blue);
  padding:14px 34px;
  border-radius:50px;
  font-weight:900;
  cursor:pointer;
}

footer{
  text-align:center;
  padding:20px;
  background:var(--navy-dark);
  color:rgba(255,255,255,.7);
}

@media(max-width:600px){

  .wheel-box{
    width:300px;
    height:300px;
  }

  .options-grid{
    grid-template-columns:1fr;
  }

}

</style>
</head>

<body>

<div class="dot"></div>
<div class="ring"></div>

<nav>

  <div class="nav-logo">
    <div class="logo-circle">EP</div>
    <div class="brand">ERGOPACK</div>
  </div>

  <div class="nav-right">
    <a href="#">Home</a>
    <a href="#">Shop</a>
    <button id="darkBtn">🌙</button>
  </div>

</nav>

<section class="hero">
  <h1>🎒 <span>ERGOPACK</span> Spin Challenge</h1>
  <p>Spin the wheel, answer correctly, and win discounts!</p>
</section>

<div id="game-wrapper">

  <!-- START -->

  <div id="start-screen" class="screen active">

    <div class="start-top">
      <span class="big-bag">🎒</span>
      <div class="start-title">
        Pack It <span>Right!</span>
      </div>
    </div>

    <div class="start-body">

      <p class="start-desc">
        Test your ergonomic knowledge and unlock exclusive ERGOPACK rewards.
      </p>

      <button class="btn-start" id="startBtn">
        START PLAYING
      </button>

    </div>

  </div>

  <!-- SPIN -->

  <div id="spin-screen" class="screen">

    <div class="spin-container">

      <div class="wheel-box">

        <div class="arrow"></div>

        <canvas id="wheelCanvas" width="400" height="400"></canvas>

      </div>

      <button class="spin-btn" id="spinBtn">
        SPIN THE WHEEL
      </button>

    </div>

  </div>

  <!-- QUESTION -->

  <div id="game-screen" class="screen">

    <div class="game-card">

      <div class="game-card-header">
        <div class="q-badge" id="q-badge">1/1</div>
        <div class="q-category" id="q-cat">Category</div>
      </div>

      <div class="game-body">

        <h2 class="question-text" id="question-text"></h2>

        <div class="options-grid" id="options-grid"></div>

        <div id="feedback-bar" class="feedback-bar">
          <span id="feedback-icon"></span>
          <span id="feedback-text"></span>
        </div>

        <button id="btn-next" class="btn-next">
          SEE RESULTS
        </button>

      </div>

    </div>

  </div>

  <!-- RESULT -->

  <div id="result-screen" class="screen">

    <div class="result-card">

      <div class="result-trophy" id="result-trophy">🏆</div>

      <h2 id="result-title">You Won!</h2>

      <p id="result-sub">
        You unlocked an exclusive discount code.
      </p>

<div class="coupon-box">

  <p style="font-size:18px;font-weight:700;color:#1c4e7a;">
    🎁 Giveaway Reward
  </p>

  <div class="coupon-code" id="coupon-code">
    PEN + STICKER
  </div>

</div>

      <button class="btn-replay" onclick="location.reload()">
        PLAY AGAIN
      </button>

    </div>

  </div>

</div>

<footer>
  © 2026 ERGOPACK — Carry Smart, Feel Better.
</footer>

<script>

document.addEventListener("DOMContentLoaded", () => {

  /* CURSOR */

  const dot = document.querySelector(".dot");
  const ring = document.querySelector(".ring");

  window.addEventListener("mousemove", (e) => {

    dot.style.left = e.clientX + "px";
    dot.style.top = e.clientY + "px";

    ring.style.left = e.clientX + "px";
    ring.style.top = e.clientY + "px";

  });

  /* DARK MODE */

  const darkBtn = document.getElementById("darkBtn");

  darkBtn.addEventListener("click", () => {

    document.body.classList.toggle("dark");

    darkBtn.textContent =
      document.body.classList.contains("dark")
      ? "☀️"
      : "🌙";

  });

  /* DATA */

  const categories = [
    {name:"Posture",color:"#1c4e7a"},
    {name:"Weight",color:"#264e80"},
    {name:"Materials",color:"#1c4e7a"},
    {name:"Design",color:"#264e80"},
    {name:"Health",color:"#1c4e7a"},
    {name:"Features",color:"#264e80"}
  ];

  const questions = {

    Posture:{
      q:"How should an ergonomic bag sit on your back?",
      opts:[
        "High and tight",
        "Low near hips",
        "One shoulder only",
        "Loose straps"
      ],
      ans:0,
      exp:"A backpack should sit high and close to the body."
    },

    Weight:{
      q:"Even weight distribution reduces strain on:",
      opts:[
        "Feet",
        "Hands",
        "Shoulders & Back",
        "Neck only"
      ],
      ans:2,
      exp:"Balanced weight prevents muscle strain."
    },

    Materials:{
      q:"Why is breathable mesh useful?",
      opts:[
        "Waterproofing",
        "Reduce sweat",
        "Adds weight",
        "Changes color"
      ],
      ans:1,
      exp:"Mesh allows airflow and reduces heat."
    },

    Design:{
      q:"ERGOPACK design philosophy is:",
      opts:[
        "Heavy is better",
        "Style only",
        "Comfort meets style",
        "No support"
      ],
      ans:2,
      exp:"ERGOPACK combines comfort with modern style."
    },

    Health:{
      q:"One shoulder carrying may cause:",
      opts:[
        "Better posture",
        "Muscle imbalance",
        "No effect",
        "Faster walking"
      ],
      ans:1,
      exp:"One-sided weight stresses the spine."
    },

    Features:{
      q:"A chest strap mainly helps:",
      opts:[
        "Decoration",
        "Stabilize load",
        "Hold phone",
        "Open the bag"
      ],
      ans:1,
      exp:"Chest straps reduce shoulder strain."
    }

  };

  /* SCREENS */

  function showScreen(id){

    document.querySelectorAll(".screen").forEach(screen=>{
      screen.classList.remove("active");
    });

    document.getElementById(id).classList.add("active");

  }

  /* START BUTTON */

  const startBtn = document.getElementById("startBtn");

  startBtn.addEventListener("click", () => {

    showScreen("spin-screen");

  });

  /* WHEEL */

  const canvas = document.getElementById("wheelCanvas");
  const ctx = canvas.getContext("2d");

  const centerX = 200;
  const centerY = 200;
  const radius = 190;

  let currentRotation = 0;
  let selectedCategory = "";
  let spinning = false;

  function drawWheel(){

    ctx.clearRect(0,0,canvas.width,canvas.height);

    const sliceAngle = (2 * Math.PI) / categories.length;

    categories.forEach((cat,i)=>{

      const startAngle =
        i * sliceAngle;

      const endAngle =
        startAngle + sliceAngle;

      ctx.beginPath();

      ctx.moveTo(centerX,centerY);

      ctx.arc(
        centerX,
        centerY,
        radius,
        startAngle,
        endAngle
      );

      ctx.fillStyle = cat.color;
      ctx.fill();

      ctx.strokeStyle = "white";
      ctx.lineWidth = 3;
      ctx.stroke();

      /* TEXT */

      ctx.save();

      ctx.translate(centerX,centerY);

      ctx.rotate(startAngle + sliceAngle/2);

      ctx.fillStyle = "white";
      ctx.font = "bold 18px Montserrat";
      ctx.textAlign = "right";

      ctx.fillText(cat.name, radius - 25, 8);

      ctx.restore();

    });

  }

  function renderWheel(){

    ctx.clearRect(0,0,canvas.width,canvas.height);

    ctx.save();

    ctx.translate(centerX,centerY);

    ctx.rotate(currentRotation * Math.PI/180);

    ctx.translate(-centerX,-centerY);

    drawWheel();

    ctx.restore();

  }

  drawWheel();

  /* SPIN */

  const spinBtn = document.getElementById("spinBtn");

  spinBtn.addEventListener("click", ()=>{

    if(spinning) return;

    spinning = true;

    spinBtn.disabled = true;

    const randomIndex =
      Math.floor(Math.random() * categories.length);

    selectedCategory =
      categories[randomIndex].name;

    const sliceDeg =
      360 / categories.length;

    const finalDeg =
      (360 * 6) +
      (360 - (randomIndex * sliceDeg)) -
      (sliceDeg / 2);

    animateSpin(finalDeg, 5000);

  });

  function animateSpin(target, duration){

    const startTime = performance.now();
    const startRotation = currentRotation;

    function animate(now){

      const elapsed = now - startTime;

      const progress =
        Math.min(elapsed / duration, 1);

      const ease =
        1 - Math.pow(1 - progress, 4);

      currentRotation =
        startRotation +
        (target - startRotation) * ease;

      renderWheel();

      if(progress < 1){

        requestAnimationFrame(animate);

      }else{

        currentRotation =
          target % 360;

        spinning = false;

        spinBtn.disabled = false;

        setTimeout(()=>{
          startQuestion();
        },700);

      }

    }

    requestAnimationFrame(animate);

  }

  /* QUESTIONS */

  function startQuestion(){

    showScreen("game-screen");

    const q =
      questions[selectedCategory];

    document.getElementById("q-cat").textContent =
      "🎡 " + selectedCategory;

    document.getElementById("question-text").textContent =
      q.q;

    const grid =
      document.getElementById("options-grid");

    grid.innerHTML = "";

    const letters = ["A","B","C","D"];

    q.opts.forEach((opt,index)=>{

      const btn =
        document.createElement("button");

      btn.className = "option-btn";

      btn.innerHTML = `
        <span class="opt-letter">
          ${letters[index]}
        </span>

        <span>${opt}</span>
      `;

      btn.addEventListener("click", ()=>{

        checkAnswer(index, btn);

      });

      grid.appendChild(btn);

    });

  }

  function checkAnswer(index, btn){

    const q =
      questions[selectedCategory];

    const buttons =
      document.querySelectorAll(".option-btn");

    buttons.forEach(b=>{
      b.disabled = true;
    });

    const feedback =
      document.getElementById("feedback-bar");

    if(index === q.ans){

      btn.classList.add("correct");

      feedback.className =
        "feedback-bar correct-fb show";

      document.getElementById("feedback-icon").textContent =
        "✅";

      document.getElementById("feedback-text").textContent =
        "Correct! " + q.exp;

    }else{

      btn.classList.add("wrong");

      buttons[q.ans].classList.add("correct");

      feedback.className =
        "feedback-bar wrong-fb show";

      document.getElementById("feedback-icon").textContent =
        "❌";

      document.getElementById("feedback-text").textContent =
        "Wrong! " + q.exp;

    }

    document
      .getElementById("btn-next")
      .classList.add("show");

  }

  /* RESULTS */

  const nextBtn =
    document.getElementById("btn-next");

  nextBtn.addEventListener("click", ()=>{

    showResults();

  });

  function showResults(){

    function showResults(){

  showScreen("result-screen");

  const lost =
    document.querySelector(".wrong");

  const won = !lost;

  const title =
    document.getElementById("result-title");

  const sub =
    document.getElementById("result-sub");

  const trophy =
    document.getElementById("result-trophy");

  const code =
    document.getElementById("coupon-code");

  if(won){

    title.textContent =
      "🎉 You Won!";

    sub.textContent =
      "Congratulations! Take your ERGOPACK pen and sticker giveaway reward.";

    trophy.textContent =
      "🏆";

    code.textContent =
      "PEN + STICKER";

  }else{

    title.textContent =
      "😅 Almost!";

    sub.textContent =
      "Better luck next time!";

    trophy.textContent =
      "🎒";

    code.textContent =
      "TRY AGAIN";

  }
    }}

});

</script>

</body>
</html>
