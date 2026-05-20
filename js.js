let dealBar = document.getElementById("deal-bar");

// Read date directly from HTML
let endDateString = dealBar.getAttribute("data-end");
let target = new Date(endDateString);

function updateCountdown() {
  let now = new Date().getTime();
  let distance = target.getTime() - now;

  if (distance <= 0) {
    document.getElementById("cd-days").innerText = "00";
    document.getElementById("cd-hrs").innerText = "00";
    document.getElementById("cd-min").innerText = "00";
    document.getElementById("cd-sec").innerText = "00";
    document.getElementById("cd-msg").innerText = "🔥 Offer has ended!";
    clearInterval(timer);
    return;
  }

  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("cd-days").innerText = String(days).padStart(2, "0");
  document.getElementById("cd-hrs").innerText = String(hours).padStart(2, "0");
  document.getElementById("cd-min").innerText = String(minutes).padStart(2, "0");
  document.getElementById("cd-sec").innerText = String(seconds).padStart(2, "0");
}

updateCountdown();
let timer = setInterval(updateCountdown, 1000);