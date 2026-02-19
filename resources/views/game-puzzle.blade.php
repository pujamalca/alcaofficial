<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🌙 Puzzle Ramadan - Yuk Susun Gambar!</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;700;900&display=swap');

  :root {
    --gold: #FFD700;
    --deep-gold: #FFA500;
    --teal: #00B4A6;
    --dark-teal: #007A73;
    --cream: #FFF8E7;
    --purple: #6C3FA0;
    --pink: #FF6B9D;
    --night: #1A1040;
    --star-yellow: #FFEC5C;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'Nunito', sans-serif;
    background: var(--night);
    min-height: 100vh;
    overflow-x: hidden;
    position: relative;
  }

  /* Starfield */
  .stars {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 0;
  }
  .star {
    position: absolute;
    background: white;
    border-radius: 50%;
    animation: twinkle 2s infinite alternate;
  }

  @keyframes twinkle {
    from { opacity: 0.2; transform: scale(1); }
    to   { opacity: 1;   transform: scale(1.4); }
  }

  /* Clouds / decorative */
  .clouds {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
  }

  .game-wrapper {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    padding: 16px;
  }

  /* Header */
  .header {
    text-align: center;
    margin-bottom: 12px;
    animation: dropIn 0.6s cubic-bezier(0.34,1.56,0.64,1);
  }
  @keyframes dropIn {
    from { transform: translateY(-60px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
  }

  .header h1 {
    font-family: 'Fredoka One', cursive;
    font-size: clamp(1.8rem, 5vw, 2.8rem);
    color: var(--gold);
    text-shadow: 0 0 30px rgba(255,215,0,0.6), 3px 3px 0 var(--deep-gold);
    letter-spacing: 1px;
  }
  .header p {
    color: var(--cream);
    font-size: clamp(0.85rem, 2.5vw, 1rem);
    margin-top: 4px;
    opacity: 0.85;
  }

  /* Stats bar */
  .stats {
    display: flex;
    gap: 12px;
    margin-bottom: 14px;
    flex-wrap: wrap;
    justify-content: center;
  }
  .stat-badge {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,215,0,0.4);
    border-radius: 50px;
    padding: 6px 18px;
    color: var(--gold);
    font-family: 'Fredoka One', cursive;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 6px;
    backdrop-filter: blur(10px);
  }
  .stat-badge span { font-size: 1.2rem; }

  /* Level pills */
  .level-select {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
    justify-content: center;
  }
  .level-btn {
    font-family: 'Fredoka One', cursive;
    font-size: 0.9rem;
    padding: 7px 18px;
    border-radius: 50px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.2s;
  }
  .level-btn.easy   { background: #4CAF50; color: white; }
  .level-btn.medium { background: #FF9800; color: white; }
  .level-btn.hard   { background: #E53935; color: white; }
  .level-btn.active { border-color: white; transform: scale(1.1); box-shadow: 0 0 16px rgba(255,255,255,0.4); }
  .level-btn:hover  { transform: scale(1.08); }

  /* Puzzle card */
  .puzzle-card {
    background: rgba(255,255,255,0.07);
    border: 2px solid rgba(255,215,0,0.25);
    border-radius: 24px;
    padding: 18px;
    backdrop-filter: blur(16px);
    box-shadow: 0 8px 40px rgba(0,0,0,0.4);
    margin-bottom: 16px;
  }

  .puzzle-label {
    text-align: center;
    font-family: 'Fredoka One', cursive;
    font-size: 1.1rem;
    color: var(--gold);
    margin-bottom: 12px;
  }

  /* Two-panel layout */
  .panels {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    flex-wrap: wrap;
    justify-content: center;
  }

  .panel-label {
    text-align: center;
    font-family: 'Fredoka One', cursive;
    font-size: 0.85rem;
    color: rgba(255,255,255,0.5);
    margin-bottom: 6px;
  }

  /* Reference image */
  .reference-panel canvas {
    border-radius: 12px;
    border: 2px solid rgba(255,215,0,0.3);
    display: block;
  }

  /* Puzzle grid */
  #puzzle-grid {
    display: grid;
    gap: 3px;
    cursor: pointer;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid rgba(255,215,0,0.3);
  }

  .puzzle-piece {
    position: relative;
    overflow: hidden;
    transition: transform 0.15s, box-shadow 0.15s;
    cursor: pointer;
    border-radius: 2px;
  }
  .puzzle-piece:hover {
    transform: scale(1.04);
    z-index: 2;
    box-shadow: 0 0 12px rgba(255,215,0,0.7);
  }
  .puzzle-piece.selected {
    box-shadow: 0 0 0 3px var(--gold), 0 0 20px rgba(255,215,0,0.8);
    z-index: 3;
    transform: scale(1.06);
  }
  .puzzle-piece canvas {
    display: block;
    pointer-events: none;
  }

  /* Buttons */
  .btn-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 12px;
  }
  .game-btn {
    font-family: 'Fredoka One', cursive;
    font-size: 1rem;
    padding: 10px 24px;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }
  .game-btn:hover  { transform: translateY(-2px) scale(1.04); }
  .game-btn:active { transform: scale(0.97); }
  .btn-shuffle  { background: linear-gradient(135deg, #FF6B9D, #C0397A); color: white; }
  .btn-hint     { background: linear-gradient(135deg, #FFD700, #FFA500); color: #1A1040; }
  .btn-new      { background: linear-gradient(135deg, #00B4A6, #007A73); color: white; }

  /* Win overlay */
  #win-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(26,16,64,0.85);
    z-index: 100;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    backdrop-filter: blur(8px);
  }
  #win-overlay.show { display: flex; }

  .win-box {
    background: linear-gradient(135deg, #2A1660, #1A1040);
    border: 3px solid var(--gold);
    border-radius: 32px;
    padding: 40px 50px;
    box-shadow: 0 0 60px rgba(255,215,0,0.4);
    animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1);
  }
  @keyframes popIn {
    from { transform: scale(0.5); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
  }
  .win-emoji { font-size: 4rem; margin-bottom: 12px; animation: bounce 0.8s infinite alternate; }
  @keyframes bounce { from { transform: translateY(0); } to { transform: translateY(-12px); } }
  .win-title {
    font-family: 'Fredoka One', cursive;
    font-size: 2.2rem;
    color: var(--gold);
    text-shadow: 0 0 20px rgba(255,215,0,0.5);
    margin-bottom: 8px;
  }
  .win-sub { color: var(--cream); font-size: 1.1rem; margin-bottom: 20px; }
  .stars-row { font-size: 2rem; margin-bottom: 16px; letter-spacing: 6px; }

  /* Leaderboard */
  .leaderboard {
    background: rgba(255,255,255,0.06);
    border: 2px solid rgba(255,215,0,0.2);
    border-radius: 20px;
    padding: 14px 18px;
    margin-top: 4px;
    min-width: 220px;
    max-width: 320px;
  }
  .lb-title {
    font-family: 'Fredoka One', cursive;
    color: var(--gold);
    font-size: 1rem;
    text-align: center;
    margin-bottom: 10px;
  }
  .lb-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 0;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: var(--cream);
    font-size: 0.85rem;
  }
  .lb-rank { font-family: 'Fredoka One', cursive; color: var(--gold); width: 24px; }
  .lb-empty { color: rgba(255,255,255,0.3); font-size: 0.8rem; text-align: center; padding: 8px 0; }

  /* Confetti */
  .confetti-piece {
    position: fixed;
    width: 10px;
    height: 10px;
    border-radius: 2px;
    animation: confettiFall linear forwards;
    z-index: 200;
    pointer-events: none;
  }
  @keyframes confettiFall {
    0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
    100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
  }

  /* Hint flash */
  .piece-highlight {
    position: absolute;
    inset: 0;
    background: rgba(255,215,0,0.5);
    border-radius: 2px;
    animation: flashHint 0.4s 3;
    pointer-events: none;
  }
  @keyframes flashHint { 0%,100% { opacity: 0; } 50% { opacity: 1; } }

  @media (max-width: 500px) {
    .panels { flex-direction: column; align-items: center; }
    .win-box { padding: 28px 24px; }
    .win-title { font-size: 1.6rem; }
  }
</style>
</head>
<body>

<div class="stars" id="stars"></div>

<div class="game-wrapper">
  <div class="header">
    <h1>🌙 Puzzle Ramadan 🌙</h1>
    <p>Susun gambar Ramadan dan dapatkan bintang!</p>
  </div>

  <div class="stats">
    <div class="stat-badge"><span>⭐</span> Skor: <b id="score-display">0</b></div>
    <div class="stat-badge"><span>🏆</span> Terbaik: <b id="best-display">0</b></div>
    <div class="stat-badge"><span>🧩</span> Selesai: <b id="solved-display">0</b></div>
  </div>

  <div class="level-select">
    <button class="level-btn easy active"  onclick="setLevel(2,'easy')"  id="btn-easy">🟢 Mudah (2×2)</button>
    <button class="level-btn medium"       onclick="setLevel(3,'medium')"id="btn-medium">🟡 Sedang (3×3)</button>
    <button class="level-btn hard"         onclick="setLevel(4,'hard')"  id="btn-hard">🔴 Sulit (4×4)</button>
  </div>

  <div class="puzzle-card">
    <div class="puzzle-label" id="puzzle-name">🌙 Bulan & Bintang</div>
    <div class="panels">
      <div class="reference-panel">
        <div class="panel-label">🖼 Gambar Asli</div>
        <canvas id="ref-canvas"></canvas>
      </div>
      <div>
        <div class="panel-label">🧩 Susun di sini!</div>
        <div id="puzzle-grid"></div>
      </div>
    </div>
    <div class="btn-row">
      <button class="game-btn btn-shuffle" onclick="shuffle()">🔀 Acak</button>
      <button class="game-btn btn-hint"    onclick="showHint()">💡 Petunjuk</button>
      <button class="game-btn btn-new"     onclick="nextPuzzle()">▶ Gambar Baru</button>
    </div>
  </div>

  <div class="leaderboard">
    <div class="lb-title">🏆 Skor Terbaik</div>
    <div id="lb-rows"><div class="lb-empty">Belum ada skor. Yuk main!</div></div>
  </div>
</div>

<!-- Win overlay -->
<div id="win-overlay">
  <div class="win-box">
    <div class="win-emoji">🎉</div>
    <div class="win-title">Hebat! Berhasil!</div>
    <div class="stars-row" id="win-stars">⭐⭐⭐</div>
    <div class="win-sub" id="win-msg">Puzzle tersusun dengan sempurna!</div>
    <div class="btn-row" style="margin-top:0">
      <button class="game-btn btn-new"     onclick="closeWin();nextPuzzle()">▶ Gambar Baru</button>
      <button class="game-btn btn-shuffle" onclick="closeWin();shuffle()">🔀 Main Lagi</button>
    </div>
  </div>
</div>

<script>
// ─── State ────────────────────────────────────────────────────────────────
let GRID = 2, score = 0, bestScore = 0, solvedCount = 0;
let pieces = [], selected = null, moveCount = 0;
let currentPuzzleIdx = 0;
let leaderboard = [];
let PSIZE; // piece pixel size
const CANVAS_SIZE = 240;

// ─── Puzzle Drawings ──────────────────────────────────────────────────────
const PUZZLES = [
  { name: '🌙 Bulan & Bintang', draw: drawMoon },
  { name: '🕌 Masjid Indah',   draw: drawMasjid },
  { name: '🏮 Lentera Cantik', draw: drawLantern },
  { name: '🌴 Kurma & Lezat',  draw: drawDates },
  { name: '🌅 Malam Ramadan',  draw: drawNight },
];

function drawMoon(ctx, W) {
  // Sky gradient
  let g = ctx.createLinearGradient(0,0,0,W);
  g.addColorStop(0,'#0D0830'); g.addColorStop(1,'#1E1060');
  ctx.fillStyle = g; ctx.fillRect(0,0,W,W);
  // Stars
  for(let i=0;i<20;i++){
    ctx.fillStyle=`rgba(255,255,200,${Math.random()*0.7+0.3})`;
    let x=Math.random()*W, y=Math.random()*W*0.75, r=Math.random()*2+1;
    ctx.beginPath(); ctx.arc(x,y,r,0,Math.PI*2); ctx.fill();
  }
  // Moon crescent
  ctx.fillStyle='#FFE066'; ctx.shadowColor='#FFD700'; ctx.shadowBlur=24;
  ctx.beginPath(); ctx.arc(W*0.5,W*0.4,W*0.28,0,Math.PI*2); ctx.fill();
  ctx.fillStyle='#1A0A50'; ctx.shadowBlur=0;
  ctx.beginPath(); ctx.arc(W*0.38,W*0.32,W*0.22,0,Math.PI*2); ctx.fill();
  // Big star
  ctx.shadowColor='#FFD700'; ctx.shadowBlur=12;
  drawStar(ctx, W*0.72, W*0.28, 5, W*0.07, W*0.03, '#FFE066');
}

function drawStar(ctx,cx,cy,spikes,outerR,innerR,color){
  ctx.fillStyle=color;
  ctx.beginPath();
  for(let i=0;i<spikes*2;i++){
    let r=i%2===0?outerR:innerR;
    let a=Math.PI/spikes*i - Math.PI/2;
    i===0?ctx.moveTo(cx+r*Math.cos(a),cy+r*Math.sin(a)):ctx.lineTo(cx+r*Math.cos(a),cy+r*Math.sin(a));
  }
  ctx.closePath(); ctx.fill();
}

function drawMasjid(ctx,W){
  // Sky
  let g=ctx.createLinearGradient(0,0,0,W);
  g.addColorStop(0,'#1A0050'); g.addColorStop(1,'#6C2F9E');
  ctx.fillStyle=g; ctx.fillRect(0,0,W,W);
  // Stars small
  for(let i=0;i<12;i++){
    ctx.fillStyle='rgba(255,255,200,0.7)';
    ctx.beginPath(); ctx.arc(Math.random()*W,Math.random()*W*0.5,1.5,0,Math.PI*2); ctx.fill();
  }
  // Ground
  ctx.fillStyle='#2D1A6A'; ctx.fillRect(0,W*0.72,W,W*0.28);
  // Main building
  ctx.fillStyle='#4AA0B5';
  ctx.fillRect(W*0.18,W*0.5,W*0.64,W*0.25);
  // Main dome
  ctx.fillStyle='#55C0D8';
  ctx.beginPath(); ctx.arc(W*0.5,W*0.5,W*0.22,Math.PI,0); ctx.fill();
  // Side domes
  ctx.fillStyle='#3A90A8';
  ctx.beginPath(); ctx.arc(W*0.25,W*0.52,W*0.1,Math.PI,0); ctx.fill();
  ctx.beginPath(); ctx.arc(W*0.75,W*0.52,W*0.1,Math.PI,0); ctx.fill();
  // Minarets
  ctx.fillStyle='#3A90A8';
  ctx.fillRect(W*0.1,W*0.38,W*0.08,W*0.37);
  ctx.fillRect(W*0.82,W*0.38,W*0.08,W*0.37);
  // Minaret tops
  ctx.fillStyle='#FFD700';
  ctx.beginPath(); ctx.moveTo(W*0.1,W*0.38); ctx.lineTo(W*0.18,W*0.38); ctx.lineTo(W*0.14,W*0.28); ctx.closePath(); ctx.fill();
  ctx.beginPath(); ctx.moveTo(W*0.82,W*0.38); ctx.lineTo(W*0.90,W*0.38); ctx.lineTo(W*0.86,W*0.28); ctx.closePath(); ctx.fill();
  // Crescent on top
  ctx.fillStyle='#FFD700'; ctx.shadowColor='#FFD700'; ctx.shadowBlur=10;
  ctx.beginPath(); ctx.arc(W*0.5,W*0.28,W*0.05,0,Math.PI*2); ctx.fill();
  ctx.fillStyle='#3A1585'; ctx.shadowBlur=0;
  ctx.beginPath(); ctx.arc(W*0.47,W*0.26,W*0.04,0,Math.PI*2); ctx.fill();
  // Door
  ctx.fillStyle='#1A0050';
  ctx.beginPath(); ctx.arc(W*0.5,W*0.68,W*0.07,Math.PI,0); ctx.fill();
  ctx.fillRect(W*0.43,W*0.68,W*0.14,W*0.07);
  // Windows
  ctx.fillStyle='#FFD700';
  for(let wx of [0.28,0.4,0.6,0.72]){
    ctx.beginPath(); ctx.arc(W*wx,W*0.6,W*0.04,Math.PI,0); ctx.fill();
    ctx.fillRect(W*(wx-0.04),W*0.6,W*0.08,W*0.04);
  }
}

function drawLantern(ctx,W){
  // Background
  let g=ctx.createLinearGradient(0,0,0,W);
  g.addColorStop(0,'#0A1A2F'); g.addColorStop(1,'#1E3A5F');
  ctx.fillStyle=g; ctx.fillRect(0,0,W,W);
  // Stars
  for(let i=0;i<15;i++){
    ctx.fillStyle=`rgba(255,255,200,${Math.random()*0.6+0.2})`;
    ctx.beginPath(); ctx.arc(Math.random()*W,Math.random()*W*0.4,Math.random()*2+0.5,0,Math.PI*2); ctx.fill();
  }
  // Lantern body
  let lg=ctx.createLinearGradient(W*0.3,0,W*0.7,0);
  lg.addColorStop(0,'#E63946'); lg.addColorStop(0.5,'#FF6B6B'); lg.addColorStop(1,'#C1121F');
  ctx.fillStyle=lg;
  ctx.beginPath();
  ctx.moveTo(W*0.38,W*0.3); ctx.lineTo(W*0.62,W*0.3);
  ctx.lineTo(W*0.68,W*0.72); ctx.lineTo(W*0.32,W*0.72);
  ctx.closePath(); ctx.fill();
  // Lantern glow
  let glow=ctx.createRadialGradient(W*0.5,W*0.5,0,W*0.5,W*0.5,W*0.25);
  glow.addColorStop(0,'rgba(255,200,0,0.35)'); glow.addColorStop(1,'rgba(255,200,0,0)');
  ctx.fillStyle=glow; ctx.fillRect(0,0,W,W);
  // Top & bottom caps
  ctx.fillStyle='#FFD700';
  ctx.fillRect(W*0.36,W*0.27,W*0.28,W*0.05);
  ctx.fillRect(W*0.3,W*0.72,W*0.4,W*0.05);
  // String
  ctx.strokeStyle='#FFD700'; ctx.lineWidth=2;
  ctx.beginPath(); ctx.moveTo(W*0.5,W*0.27); ctx.lineTo(W*0.5,W*0.15); ctx.stroke();
  // Hanging base
  ctx.fillStyle='#FFD700';
  ctx.beginPath(); ctx.arc(W*0.5,W*0.77,W*0.05,0,Math.PI*2); ctx.fill();
  // Window patterns
  ctx.strokeStyle='rgba(255,215,0,0.6)'; ctx.lineWidth=1.5;
  ctx.beginPath(); ctx.moveTo(W*0.5,W*0.3); ctx.lineTo(W*0.5,W*0.72); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(W*0.35,W*0.51); ctx.lineTo(W*0.65,W*0.51); ctx.stroke();
  // Inner light
  let innerG=ctx.createRadialGradient(W*0.5,W*0.5,0,W*0.5,W*0.5,W*0.13);
  innerG.addColorStop(0,'rgba(255,240,100,0.9)'); innerG.addColorStop(1,'rgba(255,200,0,0)');
  ctx.fillStyle=innerG; ctx.fillRect(0,0,W,W);
}

function drawDates(ctx,W){
  // Plate bg
  let g=ctx.createLinearGradient(0,0,0,W);
  g.addColorStop(0,'#2D5016'); g.addColorStop(1,'#1A3A0A');
  ctx.fillStyle=g; ctx.fillRect(0,0,W,W);
  // Decorative border
  ctx.strokeStyle='rgba(255,215,0,0.4)'; ctx.lineWidth=4;
  ctx.strokeRect(8,8,W-16,W-16);
  // Plate
  let pg=ctx.createRadialGradient(W*0.5,W*0.55,0,W*0.5,W*0.55,W*0.42);
  pg.addColorStop(0,'#F5DEB3'); pg.addColorStop(1,'#D2A679');
  ctx.fillStyle=pg;
  ctx.beginPath(); ctx.arc(W*0.5,W*0.58,W*0.4,0,Math.PI*2); ctx.fill();
  // Plate rim
  ctx.strokeStyle='#C4922A'; ctx.lineWidth=3;
  ctx.beginPath(); ctx.arc(W*0.5,W*0.58,W*0.4,0,Math.PI*2); ctx.stroke();
  // Dates (kurma)
  const datePositions=[{x:0.5,y:0.5},{x:0.36,y:0.56},{x:0.64,y:0.56},{x:0.43,y:0.68},{x:0.57,y:0.68}];
  for(let dp of datePositions){
    // Date fruit
    let dg=ctx.createLinearGradient(W*(dp.x-0.06),0,W*(dp.x+0.06),0);
    dg.addColorStop(0,'#5D2E0C'); dg.addColorStop(0.5,'#8B4513'); dg.addColorStop(1,'#5D2E0C');
    ctx.fillStyle=dg;
    ctx.beginPath(); ctx.ellipse(W*dp.x,W*dp.y,W*0.07,W*0.05,0.3,0,Math.PI*2); ctx.fill();
    // Shine
    ctx.fillStyle='rgba(255,255,255,0.2)';
    ctx.beginPath(); ctx.ellipse(W*dp.x-W*0.02,W*dp.y-W*0.01,W*0.02,W*0.01,-0.3,0,Math.PI*2); ctx.fill();
    // Tip
    ctx.fillStyle='#3D1A05';
    ctx.beginPath(); ctx.arc(W*(dp.x+0.05*Math.cos(0.3)),W*(dp.y+0.05*Math.sin(0.3)),W*0.012,0,Math.PI*2); ctx.fill();
  }
  // Palm leaves
  ctx.fillStyle='#3A7D1E'; ctx.strokeStyle='#2D6010'; ctx.lineWidth=1;
  for(let i=-2;i<=2;i++){
    ctx.save();
    ctx.translate(W*0.5,W*0.25);
    ctx.rotate(i*0.35);
    ctx.beginPath();
    ctx.moveTo(0,0); ctx.quadraticCurveTo(W*0.06,W*0.1,0,W*0.22);
    ctx.quadraticCurveTo(-W*0.06,W*0.1,0,0);
    ctx.fill(); ctx.stroke();
    ctx.restore();
  }
  // Arabic calligraphy-like label
  ctx.fillStyle='rgba(255,215,0,0.9)';
  ctx.font = `bold ${W*0.07}px Fredoka One, cursive`;
  ctx.textAlign='center';
  ctx.fillText('رمضان كريم', W*0.5, W*0.18);
}

function drawNight(ctx,W){
  // Deep night gradient
  let g=ctx.createLinearGradient(0,0,0,W);
  g.addColorStop(0,'#050A20'); g.addColorStop(0.6,'#0D1A4A'); g.addColorStop(1,'#1A3A6A');
  ctx.fillStyle=g; ctx.fillRect(0,0,W,W);
  // Many stars
  for(let i=0;i<35;i++){
    let sz=Math.random()*2.5+0.5;
    ctx.fillStyle=`rgba(255,255,220,${Math.random()*0.8+0.2})`;
    ctx.beginPath(); ctx.arc(Math.random()*W, Math.random()*W*0.6, sz, 0, Math.PI*2); ctx.fill();
  }
  // Milky way band
  let mw=ctx.createLinearGradient(0,W*0.15,W,W*0.4);
  mw.addColorStop(0,'rgba(150,180,255,0)');
  mw.addColorStop(0.5,'rgba(150,180,255,0.07)');
  mw.addColorStop(1,'rgba(150,180,255,0)');
  ctx.fillStyle=mw; ctx.fillRect(0,0,W,W);
  // Ground/silhouette
  ctx.fillStyle='#05091A';
  ctx.beginPath();
  ctx.moveTo(0,W*0.72);
  ctx.lineTo(W*0.15,W*0.6);
  ctx.lineTo(W*0.2,W*0.62);
  ctx.lineTo(W*0.35,W*0.55);
  ctx.lineTo(W*0.5,W*0.68);
  ctx.lineTo(W*0.65,W*0.58);
  ctx.lineTo(W*0.8,W*0.65);
  ctx.lineTo(W*0.85,W*0.6);
  ctx.lineTo(W,W*0.7);
  ctx.lineTo(W,W); ctx.lineTo(0,W);
  ctx.closePath(); ctx.fill();
  // Mosque silhouette
  ctx.fillStyle='#030710';
  let mx=W*0.5, my=W*0.65;
  ctx.fillRect(mx-W*0.15,my-W*0.15,W*0.3,W*0.15);
  ctx.beginPath(); ctx.arc(mx,my-W*0.15,W*0.1,Math.PI,0); ctx.fill();
  ctx.fillRect(mx-W*0.22,my-W*0.25,W*0.04,W*0.25);
  ctx.fillRect(mx+W*0.18,my-W*0.25,W*0.04,W*0.25);
  // Crescent moon big
  ctx.shadowColor='#FFFAAA'; ctx.shadowBlur=30;
  ctx.fillStyle='#FFFAAA';
  ctx.beginPath(); ctx.arc(W*0.75,W*0.2,W*0.11,0,Math.PI*2); ctx.fill();
  ctx.fillStyle='#050A20'; ctx.shadowBlur=0;
  ctx.beginPath(); ctx.arc(W*0.71,W*0.17,W*0.09,0,Math.PI*2); ctx.fill();
  // Reflection on ground
  let refG=ctx.createLinearGradient(0,W*0.72,0,W);
  refG.addColorStop(0,'rgba(255,250,170,0.08)'); refG.addColorStop(1,'rgba(255,250,170,0)');
  ctx.fillStyle=refG; ctx.fillRect(W*0.55,W*0.72,W*0.3,W*0.28);
}

// ─── Generate stars background ────────────────────────────────────────────
function generateStars(){
  const container=document.getElementById('stars');
  for(let i=0;i<80;i++){
    let s=document.createElement('div');
    s.className='star';
    let sz=Math.random()*3+1;
    s.style.cssText=`width:${sz}px;height:${sz}px;top:${Math.random()*100}%;left:${Math.random()*100}%;animation-delay:${Math.random()*3}s;animation-duration:${1.5+Math.random()*2}s`;
    container.appendChild(s);
  }
}

// ─── Puzzle helpers ───────────────────────────────────────────────────────
function getPSize(){
  const vw=Math.min(window.innerWidth, 500);
  const avail=Math.min(vw-80, CANVAS_SIZE);
  return Math.floor(avail / GRID);
}

function buildRefCanvas(){
  PSIZE=getPSize();
  const rc=document.getElementById('ref-canvas');
  rc.width=PSIZE*GRID; rc.height=PSIZE*GRID;
  const ctx=rc.getContext('2d');
  PUZZLES[currentPuzzleIdx].draw(ctx, PSIZE*GRID);
}

function buildPuzzle(){
  PSIZE=getPSize();
  const totalW=PSIZE*GRID;
  // Draw full image to offscreen
  const off=document.createElement('canvas');
  off.width=totalW; off.height=totalW;
  const oc=off.getContext('2d');
  PUZZLES[currentPuzzleIdx].draw(oc, totalW);
  // Create pieces array [{index, row, col}]
  pieces=[];
  for(let r=0;r<GRID;r++) for(let c=0;c<GRID;c++) pieces.push({target: r*GRID+c, pos: r*GRID+c});
  shufflePieces();
  renderGrid(off);
}

function shufflePieces(){
  for(let i=pieces.length-1;i>0;i--){
    let j=Math.floor(Math.random()*(i+1));
    let tmp=pieces[i].pos; pieces[i].pos=pieces[j].pos; pieces[j].pos=tmp;
  }
  // Ensure not solved
  if(isSolved()) shufflePieces();
  moveCount=0;
  selected=null;
}

function renderGrid(offscreen){
  const grid=document.getElementById('puzzle-grid');
  const totalW=PSIZE*GRID;
  grid.style.gridTemplateColumns=`repeat(${GRID}, ${PSIZE}px)`;
  grid.style.width=`${totalW}px`;
  grid.style.height=`${totalW}px`;
  grid.innerHTML='';
  // Place pieces by their pos (visual slot)
  for(let slot=0;slot<GRID*GRID;slot++){
    // find piece at this slot
    const piece=pieces.find(p=>p.pos===slot);
    const tr=Math.floor(piece.target/GRID), tc=piece.target%GRID;
    const div=document.createElement('div');
    div.className='puzzle-piece';
    div.dataset.target=piece.target;
    div.style.width=PSIZE+'px'; div.style.height=PSIZE+'px';
    const c=document.createElement('canvas');
    c.width=PSIZE; c.height=PSIZE;
    const ctx2=c.getContext('2d');
    ctx2.drawImage(offscreen, tc*PSIZE, tr*PSIZE, PSIZE, PSIZE, 0, 0, PSIZE, PSIZE);
    div.appendChild(c);
    div.addEventListener('click', ()=>clickPiece(piece.target));
    grid.appendChild(div);
  }
}

function getOffscreen(){
  const totalW=PSIZE*GRID;
  const off=document.createElement('canvas');
  off.width=totalW; off.height=totalW;
  PUZZLES[currentPuzzleIdx].draw(off.getContext('2d'), totalW);
  return off;
}

function clickPiece(targetId){
  playClick();
  if(selected===null){
    selected=targetId;
    highlightSelected();
  } else {
    if(selected===targetId){ selected=null; clearSelected(); return; }
    // Swap pos
    const pA=pieces.find(p=>p.target===selected);
    const pB=pieces.find(p=>p.target===targetId);
    let tmp=pA.pos; pA.pos=pB.pos; pB.pos=tmp;
    moveCount++;
    selected=null;
    renderGrid(getOffscreen());
    if(isSolved()) setTimeout(onSolved, 200);
  }
}

function highlightSelected(){
  document.querySelectorAll('.puzzle-piece').forEach(el=>{
    if(parseInt(el.dataset.target)===selected) el.classList.add('selected');
    else el.classList.remove('selected');
  });
}
function clearSelected(){
  document.querySelectorAll('.puzzle-piece').forEach(el=>el.classList.remove('selected'));
}

function isSolved(){
  return pieces.every(p=>p.pos===p.target);
}

function shuffle(){
  shufflePieces();
  renderGrid(getOffscreen());
  playSound('shuffle');
}

function showHint(){
  // Find first misplaced piece
  let wrong=pieces.find(p=>p.pos!==p.target);
  if(!wrong) return;
  // Highlight it
  document.querySelectorAll('.puzzle-piece').forEach(el=>{
    if(parseInt(el.dataset.target)===wrong.target){
      let flash=document.createElement('div');
      flash.className='piece-highlight';
      el.appendChild(flash);
      setTimeout(()=>flash.remove(), 1400);
    }
  });
  playSound('hint');
  score=Math.max(0, score-5);
  updateStats();
}

function nextPuzzle(){
  currentPuzzleIdx=(currentPuzzleIdx+1)%PUZZLES.length;
  document.getElementById('puzzle-name').textContent=PUZZLES[currentPuzzleIdx].name;
  buildRefCanvas();
  buildPuzzle();
  playSound('new');
}

// ─── Win ──────────────────────────────────────────────────────────────────
function onSolved(){
  let points = GRID===2 ? 50 : GRID===3 ? 100 : 200;
  let bonus = Math.max(0, 30 - moveCount) * 2;
  let total = points + bonus;
  score += total;
  if(score > bestScore) bestScore = score;
  solvedCount++;
  updateStats();
  addLeaderboard(total, GRID);

  let stars = moveCount <= GRID*GRID ? '⭐⭐⭐' : moveCount <= GRID*GRID*2 ? '⭐⭐' : '⭐';
  document.getElementById('win-stars').textContent=stars;
  document.getElementById('win-msg').textContent=`Kamu dapat +${total} poin dalam ${moveCount} langkah! Luar biasa! 🎊`;
  document.getElementById('win-overlay').classList.add('show');
  launchConfetti();
  playSound('win');
}

function closeWin(){
  document.getElementById('win-overlay').classList.remove('show');
}

// ─── Leaderboard ──────────────────────────────────────────────────────────
function addLeaderboard(pts, grid){
  let levelName=grid===2?'Mudah':grid===3?'Sedang':'Sulit';
  leaderboard.push({pts, levelName, moves:moveCount});
  leaderboard.sort((a,b)=>b.pts-a.pts);
  leaderboard=leaderboard.slice(0,5);
  renderLeaderboard();
}
function renderLeaderboard(){
  const container=document.getElementById('lb-rows');
  if(leaderboard.length===0){ container.innerHTML='<div class="lb-empty">Belum ada skor. Yuk main!</div>'; return; }
  const medals=['🥇','🥈','🥉','4️⃣','5️⃣'];
  container.innerHTML=leaderboard.map((l,i)=>`
    <div class="lb-row">
      <span class="lb-rank">${medals[i]}</span>
      <span>+${l.pts} poin (${l.levelName})</span>
      <span style="color:rgba(255,255,255,0.5);font-size:0.75rem">${l.moves} langkah</span>
    </div>`).join('');
}

function updateStats(){
  document.getElementById('score-display').textContent=score;
  document.getElementById('best-display').textContent=bestScore;
  document.getElementById('solved-display').textContent=solvedCount;
}

// ─── Level ────────────────────────────────────────────────────────────────
function setLevel(n, cls){
  GRID=n;
  ['easy','medium','hard'].forEach(c=>document.getElementById('btn-'+c).classList.remove('active'));
  document.getElementById('btn-'+cls).classList.add('active');
  buildRefCanvas();
  buildPuzzle();
  playSound('new');
}

// ─── Confetti ─────────────────────────────────────────────────────────────
function launchConfetti(){
  const colors=['#FFD700','#FF6B9D','#00B4A6','#A855F7','#FF9800','#4CAF50'];
  for(let i=0;i<60;i++){
    setTimeout(()=>{
      const el=document.createElement('div');
      el.className='confetti-piece';
      el.style.cssText=`left:${Math.random()*100}vw;background:${colors[Math.floor(Math.random()*colors.length)]};width:${6+Math.random()*8}px;height:${6+Math.random()*8}px;animation-duration:${1.5+Math.random()*2}s;animation-delay:${Math.random()*0.5}s;border-radius:${Math.random()>0.5?'50%':'2px'}`;
      document.body.appendChild(el);
      setTimeout(()=>el.remove(), 3000);
    }, i*30);
  }
}

// ─── Sound (Web Audio API) ────────────────────────────────────────────────
let audioCtx=null;
function getAudio(){ if(!audioCtx) audioCtx=new (window.AudioContext||window.webkitAudioContext)(); return audioCtx; }

function playClick(){
  try{
    const ac=getAudio();
    const o=ac.createOscillator(); const g=ac.createGain();
    o.connect(g); g.connect(ac.destination);
    o.type='sine'; o.frequency.setValueAtTime(600,ac.currentTime); o.frequency.exponentialRampToValueAtTime(800,ac.currentTime+0.07);
    g.gain.setValueAtTime(0.15,ac.currentTime); g.gain.exponentialRampToValueAtTime(0.001,ac.currentTime+0.12);
    o.start(); o.stop(ac.currentTime+0.12);
  }catch(e){}
}

function playSound(type){
  try{
    const ac=getAudio();
    if(type==='win'){
      [523,659,784,1047].forEach((f,i)=>{
        const o=ac.createOscillator(); const g=ac.createGain();
        o.connect(g); g.connect(ac.destination);
        o.type='sine'; o.frequency.value=f;
        g.gain.setValueAtTime(0.2,ac.currentTime+i*0.12);
        g.gain.exponentialRampToValueAtTime(0.001,ac.currentTime+i*0.12+0.3);
        o.start(ac.currentTime+i*0.12); o.stop(ac.currentTime+i*0.12+0.3);
      });
    } else if(type==='hint'){
      const o=ac.createOscillator(); const g=ac.createGain();
      o.connect(g); g.connect(ac.destination);
      o.type='triangle'; o.frequency.value=440;
      g.gain.setValueAtTime(0.1,ac.currentTime); g.gain.exponentialRampToValueAtTime(0.001,ac.currentTime+0.3);
      o.start(); o.stop(ac.currentTime+0.3);
    } else if(type==='shuffle'||type==='new'){
      for(let i=0;i<5;i++){
        const o=ac.createOscillator(); const g=ac.createGain();
        o.connect(g); g.connect(ac.destination);
        o.type='sine'; o.frequency.value=300+Math.random()*400;
        g.gain.setValueAtTime(0.05,ac.currentTime+i*0.04);
        g.gain.exponentialRampToValueAtTime(0.001,ac.currentTime+i*0.04+0.08);
        o.start(ac.currentTime+i*0.04); o.stop(ac.currentTime+i*0.04+0.08);
      }
    }
  }catch(e){}
}

// ─── Init ─────────────────────────────────────────────────────────────────
generateStars();
buildRefCanvas();
buildPuzzle();
document.getElementById('puzzle-name').textContent=PUZZLES[currentPuzzleIdx].name;
renderLeaderboard();

window.addEventListener('resize', ()=>{
  buildRefCanvas();
  const off=getOffscreen();
  renderGrid(off);
});
</script>
</body>
</html>