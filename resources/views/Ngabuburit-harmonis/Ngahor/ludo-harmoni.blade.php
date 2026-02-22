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

        /* Inactive bases (visual only, dimmed) */
        .home-base.inactive {
            background: #3a3a3a;
            opacity: 0.3;
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

        /* Colored paths */
        .cell.green-home { 
            background: #34D399; 
        }
        .cell.yellow-home { 
            background: #FBBF24; 
        }

        /* Start positions */
        .cell.start-green { 
            background: var(--green); 
        }
        .cell.start-green::before {
            content: '';
            width: 60%;
            height: 60%;
            background: var(--white);
            border-radius: 50%;
        }

        .cell.start-yellow { 
            background: var(--yellow); 
        }
        .cell.start-yellow::before {
            content: '';
            width: 60%;
            height: 60%;
            background: var(--white);
            border-radius: 50%;
        }

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

            // Main path (52 positions, 0-indexed) - Standard Ludo counter-clockwise
            // Grid: 1-indexed (row, col), Standard Ludo 15x15 layout
            // Green starts at bottom-left path, Yellow starts at bottom-right path
            mainPath: [
                // Bottom row (row 8): Green start area, going left to right
                {r: 8, c: 1}, {r: 8, c: 2}, {r: 8, c: 3}, {r: 8, c: 4}, {r: 8, c: 5}, {r: 8, c: 6},
                // Left column going up (col 7)
                {r: 7, c: 7}, {r: 6, c: 7}, {r: 5, c: 7}, {r: 4, c: 7}, {r: 3, c: 7}, {r: 2, c: 7}, {r: 1, c: 7},
                // Top row going right (row 1)
                {r: 1, c: 8}, {r: 1, c: 9},
                // Right column going down (col 9)
                {r: 2, c: 9}, {r: 3, c: 9}, {r: 4, c: 9}, {r: 5, c: 9}, {r: 6, c: 9}, {r: 7, c: 9},
                // Right horizontal (row 7)
                {r: 7, c: 10}, {r: 7, c: 11}, {r: 7, c: 12}, {r: 7, c: 13}, {r: 7, c: 14}, {r: 7, c: 15},
                // Right vertical going down (col 15)
                {r: 8, c: 15}, {r: 9, c: 15},
                // Bottom-right horizontal going left (row 9)
                {r: 9, c: 14}, {r: 9, c: 13}, {r: 9, c: 12}, {r: 9, c: 11}, {r: 9, c: 10}, {r: 9, c: 9},
                // Yellow start: going down (col 9)
                {r: 10, c: 9}, {r: 11, c: 9}, {r: 12, c: 9}, {r: 13, c: 9}, {r: 14, c: 9}, {r: 15, c: 9},
                // Bottom row going left (row 15)
                {r: 15, c: 8}, {r: 15, c: 7},
                // Left column going up (col 7)
                {r: 14, c: 7}, {r: 13, c: 7}, {r: 12, c: 7}, {r: 11, c: 7}, {r: 10, c: 7},
                // Bottom-left horizontal going right (row 10)
                {r: 10, c: 6}, {r: 10, c: 5}, {r: 10, c: 4}, {r: 10, c: 3}, {r: 10, c: 2}, {r: 10, c: 1}
            ],

            // Green home stretch (row 8, columns 2-6, going right toward center)
            // Green enters at position 52, then home stretch to center
            greenHomeStretch: [
                {r: 8, c: 2}, {r: 8, c: 3}, {r: 8, c: 4}, {r: 8, c: 5}, {r: 8, c: 6}
            ],

            // Yellow home stretch (column 14, rows 14-10, going up toward center)
            // Yellow enters at position 52, then home stretch to center
            yellowHomeStretch: [
                {r: 14, c: 8}, {r: 13, c: 8}, {r: 12, c: 8}, {r: 11, c: 8}, {r: 10, c: 8}
            ],

            // Yellow starts at index 32 in mainPath
            yellowStartIndex: 32,

            // Safe positions (0-based indices in mainPath): start positions and every 8th cell
            safePositions: [0, 8, 13, 21, 26, 32, 40, 45],

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

            init() {
                this.createBoard();
                this.renderPieces();
                this.load();
                this.updateDisplay();
            },

            createBoard() {
                const board = document.getElementById('ludoBoard');
                board.innerHTML = '';

                // Inactive bases (top corners - visual only, dimmed)
                const topLeftBase = document.createElement('div');
                topLeftBase.className = 'home-base inactive';
                topLeftBase.style.gridColumn = '1 / span 6';
                topLeftBase.style.gridRow = '1 / span 6';
                board.appendChild(topLeftBase);

                const topRightBase = document.createElement('div');
                topRightBase.className = 'home-base inactive';
                topRightBase.style.gridColumn = '10 / span 6';
                topRightBase.style.gridRow = '1 / span 6';
                board.appendChild(topRightBase);

                // Green Home Base (bottom-left, rows 10-15, cols 1-6)
                const greenHome = document.createElement('div');
                greenHome.className = 'home-base green';
                greenHome.innerHTML = '<div class="home-slot" data-slot="green-0"></div><div class="home-slot" data-slot="green-1"></div><div class="home-slot" data-slot="green-2"></div><div class="home-slot" data-slot="green-3"></div>';
                board.appendChild(greenHome);

                // Yellow Home Base (bottom-right, rows 10-15, cols 10-15)
                const yellowHome = document.createElement('div');
                yellowHome.className = 'home-base yellow';
                yellowHome.innerHTML = '<div class="home-slot" data-slot="yellow-0"></div><div class="home-slot" data-slot="yellow-1"></div><div class="home-slot" data-slot="yellow-2"></div><div class="home-slot" data-slot="yellow-3"></div>';
                board.appendChild(yellowHome);

                // Center Home (rows 7-9, cols 7-9)
                const centerHome = document.createElement('div');
                centerHome.className = 'center-home';
                centerHome.style.gridColumn = '7 / span 3';
                centerHome.style.gridRow = '7 / span 3';
                centerHome.textContent = '🌙';
                centerHome.id = 'center-home';
                board.appendChild(centerHome);

                // Create main path cells (52 cells)
                this.mainPath.forEach((pos, index) => {
                    const cell = document.createElement('div');
                    cell.className = 'cell';
                    cell.style.gridRow = pos.r;
                    cell.style.gridColumn = pos.c;
                    cell.dataset.pathIndex = index;

                    // Mark start positions
                    if (index === 0) {
                        cell.classList.add('start-green');
                    }
                    if (index === this.yellowStartIndex) {
                        cell.classList.add('start-yellow');
                    }

                    // Mark safe positions
                    if (this.safePositions.includes(index)) {
                        cell.classList.add('safe');
                    }

                    board.appendChild(cell);
                });

                // Create green home stretch cells
                this.greenHomeStretch.forEach((pos, index) => {
                    const cell = document.createElement('div');
                    cell.className = 'cell green-home';
                    cell.style.gridRow = pos.r;
                    cell.style.gridColumn = pos.c;
                    cell.dataset.greenHomeIndex = index;
                    board.appendChild(cell);
                });

                // Create yellow home stretch cells
                this.yellowHomeStretch.forEach((pos, index) => {
                    const cell = document.createElement('div');
                    cell.className = 'cell yellow-home';
                    cell.style.gridRow = pos.r;
                    cell.style.gridColumn = pos.c;
                    cell.dataset.yellowHomeIndex = index;
                    board.appendChild(cell);
                });
            },

            renderPieces() {
                document.querySelectorAll('.piece').forEach(p => p.remove());

                this.green.forEach((pos, idx) => {
                    if (pos === 0) {
                        const slot = document.querySelector('.home-slot[data-slot="green-' + idx + '"]');
                        if (slot) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = 'green-piece-' + idx;
                            slot.appendChild(piece);
                        }
                    } else if (pos >= 100) {
                        const center = document.getElementById('center-home');
                        if (center) {
                            const piece = document.createElement('div');
                            piece.className = 'piece green';
                            piece.id = 'green-piece-' + idx;
                            center.appendChild(piece);
                        }
                    } else {
                        this.placePieceOnPath('green', idx, pos);
                    }
                });

                this.yellow.forEach((pos, idx) => {
                    if (pos === 0) {
                        const slot = document.querySelector('.home-slot[data-slot="yellow-' + idx + '"]');
                        if (slot) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = 'yellow-piece-' + idx;
                            slot.appendChild(piece);
                        }
                    } else if (pos >= 100) {
                        const center = document.getElementById('center-home');
                        if (center) {
                            const piece = document.createElement('div');
                            piece.className = 'piece yellow';
                            piece.id = 'yellow-piece-' + idx;
                            center.appendChild(piece);
                        }
                    } else {
                        this.placePieceOnPath('yellow', idx, pos);
                    }
                });
            },

            placePieceOnPath(color, pieceIdx, pos) {
                let targetCell = null;

                if (color === 'green') {
                    // Green: 0 = home, 1-52 = main path, 53-57 = home stretch, 100 = center
                    if (pos >= 1 && pos <= 52) {
                        const pathIdx = pos - 1;
                        const cellPos = this.mainPath[pathIdx];
                        targetCell = this.findCell(cellPos.r, cellPos.c);
                    } else if (pos >= 53 && pos <= 57) {
                        const homeIdx = pos - 53;
                        if (homeIdx < this.greenHomeStretch.length) {
                            const cellPos = this.greenHomeStretch[homeIdx];
                            targetCell = this.findCell(cellPos.r, cellPos.c);
                        }
                    }
                } else {
                    // Yellow: 0 = home, starts at index 32, wraps around
                    const yellowMainPathTotal = 52;
                    if (pos >= 1 && pos <= yellowMainPathTotal) {
                        let pathIdx = (this.yellowStartIndex + pos - 1) % this.mainPath.length;
                        const cellPos = this.mainPath[pathIdx];
                        targetCell = this.findCell(cellPos.r, cellPos.c);
                    } else if (pos > yellowMainPathTotal && pos <= yellowMainPathTotal + 5) {
                        const homeIdx = pos - yellowMainPathTotal - 1;
                        if (homeIdx < this.yellowHomeStretch.length) {
                            const cellPos = this.yellowHomeStretch[homeIdx];
                            targetCell = this.findCell(cellPos.r, cellPos.c);
                        }
                    }
                }

                if (targetCell) {
                    const piece = document.createElement('div');
                    piece.className = 'piece ' + color;
                    piece.id = color + '-piece-' + pieceIdx;
                    targetCell.appendChild(piece);
                }
            },

            findCell(row, col) {
                const cells = document.querySelectorAll('.cell');
                for (let cell of cells) {
                    if (cell.style.gridRow == row && cell.style.gridColumn == col) {
                        return cell;
                    }
                }
                return null;
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
                // Try to move a piece that's on the path
                for (let i = 0; i < 4; i++) {
                    if (pieces[i] > 0 && pieces[i] < 100) {
                        const newPos = pieces[i] + this.diceValue;
                        const maxPos = 58; // 52 main + 5 home stretch + 1 center

                        if (newPos <= maxPos) {
                            const oldPos = pieces[i];
                            pieces[i] = newPos;

                            if (newPos === maxPos) {
                                pieces[i] = 100;
                                document.getElementById('diceResult').innerHTML += ' | <span class="highlight">🏠 Sampai rumah!</span>';
                            }

                            // Check for capture (only on main path, not home stretch)
                            if (newPos <= 52) {
                                this.checkCapture(color, newPos, oldPos);
                            }

                            this.renderPieces();
                            this.updateDisplay();
                            return true;
                        }
                    }
                }
                return false;
            },

            checkCapture(movingColor, newPos, oldPos) {
                // Convert position to mainPath index for safe zone check
                let pathIndex;
                if (movingColor === 'green') {
                    pathIndex = newPos - 1;
                } else {
                    pathIndex = (this.yellowStartIndex + newPos - 1) % this.mainPath.length;
                }

                // Can't capture on safe positions
                if (this.safePositions.includes(pathIndex)) {
                    return;
                }

                // Check opponent's pieces
                const opponentColor = movingColor === 'green' ? 'yellow' : 'green';
                const opponentPieces = movingColor === 'green' ? this.yellow : this.green;

                // Get the actual cell position
                const cellPos = this.mainPath[pathIndex];

                // Check each opponent piece
                for (let i = 0; i < 4; i++) {
                    if (opponentPieces[i] > 0 && opponentPieces[i] < 100) {
                        // Calculate opponent's position on the main path
                        let opponentPathIndex;
                        if (opponentColor === 'green') {
                            opponentPathIndex = opponentPieces[i] - 1;
                        } else {
                            opponentPathIndex = (this.yellowStartIndex + opponentPieces[i] - 1) % this.mainPath.length;
                        }

                        // Check if same cell
                        if (opponentPathIndex === pathIndex) {
                            // Capture! Send back to base
                            opponentPieces[i] = 0;
                            this.showCaptureMessage(opponentColor);
                            this.renderPieces();
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
