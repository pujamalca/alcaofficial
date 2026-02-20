<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 Hari 1 Amal - Random Amal Generator Ramadhan</title>
    <meta name="description" content="Dapatkan inspirasi amal kebaikan setiap hari selama bulan Ramadhan 1447H">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-green: #047857;
            --primary-green-light: #10b981;
            --primary-green-dark: #065f46;
            --gold: #F59E0B;
            --gold-light: #fbbf24;
            --gold-dark: #d97706;
            --white: #ffffff;
            --black: #1f2937;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            min-height: 100vh;
            transition: background 0.5s ease, color 0.5s ease;
            overflow-x: hidden;
        }

        body.day-mode {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
            color: var(--gray-800);
        }

        body.night-mode {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: var(--gray-100);
        }

        .stars-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .night-mode .stars-background {
            opacity: 1;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--duration) ease-in-out infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
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
            padding: 40px 20px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary-green), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .ramadhan-counter {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin: 30px auto;
            max-width: 600px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .day-mode .ramadhan-counter {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(4, 120, 87, 0.2);
        }

        .counter-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .counter-display {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .counter-item {
            text-align: center;
            min-width: 80px;
        }

        .counter-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gold);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .counter-label {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        .generator-section {
            text-align: center;
            margin: 40px 0;
        }

        .generate-btn {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-light));
            color: white;
            border: none;
            padding: 20px 50px;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(4, 120, 87, 0.3);
            position: relative;
            overflow: hidden;
        }

        .generate-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .generate-btn:hover::before {
            left: 100%;
        }

        .generate-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(4, 120, 87, 0.4);
        }

        .generate-btn:active {
            transform: translateY(-1px);
        }

        .amal-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            margin: 40px auto;
            max-width: 700px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.5s ease;
            display: none;
        }

        .day-mode .amal-card {
            background: rgba(255, 255, 255, 0.4);
            border-color: rgba(4, 120, 87, 0.15);
        }

        .amal-card.show {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }

        .amal-category {
            display: inline-block;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--gray-900);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .amal-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .amal-description {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .amal-reward {
            background: rgba(245, 158, 11, 0.15);
            border-left: 4px solid var(--gold);
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-style: italic;
        }

        .amal-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }

        .action-btn {
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .done-btn {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-light));
            color: white;
        }

        .done-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(4, 120, 87, 0.3);
        }

        .done-btn.completed {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            cursor: default;
        }

        .share-btn {
            background: rgba(255, 255, 255, 0.2);
            color: inherit;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .day-mode .share-btn {
            background: rgba(4, 120, 87, 0.1);
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .progress-section {
            margin: 40px 0;
        }

        .progress-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            height: 30px;
            overflow: hidden;
            position: relative;
            margin: 0 auto;
            max-width: 600px;
        }

        .day-mode .progress-bar {
            background: rgba(4, 120, 87, 0.2);
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-green), var(--gold));
            border-radius: 15px;
            transition: width 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 15px;
        }

        .progress-text {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .completed-amals {
            margin-top: 30px;
        }

        .completed-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .completed-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .completed-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .day-mode .completed-item {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(4, 120, 87, 0.15);
        }

        .completed-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .completed-info {
            flex: 1;
        }

        .completed-info h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .completed-info p {
            font-size: 0.85rem;
            opacity: 0.7;
        }

        .mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green), var(--gold));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            z-index: 100;
        }

        .mode-toggle:hover {
            transform: scale(1.1);
        }

        .mode-toggle svg {
            width: 30px;
            height: 30px;
        }

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            opacity: 0;
        }

        @keyframes confetti-fall {
            0% {
                opacity: 1;
                transform: translateY(0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(100vh) rotate(720deg);
            }
        }

        .toast {
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: rgba(4, 120, 87, 0.95);
            color: white;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            opacity: 0.6;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        footer {
            text-align: center;
            padding: 40px 20px;
            margin-top: 60px;
            opacity: 0.7;
        }

        footer p {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }

            .header p {
                font-size: 1rem;
            }

            .counter-number {
                font-size: 2rem;
            }

            .generate-btn {
                padding: 15px 35px;
                font-size: 1.1rem;
            }

            .amal-card {
                padding: 25px;
                margin: 20px;
            }

            .amal-title {
                font-size: 1.4rem;
            }

            .amal-description {
                font-size: 1rem;
            }

            .amal-actions {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }

            .completed-list {
                grid-template-columns: 1fr;
            }

            .mode-toggle {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .counter-item {
                min-width: 60px;
            }

            .counter-number {
                font-size: 1.5rem;
            }

            .counter-label {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body class="day-mode">
    <div class="stars-background" id="starsBackground"></div>
    <div class="confetti-container" id="confettiContainer"></div>

    <div class="container">
        <header class="header">
            <h1>🌙 1 Hari 1 Amal</h1>
            <p>Random Amal Generator Ramadhan 1447H</p>
        </header>

        <section class="ramadhan-counter">
            <h2 class="counter-title">✨ Hitung Mundur Ramadhan</h2>
            <div class="counter-display">
                <div class="counter-item">
                    <div class="counter-number" id="days">0</div>
                    <div class="counter-label">Hari</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number" id="hours">0</div>
                    <div class="counter-label">Jam</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number" id="minutes">0</div>
                    <div class="counter-label">Menit</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number" id="seconds">0</div>
                    <div class="counter-label">Detik</div>
                </div>
            </div>
        </section>

        <section class="generator-section">
            <button class="generate-btn" id="generateBtn" onclick="generateAmal()">
                🎲 Dapatkan Amal Hari Ini
            </button>
        </section>

        <article class="amal-card" id="amalCard">
            <span class="amal-category" id="amalCategory"></span>
            <h2 class="amal-title" id="amalTitle"></h2>
            <p class="amal-description" id="amalDescription"></p>
            <div class="amal-reward" id="amalReward"></div>
            <div class="amal-actions">
                <button class="action-btn done-btn" id="doneBtn" onclick="markAsDone()">
                    ✓ Sudah Melakukan Ini
                </button>
                <button class="action-btn share-btn" onclick="shareWhatsApp()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </button>
                <button class="action-btn share-btn" onclick="shareTwitter()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                    Twitter
                </button>
                <button class="action-btn share-btn" onclick="shareFacebook()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>
                <button class="action-btn share-btn" onclick="copyLink()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                    Copy
                </button>
            </div>
        </article>

        <section class="progress-section">
            <h2 class="progress-title">📊 Progress Amal Kamu</h2>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill">
                    <span class="progress-text" id="progressText">0/50</span>
                </div>
            </div>
        </section>

        <section class="completed-amals">
            <h3 class="completed-title">✅ Amal yang Sudah Dilakukan</h3>
            <div class="completed-list" id="completedList">
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    <p>Belum ada amal yang dilakukan. Mulai dengan klik tombol di atas!</p>
                </div>
            </div>
        </section>

        <button class="mode-toggle" id="modeToggle" onclick="toggleMode()">
            <svg id="sunIcon" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
            </svg>
            <svg id="moonIcon" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <footer>
        <p>🌙 1 Hari 1 Amal - Ramadhan 1447H</p>
        <p>Semoga amal kita diterima Allah SWT</p>
    </footer>

    <div class="toast" id="toast"></div>

    <script>
        // 50 Amal Database
        const amalDatabase = [
            // Ibadah (10 amal)
            {
                id: 1,
                category: "Ibadah",
                title: "Shalat Tahajud",
                description: "Bangun di sepertiga malam untuk melaksanakan shalat tahajud minimal 2 rakaat.",
                reward: "Allah akan mempermudah urusanmu di dunia dan memberi tempat yang mulia di surga."
            },
            {
                id: 2,
                category: "Ibadah",
                title: "Membaca 1 Juz Al-Quran",
                description: "Dedikasikan waktu untuk membaca dan mentadaburi 1 juz Al-Quran dengan tartil.",
                reward: "Setiap huruf dibaca mendapat 10 kebaikan. Allah mengangkat derajat pembaca Al-Quran."
            },
            {
                id: 3,
                category: "Ibadah",
                title: "Dhuha 12 Rakaat",
                description: "Lakukan shalat dhuha 12 rakaat setelah matahari naik sempurna.",
                reward: "Rumah yang dibangun di surga, cukupan rezeki, dan diampuni dosanya."
            },
            {
                id: 4,
                category: "Ibadah",
                title: "Shalat Jamaah di Masjid",
                description: "Shalat berjamaah 5 waktu di masjid untuk setiap shalat wajib.",
                reward: "Pahala 27 kali lipat dari shalat sendirian."
            },
            {
                id: 5,
                category: "Ibadah",
                title: "Wirid Setelah Shalat",
                description: "Lengkapilah wirid setelah shalat: istighfar 33x, tasbih 33x, tahmid 33x, takbir 34x.",
                reward: "Dosa diampuni dan kebaikan dilipatgandakan."
            },
            {
                id: 6,
                category: "Ibadah",
                title: "Shalat Sunnah Rawatib",
                description: "Lakukan shalat sunnah rawatib sebelum dan sesudah shalat wajib.",
                reward: "Allah membangunkan rumah di surga bagi yang istiqamah."
            },
            {
                id: 7,
                category: "Ibadah",
                title: "Doa Tahajud",
                description: "Perpanjanglah sujud di sepertiga malam dan curahkan semua hajat kepada Allah.",
                reward: "Doa di sepertiga malam adalah waktu yang mustajab."
            },
            {
                id: 8,
                category: "Ibadah",
                title: "Membaca Yasin",
                description: "Bacalah surah Yasin setelah shalat Subuh atau Maghrib.",
                reward: "Hati menjadi tenang dan mendapat syafaat di hari kiamat."
            },
            {
                id: 9,
                category: "Ibadah",
                title: "I'tikaf Sementara",
                description: "Sisihkan waktu 1-2 jam di masjid untuk beribadah tanpa gangguan.",
                reward: "Menenangkan hati dan mendekatkan diri kepada Allah."
            },
            {
                id: 10,
                category: "Ibadah",
                title: "Shalat Khusyuk",
                description: "Fokuskan sepenuh hati saat shalat, pahami setiap bacaan dan gerakan.",
                reward: "Shalat khusyuk adalah ciri orang yang beruntung."
            },

            // Sosial (10 amal)
            {
                id: 11,
                category: "Sosial",
                title: "Sedekah Harian",
                description: "Sisihkan sebagian rezeki untuk sedekah, meski hanya seribu rupiah.",
                reward: "Allah mengganti dengan yang lebih baik dan memberkahi rezeki."
            },
            {
                id: 12,
                category: "Sosial",
                title: "Berbagi Makanan",
                description: "Bagikan makanan atau minuman untuk orang yang berbuka puasa.",
                reward: "Pahala seperti orang yang berpuasa tanpa mengurangi pahala orang yang berpuasa."
            },
            {
                id: 13,
                category: "Sosial",
                title: "Zakat Penghasilan",
                description: "Hitung dan keluarkan zakat penghasilan (2.5%) jika sudah mencapai nisab.",
                reward: "Menyucikan harta dan jiwa, janji Allah untuk melipatgandakan."
            },
            {
                id: 14,
                category: "Sosial",
                title: "Membantu Tetangga",
                description: "Tanyakan kabar tetangga dan bantu jika ada kesulitan.",
                reward: "Bukti keimanan yang sempurna dan mendapat keberkahan dari Allah."
            },
            {
                id: 15,
                category: "Sosial",
                title: "Kunjungi Yatim Piatu",
                description: "Luangkan waktu untuk mengunjungi dan menyenangkan anak yatim.",
                reward: "Bersama Rasulullah di surga dan mendekat kepada Allah."
            },
            {
                id: 16,
                category: "Sosial",
                title: "Layani Janda & Lansia",
                description: "Bantu kebutuhan janda atau lansia di sekitar lingkungan.",
                reward: "Allah mengangkat derajat dan memberi kemuliaan."
            },
            {
                id: 17,
                category: "Sosial",
                title: "Damaikan Pertengkaran",
                description: "Jadi penengah jika ada pertengkaran atau konflik antar manusia.",
                reward: "Termasuk orang yang paling utama dan mendapat pahala besar."
            },
            {
                id: 18,
                category: "Sosial",
                title: "Maafkan Kesalahan",
                description: "Maafkan seseorang yang pernah menyakiti hatimu hari ini.",
                reward: "Allah memuliakan hamba yang memaafkan dan menenangkan hati."
            },
            {
                id: 19,
                category: "Sosial",
                title: "Jembatan Silaturahmi",
                description: "Hubungi kerabat yang sudah lama tidak bersua.",
                reward: "Dilapangkan rezeki dan dipanjangkan umur."
            },
            {
                id: 20,
                category: "Sosial",
                title: "Infaq Terbaik",
                description: "Berikan infak terbaikmu untuk kepentingan umat.",
                reward: "Allah mengganti dengan yang lebih baik lagi."
            },

            // Kesehatan (8 amal)
            {
                id: 21,
                category: "Kesehatan",
                title: "Sahur Sehat",
                description: "Konsumsi makanan bernutrisi saat sahur, bukan hanya minum.",
                reward: "Menjaga stamina ibadah dan kesehatan tubuh."
            },
            {
                id: 22,
                category: "Kesehatan",
                title: "Buka Puasa Moderat",
                description: "Mulai buka dengan kurma dan air, jangan berlebihan makan.",
                reward: "Menjaga kesehatan pencernaan dan ibadah tetap optimal."
            },
            {
                id: 23,
                category: "Kesehatan",
                title: "Olahraga Ringan",
                description: "Lakukan olahraga ringan 15-30 menit, sebelum buka atau setelah tarawih.",
                reward: "Menjaga kebugaran tubuh untuk ibadah yang lebih khusyuk."
            },
            {
                id: 24,
                category: "Kesehatan",
                title: "Tidur Teratur",
                description: "Atur pola tidur yang cukup, usahakan tidur sebelum tahajud.",
                reward: "Tubuh lebih segar dan ibadah lebih fokus."
            },
            {
                id: 25,
                category: "Kesehatan",
                title: "Jaga Kebersihan",
                description: "Rawat kebersihan diri, lingkungan, dan tempat ibadah.",
                reward: "Kebersihan sebagian dari iman dan Allah menyukai orang yang bersih."
            },
            {
                id: 26,
                category: "Kesehatan",
                title: "Konsumsi Madu",
                description: "Rutinkan mengonsumsi madu sebagai sunnah dan kesehatan.",
                reward: "Menjaga stamina dan mengikuti sunnah Rasulullah."
            },
            {
                id: 27,
                category: "Kesehatan",
                title: "Kurangi Gadget",
                description: "Batasi penggunaan gadget, fokus pada ibadah dan keluarga.",
                reward: "Hati lebih tenang dan waktu lebih bermanfaat."
            },
            {
                id: 28,
                category: "Kesehatan",
                title: "Minum Air Cukup",
                description: "Penuhi kebutuhan cairan tubuh dari buka hingga sahur.",
                reward: "Tubuh tetap terhidrasi dan sehat berpuasa."
            },

            // Keluarga (8 amal)
            {
                id: 29,
                category: "Keluarga",
                title: "Bermesraan dengan Pasangan",
                description: "Berikan waktu berkualitas dan perhatian lebih pada pasangan.",
                reward: "Membangun keluarga sakinah dan mendapat keberkahan."
            },
            {
                id: 30,
                category: "Keluarga",
                title: "Asuh Anak dengan Cinta",
                description: "Dampingi anak belajar, bermain, dan mengaji dengan penuh kasih sayang.",
                reward: "Membentuk generasi berakhlak mulia dan pahala pendidikan."
            },
            {
                id: 31,
                category: "Keluarga",
                title: "Santun pada Orang Tua",
                description: "Tunjukkan bakti dan kasih sayang pada orang tua, baik langsung maupun jarak jauh.",
                reward: "Kebaikan dan keridhoan Allah serta surga ada di bawah telapak kaki ibu."
            },
            {
                id: 32,
                category: "Keluarga",
                title: "Buka Bersama Keluarga",
                description: "Usahakan buka puasa bersama keluarga di rumah.",
                reward: "Mempererat tali kasih dan keberkahan makanan."
            },
            {
                id: 33,
                category: "Keluarga",
                title: "Tarawih Berjamaah Keluarga",
                description: "Tarawih bersama di masjid atau berjamaah di rumah.",
                reward: "Kebersamaan dan keberkahan ibadah."
            },
            {
                id: 34,
                category: "Keluarga",
                title: "Ajarkan Anak Mengaji",
                description: "Dampingi anak membaca Al-Quran meski hanya satu halaman.",
                reward: "Pahala mengajar dan amal jariyah yang terus mengalir."
            },
            {
                id: 35,
                category: "Keluarga",
                title: "Memaafkan Keluarga",
                description: "Lupakan kesalahan anggota keluarga, mulai hari dengan penuh maaf.",
                reward: "Allah melimpahkan ketenangan dan keberkahan dalam keluarga."
            },
            {
                id: 36,
                category: "Keluarga",
                title: "Silaturahmi Keluarga Besar",
                description: "Hubungi atau kunjungi keluarga besar yang jarang bersua.",
                reward: "Dilapangkan rezeki dan dipanjangkan umur."
            },

            // Ilmu (7 amal)
            {
                id: 37,
                category: "Ilmu",
                title: "Kajian Rutin",
                description: "Ikutilah kajian atau ceramah, baik online maupun offline.",
                reward: "Keberkahan ilmu dan naiknya derajat."
            },
            {
                id: 38,
                category: "Ilmu",
                title: "Baca Buku Islami",
                description: "Baca buku-buku bernuansa Islam minimal 30 menit.",
                reward: "Menambah wawasan dan ketenangan hati."
            },
            {
                id: 39,
                category: "Ilmu",
                title: "Pelajari Hadits",
                description: "Baca dan pelajari satu hadits Rasulullah SAW beserta artinya.",
                reward: "Memahami sunnah dan mendapat petunjuk."
            },
            {
                id: 40,
                category: "Ilmu",
                title: "Tafsir Singkat",
                description: "Baca tafsir dari ayat-ayat yang kamu baca saat shalat.",
                reward: "Memahami makna Al-Quran dan mengamalkannya."
            },
            {
                id: 41,
                category: "Ilmu",
                title: "Amalkan Ilmu",
                description: "Pilih satu ilmu yang kamu pelajari dan amalkan hari ini.",
                reward: "Ilmu yang bermanfaat adalah yang diamalkan."
            },
            {
                id: 42,
                category: "Ilmu",
                title: "Dengarkan Podcast Islami",
                description: "Dengarkan konten islami bermanfaat saat aktivitas.",
                reward: "Menambah wawasan dan ketenangan."
            },
            {
                id: 43,
                category: "Ilmu",
                title: "Tulis Catatan Ibadah",
                description: "Catat pelajaran dan refleksi ibadah hari ini.",
                reward: "Membantu konsistensi dan introspeksi diri."
            },

            // Akhlak (7 amal)
            {
                id: 44,
                category: "Akhlak",
                title: "Jaga Lisan",
                description: "Hindari ghibah, kebohongan, dan kata-kata kasar.",
                reward: "Allah menjaga dari api neraka dan memberikan kedudukan mulia."
            },
            {
                id: 45,
                category: "Akhlak",
                title: "Tundukkan Pandangan",
                description: "Jaga pandangan dari hal-hal yang tidak semestinya.",
                reward: "Hati menjadi tenang dan pandangan menjadi dingin."
            },
            {
                id: 46,
                category: "Akhlak",
                title: "Senyumlah",
                description: "Pererat tali persaudaraan dengan senyuman.",
                reward: "Sedekah yang paling mudah dan mendapat pahala."
            },
            {
                id: 47,
                category: "Akhlak",
                title: "Tahan Amarah",
                description: "Kendalikan emosi dan bersikaplah penuh hikmah.",
                reward: "Allah mencintai orang yang menahan amarah."
            },
            {
                id: 48,
                category: "Akhlak",
                title: "Hormati Tetangga",
                description: "Berikan salam dan senyum pada tetangga.",
                reward: "Mempererat tali persaudaraan dan keberkahan."
            },
            {
                id: 49,
                category: "Akhlak",
                title: "Humble dan Rendah Hati",
                description: "Rendahkan diri, jangan sombang dengan kebaikanmu.",
                reward: "Allah mengangkat derajat hamba yang merendahkan diri."
            },
            {
                id: 50,
                category: "Akhlak",
                title: "Syukur yang Tulus",
                description: "Panjatkan rasa syukur atas segala nikmat Allah.",
                reward: "Allah menambah nikmat bagi hamba yang bersyukur."
            }
        ];

        // Global variables
        let currentAmal = null;
        let completedAmals = JSON.parse(localStorage.getItem('completedAmals')) || [];
        let isNightMode = false;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initializeStars();
            determineMode();
            updateRamadhanCounter();
            updateProgress();
            updateCompletedList();

            // Update counter every second
            setInterval(updateRamadhanCounter, 1000);

            // Check mode every minute
            setInterval(determineMode, 60000);
        });

        // Create stars background
        function initializeStars() {
            const starsContainer = document.getElementById('starsBackground');
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.width = Math.random() * 3 + 1 + 'px';
                star.style.height = star.style.width;
                star.style.setProperty('--duration', (Math.random() * 3 + 2) + 's');
                star.style.animationDelay = Math.random() * 5 + 's';
                starsContainer.appendChild(star);
            }
        }

        // Determine day/night mode based on time
        function determineMode() {
            const hour = new Date().getHours();
            const shouldBeNight = hour >= 18 || hour < 6;

            if (shouldBeNight !== isNightMode) {
                toggleMode(false);
            }
        }

        // Toggle between day and night mode
        function toggleMode(showToast = true) {
            const body = document.body;
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');

            isNightMode = !isNightMode;

            if (isNightMode) {
                body.classList.remove('day-mode');
                body.classList.add('night-mode');
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            } else {
                body.classList.remove('night-mode');
                body.classList.add('day-mode');
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            }

            if (showToast) {
                showToastMessage(isNightMode ? '🌙 Mode Malam Aktif' : '☀️ Mode Siang Aktif');
            }
        }

        // Generate random amal
        function generateAmal() {
            // Get uncompleted amals first, if all completed then show all
            const uncompletedAmals = amalDatabase.filter(amal => !completedAmals.includes(amal.id));
            const availableAmals = uncompletedAmals.length > 0 ? uncompletedAmals : amalDatabase;

            // Random selection
            const randomIndex = Math.floor(Math.random() * availableAmals.length);
            currentAmal = availableAmals[randomIndex];

            // Display amal
            document.getElementById('amalCategory').textContent = currentAmal.category;
            document.getElementById('amalTitle').textContent = currentAmal.title;
            document.getElementById('amalDescription').textContent = currentAmal.description;
            document.getElementById('amalReward').textContent = '💎 ' + currentAmal.reward;

            // Update button state
            const doneBtn = document.getElementById('doneBtn');
            if (completedAmals.includes(currentAmal.id)) {
                doneBtn.textContent = '✓ Sudah Dilakukan';
                doneBtn.classList.add('completed');
            } else {
                doneBtn.textContent = '✓ Sudah Melakukan Ini';
                doneBtn.classList.remove('completed');
            }

            // Show card with animation
            const card = document.getElementById('amalCard');
            card.classList.add('show');

            // Scroll to card
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Add pulse animation to button
            const generateBtn = document.getElementById('generateBtn');
            generateBtn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                generateBtn.style.transform = '';
            }, 150);
        }

        // Mark amal as done
        function markAsDone() {
            if (!currentAmal) return;

            const amalId = currentAmal.id;

            if (completedAmals.includes(amalId)) {
                showToastMessage('Amal ini sudah selesai! ✅');
                return;
            }

            completedAmals.push(amalId);
            localStorage.setItem('completedAmals', JSON.stringify(completedAmals));

            // Update UI
            document.getElementById('doneBtn').textContent = '✓ Sudah Dilakukan';
            document.getElementById('doneBtn').classList.add('completed');

            // Trigger confetti
            triggerConfetti();

            // Update progress and list
            updateProgress();
            updateCompletedList();

            showToastMessage('MasyaAllah! Amal tercatat ✨');
        }

        // Update progress bar
        function updateProgress() {
            const total = amalDatabase.length;
            const completed = completedAmals.length;
            const percentage = (completed / total) * 100;

            const progressFill = document.getElementById('progressFill');
            progressFill.style.width = percentage + '%';
            document.getElementById('progressText').textContent = completed + '/' + total;
        }

        // Update completed amals list
        function updateCompletedList() {
            const listContainer = document.getElementById('completedList');

            if (completedAmals.length === 0) {
                listContainer.innerHTML = `
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                        <p>Belum ada amal yang dilakukan. Mulai dengan klik tombol di atas!</p>
                    </div>
                `;
                return;
            }

            const completedItems = completedAmals.map(id =>
                amalDatabase.find(amal => amal.id === id)
            ).filter(Boolean);

            listContainer.innerHTML = completedItems.map(amal => `
                <div class="completed-item">
                    <div class="completed-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="completed-info">
                        <h4>${amal.title}</h4>
                        <p>${amal.category}</p>
                    </div>
                </div>
            `).join('');
        }

        // Ramadhan counter (from February 7, 2026)
        function updateRamadhanCounter() {
            const ramadhanStart = new Date('2026-02-07T00:00:00').getTime();
            const now = new Date().getTime();

            let distance;

            if (now < ramadhanStart) {
                // Countdown to Ramadhan
                distance = ramadhanStart - now;
            } else {
                // Days since Ramadhan started
                const daysSince = Math.floor((now - ramadhanStart) / (1000 * 60 * 60 * 24));
                if (daysSince < 30) {
                    // Still in Ramadhan - show day of Ramadhan
                    document.getElementById('days').textContent = daysSince + 1;
                    document.getElementById('hours').textContent = new Date().getHours();
                    document.getElementById('minutes').textContent = new Date().getMinutes();
                    document.getElementById('seconds').textContent = new Date().getSeconds();
                    document.querySelector('.counter-title').textContent = '✨ Hari Ke-' + (daysSince + 1) + ' Ramadhan';
                    return;
                } else {
                    // Ramadhan has ended
                    distance = 0;
                }
            }

            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours;
                document.getElementById('minutes').textContent = minutes;
                document.getElementById('seconds').textContent = seconds;
            }
        }

        // Confetti animation
        function triggerConfetti() {
            const container = document.getElementById('confettiContainer');
            const colors = ['#047857', '#10b981', '#F59E0B', '#fbbf24', '#ffffff', '#ecfdf5'];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s ease-out forwards`;
                confetti.style.animationDelay = Math.random() * 0.5 + 's';
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = confetti.style.width;

                container.appendChild(confetti);

                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }

        // Show toast message
        function showToastMessage(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Share functions
        function getShareText() {
            if (!currentAmal) return 'Yuk beramal kebaikan di bulan Ramadhan!';
            return `🌙 1 Hari 1 Amal - Ramadhan 1447H\n\nHari ini: ${currentAmal.title}\n\n"${currentAmal.description}"\n\n💎 ${currentAmal.reward}\n\nYuk bareng-bareng mengumpulkan pahala di bulan penuh berkah!`;
        }

        function shareWhatsApp() {
            const text = encodeURIComponent(getShareText());
            const url = `https://wa.me/?text=${text}`;
            window.open(url, '_blank');
        }

        function shareTwitter() {
            const text = encodeURIComponent(getShareText());
            const url = `https://twitter.com/intent/tweet?text=${text}`;
            window.open(url, '_blank');
        }

        function shareFacebook() {
            const url = encodeURIComponent(window.location.href);
            const fbUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            window.open(fbUrl, '_blank');
        }

        function copyLink() {
            const text = getShareText();
            navigator.clipboard.writeText(text).then(() => {
                showToastMessage('✅ Teks berhasil disalin!');
            }).catch(() => {
                // Fallback for older browsers
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showToastMessage('✅ Teks berhasil disalin!');
            });
        }
    </script>
</body>
</html>