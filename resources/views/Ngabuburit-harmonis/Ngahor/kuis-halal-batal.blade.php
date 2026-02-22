<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>❓ Kuis Halal/Batal? - Ngabuburit Harmonis</title>
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
            --success: #10B981;
            --error: #EF4444;
            --warning: #F59E0B;
            --info: #3B82F6;
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
            max-width: 900px;
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
            padding: 20px 0;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
            cursor: pointer;
        }

        .back-btn:hover {
            background: rgba(212, 175, 55, 0.3);
            transform: translateX(-5px);
        }

        .header h1 {
            font-family: 'Amiri', serif;
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            color: var(--primary-gold);
            text-shadow: 0 0 20px var(--shadow-gold);
            text-align: center;
        }

        .audio-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-light));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .audio-btn:hover {
            transform: scale(1.1);
        }

        /* Instructions Section */
        .instructions {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 20px;
            padding: 25px;
            margin: 20px 0;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .instructions h3 {
            font-family: 'Amiri', serif;
            color: var(--primary-gold);
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .instructions ol {
            margin-left: 20px;
            line-height: 1.8;
        }

        .instructions li {
            margin-bottom: 10px;
            opacity: 0.9;
        }

        /* Level Selection */
        .level-select {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin: 25px 0;
        }

        .level-btn {
            padding: 15px 25px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .level-btn:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--primary-gold);
        }

        .level-btn.active {
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            border-color: var(--emerald-green);
            transform: scale(1.05);
        }

        .level-btn small {
            display: block;
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 4px;
        }

        /* Start Screen */
        .start-screen {
            text-align: center;
            padding: 40px 20px;
        }

        .start-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 18px 50px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.4);
            margin: 20px 10px;
        }

        .start-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 40px rgba(16, 185, 129, 0.5);
        }

        .resume-btn {
            background: linear-gradient(135deg, var(--warning), #d97706);
            box-shadow: 0 8px 30px rgba(245, 158, 11, 0.4);
        }

        .resume-btn:hover {
            box-shadow: 0 12px 40px rgba(245, 158, 11, 0.5);
        }

        /* Quiz Area */
        .quiz-area {
            display: none;
        }

        .quiz-area.active {
            display: block;
        }

        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
        }

        .question-counter {
            font-size: 1.1rem;
            color: var(--gold-light);
        }

        .timer-display {
            font-family: 'Amiri', serif;
            font-size: 1.5rem;
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .timer-display.warning {
            color: var(--error);
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--emerald-green), var(--emerald-dark));
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        .question-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 25px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .question-text {
            font-size: 1.2rem;
            line-height: 1.7;
            margin-bottom: 25px;
            color: var(--cream);
        }

        .options-grid {
            display: grid;
            gap: 15px;
        }

        .option-btn {
            padding: 18px 25px;
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-btn:hover:not(:disabled) {
            background: rgba(212, 175, 55, 0.1);
            border-color: var(--primary-gold);
            transform: translateX(10px);
        }

        .option-btn.correct {
            background: rgba(16, 185, 129, 0.3);
            border-color: var(--success);
        }

        .option-btn.wrong {
            background: rgba(239, 68, 68, 0.3);
            border-color: var(--error);
        }

        .option-btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .feedback {
            display: none;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            text-align: center;
            animation: fadeIn 0.3s ease-out;
        }

        .feedback.show {
            display: block;
        }

        .feedback.correct {
            background: rgba(16, 185, 129, 0.2);
            border: 2px solid var(--success);
        }

        .feedback.wrong {
            background: rgba(239, 68, 68, 0.2);
            border: 2px solid var(--error);
        }

        .feedback-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .next-btn {
            display: none;
            margin: 20px auto;
        }

        .next-btn.show {
            display: block;
        }

        /* Results Screen */
        .results-screen {
            display: none;
            text-align: center;
            padding: 30px 20px;
        }

        .results-screen.active {
            display: block;
        }

        .results-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .score-display {
            font-family: 'Amiri', serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--primary-gold);
            text-shadow: 0 0 30px var(--shadow-gold);
            margin: 20px 0;
        }

        .score-label {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .result-badge {
            display: inline-block;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 20px 0;
        }

        .result-badge.excellent {
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
        }

        .result-badge.good {
            background: linear-gradient(135deg, var(--warning), #d97706);
            color: white;
        }

        .result-badge.needs-improvement {
            background: linear-gradient(135deg, var(--error), #dc2626);
            color: white;
        }

        .result-message {
            font-size: 1.1rem;
            line-height: 1.7;
            opacity: 0.9;
            margin: 20px 0;
        }

        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin: 30px 0;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .share-btn.whatsapp {
            background: #25D366;
            color: white;
        }

        .share-btn.facebook {
            background: #1877F2;
            color: white;
        }

        .share-btn.copy {
            background: var(--primary-gold);
            color: var(--night-dark);
        }

        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        /* Leaderboard */
        .leaderboard {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 20px;
            padding: 25px;
            margin: 30px 0;
        }

        .leaderboard h3 {
            font-family: 'Amiri', serif;
            color: var(--primary-gold);
            font-size: 1.4rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .leaderboard-list {
            list-style: none;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .leaderboard-item:nth-child(1) {
            background: rgba(255, 215, 0, 0.15);
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .leaderboard-item:nth-child(2) {
            background: rgba(192, 192, 192, 0.15);
            border: 1px solid rgba(192, 192, 192, 0.3);
        }

        .leaderboard-item:nth-child(3) {
            background: rgba(205, 127, 50, 0.15);
            border: 1px solid rgba(205, 127, 50, 0.3);
        }

        .rank {
            font-weight: 700;
            width: 40px;
            color: var(--primary-gold);
        }

        .player-name {
            flex: 1;
            text-align: left;
        }

        .player-score {
            font-weight: 700;
            color: var(--emerald-green);
        }

        .player-date {
            font-size: 0.8rem;
            opacity: 0.6;
        }

        /* Control Buttons */
        .control-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .control-btn {
            padding: 12px 25px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-btn:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--primary-gold);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                justify-content: center;
            }

            .question-card {
                padding: 20px;
            }

            .question-text {
                font-size: 1rem;
            }

            .option-btn {
                padding: 15px 20px;
                font-size: 0.95rem;
            }

            .score-display {
                font-size: 3rem;
            }

            .level-select {
                flex-direction: column;
            }

            .level-btn {
                width: 100%;
                max-width: 300px;
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
            <a href="/Ngabuburit-harmonis" class="back-btn">
                ← Kembali
            </a>
            <h1>❓ Kuis Halal/Batal?</h1>
            <button class="audio-btn" id="audioToggle">🔇</button>
        </header>

        <!-- Start Screen -->
        <div class="start-screen" id="startScreen">
            <div class="instructions">
                <h3>📖 Cara Bermain</h3>
                <ol>
                    <li>Pilih tingkat kesulitan yang diinginkan</li>
                    <li>Klik "Mulai Kuis" untuk memulai</li>
                    <li>Jawab pertanyaan fiqih tentang puasa dan interaksi suami-istri</li>
                    <li>Pada level Sulit, setiap pertanyaan ada batas waktu 30 detik</li>
                    <li>Selesaikan semua pertanyaan untuk melihat hasil</li>
                    <li>Bagikan hasilmu ke pasangan atau media sosial!</li>
                </ol>
            </div>

            <div class="level-select">
                <button class="level-btn active" data-level="mudah" onclick="selectLevel('mudah')">
                    Mudah
                    <small>10 soal • Tanpa timer</small>
                </button>
                <button class="level-btn" data-level="sedang" onclick="selectLevel('sedang')">
                    Sedang
                    <small>15 soal • Tanpa timer</small>
                </button>
                <button class="level-btn" data-level="sulit" onclick="selectLevel('sulit')">
                    Sulit
                    <small>20 soal • Timer 30 detik</small>
                </button>
            </div>

            <button class="start-btn" onclick="startQuiz()">🚀 Mulai Kuis</button>
            <button class="start-btn resume-btn hidden" id="resumeBtn" onclick="resumeQuiz()">📂 Lanjutkan Kuis</button>

            <div class="leaderboard" id="startLeaderboard">
                <h3>🏆 Papan Peringkat</h3>
                <ul class="leaderboard-list" id="leaderboardList">
                    <li class="leaderboard-item" style="justify-content: center; opacity: 0.7;">
                        Belum ada skor tersimpan
                    </li>
                </ul>
            </div>
        </div>

        <!-- Quiz Area -->
        <div class="quiz-area" id="quizArea">
            <div class="quiz-header">
                <div class="question-counter">
                    Soal <span id="currentQ">1</span> dari <span id="totalQ">10</span>
                </div>
                <div class="timer-display hidden" id="timerDisplay">
                    ⏱️ <span id="timerValue">30</span>s
                </div>
            </div>

            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 0%"></div>
            </div>

            <div class="question-card">
                <p class="question-text" id="questionText">Loading...</p>
                <div class="options-grid" id="optionsGrid">
                    <!-- Options will be generated here -->
                </div>
            </div>

            <div class="feedback" id="feedback">
                <div class="feedback-icon" id="feedbackIcon"></div>
                <p id="feedbackText"></p>
            </div>

            <button class="start-btn next-btn" id="nextBtn" onclick="nextQuestion()">Selanjutnya →</button>

            <div class="control-buttons">
                <button class="control-btn" onclick="saveProgressManually()">💾 Simpan Progress</button>
                <button class="control-btn" onclick="resetQuiz()">🔄 Reset Kuis</button>
            </div>
        </div>

        <!-- Results Screen -->
        <div class="results-screen" id="resultsScreen">
            <div class="results-card">
                <div class="score-label">Skor Kamu</div>
                <div class="score-display" id="finalScore">0%</div>
                <div class="result-badge" id="resultBadge">Luar Biasa!</div>
                <p class="result-message" id="resultMessage"></p>
            </div>

            <div class="share-buttons">
                <button class="share-btn whatsapp" onclick="shareWhatsApp()">
                    📱 WhatsApp
                </button>
                <button class="share-btn facebook" onclick="shareFacebook()">
                    📘 Facebook
                </button>
                <button class="share-btn copy" onclick="copyResult()">
                    📋 Copy
                </button>
            </div>

            <div class="leaderboard">
                <h3>🏆 Papan Peringkat</h3>
                <ul class="leaderboard-list" id="finalLeaderboard"></ul>
            </div>

            <div class="control-buttons">
                <button class="start-btn" onclick="restartQuiz()">🔄 Main Lagi</button>
                <button class="control-btn" onclick="goHome()">🏠 Kembali ke Menu</button>
            </div>
        </div>
    </div>

    <script>
        // Questions Database
        const questions = [
            // Fiqih Puasa
            {
                question: "Apa hukum berpuasa bagi orang yang sedang bepergian (safar)?",
                options: ["Haram", "Wajib", "Sunnah", "Mubah (diperbolehkan berpuasa atau tidak)"],
                correct: 3,
                explanation: "Orang yang bepergian diperbolehkan untuk berpuasa atau tidak berpuasa (mubah). Jika tidak berpuasa, wajib mengganti di lain hari."
            },
            {
                question: "Apa hukum mandi junub bagi suami istri di siang hari bulan Ramadhan?",
                options: ["Membatalkan puasa", "Tidak membatalkan puasa", "Makruh", "Haram"],
                correct: 1,
                explanation: "Mandi junub di siang hari tidak membatalkan puasa. Yang membatalkan adalah keluarnya mani karena hubungan suami istri."
            },
            {
                question: "Apakah hukum bersuci (bersiwak) di siang hari bagi orang yang berpuasa?",
                options: ["Makruh", "Haram", "Sunnah", "Membatalkan puasa"],
                correct: 2,
                explanation: "Bersiwak di siang hari bagi orang berpuasa adalah sunnah, terutama setelah Zuhur dan saat berbuka."
            },
            {
                question: "Apa hukum menggunakan obat tetes mata saat berpuasa?",
                options: ["Membatalkan puasa", "Tidak membatalkan puasa", "Makruh", "Haram"],
                correct: 1,
                explanation: "Menurut jumhur ulama, obat tetes mata tidak membatalkan puasa karena mata bukan jalannya makanan dan minuman."
            },
            {
                question: "Apakah hukum mencium istri bagi suami yang berpuasa?",
                options: ["Haram", "Membatalkan puasa", "Diperbolehkan selama bisa menahan nafsu", "Wajib"],
                correct: 2,
                explanation: "Mencium istri diperbolehkan bagi yang bisa menahan diri. Namun jika takut terjerumus, sebaiknya ditinggalkan."
            },
            {
                question: "Apa hukum suntik vitamin saat berpuasa?",
                options: ["Membatalkan puasa", "Tidak membatalkan puasa", "Makruh", "Haram"],
                correct: 1,
                explanation: "Suntik vitamin atau obat yang bukan untuk nutrisi/makanan tidak membatalkan puasa menurut jumhur ulama."
            },
            {
                question: "Apakah hukum bermimpi basah (keluar mani saat tidur) di siang hari Ramadhan?",
                options: ["Membatalkan puasa dan berdosa", "Membatalkan puasa tapi tidak berdosa", "Tidak membatalkan puasa", "Makruh"],
                correct: 2,
                explanation: "Keluar mani saat tidur (mimpi basah) tidak membatalkan puasa karena tidak disengaja. Tetap wajib mandi junub."
            },
            {
                question: "Apa hukum bagi orang yang berbuka puasa dengan alasan syar'i (seperti sakit)?",
                options: ["Berdosa", "Tidak berdosa", "Wajib mengqadha", "Tidak berdosa dan wajib mengqadha"],
                correct: 3,
                explanation: "Tidak berdosa bagi yang berbuka dengan alasan syar'i, dan wajib mengqadha puasa tersebut di hari lain."
            },
            {
                question: "Apa hukum menggunakan inhaler untuk penderita asma saat berpuasa?",
                options: ["Membatalkan puasa", "Tidak membatalkan puasa", "Makruh", "Haram"],
                correct: 0,
                explanation: "Inhaler mengandung zat yang masuk ke tenggorokan, sehingga menurut mayoritas ulama membatalkan puasa. Penderita asma bisa berbuka dengan alasan sakit."
            },
            {
                question: "Apakah hukum menelan air liur berlebih saat berpuasa?",
                options: ["Tidak membatalkan", "Membatalkan puasa", "Makruh", "Haram"],
                correct: 0,
                explanation: "Menelan air liur yang biasa tidak membatalkan puasa. Namun mengumpulkan air liur lalu menelannya secara sengaja dibedakan oleh sebagian ulama."
            },
            // Fiqih Suami Istri
            {
                question: "Apakah hukum hubungan suami istri di siang hari bulan Ramadhan?",
                options: ["Mubah", "Sunnah", "Haram dan membatalkan puasa", "Makruh"],
                correct: 2,
                explanation: "Hubungan suami istri di siang hari Ramadhan adalah haram dan membatalkan puasa. Pelakunya harus mengqadha dan berdosa."
            },
            {
                question: "Apakah hukum hubungan suami istri di malam hari bulan Ramadhan?",
                options: ["Haram", "Makruh", "Diperbolehkan (halal)", "Membatalkan pahala puasa"],
                correct: 2,
                explanation: "Hubungan suami istri di malam hari Ramadhan adalah halal dan diperbolehkan. Allah SWT berfirman: Halal bagumu di malam-hari puasa."
            },
            {
                question: "Apa hukum mensucikan diri (mandi wajib) setelah hubungan suami istri sebelum Subuh di bulan Ramadhan?",
                options: ["Haram", "Makruh", "Sunnah dan diperbolehkan", "Membatalkan puasa"],
                correct: 2,
                explanation: "Mandi wajib setelah hubungan suami istri sebelum Subuh diperbolehkan. Bahkan junub tidak menghalangi seseorang untuk berniat puasa."
            },
            {
                question: "Apa hukum puasa bagi wanita yang mengalami haid di siang hari?",
                options: ["Sah puasanya", "Batal dan wajib mengqadha", "Sah tapi berdosa", "Makruh"],
                correct: 1,
                explanation: "Jika datang haid di siang hari, puasa batal. Wanita harus mengqadha puasa tersebut di hari lain. Tidak berdosa karena hal ini di luar kendali."
            },
            {
                question: "Apa hukum berciuman dengan nafsu berahi bagi orang yang berpuasa?",
                options: ["Sunnah", "Diperbolehkan", "Dilakukan, tapi jika keluar mani maka batal", "Haram"],
                correct: 2,
                explanation: "Berciuman dengan nafsu berbahaya karena jika keluar mani maka batal puasa dan wajib mengqadha. Sebaiknya dijauhi."
            },
            {
                question: "Apa hukum menggauli istri dengan selain jalan biasa (anal/oral) saat puasa?",
                options: ["Diperbolehkan", "Haram", "Makruh", "Mubah"],
                correct: 1,
                explanation: "Hubungan suami istri hanya boleh melalui jalan yang diperintahkan Allah (farj). Cara lain adalah haram baik saat puasa maupun tidak."
            },
            {
                question: "Apa hukum berpuasa bagi istri yang ditalak suaminya di siang hari?",
                options: ["Sah dan tetap wajib", "Batal", "Sunnah", "Makruh"],
                correct: 0,
                explanation: "Talak tidak mempengaruhi keabsahan puasa. Wanita yang ditalak tetap wajib melanjutkan puasanya jika masih di siang hari."
            },
            {
                question: "Apakah suami wajib mengganti puasa istri yang meninggal dunia dengan hutang puasa?",
                options: ["Tidak wajib", "Wajib mengganti", "Sunnah", "Haram"],
                correct: 1,
                explanation: "Jika istri meninggal dengan hutang puasa (fadlu Ramadhan), suami atau walinya disunnahkan untuk mengganti puasanya sebagaimana hadits dari Aisyah."
            },
            {
                question: "Apa hukum berpuasa sunnah bagi istri tanpa izin suami?",
                options: ["Wajib", "Diperbolehkan", "Makruh", "Tidak boleh kecuali dengan izin suami"],
                correct: 3,
                explanation: "Istri tidak boleh berpuasa sunnah tanpa izin suami karena hak suami atas istrinya lebih utama. Namun untuk puasa wajib, tidak perlu izin."
            },
            {
                question: "Apakah hukum ijtima' tanpa ejaculasi saat berpuasa?",
                options: ["Tidak membatalkan", "Membatalkan puasa", "Makruh", "Haram"],
                correct: 0,
                explanation: "Ijtima' tanpa keluar mani tidak membatalkan puasa menurut jumhur ulama. Namun jika takut keluar mani, sebaiknya dijauhi."
            },
            {
                question: "Apa hukum menggunakan pil kontrasepsi untuk mencegah kehamilan saat Ramadhan?",
                options: ["Haram", "Diperbolehkan dengan syarat", "Makruh", "Membatalkan puasa"],
                correct: 1,
                explanation: "Menggunakan KB diperbolehkan dengan syarat: tidak membahayakan, atas kesepakatan suami istri, dan bukan untuk takut miskin."
            },
            {
                question: "Apakah hukum hubungan suami istri setelah imsak tapi sebelum Subuh?",
                options: ["Haram", "Diperbolehkan", "Makruh", "Membatalkan puasa"],
                correct: 1,
                explanation: "Hubungan suami istri diperbolehkan hingga terbit fajar shadiq (Subuh). Setelah masuk waktu Subuh, baru tidak diperbolehkan."
            }
        ];

        // Game State
        let currentLevel = 'mudah';
        let currentQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let timer = null;
        let timeLeft = 30;
        let audioEnabled = false;

        // Audio Context
        let audioCtx = null;

        // Level configurations
        const levelConfig = {
            mudah: { count: 10, timer: null },
            sedang: { count: 15, timer: null },
            sulit: { count: 20, timer: 30 }
        };

        // Initialize stars
        function initStars() {
            const container = document.getElementById('starsBackground');
            container.innerHTML = '';
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.cssText = 'left:' + Math.random() * 100 + '%;top:' + Math.random() * 100 + '%;width:' + (Math.random() * 3 + 1) + 'px;height:' + star.style.width + ';animation-delay:' + Math.random() * 5 + 's;animation-duration:' + (Math.random() * 3 + 2) + 's';
                container.appendChild(star);
            }
        }

        // Audio functions
        function initAudio() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
        }

        function playCorrectSound() {
            if (!audioEnabled) return;
            initAudio();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            [523, 659, 784].forEach((freq, i) => {
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.frequency.value = freq;
                gain.gain.setValueAtTime(0.1, audioCtx.currentTime + i * 0.1);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + i * 0.1 + 0.3);
                osc.start(audioCtx.currentTime + i * 0.1);
                osc.stop(audioCtx.currentTime + i * 0.1 + 0.3);
            });
        }

        function playWrongSound() {
            if (!audioEnabled) return;
            initAudio();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.frequency.setValueAtTime(200, audioCtx.currentTime);
            osc.frequency.linearRampToValueAtTime(100, audioCtx.currentTime + 0.3);
            gain.gain.setValueAtTime(0.2, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.3);
        }

        function playCompleteSound() {
            if (!audioEnabled) return;
            initAudio();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            [523, 659, 784, 1047, 1319].forEach((freq, i) => {
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.frequency.value = freq;
                gain.gain.setValueAtTime(0.12, audioCtx.currentTime + i * 0.12);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + i * 0.12 + 0.4);
                osc.start(audioCtx.currentTime + i * 0.12);
                osc.stop(audioCtx.currentTime + i * 0.12 + 0.4);
            });
        }

        // Audio toggle
        document.getElementById('audioToggle').addEventListener('click', function() {
            initAudio();
            audioEnabled = !audioEnabled;
            if (audioEnabled && audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
            this.textContent = audioEnabled ? '🔊' : '🔇';
        });

        // Level selection
        function selectLevel(level) {
            currentLevel = level;
            document.querySelectorAll('.level-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.level === level) {
                    btn.classList.add('active');
                }
            });
        }

        // Shuffle array
        function shuffleArray(array) {
            const newArray = [...array];
            for (let i = newArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
            }
            return newArray;
        }

        // Start quiz
        function startQuiz() {
            const config = levelConfig[currentLevel];
            currentQuestions = shuffleArray(questions).slice(0, config.count);
            currentQuestionIndex = 0;
            score = 0;

            clearProgress();
            showQuizArea();
            loadQuestion();
        }

        // Resume quiz
        function resumeQuiz() {
            const saved = loadProgress();
            if (saved) {
                currentLevel = saved.level;
                currentQuestions = saved.questions;
                currentQuestionIndex = saved.index;
                score = saved.score;

                // Update level button
                document.querySelectorAll('.level-btn').forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.level === currentLevel) {
                        btn.classList.add('active');
                    }
                });

                showQuizArea();
                loadQuestion();
            }
        }

        // Show quiz area
        function showQuizArea() {
            document.getElementById('startScreen').classList.add('hidden');
            document.getElementById('quizArea').classList.add('active');
            document.getElementById('totalQ').textContent = currentQuestions.length;
        }

        // Load question
        function loadQuestion() {
            const q = currentQuestions[currentQuestionIndex];
            document.getElementById('currentQ').textContent = currentQuestionIndex + 1;
            document.getElementById('questionText').textContent = q.question;
            document.getElementById('progressFill').style.width = ((currentQuestionIndex) / currentQuestions.length * 100) + '%';

            // Hide feedback and next button
            document.getElementById('feedback').classList.remove('show');
            document.getElementById('nextBtn').classList.remove('show');

            // Generate options
            const optionsGrid = document.getElementById('optionsGrid');
            optionsGrid.innerHTML = '';
            q.options.forEach((option, index) => {
                const btn = document.createElement('button');
                btn.className = 'option-btn';
                btn.textContent = `${String.fromCharCode(65 + index)}. ${option}`;
                btn.onclick = () => checkAnswer(index);
                optionsGrid.appendChild(btn);
            });

            // Timer for hard level
            const timerDisplay = document.getElementById('timerDisplay');
            if (currentLevel === 'sulit') {
                timerDisplay.classList.remove('hidden');
                startTimer();
            } else {
                timerDisplay.classList.add('hidden');
            }
        }

        // Start timer
        function startTimer() {
            clearInterval(timer);
            timeLeft = 30;
            document.getElementById('timerValue').textContent = timeLeft;
            document.getElementById('timerDisplay').classList.remove('warning');

            timer = setInterval(() => {
                timeLeft--;
                document.getElementById('timerValue').textContent = timeLeft;

                if (timeLeft <= 10) {
                    document.getElementById('timerDisplay').classList.add('warning');
                }

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    checkAnswer(-1);
                }
            }, 1000);
        }

        // Check answer
        function checkAnswer(selectedIndex) {
            clearInterval(timer);
            const q = currentQuestions[currentQuestionIndex];
            const isCorrect = selectedIndex === q.correct;
            const options = document.querySelectorAll('.option-btn');

            options.forEach((btn, index) => {
                btn.disabled = true;
                if (index === q.correct) {
                    btn.classList.add('correct');
                } else if (index === selectedIndex && !isCorrect) {
                    btn.classList.add('wrong');
                }
            });

            const feedback = document.getElementById('feedback');
            const feedbackIcon = document.getElementById('feedbackIcon');
            const feedbackText = document.getElementById('feedbackText');

            if (isCorrect) {
                score++;
                feedback.className = 'feedback show correct';
                feedbackIcon.textContent = '✅';
                feedbackText.textContent = 'Benar! ' + q.explanation;
                playCorrectSound();
            } else {
                feedback.className = 'feedback show wrong';
                feedbackIcon.textContent = selectedIndex === -1 ? '⏱️' : '❌';
                feedbackText.textContent = selectedIndex === -1 ? 'Waktu habis! ' : 'Salah! ';
                feedbackText.textContent += `Jawaban yang benar: ${String.fromCharCode(65 + q.correct)}. ${q.options[q.correct]}. ${q.explanation}`;
                playWrongSound();
            }

            document.getElementById('nextBtn').classList.add('show');
            saveProgress();
        }

        // Next question
        function nextQuestion() {
            currentQuestionIndex++;

            if (currentQuestionIndex >= currentQuestions.length) {
                showResults();
            } else {
                loadQuestion();
            }
        }

        // Show results
        function showResults() {
            clearInterval(timer);
            playCompleteSound();

            document.getElementById('quizArea').classList.remove('active');
            document.getElementById('resultsScreen').classList.add('active');

            const percentage = Math.round((score / currentQuestions.length) * 100);
            document.getElementById('finalScore').textContent = percentage + '%';

            const badge = document.getElementById('resultBadge');
            const message = document.getElementById('resultMessage');

            if (percentage >= 80) {
                badge.textContent = '🌟 Luar Biasa!';
                badge.className = 'result-badge excellent';
                message.textContent = 'Masya Allah! Pengetahuan fiqihmu sangat baik. Teruslah belajar dan amalkan ilmumu!';
            } else if (percentage >= 60) {
                badge.textContent = '👍 Bagus!';
                badge.className = 'result-badge good';
                message.textContent = 'Pengetahuanmu cukup baik. Tingkatkan terus dengan belajar fiqih puasa dan pernikahan!';
            } else {
                badge.textContent = '📚 Perlu Belajar Lagi';
                badge.className = 'result-badge needs-improvement';
                message.textContent = 'Jangan menyerah! Perbanyak belajar fiqih, bisa dari buku, pengajian, atau ustaz terpercaya.';
            }

            // Save to leaderboard
            saveToLeaderboard(score, currentQuestions.length);
            clearProgress();

            // Update leaderboard display
            updateLeaderboardDisplay();
        }

        // Save progress
        function saveProgress() {
            const state = {
                level: currentLevel,
                questions: currentQuestions,
                index: currentQuestionIndex,
                score: score,
                timestamp: new Date().toISOString()
            };
            localStorage.setItem('kuis_halal_batal_progress', JSON.stringify(state));
        }

        // Load progress
        function loadProgress() {
            const saved = localStorage.getItem('kuis_halal_batal_progress');
            return saved ? JSON.parse(saved) : null;
        }

        // Clear progress
        function clearProgress() {
            localStorage.removeItem('kuis_halal_batal_progress');
        }

        // Save progress manually
        function saveProgressManually() {
            saveProgress();
            alert('✅ Progress tersimpan! Anda bisa melanjutkan nanti.');
        }

        // Reset quiz
        function resetQuiz() {
            if (confirm('Apakah Anda yakin ingin mereset kuis? Semua progress akan hilang.')) {
                clearProgress();
                document.getElementById('quizArea').classList.remove('active');
                document.getElementById('startScreen').classList.remove('hidden');
                clearInterval(timer);
            }
        }

        // Save to leaderboard
        function saveToLeaderboard(correct, total) {
            let leaderboard = JSON.parse(localStorage.getItem('kuis_halal_batal_leaderboard')) || [];
            leaderboard.push({
                score: correct,
                total: total,
                level: currentLevel,
                date: new Date().toISOString()
            });
            leaderboard.sort((a, b) => (b.score / b.total) - (a.score / a.total));
            leaderboard = leaderboard.slice(0, 10);
            localStorage.setItem('kuis_halal_batal_leaderboard', JSON.stringify(leaderboard));
        }

        // Get leaderboard
        function getLeaderboard() {
            return JSON.parse(localStorage.getItem('kuis_halal_batal_leaderboard')) || [];
        }

        // Update leaderboard display
        function updateLeaderboardDisplay() {
            const leaderboard = getLeaderboard();
            const listHtml = leaderboard.length > 0 ? leaderboard.map((entry, i) => {
                const date = new Date(entry.date);
                const dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                return `
                    <li class="leaderboard-item">
                        <span class="rank">#${i + 1}</span>
                        <span class="player-name">Level ${entry.level.charAt(0).toUpperCase() + entry.level.slice(1)}</span>
                        <span class="player-score">${entry.score}/${entry.total}</span>
                        <span class="player-date">${dateStr}</span>
                    </li>
                `;
            }).join('') : '<li class="leaderboard-item" style="justify-content: center; opacity: 0.7;">Belum ada skor tersimpan</li>';

            document.getElementById('finalLeaderboard').innerHTML = listHtml;
        }

        // Update start screen leaderboard
        function updateStartLeaderboard() {
            const leaderboard = getLeaderboard();
            const listHtml = leaderboard.length > 0 ? leaderboard.map((entry, i) => {
                const date = new Date(entry.date);
                const dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                return `
                    <li class="leaderboard-item">
                        <span class="rank">#${i + 1}</span>
                        <span class="player-name">Level ${entry.level.charAt(0).toUpperCase() + entry.level.slice(1)}</span>
                        <span class="player-score">${entry.score}/${entry.total}</span>
                        <span class="player-date">${dateStr}</span>
                    </li>
                `;
            }).join('') : '<li class="leaderboard-item" style="justify-content: center; opacity: 0.7;">Belum ada skor tersimpan</li>';

            document.getElementById('leaderboardList').innerHTML = listHtml;
        }

        // Share functions
        function getShareText() {
            const percentage = Math.round((score / currentQuestions.length) * 100);
            return `🌙 Kuis Halal/Batal - Ngabuburit Harmonis\n\nSaya baru saja menyelesaikan kuis fiqih dengan skor ${score}/${currentQuestions.length} (${percentage}%)!\n\nYuk uji pengetahuan fiqihmu bersama pasangan! 🕌\n\nhttps://alcaofficial.com/Ngabuburit-harmonis/kuis-halal-batal`;
        }

        function shareWhatsApp() {
            const text = encodeURIComponent(getShareText());
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function shareFacebook() {
            const url = encodeURIComponent('https://alcaofficial.com/Ngabuburit-harmonis/kuis-halal-batal');
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function copyResult() {
            navigator.clipboard.writeText(getShareText()).then(() => {
                alert('✅ Hasil berhasil disalin! Paste ke WhatsApp atau media sosial lainnya.');
            }).catch(() => {
                const textArea = document.createElement('textarea');
                textArea.value = getShareText();
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert('✅ Hasil berhasil disalin! Paste ke WhatsApp atau media sosial lainnya.');
            });
        }

        // Restart quiz
        function restartQuiz() {
            document.getElementById('resultsScreen').classList.remove('active');
            document.getElementById('startScreen').classList.remove('hidden');
        }

        // Go home
        function goHome() {
            window.location.href = '/Ngabuburit-harmonis';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initStars();
            updateStartLeaderboard();

            // Check for saved progress
            const saved = loadProgress();
            if (saved) {
                document.getElementById('resumeBtn').classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
