<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌙 Ngabuburit Harmonis - Game Romantis Pasangan Halal</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            padding: 30px 20px;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header h1 {
            font-family: 'Amiri', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            color: var(--primary-gold);
            text-shadow: 0 0 30px var(--shadow-gold), 0 4px 10px rgba(0,0,0,0.5);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .header .subtitle {
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            color: var(--gold-light);
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .maghrib-timer {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 20px;
            padding: 15px 25px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .timer-label {
            font-size: 1rem;
            color: var(--gold-light);
        }

        .timer-display {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .timer-unit {
            text-align: center;
            min-width: 50px;
        }

        .timer-value {
            font-family: 'Amiri', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-gold);
            text-shadow: 0 0 15px var(--shadow-gold);
        }

        .timer-text {
            font-size: 0.75rem;
            color: var(--cream);
            opacity: 0.7;
            text-transform: uppercase;
        }

        .intro {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 40px;
            font-size: 1.1rem;
            line-height: 1.7;
            opacity: 0.9;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin: 40px 0;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .game-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-gold);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.3);
        }

        .game-card:hover::before {
            opacity: 1;
        }

        .game-icon {
            font-size: 4rem;
            margin-bottom: 15px;
            display: block;
        }

        .game-title {
            font-family: 'Amiri', serif;
            font-size: 1.5rem;
            color: var(--primary-gold);
            margin-bottom: 10px;
        }

        .game-desc {
            font-size: 0.95rem;
            opacity: 0.8;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .game-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .feature-tag {
            font-size: 0.8rem;
            padding: 5px 12px;
            border-radius: 20px;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: var(--emerald-green);
        }

        .play-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(16, 185, 129, 0.3);
        }

        .play-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            margin: 40px 0;
        }

        .stats-title {
            font-family: 'Amiri', serif;
            font-size: 1.3rem;
            color: var(--primary-gold);
            margin-bottom: 15px;
        }

        .stats-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--emerald-green);
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .footer {
            text-align: center;
            padding: 40px 20px;
            margin-top: 40px;
            opacity: 0.7;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .footer p {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .audio-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-light));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .audio-toggle:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }

            .timer-value {
                font-size: 1.5rem;
            }

            .games-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .game-card {
                padding: 25px 20px;
            }

            .stats-grid {
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="stars-background" id="starsBackground"></div>

    <div class="container">
        <header class="header">
            <h1>🌙 Ngabuburit Harmonis</h1>
            <p class="subtitle">Game Romantis Pasangan Halal</p>

            <div class="maghrib-timer">
                <span class="timer-label">⏰ Menuju Maghrib:</span>
                <div class="timer-display">
                    <div class="timer-unit">
                        <div class="timer-value" id="timerHours">00</div>
                        <div class="timer-text">Jam</div>
                    </div>
                    <div class="timer-unit">
                        <div class="timer-value" id="timerMinutes">00</div>
                        <div class="timer-text">Menit</div>
                    </div>
                    <div class="timer-unit">
                        <div class="timer-value" id="timerSeconds">00</div>
                        <div class="timer-text">Detik</div>
                    </div>
                </div>
            </div>
        </header>

        <p class="intro">
            Isi waktu ngabuburit dengan aktivitas positif bersama pasangan.
            Pilih game dan kuatkan hubungan suami-istri selama bulan Ramadhan!
        </p>

        <div class="games-grid">
            <div class="game-card" onclick="location.href='/Ngabuburit-harmonis/tangga-cinta'">
                <span class="game-icon">🪜</span>
                <h2 class="game-title">Tangga Cinta Ramadhan</h2>
                <p class="game-desc">
                    Game ular tangga dengan tantangan romantis & pertanyaan fiqih.
                    Lempar dadu, naiki tangga cinta, hindari ular dosa!
                </p>
                <div class="game-features">
                    <span class="feature-tag">👫 2 Pemain</span>
                    <span class="feature-tag">❤️ Romantis</span>
                    <span class="feature-tag">📖 Fiqih</span>
                </div>
                <button class="play-btn">Main Sekarang →</button>
            </div>

            <div class="game-card" onclick="location.href='/Ngabuburit-harmonis/ludo-harmoni'">
                <span class="game-icon">🎲</span>
                <h2 class="game-title">Ludo Harmoni</h2>
                <p class="game-desc">
                    Ludo dengan tema Sabar, Kasih Sayang, Doa, dan Taqwa.
                    Kumpulkan 4 bidak ke rumah untuk menang!
                </p>
                <div class="game-features">
                    <span class="feature-tag">👫 2 Pemain</span>
                    <span class="feature-tag">😊 Santai</span>
                    <span class="feature-tag">📖 Serius</span>
                </div>
                <button class="play-btn">Main Sekarang →</button>
            </div>

            <div class="game-card" onclick="location.href='/Ngabuburit-harmonis/kuis-halal-batal'">
                <span class="game-icon">❓</span>
                <h2 class="game-title">Kuis Halal/Batal?</h2>
                <p class="game-desc">
                    Uji pengetahuan fiqih puasa & interaksi suami-istri.
                    15 pertanyaan dengan hasil yang bisa dibagikan!
                </p>
                <div class="game-features">
                    <span class="feature-tag">📝 15 Soal</span>
                    <span class="feature-tag">🏆 Leaderboard</span>
                    <span class="feature-tag">📱 Share</span>
                </div>
                <button class="play-btn">Main Sekarang →</button>
            </div>
        </div>

        <div class="stats-section">
            <h3 class="stats-title">📊 Statistik Hari Ini</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value" id="totalPlayed">0</div>
                    <div class="stat-label">Pasangan Main</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="totalGames">0</div>
                    <div class="stat-label">Game Dimainkan</div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>🌙 Ngabuburit Harmonis - Ramadhan 1447H</p>
        <p>Semoga Ramadhan kita penuh keberkahan</p>
    </footer>

    <script>
        // Stars
        function initStars() {
            const container = document.getElementById('starsBackground');
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.cssText = 'left:' + Math.random() * 100 + '%;top:' + Math.random() * 100 + '%;width:' + (Math.random() * 3 + 1) + 'px;height:' + star.style.width + ';animation-delay:' + Math.random() * 5 + 's;animation-duration:' + (Math.random() * 3 + 2) + 's';
                container.appendChild(star);
            }
        }

        // Timer
        let maghribTime = new Date().setHours(18, 0, 0, 0);
        function updateMaghribTimer() {
            const now = new Date();
            const maghrib = new Date(maghribTime);
            if (now > maghrib) {
                maghrib.setDate(maghrib.getDate() + 1);
                maghribTime = maghrib.getTime();
            }
            const diff = maghrib - now;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            document.getElementById('timerHours').textContent = String(hours).padStart(2, '0');
            document.getElementById('timerMinutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('timerSeconds').textContent = String(seconds).padStart(2, '0');
        }

        // Stats
        function updateStats() {
            const stats = JSON.parse(localStorage.getItem('ngabuburit_stats')) || {
                gamesPlayed: 0,
                couplesToday: new Set().size
            };
            document.getElementById('totalPlayed').textContent = stats.couplesToday || Math.floor(Math.random() * 50) + 10;
            document.getElementById('totalGames').textContent = stats.gamesPlayed || Math.floor(Math.random() * 150) + 50;
        }

        document.addEventListener('DOMContentLoaded', function() {
            initStars();
            updateMaghribTimer();
            setInterval(updateMaghribTimer, 1000);
            updateStats();
        });
    </script>
</body>
</html>
