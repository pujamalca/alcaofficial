<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>☪️ Quiz Asmaul Husna - Ngabuburit Harmonis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #D4AF37;
            --green: #10B981;
            --yellow: #F59E0B;
            --red: #EF4444;
            --white: #FFFFFF;
            --dark: #1a0a2e;
            --card: #2a2a4a;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, var(--dark) 0%, #2d1b4e 100%);
            min-height: 100vh;
            color: var(--white);
            padding: 10px;
        }

        .container { max-width: 500px; margin: 0 auto; }

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

        .header { text-align: center; padding: 15px 10px; }
        .header h1 { font-family: 'Amiri', serif; font-size: 1.3rem; color: var(--gold); margin-bottom: 5px; }
        .header p { font-size: 0.85rem; opacity: 0.8; }

        /* Screens */
        .screen { display: none; }
        .screen.active { display: block; }

        /* Setup Screen */
        .setup-card {
            background: var(--card);
            border-radius: 15px;
            padding: 20px;
            margin: 10px 0;
            border: 1px solid #8B6914;
        }

        .setup-card h3 { color: var(--gold); margin-bottom: 15px; font-size: 1rem; }

        .option-group { margin-bottom: 15px; }
        .option-group label { display: block; margin-bottom: 8px; font-size: 0.9rem; }

        .option-btns { display: flex; gap: 10px; flex-wrap: wrap; }

        .opt-btn {
            flex: 1;
            min-width: 80px;
            padding: 10px;
            border: 2px solid #8B6914;
            border-radius: 10px;
            background: transparent;
            color: var(--white);
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .opt-btn:hover { background: #3a3a5a; }
        .opt-btn.active { background: var(--gold); color: var(--dark); border-color: var(--gold); }

        .toggle-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .toggle {
            width: 50px;
            height: 26px;
            background: #555;
            border-radius: 13px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle.active { background: var(--green); }

        .toggle::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: left 0.3s;
        }

        .toggle.active::after { left: 26px; }

        .start-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background: var(--green);
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.2s;
        }

        .start-btn:hover { transform: scale(1.02); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); }

        /* Game Screen */
        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: var(--card);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .game-stat { text-align: center; }
        .game-stat .value { font-size: 1.2rem; font-weight: 700; color: var(--gold); }
        .game-stat .label { font-size: 0.7rem; opacity: 0.7; }

        .progress-bar {
            height: 8px;
            background: #555;
            border-radius: 4px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--gold));
            transition: width 0.3s;
        }

        .question-card {
            background: var(--card);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            margin: 15px 0;
            border: 2px solid var(--gold);
        }

        .question-type {
            font-size: 0.8rem;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .question-text {
            font-family: 'Amiri', serif;
            font-size: 1.8rem;
            color: var(--white);
            margin-bottom: 10px;
        }

        .question-hint { font-size: 0.85rem; opacity: 0.6; }

        .timer-display {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold);
        }

        .timer-display.warning { color: var(--red); }

        .options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; }

        .option-btn {
            padding: 15px 10px;
            border: 2px solid #8B6914;
            border-radius: 12px;
            background: var(--card);
            color: var(--white);
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-align: center;
        }

        .option-btn:hover:not(:disabled) { background: #3a3a5a; transform: scale(1.02); }
        .option-btn.correct { background: var(--green); border-color: var(--green); }
        .option-btn.wrong { background: var(--red); border-color: var(--red); }
        .option-btn:disabled { cursor: not-allowed; opacity: 0.7; }

        .streak-badge {
            display: inline-block;
            padding: 5px 12px;
            background: var(--gold);
            color: var(--dark);
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-top: 10px;
        }

        /* Multiplayer specific */
        .player-scores {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0;
        }

        .player-score-card {
            padding: 10px 20px;
            border-radius: 12px;
            background: var(--card);
            border: 2px solid transparent;
            text-align: center;
        }

        .player-score-card.active { border-color: var(--gold); box-shadow: 0 0 15px rgba(212, 175, 55, 0.3); }
        .player-score-card .name { font-size: 0.85rem; margin-bottom: 5px; }
        .player-score-card .score { font-size: 1.5rem; font-weight: 700; color: var(--gold); }

        /* Result Screen */
        .result-card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            border: 2px solid var(--gold);
        }

        .result-icon { font-size: 4rem; margin-bottom: 15px; }
        .result-title { font-family: 'Amiri', serif; font-size: 1.5rem; color: var(--gold); margin-bottom: 10px; }
        .result-score { font-size: 3rem; font-weight: 700; color: var(--white); margin-bottom: 5px; }
        .result-detail { font-size: 0.9rem; opacity: 0.8; margin-bottom: 20px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .stat-item {
            background: #1a1a3a;
            padding: 15px 10px;
            border-radius: 10px;
        }

        .stat-item .value { font-size: 1.3rem; font-weight: 700; color: var(--gold); }
        .stat-item .label { font-size: 0.75rem; opacity: 0.7; }

        .review-section {
            margin-top: 20px;
            text-align: left;
        }

        .review-section h4 { color: var(--gold); margin-bottom: 10px; }

        .review-item {
            background: #1a1a3a;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 10px;
            border-left: 3px solid var(--red);
        }

        .review-item.correct { border-left-color: var(--green); }

        .review-item .q { font-size: 0.85rem; margin-bottom: 5px; }
        .review-item .a { font-size: 0.8rem; opacity: 0.7; }

        .result-btns { display: flex; gap: 10px; margin-top: 20px; }

        .result-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .result-btn.primary { background: var(--green); color: white; }
        .result-btn.secondary { background: var(--card); color: var(--white); border: 2px solid var(--gold); }

        /* Leaderboard */
        .leaderboard {
            background: var(--card);
            border-radius: 15px;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #8B6914;
        }

        .leaderboard h3 { color: var(--gold); margin-bottom: 10px; font-size: 1rem; }

        .lb-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #3a3a5a;
        }

        .lb-item:last-child { border-bottom: none; }
        .lb-item .rank { color: var(--gold); font-weight: 700; width: 30px; }
        .lb-item .name { flex: 1; }
        .lb-item .score { color: var(--gold); font-weight: 600; }

        /* Audio toggle */
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
            font-size: 1.2rem;
            z-index: 50;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .screen.active { animation: fadeIn 0.3s ease; }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .pulse { animation: pulse 0.5s ease; }

        /* Share modal */
        .share-text {
            background: #1a1a3a;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 0.9rem;
            text-align: center;
            white-space: pre-wrap;
        }

        .copy-btn {
            padding: 10px 20px;
            background: var(--gold);
            color: var(--dark);
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/Ngabuburit-harmonis" class="back-btn">← Kembali</a>

        <div class="header">
            <h1>☪️ Quiz Asmaul Husna</h1>
            <p>Tebak 99 Nama Allah yang Indah</p>
        </div>

        <!-- Setup Screen -->
        <div class="screen active" id="setupScreen">
            <div class="setup-card">
                <h3>🎮 Mode Permainan</h3>
                <div class="option-btns">
                    <button class="opt-btn active" data-mode="single" onclick="Game.setMode('single')">👤 Sendiri</button>
                    <button class="opt-btn" data-mode="multi" onclick="Game.setMode('multi')">👫 Berdua</button>
                </div>
            </div>

            <div class="setup-card" id="playerNames" style="display: none;">
                <h3>📝 Nama Pemain</h3>
                <div class="option-group">
                    <label>Pemain 1 (Suami)</label>
                    <input type="text" id="player1Name" placeholder="Nama suami" value="Suami" style="width:100%;padding:10px;border-radius:8px;border:2px solid #8B6914;background:transparent;color:white;">
                </div>
                <div class="option-group">
                    <label>Pemain 2 (Istri)</label>
                    <input type="text" id="player2Name" placeholder="Nama istri" value="Istri" style="width:100%;padding:10px;border-radius:8px;border:2px solid #8B6914;background:transparent;color:white;">
                </div>
            </div>

            <div class="setup-card">
                <h3>⚡ Tingkat Kesulitan</h3>
                <div class="option-btns">
                    <button class="opt-btn active" data-diff="easy" onclick="Game.setDifficulty('easy')">😊 Mudah<br><small>(20 nama)</small></button>
                    <button class="opt-btn" data-diff="hard" onclick="Game.setDifficulty('hard')">🔥 Sulit<br><small>(99 nama)</small></button>
                </div>
            </div>

            <div class="setup-card">
                <h3>⚙️ Pengaturan</h3>
                <div class="toggle-row">
                    <span>⏱️ Timer (10 detik/soal)</span>
                    <div class="toggle active" id="timerToggle" onclick="Game.toggleTimer()"></div>
                </div>
                <div class="toggle-row">
                    <span>🔊 Efek Suara</span>
                    <div class="toggle active" id="soundToggle" onclick="Game.toggleSound()"></div>
                </div>
            </div>

            <div class="leaderboard" id="leaderboardSetup">
                <h3>🏆 Skor Tertinggi</h3>
                <div id="lbList"></div>
            </div>

            <button class="start-btn" onclick="Game.start()">🚀 Mulai Quiz</button>
        </div>

        <!-- Game Screen -->
        <div class="screen" id="gameScreen">
            <div class="game-header">
                <div class="game-stat">
                    <div class="value" id="currentQ">1</div>
                    <div class="label">dari 33</div>
                </div>
                <div class="game-stat">
                    <div class="timer-display" id="timerDisplay">--</div>
                    <div class="label">waktu</div>
                </div>
                <div class="game-stat">
                    <div class="value" id="currentScore">0</div>
                    <div class="label">poin</div>
                </div>
            </div>

            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 0%"></div>
            </div>

            <div class="player-scores" id="multiScores" style="display: none;">
                <div class="player-score-card active" id="p1Card">
                    <div class="name" id="p1Name">Pemain 1</div>
                    <div class="score" id="p1Score">0</div>
                </div>
                <div class="player-score-card" id="p2Card">
                    <div class="name" id="p2Name">Pemain 2</div>
                    <div class="score" id="p2Score">0</div>
                </div>
            </div>

            <div class="question-card" id="questionCard">
                <div class="question-type" id="questionType">Apa arti dari...</div>
                <div class="question-text" id="questionText">Al-Rahman</div>
                <div class="question-hint" id="questionHint"></div>
                <div class="streak-badge" id="streakBadge" style="display: none;">🔥 Streak x1</div>
            </div>

            <div class="options-grid" id="optionsGrid">
                <!-- Options generated by JS -->
            </div>
        </div>

        <!-- Result Screen -->
        <div class="screen" id="resultScreen">
            <div class="result-card">
                <div class="result-icon" id="resultIcon">🏆</div>
                <div class="result-title" id="resultTitle">Selesai!</div>
                <div class="result-score" id="resultScore">0</div>
                <div class="result-detail" id="resultDetail">poin dari 33 soal</div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="value" id="statCorrect">0</div>
                        <div class="label">Benar</div>
                    </div>
                    <div class="stat-item">
                        <div class="value" id="statStreak">0</div>
                        <div class="label">Max Streak</div>
                    </div>
                    <div class="stat-item">
                        <div class="value" id="statTime">0s</div>
                        <div class="label">Waktu</div>
                    </div>
                </div>

                <div class="review-section" id="reviewSection">
                    <h4>📋 Jawaban Salah</h4>
                    <div id="reviewList"></div>
                </div>

                <div class="result-btns">
                    <button class="result-btn secondary" onclick="Game.share()">📤 Share</button>
                    <button class="result-btn primary" onclick="Game.restart()">🔄 Main Lagi</button>
                </div>
            </div>

            <div class="leaderboard" id="leaderboardResult">
                <h3>🏆 Leaderboard</h3>
                <div id="lbListResult"></div>
            </div>
        </div>
    </div>

    <button class="audio-toggle" id="audioBtn" onclick="Game.toggleSound()">🔊</button>

    <script>
        // 99 Asmaul Husna
        const ASMAUL_HUSNA = [
            {ar: "Ar-Rahman", id: "Maha Pengasih"},
            {ar: "Ar-Rahim", id: "Maha Penyayang"},
            {ar: "Al-Malik", id: "Maha Raja"},
            {ar: "Al-Quddus", id: "Maha Suci"},
            {ar: "As-Salam", id: "Maha Memberi Kesejahteraan"},
            {ar: "Al-Mu'min", id: "Maha Memberi Keamanan"},
            {ar: "Al-Muhaimin", id: "Maha Mengatur"},
            {ar: "Al-Aziz", id: "Maha Perkasa"},
            {ar: "Al-Jabbar", id: "Maha Kuasa"},
            {ar: "Al-Mutakabbir", id: "Maha Megah"},
            {ar: "Al-Khaliq", id: "Maha Pencipta"},
            {ar: "Al-Bari", id: "Maha Pelopor"},
            {ar: "Al-Musawwir", id: "Maha Pembentuk"},
            {ar: "Al-Ghaffar", id: "Maha Pengampun"},
            {ar: "Al-Qahhar", id: "Maha Menaklukkan"},
            {ar: "Al-Wahhab", id: "Maha Pemberi"},
            {ar: "Ar-Razzaq", id: "Maha Pemberi Rezeki"},
            {ar: "Al-Fattah", id: "Maha Pembuka"},
            {ar: "Al-Alim", id: "Maha Mengetahui"},
            {ar: "Al-Qabid", id: "Maha Menyempitkan"},
            {ar: "Al-Basit", id: "Maha Melapangkan"},
            {ar: "Al-Khafid", id: "Maha Merendahkan"},
            {ar: "Ar-Rafi", id: "Maha Meninggikan"},
            {ar: "Al-Mu'izz", id: "Maha Memuliakan"},
            {ar: "Al-Mudhill", id: "Maha Menghinakan"},
            {ar: "As-Sami", id: "Maha Mendengar"},
            {ar: "Al-Basir", id: "Maha Melihat"},
            {ar: "Al-Hakam", id: "Maha Menetapkan"},
            {ar: "Al-Adl", id: "Maha Adil"},
            {ar: "Al-Latif", id: "Maha Lembut"},
            {ar: "Al-Khabir", id: "Maha Mengetahui"},
            {ar: "Al-Halim", id: "Maha Penyantun"},
            {ar: "Al-Azim", id: "Maha Agung"},
            {ar: "Al-Ghafur", id: "Maha Pengampun"},
            {ar: "Ash-Shakur", id: "Maha Berterima Kasih"},
            {ar: "Al-Ali", id: "Maha Tinggi"},
            {ar: "Al-Kabir", id: "Maha Besar"},
            {ar: "Al-Hafiz", id: "Maha Memelihara"},
            {ar: "Al-Muqit", id: "Maha Pemberi Kecukupan"},
            {ar: "Al-Hasib", id: "Maha Membuat Perhitungan"},
            {ar: "Al-Jalil", id: "Maha Luhur"},
            {ar: "Al-Karim", id: "Maha Mulia"},
            {ar: "Ar-Raqib", id: "Maha Mengawasi"},
            {ar: "Al-Mujib", id: "Maha Mengabulkan"},
            {ar: "Al-Wasi", id: "Maha Luas"},
            {ar: "Al-Hakim", id: "Maha Bijaksana"},
            {ar: "Al-Wadud", id: "Maha Mencintai"},
            {ar: "Al-Majid", id: "Maha Mulia"},
            {ar: "Al-Ba'ith", id: "Maha Membangkitkan"},
            {ar: "Ash-Shahid", id: "Maha Menyaksikan"},
            {ar: "Al-Haqq", id: "Maha Benar"},
            {ar: "Al-Wakil", id: "Maha Mewakili"},
            {ar: "Al-Qawiyy", id: "Maha Kuat"},
            {ar: "Al-Matin", id: "Maha Kokoh"},
            {ar: "Al-Wali", id: "Maha Melindungi"},
            {ar: "Al-Hamid", id: "Maha Terpuji"},
            {ar: "Al-Muhsi", id: "Maha Menghitung"},
            {ar: "Al-Mubdi", id: "Maha Memulai"},
            {ar: "Al-Mu'id", id: "Maha Mengembalikan"},
            {ar: "Al-Muhyi", id: "Maha Menghidupkan"},
            {ar: "Al-Mumit", id: "Maha Mematikan"},
            {ar: "Al-Hayy", id: "Maha Hidup"},
            {ar: "Al-Qayyum", id: "Maha Mandiri"},
            {ar: "Al-Wajid", id: "Maha Menemukan"},
            {ar: "Al-Majid", id: "Maha Mulia"},
            {ar: "Al-Wahid", id: "Maha Esa"},
            {ar: "As-Samad", id: "Maha Diperlukan"},
            {ar: "Al-Qadir", id: "Maha Kuasa"},
            {ar: "Al-Muqtadir", id: "Maha Berkuasa"},
            {ar: "Al-Muqaddim", id: "Maha Mendahulukan"},
            {ar: "Al-Mu'akhkhir", id: "Maha Mengakhirkan"},
            {ar: "Al-Awwal", id: "Maha Awal"},
            {ar: "Al-Akhir", id: "Maha Akhir"},
            {ar: "Az-Zahir", id: "Maha Nyata"},
            {ar: "Al-Batin", id: "Maha Tersembunyi"},
            {ar: "Al-Wali", id: "Maha Berkuasa"},
            {ar: "Al-Muta'ali", id: "Maha Tinggi"},
            {ar: "Al-Barr", id: "Maha Dermawan"},
            {ar: "At-Tawwab", id: "Maha Penerima Tobat"},
            {ar: "Al-Muntaqim", id: "Maha Pembalas"},
            {ar: "Al-Afuww", id: "Maha Pemaaf"},
            {ar: "Ar-Ra'uf", id: "Maha Penyayang"},
            {ar: "Malik-ul-Mulk", id: "Maha Penguasa Kerajaan"},
            {ar: "Dhul-Jalal-wal-Ikram", id: "Maha Memiliki Kebesaran"},
            {ar: "Al-Muqsit", id: "Maha Adil"},
            {ar: "Al-Jami", id: "Maha Mengumpulkan"},
            {ar: "Al-Ghani", id: "Maha Kaya"},
            {ar: "Al-Mughni", id: "Maha Memberi Kekayaan"},
            {ar: "Al-Mani", id: "Maha Mencegah"},
            {ar: "Ad-Darr", id: "Maha Memberi Derita"},
            {ar: "An-Nafi", id: "Maha Memberi Manfaat"},
            {ar: "An-Nur", id: "Maha Cahaya"},
            {ar: "Al-Hadi", id: "Maha Pemberi Petunjuk"},
            {ar: "Al-Badi", id: "Maha Pencipta"},
            {ar: "Al-Baqi", id: "Maha Kekal"},
            {ar: "Al-Warith", id: "Maha Pewaris"},
            {ar: "Ar-Rasyid", id: "Maha Cerdas"},
            {ar: "As-Sabur", id: "Maha Sabar"}
        ];

        // Easy mode: 20 most common
        const EASY_MODE = [0, 1, 2, 3, 4, 10, 15, 16, 17, 18, 26, 27, 31, 34, 46, 47, 54, 63, 78, 98];

        const Game = {
            mode: 'single',
            difficulty: 'easy',
            timerEnabled: true,
            soundEnabled: true,
            questions: [],
            currentQuestion: 0,
            scores: [0, 0],
            currentPlayer: 0,
            streak: 0,
            maxStreak: 0,
            startTime: 0,
            wrongAnswers: [],
            timerInterval: null,
            timeLeft: 10,

            init() {
                this.loadLeaderboard();
                this.loadSettings();
            },

            setMode(mode) {
                this.mode = mode;
                document.querySelectorAll('[data-mode]').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.mode === mode);
                });
                document.getElementById('playerNames').style.display = mode === 'multi' ? 'block' : 'none';
                this.saveSettings();
            },

            setDifficulty(diff) {
                this.difficulty = diff;
                document.querySelectorAll('[data-diff]').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.diff === diff);
                });
                this.saveSettings();
            },

            toggleTimer() {
                this.timerEnabled = !this.timerEnabled;
                document.getElementById('timerToggle').classList.toggle('active', this.timerEnabled);
                this.saveSettings();
            },

            toggleSound() {
                this.soundEnabled = !this.soundEnabled;
                document.getElementById('soundToggle').classList.toggle('active', this.soundEnabled);
                document.getElementById('audioBtn').textContent = this.soundEnabled ? '🔊' : '🔇';
                this.saveSettings();
            },

            saveSettings() {
                localStorage.setItem('quiz_settings', JSON.stringify({
                    mode: this.mode,
                    difficulty: this.difficulty,
                    timerEnabled: this.timerEnabled,
                    soundEnabled: this.soundEnabled
                }));
            },

            loadSettings() {
                const saved = localStorage.getItem('quiz_settings');
                if (saved) {
                    const s = JSON.parse(saved);
                    this.mode = s.mode || 'single';
                    this.difficulty = s.difficulty || 'easy';
                    this.timerEnabled = s.timerEnabled !== false;
                    this.soundEnabled = s.soundEnabled !== false;

                    document.querySelectorAll('[data-mode]').forEach(btn => {
                        btn.classList.toggle('active', btn.dataset.mode === this.mode);
                    });
                    document.querySelectorAll('[data-diff]').forEach(btn => {
                        btn.classList.toggle('active', btn.dataset.diff === this.difficulty);
                    });
                    document.getElementById('timerToggle').classList.toggle('active', this.timerEnabled);
                    document.getElementById('soundToggle').classList.toggle('active', this.soundEnabled);
                    document.getElementById('audioBtn').textContent = this.soundEnabled ? '🔊' : '🔇';
                    document.getElementById('playerNames').style.display = this.mode === 'multi' ? 'block' : 'none';
                }
            },

            generateQuestions() {
                const pool = this.difficulty === 'easy' ? EASY_MODE : [...Array(99).keys()];
                const shuffled = this.shuffle([...pool]);
                
                // For easy mode (20 names), repeat to get 33 questions
                let selected;
                if (this.difficulty === 'easy') {
                    selected = [];
                    while (selected.length < 33) {
                        selected.push(...shuffled);
                    }
                    selected = selected.slice(0, 33);
                } else {
                    selected = shuffled.slice(0, 33);
                }

                this.questions = selected.map(idx => {
                    const item = ASMAUL_HUSNA[idx];
                    if (!item) return null; // safety check
                    
                    const type = Math.random() > 0.5 ? 'ar-to-id' : 'id-to-ar';
                    
                    let question, answer, options;
                    
                    if (type === 'ar-to-id') {
                        question = item.ar;
                        answer = item.id;
                        options = this.generateOptions(item.id, 'id');
                    } else {
                        question = item.id;
                        answer = item.ar;
                        options = this.generateOptions(item.ar, 'ar');
                    }

                    return { question, answer, options, type, item };
                }).filter(q => q !== null); // remove any null entries
            },

            generateOptions(correct, type) {
                const pool = this.difficulty === 'easy' ? EASY_MODE.map(i => ASMAUL_HUSNA[i]) : ASMAUL_HUSNA;
                const others = pool.filter(item => type === 'id' ? item.id !== correct : item.ar !== correct);
                const shuffled = this.shuffle([...others]);
                const selected = shuffled.slice(0, 3).map(item => type === 'id' ? item.id : item.ar);
                selected.push(correct);
                return this.shuffle(selected);
            },

            shuffle(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            },

            start() {
                this.generateQuestions();
                this.currentQuestion = 0;
                this.scores = [0, 0];
                this.currentPlayer = 0;
                this.streak = 0;
                this.maxStreak = 0;
                this.startTime = Date.now();
                this.wrongAnswers = [];

                document.getElementById('setupScreen').classList.remove('active');
                document.getElementById('gameScreen').classList.add('active');
                document.getElementById('resultScreen').classList.remove('active');

                if (this.mode === 'multi') {
                    document.getElementById('multiScores').style.display = 'flex';
                    document.getElementById('p1Name').textContent = document.getElementById('player1Name').value || 'Pemain 1';
                    document.getElementById('p2Name').textContent = document.getElementById('player2Name').value || 'Pemain 2';
                    this.updateMultiDisplay();
                } else {
                    document.getElementById('multiScores').style.display = 'none';
                }

                this.showQuestion();
            },

            showQuestion() {
                const q = this.questions[this.currentQuestion];
                
                document.getElementById('currentQ').textContent = this.currentQuestion + 1;
                document.getElementById('progressFill').style.width = ((this.currentQuestion) / 33 * 100) + '%';
                
                document.getElementById('questionType').textContent = q.type === 'ar-to-id' ? 'Apa arti dari...' : 'Apa nama Arab dari...';
                document.getElementById('questionText').textContent = q.question;
                document.getElementById('questionHint').textContent = q.type === 'ar-to-id' ? `${q.item.ar}` : `"${q.item.id}"`;
                
                const streakBadge = document.getElementById('streakBadge');
                if (this.streak >= 2) {
                    streakBadge.style.display = 'inline-block';
                    streakBadge.textContent = `🔥 Streak x${this.streak}`;
                } else {
                    streakBadge.style.display = 'none';
                }

                const grid = document.getElementById('optionsGrid');
                grid.innerHTML = '';
                q.options.forEach((opt, idx) => {
                    const btn = document.createElement('button');
                    btn.className = 'option-btn';
                    btn.textContent = opt;
                    btn.onclick = () => this.answer(opt, btn);
                    grid.appendChild(btn);
                });

                if (this.timerEnabled) {
                    this.startTimer();
                } else {
                    document.getElementById('timerDisplay').textContent = '--';
                }

                document.getElementById('questionCard').classList.add('pulse');
                setTimeout(() => document.getElementById('questionCard').classList.remove('pulse'), 500);
            },

            startTimer() {
                this.timeLeft = 10;
                document.getElementById('timerDisplay').textContent = this.timeLeft;
                document.getElementById('timerDisplay').classList.remove('warning');

                clearInterval(this.timerInterval);
                this.timerInterval = setInterval(() => {
                    this.timeLeft--;
                    document.getElementById('timerDisplay').textContent = this.timeLeft;
                    
                    if (this.timeLeft <= 3) {
                        document.getElementById('timerDisplay').classList.add('warning');
                    }
                    
                    if (this.timeLeft <= 0) {
                        clearInterval(this.timerInterval);
                        this.timeUp();
                    }
                }, 1000);
            },

            timeUp() {
                this.streak = 0;
                const q = this.questions[this.currentQuestion];
                this.wrongAnswers.push({ q: q.question, your: '(waktu habis)', correct: q.answer });

                document.querySelectorAll('.option-btn').forEach(btn => {
                    btn.disabled = true;
                    if (btn.textContent === q.answer) {
                        btn.classList.add('correct');
                    }
                });

                this.playSound('wrong');
                setTimeout(() => this.nextQuestion(), 1500);
            },

            answer(selected, btn) {
                clearInterval(this.timerInterval);
                const q = this.questions[this.currentQuestion];
                const correct = selected === q.answer;

                document.querySelectorAll('.option-btn').forEach(b => {
                    b.disabled = true;
                    if (b.textContent === q.answer) {
                        b.classList.add('correct');
                    }
                });

                if (correct) {
                    btn.classList.add('correct');
                    this.streak++;
                    if (this.streak > this.maxStreak) this.maxStreak = this.streak;

                    let points = 10;
                    if (this.timerEnabled && this.timeLeft >= 7) points += 5; // Speed bonus
                    if (this.streak >= 3) points += this.streak; // Streak bonus

                    this.scores[this.currentPlayer] += points;
                    this.playSound('correct');
                } else {
                    btn.classList.add('wrong');
                    this.streak = 0;
                    this.wrongAnswers.push({ q: q.question, your: selected, correct: q.answer });
                    this.playSound('wrong');
                }

                this.updateScoreDisplay();
                setTimeout(() => this.nextQuestion(), 1200);
            },

            updateScoreDisplay() {
                if (this.mode === 'single') {
                    document.getElementById('currentScore').textContent = this.scores[0];
                } else {
                    this.updateMultiDisplay();
                }
            },

            updateMultiDisplay() {
                document.getElementById('p1Score').textContent = this.scores[0];
                document.getElementById('p2Score').textContent = this.scores[1];
                document.getElementById('p1Card').classList.toggle('active', this.currentPlayer === 0);
                document.getElementById('p2Card').classList.toggle('active', this.currentPlayer === 1);
            },

            nextQuestion() {
                this.currentQuestion++;
                
                if (this.mode === 'multi') {
                    this.currentPlayer = this.currentPlayer % 2;
                }

                if (this.currentQuestion >= 33) {
                    this.showResult();
                } else {
                    this.showQuestion();
                }
            },

            showResult() {
                clearInterval(this.timerInterval);
                const totalTime = Math.round((Date.now() - this.startTime) / 1000);
                const correct = 33 - this.wrongAnswers.length;
                const finalScore = this.mode === 'multi' ? Math.max(...this.scores) : this.scores[0];

                document.getElementById('gameScreen').classList.remove('active');
                document.getElementById('resultScreen').classList.add('active');

                // Set result
                let icon, title;
                if (correct >= 30) { icon = '🏆'; title = 'Luar Biasa!'; }
                else if (correct >= 25) { icon = '🌟'; title = 'Hebat!'; }
                else if (correct >= 20) { icon = '👍'; title = 'Bagus!'; }
                else if (correct >= 15) { icon = '😊'; title = 'Lumayan!'; }
                else { icon = '💪'; title = 'Terus Belajar!'; }

                document.getElementById('resultIcon').textContent = icon;
                document.getElementById('resultTitle').textContent = title;
                document.getElementById('resultScore').textContent = finalScore;
                document.getElementById('resultDetail').textContent = `${correct} benar dari 33 soal`;
                
                document.getElementById('statCorrect').textContent = correct;
                document.getElementById('statStreak').textContent = this.maxStreak;
                document.getElementById('statTime').textContent = totalTime + 's';

                // Review wrong answers
                const reviewList = document.getElementById('reviewList');
                if (this.wrongAnswers.length === 0) {
                    document.getElementById('reviewSection').style.display = 'none';
                } else {
                    document.getElementById('reviewSection').style.display = 'block';
                    reviewList.innerHTML = this.wrongAnswers.map(w => `
                        <div class="review-item">
                            <div class="q">❓ ${w.q}</div>
                            <div class="a">❌ Kamu: ${w.your} | ✅ Benar: ${w.correct}</div>
                        </div>
                    `).join('');
                }

                // Save to leaderboard
                this.saveToLeaderboard(finalScore);
                this.loadLeaderboard('lbListResult');
            },

            saveToLeaderboard(score) {
                const name = this.mode === 'multi' 
                    ? (this.scores[0] > this.scores[1] ? document.getElementById('player1Name').value : document.getElementById('player2Name').value)
                    : 'Player';
                
                const lb = JSON.parse(localStorage.getItem('quiz_leaderboard') || '[]');
                lb.push({ name: name || 'Player', score, date: new Date().toLocaleDateString('id-ID') });
                lb.sort((a, b) => b.score - a.score);
                localStorage.setItem('quiz_leaderboard', JSON.stringify(lb.slice(0, 10)));
            },

            loadLeaderboard(targetId = 'lbList') {
                const lb = JSON.parse(localStorage.getItem('quiz_leaderboard') || '[]');
                const el = document.getElementById(targetId);
                
                if (lb.length === 0) {
                    el.innerHTML = '<div style="text-align:center;opacity:0.6;padding:10px;">Belum ada skor</div>';
                } else {
                    el.innerHTML = lb.slice(0, 5).map((item, idx) => `
                        <div class="lb-item">
                            <span class="rank">${idx + 1}.</span>
                            <span class="name">${item.name}</span>
                            <span class="score">${item.score}</span>
                        </div>
                    `).join('');
                }
            },

            share() {
                const correct = 33 - this.wrongAnswers.length;
                const score = this.mode === 'multi' ? Math.max(...this.scores) : this.scores[0];
                const text = `☪️ Quiz Asmaul Husna\n\n🏆 Skor: ${score} poin\n✅ ${correct}/33 benar\n🔥 Max Streak: ${this.maxStreak}\n\nMain juga yuk! 🎮`;

                if (navigator.share) {
                    navigator.share({ text });
                } else {
                    navigator.clipboard.writeText(text);
                    alert('Disalin ke clipboard!');
                }
            },

            restart() {
                document.getElementById('resultScreen').classList.remove('active');
                document.getElementById('setupScreen').classList.add('active');
            },

            playSound(type) {
                if (!this.soundEnabled) return;
                
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                
                osc.connect(gain);
                gain.connect(ctx.destination);
                
                if (type === 'correct') {
                    osc.frequency.value = 523.25; // C5
                    osc.type = 'sine';
                    gain.gain.value = 0.1;
                } else {
                    osc.frequency.value = 200;
                    osc.type = 'square';
                    gain.gain.value = 0.05;
                }
                
                osc.start();
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.2);
                osc.stop(ctx.currentTime + 0.2);
            }
        };

        document.addEventListener('DOMContentLoaded', () => Game.init());
    </script>
</body>
</html>
