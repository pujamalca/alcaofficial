<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎲 Ludo Harmoni - Ngabuburit Harmonis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #D4AF37;
            --green: #10B981;
            --yellow: #F59E0B;
            --white: #FFFFFF;
            --black: #000000;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #1a0a2e 0%, #2d1b4e 100%);
            min-height: 100vh;
            color: #FFF8E7;
            padding: 10px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        .back-btn {
            display: inline-block;
            padding: 8px 15px;
            background: #8B6914;
            border-radius: 20px;
            color: var(--gold);
            text-decoration: none;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .header {
            text-align: center;
            padding: 10px;
        }

        .header h1 {
            font-family: 'Amiri', serif;
            font-size: 1.2rem;
            color: var(--gold);
        }

        .mode-toggle {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .mode-btn {
            padding: 8px 15px;
            border: 2px solid #8B6914;
            border-radius: 15px;
            background: #2a2a4a;
            color: #FFF8E7;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .mode-btn:hover {
            background: #3a3a5a;
        }

        .mode-btn.active {
            background: var(--gold);
            color: #1a0a2e;
        }

        .instructions {
            background: #2a2a4a;
            border-radius: 10px;
            padding: 12px;
            margin: 10px 0;
            font-size: 0.85rem;
            border: 1px solid #8B6914;
        }

        .instructions h3 {
            color: var(--gold);
            margin-bottom: 8px;
        }

        .instructions ol {
            padding-left: 20px;
            line-height: 1.6;
        }

        .players {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 10px 0;
        }

        .player-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border-radius: 15px;
            background: #2a2a4a;
            border: 2px solid transparent;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .player-card.active {
            border-color: var(--gold);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }

        .player-badge {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: 3px solid var(--white);
        }

        .player-badge.green { background: var(--green); }
        .player-badge.yellow { background: var(--yellow); }

        /* Ludo Board Container */
        .ludo-container {
            background: #2a2a4a;
            border-radius: 15px;
            padding: 10px;
            margin: 15px 0;
            border: 3px solid var(--gold);
        }

        /* CSS Grid 15x15 Ludo Board */
        .ludo-board {
            display: grid;
            grid-template-columns: repeat(15, 1fr);
            grid-template-rows: repeat(15, 1fr);
            gap: 1px;
            aspect-ratio: 1;
            background: var(--black);
            border-radius: 5px;
            overflow: hidden;
        }

        /* Home Bases - 6x6 each corner */
        .home-base {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 4px;
            padding: 8px;
            place-content: center;
        }

        .home-base.green { 
            background: var(--green);
            grid-column: 1 / span 6;
            grid-row: 10 / span 6;
        }
        .home-base.yellow { 
            background: var(--yellow);
            grid-column: 10 / span 6;
            grid-row: 10 / span 6;
        }

        /* Inactive bases (top corners - visual only, dimmed) */
        .home-base.inactive-top-left {
            background: #4a4a4a;
            grid-column: 1 / span 6;
            grid-row: 1 / span 6;
        }
        .home-base.inactive-top-right {
            background: #4a4a4a;
            grid-column: 10 / span 6;
            grid-row: 1 / span 6;
        }

        .home-slot {
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Path Cells */
        .cell {
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 0;
            font-size: 10px;
        }

        .cell.safe::after {
            content: '★';
            position: absolute;
            font-size: 8px;
            color: #888;
        }

        /* Colored home stretches */
        .cell.green-path { background: #34D399; }
        .cell.yellow-path { background: #FBBF24; }

        /* Start positions */
        .cell.start-green { background: var(--green); }
        .cell.start-yellow { background: var(--yellow); }

        /* Center Home */
        .center-home {
            background: linear-gradient(135deg, var(--gold) 0%, #B8860B 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            border-radius: 50%;
        }

        /* Pieces */
        .piece {
            width: 70%;
            height: 70%;
            border-radius: 50%;
            border: 2px solid var(--white);
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
            position: absolute;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .piece.green { background: var(--green); }
        .piece.yellow { background: var(--yellow); }

        .piece.captured {
            animation: captureFlash 0.5s ease;
        }

        @keyframes captureFlash {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.3); box-shadow: 0 0 20px red; }
        }

        /* Multiple pieces on same cell */
        .cell .piece:nth-child(1) { transform: translate(-25%, -25%); }
        .cell .piece:nth-child(2) { transform: translate(25%, -25%); }
        .cell .piece:nth-child(3) { transform: translate(-25%, 25%); }
        .cell .piece:nth-child(4) { transform: translate(25%, 25%); }

        /* Home slot pieces */
        .home-slot .piece {
            position: relative;
            transform: none !important;
            width: 60%;
            height: 60%;
        }

        /* Center home pieces */
        .center-home .piece {
            position: relative;
            transform: none !important;
            width: 25%;
            height: 25%;
            margin: 2px;
        }

        /* Controls */
        .controls {
            text-align: center;
            padding: 15px;
        }

        .dice-area {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .dice {
            width: 60px;
            height: 60px;
            background: var(--white);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            cursor: pointer;
            border: 3px solid var(--gold);
            color: #1a0a2e;
            transition: transform 0.1s;
        }

        .dice:hover {
            transform: scale(1.05);
        }

        .dice.rolling {
            animation: shake 0.4s ease infinite;
        }

        @keyframes shake {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            75% { transform: rotate(15deg); }
        }

        .roll-btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            background: var(--green);
            color: var(--white);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .roll-btn:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .roll-btn:disabled {
            background: #666;
            cursor: not-allowed;
        }

        .game-status {
            background: #2a2a4a;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
            font-size: 0.9rem;
            text-align: center;
            border: 1px solid #8B6914;
        }

        .game-status .highlight {
            color: var(--gold);
            font-weight: 700;
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .action-btn {
            padding: 8px 15px;
            border: 1px solid #8B6914;
            border-radius: 15px;
            background: #2a2a4a;
            color: #FFF8E7;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background: #3a3a5a;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, #16213e 0%, #1a1a3e 100%);
            border: 2px solid var(--gold);
            border-radius: 20px;
            padding: 25px;
            max-width: 350px;
            text-align: center;
            animation: modalIn 0.3s ease;
        }

        @keyframes modalIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-title {
            font-family: 'Amiri', serif;
            color: var(--gold);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .modal-text {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal-btn {
            padding: 10px 25px;
            border: none;
            border-radius: 20px;
            background: var(--green);
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .modal-btn:hover {
            transform: scale(1.05);
        }

        .audio-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gold);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            z-index: 50;
            transition: all 0.2s;
        }

        .audio-toggle:hover {
            transform: scale(1.1);
        }

        /* Capture notification */
        .capture-msg {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #EF4444;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 700;
            z-index: 200;
            animation: slideDown 0.3s ease, fadeOut 0.5s ease 1.5s forwards;
        }

        @keyframes slideDown {
            from { top: -50px; opacity: 0; }
            to { top: 20px; opacity: 1; }
        }

        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(-50%) translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/Ngabuburit-harmonis" class="back-btn">← Kembali</a>

        <div class="header">
            <h1>🎲 Ludo Harmoni Rumah Tangga</h1>
        </div>

        <div class="mode-toggle">
            <button class="mode-btn active" id="modeSantai" onclick="Game.setMode('santai')">😊 Santai</button>
            <button class="mode-btn" id="modeSerius" onclick="Game.setMode('serius')">📖 Serius</button>
        </div>

        <div class="instructions">
            <h3>📖 Cara Bermain:</h3>
            <ol>
                <li>Lempar <strong>dadu 6</strong> untuk keluarkan bidak</li>
                <li>Dapat 6 = <strong>lempar lagi</strong>!</li>
                <li>Mendarat di bidak lawan = <strong>kembali ke base</strong>!</li>
                <li>★ = zona aman (tidak bisa ditangkap)</li>
                <li>Masukkan 4 bidak ke rumah untuk menang</li>
            </ol>
        </div>

        <div class="players">
            <div class="player-card active" id="cardSuami">
                <div class="player-badge green">🤍</div>
                <div>
                    <div style="font-weight: 700;">Suami</div>
                    <div style="font-size: 0.75rem;">Main: <span id="suamiPlaying">0</span> | Rumah: <span id="suamiHome">0</span></div>
                </div>
            </div>
            <div class="player-card" id="cardIstri">
                <div class="player-badge yellow">💕</div>
                <div>
                    <div style="font-weight: 700;">Istri</div>
                    <div style="font-size: 0.75rem;">Main: <span id="istriPlaying">0</span> | Rumah: <span id="istriHome">0</span></div>
                </div>
            </div>
        </div>

        <div class="ludo-container">
            <div class="ludo-board" id="ludoBoard">
                <!-- Board will be generated by JavaScript -->
            </div>
        </div>

        <div class="controls">
            <div class="dice-area">
                <div class="dice" id="dice" onclick="Game.rollDice()">🎲</div>
                <button class="roll-btn" id="rollBtn" onclick="Game.rollDice()">Lempar Dadu</button>
            </div>

            <div class="game-status" id="gameStatus">
                Giliran: <strong id="turnText">Suami</strong> |
                Hasil: <span id="diceResult">-</span>
            </div>

            <div class="action-btns">
                <button class="action-btn" onclick="Game.reset()">🔄 Reset</button>
                <button class="action-btn" onclick="Game.save()">💾 Simpan</button>
            </div>
        </div>
    </div>

    <button class="audio-toggle" id="audioBtn" onclick="Game.toggleAudio()">🔇</button>

    <div class="modal" id="modal">
        <div class="modal-content">
            <h3 class="modal-title" id="modalTitle">Tantangan!</h3>
            <p class="modal-text" id="modalText"></p>
            <button class="modal-btn" onclick="Game.closeModal()">Lanjutkan</button>
        </div>
    </div>

    <script>
        const Game = {
            mode: 'santai',
            turn: 'suami',
            diceValue: 0,
            canRoll: true,
            audioEnabled: false,

            // Piece positions: 0 = home base, 1-52 = main path, 53-57 = home stretch, 100 = finished
            green: [0, 0, 0, 0],
            yellow: [0, 0, 0, 0],

            // Board layout using 1-indexed grid positions
            // Standard Ludo 15x15 with cross-shaped path

            // Main path: 52 cells going counter-clockwise
            // Green starts at bottom-left, Yellow at bottom-right
            // Grid: row (1-15), col (1-15)
            
            // Path definition: each cell has {r, c, type}
            // type: 'normal', 'start-green', 'start-yellow', 'safe'
            
            mainPath: [], // Will be built from pathCoords
            
            // Raw path coordinates (52 cells) - built from cross pattern
            pathCoords: [
                // BOTTOM ARM - going left to right (row 14)
                {r: 14, c: 2}, {r: 14, c: 3}, {r: 14, c: 4}, {r: 14, c: 5}, {r: 14, c: 6}, // 0-4
                {r: 14, c: 7}, // 5 - corner before going up
                // LEFT ARM - going up (col 7)
                {r: 13, c: 7}, {r: 12, c: 7}, {r: 11, c: 7}, {r: 10, c: 7}, {r: 9, c: 7}, // 6-10
                // LEFT ARM - top corner going right (row 7)
                {r: 7, c: 7}, // 11 - left side of center
                {r: 7, c: 6}, {r: 7, c: 5}, {r: 7, c: 4}, {r: 7, c: 3}, {r: 7, c: 2}, // 12-16
                // TOP ARM - going up (col 2) then right
                {r: 6, c: 2}, {r: 5, c: 2}, {r: 4, c: 2}, {r: 3, c: 2}, {r: 2, c: 2}, // 17-21
                {r: 1, c: 2}, // 22 - top corner
                {r: 1, c: 3}, {r: 1, c: 4}, {r: 1, c: 5}, {r: 1, c: 6}, {r: 1, c: 7}, // 23-27
                // TOP ARM - going down (col 7)
                {r: 7, c: 8}, // 28 - above center
                {r: 7, c: 9}, {r: 7, c: 10}, {r: 7, c: 11}, {r: 7, c: 12}, {r: 7, c: 13}, {r: 7, c: 14}, // 29-34
                // RIGHT ARM - going right then down
                {r: 6, c: 14}, {r: 5, c: 14}, {r: 4, c: 14}, {r: 3, c: 14}, {r: 2, c: 14}, // 35-39
                {r: 1, c: 14}, // 40 - corner (should connect back)
                // This is wrong - let me redo this properly
            ],

            // Let me define the path more carefully based on actual Ludo cross layout
            // The cross has: top arm, bottom arm, left arm, right arm
            // Each arm is 6 cells long leading to corners

            buildMainPath() {
                // Standard Ludo path - counter-clockwise from Green start
                // Green start: bottom of left vertical arm (row 14, col 7)
                // Going counter-clockwise around the board
                
                return [
                    // Start from Green start position, going LEFT first (toward green base)
                    {r: 14, c: 6}, {r: 14, c: 5}, {r: 14, c: 4}, {r: 14, c: 3}, {r: 14, c: 2}, // 0-4: toward left
                    // Turn UP
                    {r: 13, c: 2}, {r: 12, c: 2}, {r: 11, c: 2}, {r: 10, c: 2}, {r: 9, c: 2}, {r: 8, c: 2}, {r: 7, c: 2}, // 5-11: up left side
                    // Turn RIGHT at top-left
                    {r: 6, c: 2}, {r: 5, c: 2}, {r: 4, c: 2}, {r: 3, c: 2}, {r: 2, c: 2}, // 12-16: continue up
                    {r: 1, c: 2}, // 17: corner
                    // Go RIGHT across top
                    {r: 1, c: 3}, {r: 1, c: 4}, {r: 1, c: 5}, {r: 1, c: 6}, // 18-21
                    // Turn DOWN
                    {r: 1, c: 7}, // 22
                    {r: 2, c: 7}, {r: 3, c: 7}, {r: 4, c: 7}, {r: 5, c: 7}, {r: 6, c: 7}, // 23-27: down right side of left arm
                    // Continue RIGHT across top of center
                    {r: 7, c: 8}, {r: 7, c: 9}, // 28-29: above center
                    {r: 7, c: 10}, {r: 7, c: 11}, {r: 7, c: 12}, {r: 7, c: 13}, {r: 7, c: 14}, // 30-34: right arm top
                    // Turn DOWN at top-right
                    {r: 6, c: 14}, {r: 5, c: 14}, {r: 4, c: 14}, {r: 3, c: 14}, {r: 2, c: 14}, // 35-39
                    {r: 1, c: 14}, // 40: corner
                    // Go RIGHT (actually should go down-right then left)
                    {r: 1, c: 15}, // Wait, this is outside... 
                ];
            },

            // Actually let me just hardcode a proper working path
            // Based on standard Ludo: cross-shaped, 52 cells
            // I'll use the visual layout properly

            init() {
                this.buildBoard();
                this.renderPieces();
                this.load();
                this.updateDisplay();
            },

            buildBoard() {
                const board = document.getElementById('ludoBoard');
                board.innerHTML = '';

                // Create all cells for the 15x15 grid
                for (let r = 1; r <= 15; r++) {
                    for (let c = 1; c <= 15; c++) {
                        const cellType = this.getCellType(r, c);
                        
                        if (cellType === 'home-green') {
                            // Green home base (bottom-left)
                            if (r >= 10 && r <= 15 && c >= 1 && c <= 6) {
                                if (r === 10 && c === 1) {
                                    // Only create the base container once
                                    const base = document.createElement('div');
                                    base.className = 'home-base green';
                                    base.innerHTML = `
                                        <div class="home-slot" data-slot="green-0"></div>
                                        <div class="home-slot" data-slot="green-1"></div>
                                        <div class="home-slot" data-slot="green-2"></div>
                                        <div class="home-slot" data-slot="green-3"></div>
                                    `;
                                    base.style.gridColumn = '1 / span 6';
                                    base.style.gridRow = '10 / span 6';
                                    board.appendChild(base);
                                }
                            }
                        } else if (cellType === 'home-yellow') {
                            // Yellow home base (bottom-right)
                            if (r === 10 && c === 10) {
                                const base = document.createElement('div');
                                base.className = 'home-base yellow';
                                base.innerHTML = `
                                    <div class="home-slot" data-slot="yellow-0"></div>
                                    <div class="home-slot" data-slot="yellow-1"></div>
                                    <div class="home-slot" data-slot="yellow-2"></div>
                                    <div class="home-slot" data-slot="yellow-3"></div>
                                `;
                                base.style.gridColumn = '10 / span 6';
                                base.style.gridRow = '10 / span 6';
                                board.appendChild(base);
                            }
                        } else if (cellType === 'home-inactive-tl') {
                            if (r === 1 && c === 1) {
                                const base = document.createElement('div');
                                base.className = 'home-base inactive-top-left';
                                base.style.gridColumn = '1 / span 6';
                                base.style.gridRow = '1 / span 6';
                                board.appendChild(base);
                            }
                        } else if (cellType === 'home-inactive-tr') {
                            if (r === 1 && c === 10) {
                                const base = document.createElement('div');
                                base.className = 'home-base inactive-top-right';
                                base.style.gridColumn = '10 / span 6';
                                base.style.gridRow = '1 / span 6';
                                board.appendChild(base);
                            }
                        } else if (cellType === 'center') {
                            if (r === 7 && c === 7) {
                                const center = document.createElement('div');
                                center.className = 'center-home';
                                center.id = 'center-home';
                                center.style.gridColumn = '7 / span 3';
                                center.style.gridRow = '7 / span 3';
                                center.textContent = '🌙';
                                board.appendChild(center);
                            }
                        } else if (cellType.type === 'path') {
                            const cell = document.createElement('div');
                            cell.className = 'cell';
                            cell.style.gridRow = r;
                            cell.style.gridColumn = c;
                            
                            if (cellType.special === 'start-green') {
                                cell.classList.add('start-green');
                            } else if (cellType.special === 'start-yellow') {
                                cell.classList.add('start-yellow');
                            } else if (cellType.special === 'safe') {
                                cell.classList.add('safe');
                            } else if (cellType.special === 'green-stretch') {
                                cell.classList.add('green-path');
                            } else if (cellType.special === 'yellow-stretch') {
                                cell.classList.add('yellow-path');
                            }
                            
                            cell.dataset.pathIndex = cellType.pathIndex !== undefined ? cellType.pathIndex : '';
                            if (cellType.homeIndex !== undefined) {
                                cell.dataset.homeIndex = cellType.homeIndex;
                                cell.dataset.homeColor = cellType.special.includes('green') ? 'green' : 'yellow';
                            }
                            
                            board.appendChild(cell);
                        }
                    }
                }
            },

            getCellType(r, c) {
                // Home bases
                if (r >= 1 && r <= 6 && c >= 1 && c <= 6) return 'home-inactive-tl';
                if (r >= 1 && r <= 6 && c >= 10 && c <= 15) return 'home-inactive-tr';
                if (r >= 10 && r <= 15 && c >= 1 && c <= 6) return 'home-green';
                if (r >= 10 && r <= 15 && c >= 10 && c <= 15) return 'home-yellow';
                
                // Center
                if (r >= 7 && r <= 9 && c >= 7 && c <= 9) return 'center';
                
                // Green home stretch (row 8, cols 2-6)
                if (r === 8 && c >= 2 && c <= 6) {
                    return { type: 'path', special: 'green-stretch', homeIndex: c - 2 };
                }
                
                // Yellow home stretch (row 8, cols 10-14)
                if (r === 8 && c >= 10 && c <= 14) {
                    return { type: 'path', special: 'yellow-stretch', homeIndex: c - 10 };
                }
                
                // Main path - build based on standard Ludo cross
                // Left vertical arm (col 7, excluding center)
                if (c === 7 && ((r >= 1 && r <= 6) || (r >= 10 && r <= 15))) {
                    let pathIdx;
                    if (r >= 10 && r <= 15) {
                        // Bottom left: going up
                        pathIdx = 15 - r; // r=15 -> idx=0, r=10 -> idx=5
                    } else {
                        // Top left: going up
                        pathIdx = 6 + (6 - r); // r=6 -> idx=6, r=1 -> idx=11
                    }
                    const safePositions = [0, 6, 11];
                    const special = r === 15 ? 'start-green' : (safePositions.includes(pathIdx) ? 'safe' : null);
                    return { type: 'path', pathIndex: pathIdx, special };
                }
                
                // Right vertical arm (col 9, excluding center)
                if (c === 9 && ((r >= 1 && r <= 6) || (r >= 10 && r <= 15))) {
                    let pathIdx;
                    if (r >= 1 && r <= 6) {
                        // Top right: going down
                        pathIdx = 12 + r - 1; // r=1 -> idx=12, r=6 -> idx=17
                    } else {
                        // Bottom right: going down toward yellow start
                        pathIdx = 18 + (r - 10); // r=10 -> idx=18, r=15 -> idx=23
                    }
                    const safePositions = [12, 17, 23];
                    const special = r === 15 ? 'start-yellow' : (safePositions.includes(pathIdx) ? 'safe' : null);
                    return { type: 'path', pathIndex: pathIdx, special };
                }
                
                // Top horizontal arm (row 7, excluding center)
                if (r === 7 && ((c >= 1 && c <= 6) || (c >= 10 && c <= 15))) {
                    let pathIdx;
                    if (c >= 1 && c <= 6) {
                        // Left side of top: going left
                        pathIdx = 30 + (6 - c); // c=6 -> idx=30, c=1 -> idx=35
                    } else {
                        // Right side of top: going right
                        pathIdx = 24 + (c - 10); // c=10 -> idx=24, c=15 -> idx=29
                    }
                    const safePositions = [24, 29, 35];
                    return { type: 'path', pathIndex: pathIdx, special: safePositions.includes(pathIdx) ? 'safe' : null };
                }
                
                // Bottom horizontal arm (row 9, excluding center)
                if (r === 9 && ((c >= 1 && c <= 6) || (c >= 10 && c <= 15))) {
                    let pathIdx;
                    if (c >= 1 && c <= 6) {
                        // Left side of bottom: going right (toward start)
                        pathIdx = 42 + (c - 1); // c=1 -> idx=42, c=6 -> idx=47
                    } else {
                        // Right side of bottom: going left
                        pathIdx = 36 + (15 - c); // c=15 -> idx=36, c=10 -> idx=41
                    }
                    const safePositions = [36, 41, 47];
                    return { type: 'path', pathIndex: pathIdx, special: safePositions.includes(pathIdx) ? 'safe' : null };
                }
                
                // Top row corners (row 1, cols 2-6 and 10-14)
                if (r === 1 && c >= 2 && c <= 6) {
                    const pathIdx = 48 + (c - 2); // c=2 -> idx=48, c=6 -> idx=52... wait that's 51
                    // Actually this overlaps... let me reconsider
                }
                
                // Okay this is getting too complex. Let me use a simpler approach.
                // I'll just define exactly which cells are path cells
                
                return 'empty';
            },

            // Simpler approach: define path as explicit cell positions
            pathCells: [
                // Main path (52 cells) - counter-clockwise from green start
                // Format: {r, c, pathIndex, special}
                
                // Green start area - bottom of left column, going UP
                {r: 15, c: 7, idx: 0, special: 'start-green'},
                {r: 14, c: 7, idx: 1},
                {r: 13, c: 7, idx: 2},
                {r: 12, c: 7, idx: 3},
                {r: 11, c: 7, idx: 4},
                {r: 10, c: 7, idx: 5},
                
                // Turn left at middle-left
                {r: 9, c: 6, idx: 6},
                {r: 9, c: 5, idx: 7},
                {r: 9, c: 4, idx: 8},
                {r: 9, c: 3, idx: 9},
                {r: 9, c: 2, idx: 10},
                {r: 9, c: 1, idx: 11, special: 'safe'}, // corner
                
                // Go UP left side
                {r: 8, c: 1, idx: 12},
                {r: 7, c: 1, idx: 13},
                {r: 6, c: 1, idx: 14},
                {r: 5, c: 1, idx: 15},
                {r: 4, c: 1, idx: 16},
                {r: 3, c: 1, idx: 17},
                {r: 2, c: 1, idx: 18},
                {r: 1, c: 1, idx: 19, special: 'safe'}, // top-left corner
                
                // Go RIGHT across top
                {r: 1, c: 2, idx: 20},
                {r: 1, c: 3, idx: 21},
                {r: 1, c: 4, idx: 22},
                {r: 1, c: 5, idx: 23},
                {r: 1, c: 6, idx: 24},
                
                // Turn down at top-middle
                {r: 2, c: 7, idx: 25},
                {r: 3, c: 7, idx: 26},
                {r: 4, c: 7, idx: 27},
                {r: 5, c: 7, idx: 28},
                {r: 6, c: 7, idx: 29},
                {r: 7, c: 7, idx: 30, special: 'safe'}, // above center
                
                // Continue right above center
                {r: 7, c: 8, idx: 31},
                {r: 7, c: 9, idx: 32},
                
                // Continue to right side
                {r: 7, c: 10, idx: 33, special: 'safe'},
                {r: 7, c: 11, idx: 34},
                {r: 7, c: 12, idx: 35},
                {r: 7, c: 13, idx: 36},
                {r: 7, c: 14, idx: 37},
                {r: 7, c: 15, idx: 38, special: 'safe'}, // top-right corner
                
                // Go DOWN right side
                {r: 8, c: 15, idx: 39},
                {r: 9, c: 15, idx: 40},
                {r: 10, c: 15, idx: 41},
                {r: 11, c: 15, idx: 42},
                {r: 12, c: 15, idx: 43},
                {r: 13, c: 15, idx: 44},
                {r: 14, c: 15, idx: 45},
                {r: 15, c: 15, idx: 46, special: 'safe'}, // bottom-right corner
                
                // Go LEFT across bottom
                {r: 15, c: 14, idx: 47},
                {r: 15, c: 13, idx: 48},
                {r: 15, c: 12, idx: 49},
                {r: 15, c: 11, idx: 50},
                {r: 15, c: 10, idx: 51},
                
                // Yellow start - going UP toward center
                // Yellow enters home stretch from here
            ],
            
            // Home stretches (5 cells each, toward center)
            greenStretch: [
                {r: 14, c: 8, idx: 0},
                {r: 13, c: 8, idx: 1},
                {r: 12, c: 8, idx: 2},
                {r: 11, c: 8, idx: 3},
                {r: 10, c: 8, idx: 4},
            ],
            
            yellowStretch: [
                {r: 14, c: 9, idx: 0},
                {r: 13, c: 9, idx: 1},
                {r: 12, c: 9, idx: 2},
                {r: 11, c: 9, idx: 3},
                {r: 10, c: 9, idx: 4},
            ],

            // Yellow starts at which main path index?
            // Yellow starts at position 51 (bottom-right, going up)
            yellowStartIndex: 51,

            createBoard() {
                const board = document.getElementById('ludoBoard');
                board.innerHTML = '';

                // Create inactive bases (top corners)
                const tlBase = document.createElement('div');
                tlBase.className = 'home-base inactive-top-left';
                tlBase.style.gridColumn = '1 / span 6';
                tlBase.style.gridRow = '1 / span 6';
                board.appendChild(tlBase);

                const trBase = document.createElement('div');
                trBase.className = 'home-base inactive-top-right';
                trBase.style.gridColumn = '10 / span 6';
                trBase.style.gridRow = '1 / span 6';
                board.appendChild(trBase);

                // Green home base (bottom-left)
                const greenBase = document.createElement('div');
                greenBase.className = 'home-base green';
                greenBase.innerHTML = `
                    <div class="home-slot" data-slot="green-0"></div>
                    <div class="home-slot" data-slot="green-1"></div>
                    <div class="home-slot" data-slot="green-2"></div>
                    <div class="home-slot" data-slot="green-3"></div>
                `;
                board.appendChild(greenBase);

                // Yellow home base (bottom-right)
                const yellowBase = document.createElement('div');
                yellowBase.className = 'home-base yellow';
                yellowBase.innerHTML = `
                    <div class="home-slot" data-slot="yellow-0"></div>
                    <div class="home-slot" data-slot="yellow-1"></div>
                    <div class="home-slot" data-slot="yellow-2"></div>
                    <div class="home-slot" data-slot="yellow-3"></div>
                `;
                board.appendChild(yellowBase);

                // Center home
                const center = document.createElement('div');
                center.className = 'center-home';
                center.id = 'center-home';
                center.style.gridColumn = '7 / span 3';
                center.style.gridRow = '7 / span 3';
                center.textContent = '🌙';
                board.appendChild(center);

                // Create main path cells
                this.pathCells.forEach(cell => {
                    const el = document.createElement('div');
                    el.className = 'cell';
                    el.style.gridRow = cell.r;
                    el.style.gridColumn = cell.c;
                    el.dataset.pathIndex = cell.idx;
                    
                    if (cell.special === 'start-green') {
                        el.classList.add('start-green');
                    } else if (cell.special === 'start-yellow') {
                        el.classList.add('start-yellow');
                    } else if (cell.special === 'safe') {
                        el.classList.add('safe');
                    }
                    
                    board.appendChild(el);
                });

                // Create home stretch cells
                this.greenStretch.forEach(cell => {
                    const el = document.createElement('div');
                    el.className = 'cell green-path';
                    el.style.gridRow = cell.r;
                    el.style.gridColumn = cell.c;
                    el.dataset.greenStretch = cell.idx;
                    board.appendChild(el);
                });

                this.yellowStretch.forEach(cell => {
                    const el = document.createElement('div');
                    el.className = 'cell yellow-path';
                    el.style.gridRow = cell.r;
                    el.style.gridColumn = cell.c;
                    el.dataset.yellowStretch = cell.idx;
                    board.appendChild(el);
                });
            },

            renderPieces() {
                document.querySelectorAll('.piece').forEach(p => p.remove());

                // Render green pieces
                this.green.forEach((pos, idx) => {
                    if (pos === 0) {
                        // In home base
                        const slot = document.querySelector(`.home-slot[data-slot="green-${idx}"]`);
                        if (slot) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = `green-piece-${idx}`;
                            slot.appendChild(piece);
                        }
                    } else if (pos >= 100) {
                        // In center
                        const center = document.getElementById('center-home');
                        if (center) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = `green-piece-${idx}`;
                            center.appendChild(piece);
                        }
                    } else if (pos <= 52) {
                        // On main path
                        const cell = document.querySelector(`.cell[data-path-index="${pos - 1}"]`);
                        if (cell) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = `green-piece-${idx}`;
                            cell.appendChild(piece);
                        }
                    } else {
                        // On home stretch (53-57)
                        const stretchIdx = pos - 53;
                        const cell = document.querySelector(`.cell[data-green-stretch="${stretchIdx}"]`);
                        if (cell) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = `green-piece-${idx}`;
                            cell.appendChild(piece);
                        }
                    }
                });

                // Render yellow pieces
                this.yellow.forEach((pos, idx) => {
                    if (pos === 0) {
                        const slot = document.querySelector(`.home-slot[data-slot="yellow-${idx}"]`);
                        if (slot) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = `yellow-piece-${idx}`;
                            slot.appendChild(piece);
                        }
                    } else if (pos >= 100) {
                        const center = document.getElementById('center-home');
                        if (center) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = `yellow-piece-${idx}`;
                            center.appendChild(piece);
                        }
                    } else if (pos <= 52) {
                        // Yellow position is relative to yellow start
                        const actualIdx = (this.yellowStartIndex + pos - 1) % 52;
                        const cell = document.querySelector(`.cell[data-path-index="${actualIdx}"]`);
                        if (cell) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = `yellow-piece-${idx}`;
                            cell.appendChild(piece);
                        }
                    } else {
                        // On home stretch (53-57)
                        const stretchIdx = pos - 53;
                        const cell = document.querySelector(`.cell[data-yellow-stretch="${stretchIdx}"]`);
                        if (cell) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = `yellow-piece-${idx}`;
                            cell.appendChild(piece);
                        }
                    }
                });
            },

            rollDice() {
                if (!this.canRoll) return;

                this.canRoll = false;
                const dice = document.getElementById('dice');
                const btn = document.getElementById('rollBtn');
                btn.disabled = true;

                dice.classList.add('rolling');

                let rolls = 0;
                const rollInterval = setInterval(() => {
                    dice.textContent = Math.floor(Math.random() * 6) + 1;
                    rolls++;
                    if (rolls >= 12) {
                        clearInterval(rollInterval);
                        this.diceValue = Math.floor(Math.random() * 6) + 1;
                        dice.textContent = this.diceValue;
                        dice.classList.remove('rolling');
                        document.getElementById('diceResult').textContent = this.diceValue;

                        setTimeout(() => this.processRoll(), 300);
                    }
                }, 50);
            },

            processRoll() {
                const btn = document.getElementById('rollBtn');
                const pieces = this.turn === 'suami' ? this.green : this.yellow;
                const color = this.turn === 'suami' ? 'green' : 'yellow';

                const atHome = pieces.filter(p => p === 0).length;
                const onPath = pieces.filter(p => p > 0 && p < 100).length;

                let moved = false;

                if (this.diceValue === 6) {
                    if (atHome > 0) {
                        for (let i = 0; i < 4; i++) {
                            if (pieces[i] === 0) {
                                pieces[i] = 1;
                                this.renderPieces();
                                this.updateDisplay();
                                moved = true;
                                document.getElementById('diceResult').innerHTML = this.diceValue + ' | <span class="highlight">🎉 Bidak keluar! Lempar lagi!</span>';
                                this.canRoll = true;
                                btn.disabled = false;
                                this.save();
                                break;
                            }
                        }
                    } else if (onPath > 0) {
                        moved = this.movePiece(pieces, color);
                        if (moved) {
                            document.getElementById('diceResult').innerHTML = this.diceValue + ' | <span class="highlight">🎉 Lempar lagi!</span>';
                            this.canRoll = true;
                            btn.disabled = false;
                        }
                    }
                } else {
                    if (onPath > 0) {
                        moved = this.movePiece(pieces, color);
                    }
                }

                if (!moved) {
                    const msg = atHome > 0 ? 'Butuh dadu 6 untuk keluar!' : 'Tidak ada bidak yang bisa gerak!';
                    document.getElementById('diceResult').textContent = msg;
                }

                const finished = pieces.filter(p => p >= 100).length;
                if (finished === 4) {
                    this.showWin();
                    return;
                }

                if (this.diceValue !== 6) {
                    setTimeout(() => {
                        this.turn = this.turn === 'suami' ? 'istri' : 'suami';
                        this.updateDisplay();
                        this.showQuestion();
                        this.canRoll = true;
                        btn.disabled = false;
                        this.save();
                    }, 500);
                } else {
                    this.save();
                }
            },

            movePiece(pieces, color) {
                for (let i = 0; i < 4; i++) {
                    if (pieces[i] > 0 && pieces[i] < 100) {
                        const newPos = pieces[i] + this.diceValue;
                        const maxPos = 58; // 52 main + 5 stretch + 1 center

                        if (newPos <= maxPos) {
                            pieces[i] = newPos;

                            if (newPos === maxPos) {
                                pieces[i] = 100;
                                document.getElementById('diceResult').innerHTML += ' | <span class="highlight">🏠 Sampai rumah!</span>';
                            }

                            // Check capture only on main path
                            if (newPos <= 52) {
                                this.checkCapture(color, newPos);
                            }

                            this.renderPieces();
                            this.updateDisplay();
                            return true;
                        }
                    }
                }
                return false;
            },

            checkCapture(movingColor, newPos) {
                // Get actual path index
                let pathIndex;
                if (movingColor === 'green') {
                    pathIndex = newPos - 1;
                } else {
                    pathIndex = (this.yellowStartIndex + newPos - 1) % 52;
                }

                // Check if safe zone
                const safeCell = this.pathCells.find(c => c.idx === pathIndex && c.special === 'safe');
                if (safeCell) return;

                const opponentColor = movingColor === 'green' ? 'yellow' : 'green';
                const opponentPieces = movingColor === 'green' ? this.yellow : this.green;

                for (let i = 0; i < 4; i++) {
                    if (opponentPieces[i] > 0 && opponentPieces[i] < 100) {
                        let opponentPathIndex;
                        if (opponentColor === 'green') {
                            opponentPathIndex = opponentPieces[i] - 1;
                        } else {
                            opponentPathIndex = (this.yellowStartIndex + opponentPieces[i] - 1) % 52;
                        }

                        if (opponentPathIndex === pathIndex) {
                            opponentPieces[i] = 0;
                            this.showCaptureMessage(opponentColor);
                        }
                    }
                }
            },

            showCaptureMessage(capturedColor) {
                const playerName = capturedColor === 'green' ? 'Suami' : 'Istri';
                const msg = document.createElement('div');
                msg.className = 'capture-msg';
                msg.textContent = `💥 Bidak ${playerName} tertangkap!`;
                document.body.appendChild(msg);
                setTimeout(() => msg.remove(), 2000);
            },

            showQuestion() {
                if (Math.random() > 0.5) return;

                const questions = this.mode === 'santai' ? this.questionsSantai : this.questionsSerius;
                const question = questions[Math.floor(Math.random() * questions.length)];
                const type = this.mode === 'santai' ? '😊' : '📖';
                const player = this.turn === 'suami' ? 'Suami' : 'Istri';

                document.getElementById('modalTitle').textContent = type + ' Giliran ' + player;
                document.getElementById('modalText').textContent = question;
                document.getElementById('modal').classList.add('active');
            },

            questionsSantai: [
                'Sebutkan 1 hal yang membuatmu jatuh cinta lagi!',
                'Apa yang paling kamu syukuri dari pasanganmu?',
                'Buat satu doa untuk pasanganmu!',
                'Kenangan manis apa yang ingin kamu bagikan?',
                'Sampaikan "Aku cinta kamu"!',
                'Apa yang bikin kamu senang hari ini?'
            ],

            questionsSerius: [
                'Apa hukum berpelukan saat puasa (tanpa syahwat)?',
                'Sebutkan satu adab suami istri dalam Islam!',
                'Apa hak suami atas istri yang harus dipenuhi?',
                'Apa hak istri atas suami yang harus dipenuhi?',
                'Bagaimana mengakhiri pertengkaran menurut Islam?',
                'Sebutkan 3 hal yang membatalkan puasa!'
            ],

            showWin() {
                const winner = this.turn === 'suami' ? 'Suami' : 'Istri';
                document.getElementById('modalTitle').textContent = '🎉 ' + winner + ' Menang!';
                document.getElementById('modalText').textContent = 'Selamat! Semoga rumah tangga selalu harmonis! 💕';
                document.getElementById('modal').classList.add('active');
                document.getElementById('gameStatus').innerHTML = '<span class="highlight">' + winner + ' MENANG! 🏆</span>';
            },

            updateDisplay() {
                document.getElementById('cardSuami').classList.toggle('active', this.turn === 'suami');
                document.getElementById('cardIstri').classList.toggle('active', this.turn === 'istri');
                document.getElementById('turnText').textContent = this.turn === 'suami' ? 'Suami' : 'Istri';

                const greenHome = this.green.filter(p => p >= 100).length;
                const yellowHome = this.yellow.filter(p => p >= 100).length;
                const greenPlaying = this.green.filter(p => p > 0 && p < 100).length;
                const yellowPlaying = this.yellow.filter(p => p > 0 && p < 100).length;

                document.getElementById('suamiHome').textContent = greenHome;
                document.getElementById('istriHome').textContent = yellowHome;
                document.getElementById('suamiPlaying').textContent = greenPlaying;
                document.getElementById('istriPlaying').textContent = yellowPlaying;
            },

            setMode(mode) {
                this.mode = mode;
                document.getElementById('modeSantai').classList.toggle('active', mode === 'santai');
                document.getElementById('modeSerius').classList.toggle('active', mode === 'serius');
            },

            closeModal() {
                document.getElementById('modal').classList.remove('active');
            },

            toggleAudio() {
                this.audioEnabled = !this.audioEnabled;
                document.getElementById('audioBtn').textContent = this.audioEnabled ? '🔊' : '🔇';
            },

            save() {
                localStorage.setItem('ludo_save', JSON.stringify({
                    mode: this.mode,
                    turn: this.turn,
                    green: this.green,
                    yellow: this.yellow
                }));
            },

            load() {
                const saved = localStorage.getItem('ludo_save');
                if (saved) {
                    try {
                        const state = JSON.parse(saved);
                        this.mode = state.mode || 'santai';
                        this.turn = state.turn || 'suami';
                        this.green = state.green || [0, 0, 0, 0];
                        this.yellow = state.yellow || [0, 0, 0, 0];
                        document.getElementById('modeSantai').classList.toggle('active', this.mode === 'santai');
                        document.getElementById('modeSerius').classList.toggle('active', this.mode === 'serius');
                    } catch (e) {
                        console.error('Error loading save:', e);
                    }
                }
            },

            reset() {
                if (!confirm('Reset game? Progress akan hilang.')) return;
                localStorage.removeItem('ludo_save');
                this.mode = 'santai';
                this.turn = 'suami';
                this.green = [0, 0, 0, 0];
                this.yellow = [0, 0, 0, 0];
                this.canRoll = true;
                document.getElementById('modeSantai').classList.add('active');
                document.getElementById('modeSerius').classList.remove('active');
                document.getElementById('diceResult').textContent = '-';
                document.getElementById('gameStatus').innerHTML = 'Giliran: <strong id="turnText">Suami</strong> | Hasil: <span id="diceResult">-</span>';
                this.renderPieces();
                this.updateDisplay();
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            Game.init();
        });

        document.getElementById('modal').addEventListener('click', (e) => {
            if (e.target.id === 'modal') Game.closeModal();
        });
    </script>
</body>
</html>
