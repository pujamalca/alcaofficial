<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🪜 Tangga Cinta Ramadhan - Ngabuburit Harmonis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap');

        :root {
            --primary-gold: #D4AF37;
            --gold-light: #F4E4A6;
            --emerald-green: #10B981;
            --emerald-dark: #047857;
            --cream: #FFF8E7;
            --night-bg: #1a0a2e;
            --night-dark: #0d061a;
            --purple-deep: #16213e;
            --shadow-gold: rgba(212, 175, 55, 0.3);
            --suami-color: #3B82F6;
            --istri-color: #EC4899;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(180deg, var(--night-bg) 0%, var(--purple-deep) 50%, var(--night-dark) 100%);
            min-height: 100vh;
            color: var(--cream);
            overflow-x: hidden;
            position: relative;
        }

        .stars-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s infinite ease-in-out;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.3); }
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px 0;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 50px;
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(212, 175, 55, 0.3);
            transform: translateX(-5px);
        }

        .header h1 {
            font-family: 'Amiri', serif;
            font-size: clamp(1.3rem, 4vw, 1.8rem);
            color: var(--primary-gold);
            text-shadow: 0 0 20px var(--shadow-gold);
            text-align: center;
        }

        .audio-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-light));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .audio-btn:hover {
            transform: scale(1.1);
        }

        /* Instructions */
        .instructions {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 15px;
            padding: 15px;
            margin: 15px 0;
        }

        .instructions h3 {
            font-family: 'Amiri', serif;
            color: var(--primary-gold);
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .instructions ol {
            margin-left: 20px;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            font-size: 0.85rem;
        }

        /* Level Selection */
        .level-select {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 15px 0;
        }

        .level-btn {
            padding: 10px 20px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .level-btn.active {
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            border-color: var(--emerald-green);
        }

        /* Game Area */
        .game-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            margin: 15px 0;
            font-size: 0.9rem;
        }

        .turn-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .turn-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .turn-dot.suami { background: var(--suami-color); }
        .turn-dot.istri { background: var(--istri-color); }

        /* Board */
        .board-wrapper {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 15px;
            margin: 15px 0;
        }

        .board {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 2px;
            aspect-ratio: 1;
        }

        .cell {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(212, 175, 55, 0.15);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 45px;
            font-size: 0.8rem;
        }

        .cell.ladder {
            background: rgba(16, 185, 129, 0.25);
            border-color: var(--emerald-green);
        }

        .cell.snake {
            background: rgba(239, 68, 68, 0.25);
            border-color: #EF4444;
        }

        .cell.special {
            background: rgba(212, 175, 55, 0.2);
            border-color: var(--primary-gold);
        }

        .cell.start {
            background: rgba(59, 130, 246, 0.2);
        }

        .cell.finish {
            background: rgba(212, 175, 55, 0.3);
            border-color: var(--primary-gold);
        }

        .cell-number {
            font-size: 0.65rem;
            opacity: 0.7;
        }

        .cell-icon {
            font-size: 1.2rem;
            line-height: 1;
        }

        .player-marker {
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        .player-marker.suami {
            background: var(--suami-color);
            bottom: 2px;
            left: 2px;
        }

        .player-marker.istri {
            background: var(--istri-color);
            bottom: 2px;
            right: 2px;
        }

        /* Dice Area */
        .dice-area {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            margin: 15px 0;
        }

        .dice {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--night-bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .dice.rolling {
            animation: diceRoll 0.5s ease-out;
        }

        @keyframes diceRoll {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg) scale(1.1); }
            75% { transform: rotate(15deg) scale(1.1); }
        }

        .roll-btn {
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .roll-btn:hover:not(:disabled) {
            transform: scale(1.05);
        }

        .roll-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, var(--purple-deep), var(--night-bg));
            border: 2px solid var(--primary-gold);
            border-radius: 20px;
            padding: 25px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .modal-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .modal-title {
            font-family: 'Amiri', serif;
            font-size: 1.3rem;
            color: var(--primary-gold);
            margin-bottom: 15px;
        }

        .modal-text {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal-btn {
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
        }

        /* Control Buttons */
        .control-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .control-btn {
            padding: 10px 20px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .control-btn:hover {
            background: rgba(212, 175, 55, 0.15);
        }

        /* Win Screen */
        .win-screen {
            display: none;
            text-align: center;
            padding: 30px 20px;
        }

        .win-screen.active {
            display: block;
        }

        .win-card {
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid var(--primary-gold);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .win-trophy {
            font-size: 4rem;
        }

        .win-title {
            font-family: 'Amiri', serif;
            font-size: 1.5rem;
            color: var(--primary-gold);
            margin: 15px 0;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .cell {
                min-height: 35px;
                font-size: 0.7rem;
            }

            .cell-icon {
                font-size: 1rem;
            }

            .player-marker {
                width: 14px;
                height: 14px;
            }

            .dice {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="stars-background" id="starsBackground"></div>

    <div class="container">
        <header class="header">
            <a href="/Ngabuburit-harmonis" class="back-btn">← Kembali</a>
            <h1>🪜 Tangga Cinta Ramadhan</h1>
            <button class="audio-btn" id="audioToggle">🔇</button>
        </header>

        <div class="instructions">
            <h3>📖 Cara Bermain</h3>
            <ol>
                <li>Lempar dadu untuk menggerakkan bidak</li>
                <li>Naiki tangga 🪜 untuk maju cepat</li>
                <li>Hindari ular 🐍 atau turun posisi</li>
                <li>Selesaikan tantangan di kotak spesial</li>
                <li>Pemain pertama sampai kotak 64 menang!</li>
            </ol>
            <div class="legend">
                <span>🔵 Suami</span>
                <span>🩷 Istri</span>
                <span>🪜 Tangga</span>
                <span>🐍 Ular</span>
                <span>❤️ Romantis</span>
                <span>📖 Fiqih</span>
                <span>🌙 Pahala</span>
            </div>
        </div>

        <div class="level-select">
            <button class="level-btn active" data-level="mudah" onclick="selectLevel('mudah')">Mudah</button>
            <button class="level-btn" data-level="sedang" onclick="selectLevel('sedang')">Sedang</button>
            <button class="level-btn" data-level="sulit" onclick="selectLevel('sulit')">Sulit</button>
        </div>

        <div class="game-info" id="gameInfo">
            <div class="turn-indicator">
                <span class="turn-dot suami" id="turnDot"></span>
                <span id="turnText">Giliran: Suami</span>
            </div>
            <div>🏆 High Score: <span id="highScoreDisplay">-</span></div>
        </div>

        <div class="board-wrapper">
            <div class="board" id="board">
                <!-- Board generated by JS -->
            </div>
        </div>

        <div class="dice-area">
            <div class="dice" id="dice">🎲</div>
            <button class="roll-btn" id="rollBtn" onclick="rollDice()">Lempar Dadu</button>
        </div>

        <div class="control-buttons">
            <button class="control-btn" onclick="saveProgressManually()">💾 Simpan</button>
            <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
        </div>

        <!-- Win Screen -->
        <div class="win-screen" id="winScreen">
            <div class="win-card">
                <div class="win-trophy">🏆</div>
                <h2 class="win-title" id="winTitle">Selamat!</h2>
                <p id="winMessage"></p>
            </div>
            <div class="control-buttons">
                <button class="roll-btn" onclick="resetGame()">🔄 Main Lagi</button>
                <button class="control-btn" onclick="goHome()">🏠 Menu</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div class="modal-icon" id="modalIcon">❤️</div>
            <h3 class="modal-title" id="modalTitle">Tantangan!</h3>
            <p class="modal-text" id="modalText"></p>
            <button class="modal-btn" onclick="closeModal()">Lanjutkan</button>
        </div>
    </div>

    <script>
        // Game State
        let currentPlayer = 'suami';
        let positions = { suami: 1, istri: 1 };
        let currentLevel = 'mudah';
        let totalMoves = 0;
        let gameActive = true;
        let audioEnabled = false;
        let highScore = localStorage.getItem('tangga_cinta_highscore') || null;
        let audioCtx = null;

        // Ladder and Snake configurations
        const levelConfig = {
            mudah: {
                ladders: { 3: 15, 8: 26, 20: 38, 28: 45, 40: 55, 50: 62 },
                snakes: { 25: 5, 35: 15, 48: 30 }
            },
            sedang: {
                ladders: { 4: 18, 15: 32, 27: 46, 42: 58 },
                snakes: { 18: 6, 30: 12, 38: 20, 44: 22, 52: 35, 60: 40 }
            },
            sulit: {
                ladders: { 5: 20, 25: 44, 47: 60 },
                snakes: { 12: 3, 22: 8, 33: 15, 38: 25, 45: 30, 54: 35, 58: 42, 62: 45 }
            }
        };

        // Special squares
        const specialSquares = {
            7: { icon: '❤️', text: 'Bilang "Aku cinta kamu" ke pasangan!' },
            14: { icon: '📖', text: 'Sebutkan satu sunnah puasa!' },
            21: { icon: '🌙', text: 'Shalawat kepada Nabi Muhammad SAW 3x.' },
            31: { icon: '💕', text: 'Puji satu kebaikan pasanganmu.' },
            37: { icon: '📖', text: 'Apa hukum mencium istri saat puasa (bisa tahan)?' },
            43: { icon: '🌙', text: 'Bacalah Al-Fatihah untuk orang tua.' },
            51: { icon: '💑', text: 'Peluk pasangan atau doakan kebaikan.' },
            56: { icon: '📖', text: 'Sebutkan 3 hal yang membatalkan puasa!' },
            61: { icon: '🌙', text: 'Doakan agar puasa kita diterima.' }
        };

        // Initialize
        function initStars() {
            const container = document.getElementById('starsBackground');
            for (let i = 0; i < 60; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.cssText = 'left:' + Math.random() * 100 + '%;top:' + Math.random() * 100 + '%;width:' + (Math.random() * 2 + 1) + 'px;height:' + star.style.width + ';animation-delay:' + Math.random() * 4 + 's';
                container.appendChild(star);
            }
        }

        // Audio
        function initAudio() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
        }

        function playDiceSound() {
            if (!audioEnabled) return;
            initAudio();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.frequency.setValueAtTime(300, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(500, audioCtx.currentTime + 0.1);
            gain.gain.setValueAtTime(0.15, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.15);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.15);
        }

        function playLadderSound() {
            if (!audioEnabled) return;
            initAudio();
            [523, 659, 784].forEach((freq, i) => {
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.frequency.value = freq;
                gain.gain.setValueAtTime(0.08, audioCtx.currentTime + i * 0.08);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + i * 0.08 + 0.25);
                osc.start(audioCtx.currentTime + i * 0.08);
                osc.stop(audioCtx.currentTime + i * 0.08 + 0.25);
            });
        }

        function playSnakeSound() {
            if (!audioEnabled) return;
            initAudio();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.frequency.setValueAtTime(350, audioCtx.currentTime);
            osc.frequency.linearRampToValueAtTime(150, audioCtx.currentTime + 0.3);
            gain.gain.setValueAtTime(0.15, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.3);
        }

        document.getElementById('audioToggle').addEventListener('click', function() {
            initAudio();
            audioEnabled = !audioEnabled;
            if (audioEnabled && audioCtx.state === 'suspended') audioCtx.resume();
            this.textContent = audioEnabled ? '🔊' : '🔇';
        });

        // Level selection
        function selectLevel(level) {
            if (totalMoves > 0 && !confirm('Ganti level akan mereset permainan. Lanjutkan?')) return;
            currentLevel = level;
            document.querySelectorAll('.level-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.level === level);
            });
            resetGame();
        }

        // Create board - FIXED
        function createBoard() {
            const board = document.getElementById('board');
            board.innerHTML = '';
            const config = levelConfig[currentLevel];

            // Create 8x8 grid, numbered from bottom-left (1) to top-left moving in snake pattern
            // Grid row 0 = top (64), row 7 = bottom (1)
            const boardLayout = [];
            for (let row = 0; row < 8; row++) {
                boardLayout[row] = [];
                const isEvenRow = (7 - row) % 2 === 0;
                for (let col = 0; col < 8; col++) {
                    const actualCol = isEvenRow ? col : (7 - col);
                    const num = (7 - row) * 8 + actualCol + 1;
                    boardLayout[row][col] = num;
                }
            }

            // Render cells
            for (let row = 0; row < 8; row++) {
                for (let col = 0; col < 8; col++) {
                    const num = boardLayout[row][col];
                    const cell = document.createElement('div');
                    cell.className = 'cell';
                    cell.id = 'cell-' + num;
                    cell.dataset.number = num;

                    // Check cell type
                    const isLadderStart = config.ladders[num] !== undefined;
                    const isLadderEnd = Object.values(config.ladders).includes(num);
                    const isSnakeStart = config.snakes[num] !== undefined;
                    const isSnakeEnd = Object.values(config.snakes).includes(num);
                    const isSpecial = specialSquares[num] !== undefined;

                    if (num === 1) {
                        cell.classList.add('start');
                        cell.innerHTML = '<span class="cell-icon">🔵</span>';
                    } else if (num === 64) {
                        cell.classList.add('finish');
                        cell.innerHTML = '<span class="cell-icon">🏆</span>';
                    } else if (isLadderStart) {
                        cell.classList.add('ladder');
                        cell.innerHTML = '<span class="cell-number">' + num + '</span><span class="cell-icon">🪜</span>';
                        cell.title = 'Naik ke ' + config.ladders[num];
                    } else if (isLadderEnd) {
                        cell.classList.add('ladder');
                        cell.innerHTML = '<span class="cell-number">' + num + '</span><span class="cell-icon">⬆️</span>';
                    } else if (isSnakeStart) {
                        cell.classList.add('snake');
                        cell.innerHTML = '<span class="cell-number">' + num + '</span><span class="cell-icon">🐍</span>';
                        cell.title = 'Turun ke ' + config.snakes[num];
                    } else if (isSnakeEnd) {
                        cell.classList.add('snake');
                        cell.innerHTML = '<span class="cell-number">' + num + '</span><span class="cell-icon">⬇️</span>';
                    } else if (isSpecial) {
                        cell.classList.add('special');
                        cell.innerHTML = '<span class="cell-number">' + num + '</span><span class="cell-icon">' + specialSquares[num].icon + '</span>';
                        cell.title = specialSquares[num].text;
                    } else {
                        cell.innerHTML = '<span class="cell-number">' + num + '</span>';
                    }

                    board.appendChild(cell);
                }
            }

            updatePlayerMarkers();
        }

        // Update player markers
        function updatePlayerMarkers() {
            // Remove old markers
            document.querySelectorAll('.player-marker').forEach(m => m.remove());

            // Add new markers
            ['suami', 'istri'].forEach(player => {
                const cell = document.getElementById('cell-' + positions[player]);
                if (cell) {
                    const marker = document.createElement('div');
                    marker.className = 'player-marker ' + player;
                    cell.appendChild(marker);
                }
            });
        }

        // Roll dice
        function rollDice() {
            if (!gameActive) return;

            const dice = document.getElementById('dice');
            const rollBtn = document.getElementById('rollBtn');
            rollBtn.disabled = true;
            dice.classList.add('rolling');
            playDiceSound();

            let rolls = 0;
            const rollInterval = setInterval(() => {
                dice.textContent = Math.floor(Math.random() * 6) + 1;
                rolls++;
                if (rolls >= 10) {
                    clearInterval(rollInterval);
                    const result = Math.floor(Math.random() * 6) + 1;
                    dice.textContent = result;
                    dice.classList.remove('rolling');
                    movePlayer(result);
                }
            }, 50);
        }

        // Move player
        function movePlayer(steps) {
            const player = currentPlayer;
            let newPos = positions[player] + steps;

            if (newPos > 64) {
                newPos = positions[player];
            }

            positions[player] = newPos;
            totalMoves++;
            updatePlayerMarkers();

            setTimeout(() => {
                const config = levelConfig[currentLevel];
                let moved = false;

                if (config.ladders[newPos]) {
                    positions[player] = config.ladders[newPos];
                    playLadderSound();
                    moved = true;
                    showToast('🪜 Naik tangga!', 'green');
                } else if (config.snakes[newPos]) {
                    positions[player] = config.snakes[newPos];
                    playSnakeSound();
                    moved = true;
                    showToast('🐍 Turun ular!', 'red');
                }

                updatePlayerMarkers();

                if (specialSquares[positions[player]] && !moved) {
                    setTimeout(() => showModal(positions[player]), 400);
                } else {
                    setTimeout(() => checkWin(), moved ? 500 : 200);
                }

                saveProgress();
            }, 400);
        }

        // Show toast
        function showToast(text, color) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed; top: 80px; left: 50%; transform: translateX(-50%);
                background: ${color === 'green' ? 'rgba(16, 185, 129, 0.9)' : 'rgba(239, 68, 68, 0.9)'};
                color: white; padding: 10px 20px; border-radius: 25px;
                font-weight: 600; z-index: 200; animation: fadeInOut 1.5s forwards;
            `;
            toast.textContent = text;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 1500);
        }

        // Show modal
        function showModal(pos) {
            const special = specialSquares[pos];
            document.getElementById('modalIcon').textContent = special.icon;
            document.getElementById('modalTitle').textContent = 'Tantangan!';
            document.getElementById('modalText').textContent = special.text;
            document.getElementById('modalOverlay').classList.add('active');
        }

        // Close modal
        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('active');
            checkWin();
        }

        // Check win
        function checkWin() {
            if (positions[currentPlayer] >= 64) {
                gameActive = false;
                showWinScreen();
                return;
            }

            currentPlayer = currentPlayer === 'suami' ? 'istri' : 'suami';
            updateTurnIndicator();
            document.getElementById('rollBtn').disabled = false;
        }

        // Update turn indicator
        function updateTurnIndicator() {
            const turnDot = document.getElementById('turnDot');
            const turnText = document.getElementById('turnText');
            turnDot.className = 'turn-dot ' + currentPlayer;
            turnText.textContent = 'Giliran: ' + (currentPlayer === 'suami' ? 'Suami' : 'Istri');
        }

        // Show win screen
        function showWinScreen() {
            document.getElementById('gameInfo').classList.add('hidden');
            document.querySelector('.board-wrapper').classList.add('hidden');
            document.querySelector('.dice-area').classList.add('hidden');
            document.querySelector('.control-buttons').classList.add('hidden');
            document.getElementById('winScreen').classList.add('active');

            const winner = currentPlayer === 'suami' ? 'Suami' : 'Istri';
            document.getElementById('winTitle').textContent = '🎉 ' + winner + ' Menang!';
            document.getElementById('winMessage').textContent =
                `${winner} berhasil mencapai rumah dengan ${totalMoves} langkah. Semoga Ramadhan penuh keberkahan!`;

            if (!highScore || totalMoves < parseInt(highScore)) {
                highScore = totalMoves;
                localStorage.setItem('tangga_cinta_highscore', highScore);
                document.getElementById('winMessage').textContent += ' 🏆 Rekor baru!';
            }

            clearProgress();
        }

        // Save/Load
        function saveProgress() {
            localStorage.setItem('tangga_cinta_progress', JSON.stringify({
                positions, currentPlayer, totalMoves, level: currentLevel
            }));
        }

        function loadProgress() {
            const saved = localStorage.getItem('tangga_cinta_progress');
            if (saved) {
                const state = JSON.parse(saved);
                positions = state.positions;
                currentPlayer = state.currentPlayer;
                totalMoves = state.totalMoves;
                currentLevel = state.level || 'mudah';
                document.querySelectorAll('.level-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.level === currentLevel);
                });
                return true;
            }
            return false;
        }

        function clearProgress() {
            localStorage.removeItem('tangga_cinta_progress');
        }

        function saveProgressManually() {
            saveProgress();
            alert('✅ Progress tersimpan!');
        }

        // Reset
        function resetGame() {
            if (totalMoves > 5 && !confirm('Yakin ingin mereset?')) return;

            positions = { suami: 1, istri: 1 };
            currentPlayer = 'suami';
            totalMoves = 0;
            gameActive = true;

            document.getElementById('gameInfo').classList.remove('hidden');
            document.querySelector('.board-wrapper').classList.remove('hidden');
            document.querySelector('.dice-area').classList.remove('hidden');
            document.querySelector('.control-buttons').classList.remove('hidden');
            document.getElementById('winScreen').classList.remove('active');
            document.getElementById('rollBtn').disabled = false;

            clearProgress();
            createBoard();
            updateTurnIndicator();
        }

        function goHome() {
            window.location.href = '/Ngabuburit-harmonis';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initStars();
            document.getElementById('highScoreDisplay').textContent = highScore || '-';

            if (loadProgress()) {
                createBoard();
                updateTurnIndicator();
            } else {
                createBoard();
                updateTurnIndicator();
            }

            // Add toast animation
            const style = document.createElement('style');
            style.textContent = `@keyframes fadeInOut { 0% { opacity: 0; transform: translateX(-50%) translateY(-10px); } 20% { opacity: 1; transform: translateX(-50%) translateY(0); } 80% { opacity: 1; } 100% { opacity: 0; } }`;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
