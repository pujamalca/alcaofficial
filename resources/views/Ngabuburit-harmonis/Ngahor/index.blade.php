<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>🌙 Ngabuburit Harmonis - Game Romantis Pasangan Halal</title>
    <meta name="description" content="Game romantis & edukatif khusus suami-istri selama Ramadhan. Seru, syar'i, dan tidak membatalkan puasa.">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap');

        :root {
            --primary-gold: #D4AF37;
            --gold-light: #F4E4A6;
            --gold-dark: #B8860B;
            --emerald-green: #10B981;
            --emerald-dark: #047857;
            --emerald-light: #34D399;
            --cream: #FFF8E7;
            --cream-dark: #F5E6C8;
            --burgundy: #7C2D2D;
            --burgundy-light: #9F3F3F;
            --night-bg: #1a0a2e;
            --night-dark: #0d061a;
            --purple-deep: #16213e;
            --white: #ffffff;
            --shadow-gold: rgba(212, 175, 55, 0.3);
            --shadow-emerald: rgba(16, 185, 129, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 15px;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            padding: 20px 10px;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header h1 {
            font-family: 'Amiri', serif;
            font-size: clamp(1.8rem, 5vw, 3rem);
            color: var(--primary-gold);
            text-shadow: 0 0 30px var(--shadow-gold), 0 2px 10px rgba(0,0,0,0.5);
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .header .subtitle {
            font-size: clamp(0.9rem, 2.5vw, 1.2rem);
            color: var(--gold-light);
            opacity: 0.9;
            margin-bottom: 15px;
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
        }

        .timer-label {
            font-size: 0.95rem;
            color: var(--gold-light);
        }

        .timer-display {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .timer-unit {
            text-align: center;
            min-width: 45px;
        }

        .timer-value {
            font-family: 'Amiri', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-gold);
            text-shadow: 0 0 15px var(--shadow-gold);
        }

        .timer-text {
            font-size: 0.7rem;
            color: var(--cream);
            opacity: 0.7;
            text-transform: uppercase;
        }

        .game-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .tab-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: clamp(0.8rem, 2vw, 1rem);
            padding: 12px 20px;
            border-radius: 50px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            backdrop-filter: blur(5px);
            min-width: 120px;
        }

        .tab-btn:hover {
            transform: translateY(-2px);
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--primary-gold);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
            color: var(--night-bg);
            border-color: var(--primary-gold);
            box-shadow: 0 5px 25px var(--shadow-gold);
            transform: scale(1.05);
        }

        .game-section {
            display: none;
            animation: fadeIn 0.4s ease-out;
        }

        .game-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .game-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        /* TANGGA CINTA */
        .tangga-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .tangga-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
            gap: 15px;
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .player-info.active {
            border-color: var(--primary-gold);
            box-shadow: 0 0 20px var(--shadow-gold);
        }

        .player-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .player-suami .player-icon {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }

        .player-istri .player-icon {
            background: linear-gradient(135deg, #EC4899, #BE185D);
        }

        .player-name {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .player-position {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .tangga-board {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 2px;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            border-radius: 15px;
            max-width: 500px;
            width: 100%;
        }

        .tangga-cell {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            position: relative;
            transition: all 0.2s ease;
        }

        .tangga-cell:nth-child(odd) {
            background: rgba(16, 185, 129, 0.15);
        }

        .tangga-cell:nth-child(even) {
            background: rgba(212, 175, 55, 0.15);
        }

        .tangga-cell.special {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(212, 175, 55, 0.1));
            border: 1px solid rgba(212, 175, 55, 0.5);
        }

        .tangga-cell .cell-icon {
            font-size: 1rem;
        }

        .tangga-cell .cell-number {
            position: absolute;
            top: 2px;
            left: 4px;
            font-size: 0.6rem;
            opacity: 0.5;
        }

        .piece-on-board {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .piece-suami {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }

        .piece-istri {
            background: linear-gradient(135deg, #EC4899, #BE185D);
        }

        .dice-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .dice {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--cream), var(--cream-dark));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--night-bg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid var(--primary-gold);
        }

        .dice:hover {
            transform: scale(1.1);
        }

        .dice.rolling {
            animation: diceRoll 0.6s ease-out;
        }

        @keyframes diceRoll {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(-15deg) scale(1.1); }
            50% { transform: rotate(15deg) scale(1.15); }
            75% { transform: rotate(-10deg) scale(1.05); }
        }

        .roll-btn {
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
            box-shadow: 0 5px 20px var(--shadow-emerald);
        }

        .roll-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--shadow-emerald);
        }

        .roll-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* LUDO */
        .ludo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .ludo-mode-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .mode-toggle-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 16px;
            border-radius: 20px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mode-toggle-btn.active {
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
            color: var(--night-bg);
            border-color: var(--primary-gold);
        }

        .ludo-board {
            display: grid;
            grid-template-columns: repeat(15, 1fr);
            grid-template-rows: repeat(15, 1fr);
            gap: 1px;
            background: var(--night-bg);
            padding: 5px;
            border-radius: 10px;
            max-width: 450px;
            width: 100%;
            aspect-ratio: 1;
        }

        .ludo-cell {
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .ludo-home {
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ludo-home.red { background: linear-gradient(135deg, #EF4444, #B91C1C); }
        .ludo-home.green { background: linear-gradient(135deg, #10B981, #047857); }
        .ludo-home.yellow { background: linear-gradient(135deg, #F59E0B, #D97706); }
        .ludo-home.blue { background: linear-gradient(135deg, #3B82F6, #1D4ED8); }

        .ludo-center {
            grid-column: 7 / span 3;
            grid-row: 7 / span 3;
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .ludo-path {
            background: rgba(255, 255, 255, 0.1);
        }

        .ludo-path.red-path { background: rgba(239, 68, 68, 0.3); }
        .ludo-path.green-path { background: rgba(16, 185, 129, 0.3); }
        .ludo-path.yellow-path { background: rgba(245, 158, 11, 0.3); }
        .ludo-path.blue-path { background: rgba(59, 130, 246, 0.3); }

        .ludo-path.safe-zone {
            background: rgba(212, 175, 55, 0.4);
            border: 1px solid var(--primary-gold);
        }

        .ludo-piece {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.4);
            cursor: pointer;
            transition: all 0.2s ease;
            position: absolute;
            z-index: 5;
        }

        .ludo-piece:hover {
            transform: scale(1.2);
        }

        .ludo-piece.red { background: linear-gradient(135deg, #EF4444, #B91C1C); }
        .ludo-piece.green { background: linear-gradient(135deg, #10B981, #047857); }
        .ludo-piece.yellow { background: linear-gradient(135deg, #F59E0B, #D97706); }
        .ludo-piece.blue { background: linear-gradient(135deg, #3B82F6, #1D4ED8); }

        .ludo-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .ludo-dice {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--cream), var(--cream-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--night-bg);
            border: 2px solid var(--primary-gold);
        }

        /* KUIS */
        .kuis-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .kuis-start, .kuis-result {
            text-align: center;
            padding: 30px 20px;
        }

        .kuis-start h2, .kuis-result h2 {
            font-family: 'Amiri', serif;
            font-size: 2rem;
            color: var(--primary-gold);
            margin-bottom: 20px;
        }

        .kuis-start p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .start-kuis-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px var(--shadow-emerald);
        }

        .start-kuis-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px var(--shadow-emerald);
        }

        .kuis-question {
            display: none;
        }

        .kuis-question.active {
            display: block;
        }

        .question-card {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .question-number {
            font-size: 0.9rem;
            color: var(--primary-gold);
            margin-bottom: 10px;
        }

        .question-text {
            font-size: 1.2rem;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .question-progress {
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--emerald-green), var(--emerald-light));
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .options-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            padding: 15px 20px;
            border-radius: 15px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: var(--cream);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
        }

        .option-btn:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--primary-gold);
            transform: translateX(5px);
        }

        .option-btn.correct {
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            border-color: var(--emerald-green);
        }

        .option-btn.wrong {
            background: linear-gradient(135deg, var(--burgundy), var(--burgundy-light));
            border-color: var(--burgundy);
        }

        .explanation {
            margin-top: 15px;
            padding: 15px;
            background: rgba(16, 185, 129, 0.1);
            border-left: 4px solid var(--emerald-green);
            border-radius: 8px;
            font-size: 0.95rem;
            line-height: 1.6;
            display: none;
        }

        .explanation.show {
            display: block;
        }

        .next-question-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
            color: var(--night-bg);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            display: none;
        }

        .next-question-btn.show {
            display: inline-block;
        }

        .result-card {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .result-emoji {
            font-size: 4rem;
            margin-bottom: 15px;
        }

        .result-title {
            font-family: 'Amiri', serif;
            font-size: 2rem;
            color: var(--primary-gold);
            margin-bottom: 10px;
        }

        .result-subtitle {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .result-score {
            font-size: 3rem;
            font-weight: 700;
            color: var(--emerald-green);
            text-shadow: 0 0 20px var(--shadow-emerald);
        }

        .result-label {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 25px;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .share-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .share-btn.whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
        }

        .share-btn.facebook {
            background: linear-gradient(135deg, #1877F2, #0C63D4);
            color: white;
        }

        .share-btn.copy {
            background: rgba(255, 255, 255, 0.1);
            color: var(--cream);
            border: 2px solid rgba(212, 175, 55, 0.3);
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(5px);
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, var(--night-bg), var(--purple-deep));
            border: 2px solid var(--primary-gold);
            border-radius: 24px;
            padding: 30px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 50px rgba(212, 175, 55, 0.3);
            animation: modalPop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalPop {
            from { transform: scale(0.7); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-title {
            font-family: 'Amiri', serif;
            font-size: 1.5rem;
            color: var(--primary-gold);
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--cream);
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--burgundy);
            transform: rotate(90deg);
        }

        .modal-body {
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .modal-type {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .modal-type.romantis {
            background: linear-gradient(135deg, #EC4899, #BE185D);
            color: white;
        }

        .modal-type.fiqih {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
        }

        .modal-type.pahala {
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
        }

        .modal-type.ludo {
            background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
            color: var(--night-bg);
        }

        .modal-action-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 25px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--emerald-green), var(--emerald-dark));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            width: 100%;
        }

        .modal-action-btn:hover {
            transform: scale(1.02);
        }

        .footer {
            text-align: center;
            padding: 30px 20px;
            margin-top: 40px;
            opacity: 0.7;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .footer p {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            pointer-events: none;
            z-index: 1000;
            animation: confettiFall linear forwards;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-20px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 1.6rem;
            }

            .header .subtitle {
                font-size: 0.9rem;
            }

            .maghrib-timer {
                padding: 12px 15px;
            }

            .timer-value {
                font-size: 1.4rem;
            }

            .game-tabs {
                gap: 8px;
            }

            .tab-btn {
                font-size: 0.8rem;
                padding: 10px 15px;
                min-width: 100px;
            }

            .game-card {
                padding: 15px;
            }

            .tangga-board {
                gap: 1px;
                padding: 5px;
            }

            .tangga-cell {
                font-size: 0.6rem;
            }

            .player-info {
                padding: 8px 12px;
            }

            .player-icon {
                width: 32px;
                height: 32px;
                font-size: 1.2rem;
            }

            .ludo-board {
                max-width: 100%;
            }

            .ludo-piece {
                width: 14px;
                height: 14px;
            }

            .kuis-start h2, .kuis-result h2 {
                font-size: 1.5rem;
            }

            .modal-content {
                padding: 20px;
                margin: 10px;
            }

            .share-buttons {
                flex-direction: column;
            }

            .share-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .timer-unit {
                min-width: 35px;
            }

            .timer-value {
                font-size: 1.2rem;
            }

            .timer-text {
                font-size: 0.6rem;
            }

            .tangga-cell .cell-icon {
                font-size: 0.8rem;
            }

            .dice {
                width: 55px;
                height: 55px;
                font-size: 2rem;
            }

            .question-text {
                font-size: 1rem;
            }

            .option-btn {
                font-size: 0.9rem;
                padding: 12px 15px;
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

        <nav class="game-tabs">
            <button class="tab-btn active" data-game="tangga">🪜 Tangga Cinta</button>
            <button class="tab-btn" data-game="ludo">🎲 Ludo Harmoni</button>
            <button class="tab-btn" data-game="kuis">❓ Kuis Halal/Batal</button>
        </nav>

        <!-- GAME 1: TANGGA CINTA -->
        <section id="game-tangga" class="game-section active">
            <div class="game-card">
                <div class="tangga-container">
                    <div class="tangga-header">
                        <div class="player-info player-suami active" id="playerSuami">
                            <div class="player-icon">👨</div>
                            <div>
                                <div class="player-name">Suami</div>
                                <div class="player-position">Posisi: <span id="suamiPos">1</span></div>
                            </div>
                        </div>
                        <div class="player-info player-istri" id="playerIstri">
                            <div class="player-icon">👩</div>
                            <div>
                                <div class="player-name">Istri</div>
                                <div class="player-position">Posisi: <span id="istriPos">1</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="tangga-board" id="tanggaBoard"></div>

                    <div class="dice-section">
                        <div class="dice" id="tanggaDice">🎲</div>
                        <button class="roll-btn" id="rollBtn" onclick="TanggaCinta.rollDice()">
                            Lempar Dadu
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- GAME 2: LUDO HARMONI -->
        <section id="game-ludo" class="game-section">
            <div class="game-card">
                <div class="ludo-container">
                    <div class="ludo-mode-toggle">
                        <button class="mode-toggle-btn active" id="modeSantai" onclick="LudoHarmoni.setMode('santai')">
                            😊 Mode Santai
                        </button>
                        <button class="mode-toggle-btn" id="modeSerius" onclick="LudoHarmoni.setMode('serius')">
                            📖 Mode Serius
                        </button>
                    </div>

                    <div class="tangga-header">
                        <div class="player-info player-suami active" id="ludoPlayerSuami">
                            <div class="player-icon">🤍</div>
                            <div>
                                <div class="player-name">Suami (Hijau)</div>
                                <div class="player-position">Rumah: <span id="suamiHome">0</span>/4</div>
                            </div>
                        </div>
                        <div class="player-info player-istri" id="ludoPlayerIstri">
                            <div class="player-icon">💕</div>
                            <div>
                                <div class="player-name">Istri (Kuning)</div>
                                <div class="player-position">Rumah: <span id="istriHome">0</span>/4</div>
                            </div>
                        </div>
                    </div>

                    <div class="ludo-board" id="ludoBoard"></div>

                    <div class="ludo-controls">
                        <div class="ludo-dice" id="ludoDice">🎲</div>
                        <button class="roll-btn" id="ludoRollBtn" onclick="LudoHarmoni.rollDice()">
                            Lempar Dadu
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- GAME 3: KUIS -->
        <section id="game-kuis" class="game-section">
            <div class="game-card">
                <div class="kuis-container">
                    <div class="kuis-start" id="kuisStart">
                        <h2>❓ Kuis Halal atau Batal?</h2>
                        <p>
                            Uji pengetahuanmu dan pasangan tentang fiqih puasa dan interaksi suami-istri saat Ramadhan.
                            Jawab 15 pertanyaan dan lihat hasilnya!
                        </p>
                        <button class="start-kuis-btn" onclick="KuisHalalBatal.start()">
                            🎮 Mulai Kuis
                        </button>
                    </div>

                    <div class="kuis-question" id="kuisQuestion">
                        <div class="question-card">
                            <div class="question-number">
                                Pertanyaan <span id="questionNum">1</span> dari 15
                            </div>
                            <div class="question-progress">
                                <div class="progress-fill" id="questionProgress" style="width: 6.67%"></div>
                            </div>
                            <div class="question-text" id="questionText">
                                Loading...
                            </div>
                            <div class="options-list" id="optionsList"></div>
                            <div class="explanation" id="explanation"></div>
                            <button class="next-question-btn" id="nextQuestionBtn" onclick="KuisHalalBatal.nextQuestion()">
                                Pertanyaan Selanjutnya →
                            </button>
                        </div>
                    </div>

                    <div class="kuis-result" id="kuisResult" style="display: none;">
                        <h2>Hasil Kuis Kamu</h2>
                        <div class="result-card">
                            <div class="result-emoji" id="resultEmoji">🎉</div>
                            <div class="result-title" id="resultTitle">Pasangan Harmonis!</div>
                            <div class="result-subtitle" id="resultSubtitle">Kalian paham batas-batasnya</div>
                            <div class="result-score" id="finalScore">0</div>
                            <div class="result-label">dari 15 jawaban benar</div>
                            <div class="share-buttons">
                                <button class="share-btn whatsapp" onclick="KuisHalalBatal.shareWhatsApp()">
                                    <span>📱</span> WhatsApp
                                </button>
                                <button class="share-btn facebook" onclick="KuisHalalBatal.shareFacebook()">
                                    <span>📘</span> Facebook
                                </button>
                                <button class="share-btn copy" onclick="KuisHalalBatal.copyResult()">
                                    <span>📋</span> Copy
                                </button>
                            </div>
                        </div>
                        <button class="start-kuis-btn" onclick="KuisHalalBatal.restart()">
                            🔄 Main Lagi
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Modal Title</h3>
                <button class="modal-close" onclick="closeModal()">✕</button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <button class="modal-action-btn" id="modalActionBtn" onclick="closeModal()">
                Lanjutkan
            </button>
        </div>
    </div>

    <footer class="footer">
        <p>🌙 Ngabuburit Harmonis - Ramadhan 1447H</p>
        <p>Semoga Ramadhan kita penuh keberkahan</p>
    </footer>

    <script>
        const State = {
            currentGame: 'tangga',
            maghribTime: new Date().setHours(18, 0, 0, 0),
            stats: JSON.parse(localStorage.getItem('ngabuburitStats')) || {
                gamesPlayed: 0,
                couplesToday: 0,
                tanggaWins: { suami: 0, istri: 0 },
                ludoWins: { suami: 0, istri: 0 },
                kuisScores: []
            }
        };

        function saveStats() {
            localStorage.setItem('ngabuburitStats', JSON.stringify(State.stats));
        }

        function showModal(title, content, type = '') {
            document.getElementById('modalTitle').textContent = title;
            const body = document.getElementById('modalBody');
            if (type) {
                body.innerHTML = '<span class="modal-type ' + type + '">' + type.toUpperCase() + '</span><br>' + content;
            } else {
                body.innerHTML = content;
            }
            document.getElementById('modalOverlay').classList.add('show');
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('show');
        }

        function launchConfetti() {
            const colors = ['#D4AF37', '#10B981', '#EC4899', '#3B82F6', '#F59E0B'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.style.animationDelay = Math.random() * 0.5 + 's';
                confetti.style.width = (Math.random() * 10 + 5) + 'px';
                confetti.style.height = confetti.style.width;
                document.body.appendChild(confetti);
                setTimeout(() => confetti.remove(), 5000);
            }
        }

        function initStars() {
            const container = document.getElementById('starsBackground');
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.cssText = 'left:' + Math.random() * 100 + '%;top:' + Math.random() * 100 + '%;width:' + (Math.random() * 3 + 1) + 'px;height:' + star.style.width + ';animation-delay:' + Math.random() * 5 + 's;animation-duration:' + (Math.random() * 3 + 2) + 's';
                container.appendChild(star);
            }
        }

        function updateMaghribTimer() {
            const now = new Date();
            const maghrib = new Date(State.maghribTime);
            if (now > maghrib) {
                maghrib.setDate(maghrib.getDate() + 1);
                State.maghribTime = maghrib.getTime();
            }
            const diff = maghrib - now;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            document.getElementById('timerHours').textContent = String(hours).padStart(2, '0');
            document.getElementById('timerMinutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('timerSeconds').textContent = String(seconds).padStart(2, '0');
        }

        function switchTab(gameId) {
            State.currentGame = gameId;
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.game === gameId);
            });
            document.querySelectorAll('.game-section').forEach(section => {
                section.classList.toggle('active', section.id === 'game-' + gameId);
            });
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => switchTab(btn.dataset.game));
        });

        const TanggaCinta = {
            boardSize: 64,
            players: {
                suami: { position: 1, color: 'blue' },
                istri: { position: 1, color: 'pink' }
            },
            currentPlayer: 'suami',
            isRolling: false,
            ladders: [
                { from: 4, to: 14 },
                { from: 9, to: 31 },
                { from: 20, to: 38 },
                { from: 28, to: 50 },
                { from: 40, to: 59 },
                { from: 51, to: 64 }
            ],
            snakes: [
                { from: 17, to: 7 },
                { from: 54, to: 34 },
                { from: 62, to: 19 },
                { from: 64, to: 60 }
            ],
            specialSquares: {
                5: { type: 'romantis', content: 'Peluk pasangan selama 10 detik 💕' },
                11: { type: 'fiqih', question: 'Bolehkah cium kening saat puasa?', answer: true, explanation: 'Cium kening diperbolehkan karena tidak membangkitkan syahwat.' },
                15: { type: 'pahala', content: 'Sebutkan 3 kebaikan pasanganmu 🌙' },
                22: { type: 'romantis', content: 'Sebutkan 3 hal yang kamu syukuri dari pasangan ❤️' },
                27: { type: 'fiqih', question: 'Bolehkah berpelukan saat puasa?', answer: true, explanation: 'Berpelukan diperbolehkan selama tidak membangkitkan syahwat.' },
                33: { type: 'pahala', content: 'Bacakan doa untuk pasangan 🤲' },
                39: { type: 'romantis', content: 'Genggam tangan pasangan dan tersenyum 😊' },
                45: { type: 'fiqih', question: 'Apakah bercanda mesra membatalkan puasa?', answer: false, explanation: 'Bercanda mesra tidak membatalkan puasa selama tidak menyebabkan keluar mani.' },
                50: { type: 'pahala', content: 'Sebutkan satu amal sunnah Ramadhan yang ingin dilakukan bersama ✨' },
                56: { type: 'romantis', content: 'Buat janji untuk tarawih bersama nanti malam 🕌' },
                61: { type: 'fiqih', question: 'Bolehkah cium pipi saat puasa?', answer: true, explanation: 'Cium pipi diperbolehkan dengan syarat tidak membangkitkan syahwat berlebihan.' }
            },

            init() {
                this.renderBoard();
                this.updatePlayerPositions();
            },

            renderBoard() {
                const board = document.getElementById('tanggaBoard');
                board.innerHTML = '';
                for (let row = 7; row >= 0; row--) {
                    const start = row * 8 + 1;
                    const end = start + 7;
                    const isReversed = row % 2 === 1;
                    for (let col = 0; col < 8; col++) {
                        const num = isReversed ? end - col : start + col;
                        const cell = document.createElement('div');
                        cell.className = 'tangga-cell';
                        cell.dataset.position = num;
                        const isLadder = this.ladders.find(l => l.from === num);
                        const isSnake = this.snakes.find(s => s.from === num);
                        const isSpecial = this.specialSquares[num];
                        if (isLadder) {
                            cell.classList.add('special');
                            cell.innerHTML = '<span class="cell-icon">🪜</span><span class="cell-number">' + num + '</span>';
                        } else if (isSnake) {
                            cell.classList.add('special');
                            cell.innerHTML = '<span class="cell-icon">🐍</span><span class="cell-number">' + num + '</span>';
                        } else if (isSpecial) {
                            cell.classList.add('special');
                            const icon = isSpecial.type === 'romantis' ? '❤️' : isSpecial.type === 'fiqih' ? '📖' : '🌙';
                            cell.innerHTML = '<span class="cell-icon">' + icon + '</span><span class="cell-number">' + num + '</span>';
                        } else {
                            cell.innerHTML = '<span class="cell-number">' + num + '</span>';
                        }
                        board.appendChild(cell);
                    }
                }
            },

            updatePlayerPositions() {
                document.querySelectorAll('.piece-on-board').forEach(p => p.remove());
                ['suami', 'istri'].forEach(player => {
                    const pos = this.players[player].position;
                    const cell = document.querySelector('[data-position="' + pos + '"]');
                    if (cell) {
                        const piece = document.createElement('div');
                        piece.className = 'piece-on-board piece-' + player;
                        cell.style.position = 'relative';
                        cell.appendChild(piece);
                    }
                    document.getElementById(player + 'Pos').textContent = pos;
                });
                document.getElementById('playerSuami').classList.toggle('active', this.currentPlayer === 'suami');
                document.getElementById('playerIstri').classList.toggle('active', this.currentPlayer === 'istri');
            },

            rollDice() {
                if (this.isRolling) return;
                this.isRolling = true;
                const dice = document.getElementById('tanggaDice');
                const btn = document.getElementById('rollBtn');
                btn.disabled = true;
                dice.classList.add('rolling');
                let rolls = 0;
                const rollInterval = setInterval(() => {
                    dice.textContent = Math.floor(Math.random() * 6) + 1;
                    rolls++;
                    if (rolls >= 10) {
                        clearInterval(rollInterval);
                        const result = Math.floor(Math.random() * 6) + 1;
                        dice.textContent = result;
                        dice.classList.remove('rolling');
                        this.movePlayer(result);
                    }
                }, 80);
            },

            movePlayer(steps) {
                const player = this.currentPlayer;
                let newPos = this.players[player].position + steps;
                if (newPos > 64) newPos = 64;
                this.players[player].position = newPos;
                this.updatePlayerPositions();

                if (newPos === 64) {
                    setTimeout(() => {
                        showModal('🎉 Selamat!', 'Selamat! ' + (player === 'suami' ? 'Suami' : 'Istri') + ' menang! 🏆<br><br>Semoga hubungan kalian semakin harmonis.', 'romantis');
                        document.getElementById('modalActionBtn').onclick = () => { closeModal(); this.reset(); };
                        launchConfetti();
                        State.stats.tanggaWins[player]++;
                        State.stats.gamesPlayed++;
                        saveStats();
                    }, 500);
                    this.isRolling = false;
                    document.getElementById('rollBtn').disabled = false;
                    return;
                }

                const ladder = this.ladders.find(l => l.from === newPos);
                if (ladder) {
                    setTimeout(() => {
                        showModal('🪜 Tangga!', 'Naik tangga dari posisi ' + ladder.from + ' ke ' + Math.min(ladder.to, 64) + '!', 'pahala');
                        this.players[player].position = Math.min(ladder.to, 64);
                        this.updatePlayerPositions();
                    }, 300);
                }

                const snake = this.snakes.find(s => s.from === newPos);
                if (snake) {
                    setTimeout(() => {
                        showModal('🐍 Ular!', 'Turun dari posisi ' + snake.from + ' ke ' + snake.to, 'fiqih');
                        this.players[player].position = snake.to;
                        this.updatePlayerPositions();
                    }, 300);
                }

                const special = this.specialSquares[newPos];
                if (special) {
                    setTimeout(() => {
                        if (special.type === 'romantis') {
                            showModal('💕 Tantangan Romantis', special.content, 'romantis');
                        } else if (special.type === 'fiqih') {
                            const answerText = special.answer ? 'Boleh' : 'Tidak boleh';
                            showModal('📖 Pertanyaan Fiqih', special.question + '<br><br><strong>Jawaban: ' + answerText + '</strong><br><em>' + special.explanation + '</em>', 'fiqih');
                        } else {
                            showModal('🌙 Misi Pahala', special.content, 'pahala');
                        }
                    }, 500);
                }

                setTimeout(() => {
                    this.currentPlayer = this.currentPlayer === 'suami' ? 'istri' : 'suami';
                    this.updatePlayerPositions();
                    this.isRolling = false;
                    document.getElementById('rollBtn').disabled = false;
                }, special ? 1000 : 600);
            },

            reset() {
                this.players.suami.position = 1;
                this.players.istri.position = 1;
                this.currentPlayer = 'suami';
                this.isRolling = false;
                this.updatePlayerPositions();
                document.getElementById('rollBtn').disabled = false;
                document.getElementById('tanggaDice').textContent = '🎲';
            }
        };

        const LudoHarmoni = {
            mode: 'santai',
            currentPlayer: 'suami',
            diceValue: 0,
            isRolling: false,
            greenPieces: [0, 0, 0, 0],
            yellowPieces: [0, 0, 0, 0],
            greenHome: 0,
            yellowHome: 0,

            questionsSantai: [
                'Sebutkan 1 hal yang membuatmu jatuh cinta lagi hari ini!',
                'Apa yang paling kamu syukuri dari pasanganmu?',
                'Buat satu doa untuk pasanganmu!',
                'Kenangan manis apa yang ingin kamu bagikan?',
                'Sampaikan satu kalimat sayang untuk pasangan!'
            ],
            questionsSerius: [
                'Apa hukum berpelukan saat puasa?',
                'Sebutkan satu adab suami istri dalam Islam!',
                'Apa hak suami atas istri yang harus dipenuhi?',
                'Apa hak istri atas suami yang harus dipenuhi?',
                'Bagaimana cara mengakhiri pertengkaran menurut Islam?'
            ],

            init() {
                this.renderBoard();
            },

            setMode(mode) {
                this.mode = mode;
                document.getElementById('modeSantai').classList.toggle('active', mode === 'santai');
                document.getElementById('modeSerius').classList.toggle('active', mode === 'serius');
            },

            renderBoard() {
                const board = document.getElementById('ludoBoard');
                board.innerHTML = '';
                for (let row = 0; row < 15; row++) {
                    for (let col = 0; col < 15; col++) {
                        const cell = document.createElement('div');
                        cell.className = 'ludo-cell';
                        cell.dataset.row = row;
                        cell.dataset.col = col;
                        if (row < 6 && col < 6) cell.className += ' ludo-home red';
                        else if (row < 6 && col > 8) cell.className += ' ludo-home green';
                        else if (row > 8 && col < 6) cell.className += ' ludo-home blue';
                        else if (row > 8 && col > 8) cell.className += ' ludo-home yellow';
                        else if (row >= 6 && row <= 8 && col >= 6 && col <= 8) {
                            cell.className += ' ludo-center';
                            cell.innerHTML = '🌙';
                        } else if (row === 6 || row === 8) {
                            if (col >= 0 && col <= 5) cell.className += ' ludo-path blue-path';
                            else if (col >= 9 && col <= 14) cell.className += ' ludo-path green-path';
                        } else if (col === 6 || col === 8) {
                            if (row >= 0 && row <= 5) cell.className += ' ludo-path red-path';
                            else if (row >= 9 && row <= 14) cell.className += ' ludo-path yellow-path';
                        } else if (row === 7 && col < 6) cell.className += ' ludo-path blue-path';
                        else if (row === 7 && col > 8) cell.className += ' ludo-path green-path';
                        else if (col === 7 && row < 6) cell.className += ' ludo-path red-path';
                        else if (col === 7 && row > 8) cell.className += ' ludo-path yellow-path';

                        if ((row === 6 && col === 1) || (row === 8 && col === 1) ||
                            (row === 6 && col === 13) || (row === 8 && col === 13) ||
                            (row === 1 && col === 6) || (row === 1 && col === 8) ||
                            (row === 13 && col === 6) || (row === 13 && col === 8)) {
                            cell.classList.add('safe-zone');
                        }
                        board.appendChild(cell);
                    }
                }
                this.renderPieces();
            },

            renderPieces() {
                document.querySelectorAll('.ludo-piece').forEach(p => p.remove());
                const greenHome = document.querySelector('.ludo-home.green');
                const yellowHome = document.querySelector('.ludo-home.yellow');
                const positions = [[15, 15], [45, 15], [15, 45], [45, 45]];
                this.greenPieces.forEach((pos, i) => {
                    if (pos === 0) {
                        const piece = document.createElement('div');
                        piece.className = 'ludo-piece green';
                        piece.style.cssText = 'position:absolute;left:' + positions[i][0] + 'px;top:' + positions[i][1] + 'px';
                        if (greenHome) {
                            greenHome.style.position = 'relative';
                            greenHome.appendChild(piece);
                        }
                    }
                });
                this.yellowPieces.forEach((pos, i) => {
                    if (pos === 0) {
                        const piece = document.createElement('div');
                        piece.className = 'ludo-piece yellow';
                        piece.style.cssText = 'position:absolute;left:' + positions[i][0] + 'px;top:' + positions[i][1] + 'px';
                        if (yellowHome) {
                            yellowHome.style.position = 'relative';
                            yellowHome.appendChild(piece);
                        }
                    }
                });
            },

            rollDice() {
                if (this.isRolling) return;
                this.isRolling = true;
                const dice = document.getElementById('ludoDice');
                const btn = document.getElementById('ludoRollBtn');
                btn.disabled = true;
                let rolls = 0;
                const rollInterval = setInterval(() => {
                    dice.textContent = Math.floor(Math.random() * 6) + 1;
                    rolls++;
                    if (rolls >= 10) {
                        clearInterval(rollInterval);
                        this.diceValue = Math.floor(Math.random() * 6) + 1;
                        dice.textContent = this.diceValue;
                        this.processRoll();
                    }
                }, 80);
            },

            processRoll() {
                setTimeout(() => {
                    this.currentPlayer = this.currentPlayer === 'suami' ? 'istri' : 'suami';
                    this.isRolling = false;
                    document.getElementById('ludoRollBtn').disabled = false;
                    document.getElementById('ludoPlayerSuami').classList.toggle('active', this.currentPlayer === 'suami');
                    document.getElementById('ludoPlayerIstri').classList.toggle('active', this.currentPlayer === 'istri');

                    const questions = this.mode === 'santai' ? this.questionsSantai : this.questionsSerius;
                    const question = questions[Math.floor(Math.random() * questions.length)];
                    showModal('💕 Giliran ' + (this.currentPlayer === 'suami' ? 'Suami' : 'Istri'), question, this.mode === 'santai' ? 'romantis' : 'fiqih');
                }, 1000);
            },

            reset() {
                this.greenPieces = [0, 0, 0, 0];
                this.yellowPieces = [0, 0, 0, 0];
                this.greenHome = 0;
                this.yellowHome = 0;
                this.currentPlayer = 'suami';
                this.isRolling = false;
                document.getElementById('suamiHome').textContent = '0';
                document.getElementById('istriHome').textContent = '0';
                document.getElementById('ludoDice').textContent = '🎲';
                this.renderBoard();
            }
        };

        const KuisHalalBatal = {
            currentQuestion: 0,
            score: 0,
            answered: false,

            questions: [
                { id: 1, question: 'Bolehkah berpelukan saat puasa?', options: [{ text: 'Boleh, selama tidak membangkitkan syahwat', correct: true }, { text: 'Tidak boleh, membatalkan puasa', correct: false }, { text: 'Boleh, tanpa batasan', correct: false }], explanation: 'Berpelukan diperbolehkan selama tidak membangkitkan syahwat.' },
                { id: 2, question: 'Apakah mimpi basah membatalkan puasa?', options: [{ text: 'Ya, membatalkan puasa', correct: false }, { text: 'Tidak, tidak membatalkan puasa', correct: true }, { text: 'Membatalkan jika disengaja', correct: false }], explanation: 'Mimpi basah tidak membatalkan puasa karena terjadi di luar kesengajaan.' },
                { id: 3, question: 'Bolehkah cium kening atau tangan istri saat puasa?', options: [{ text: 'Boleh karena tidak membangkitkan syahwat berlebih', correct: true }, { text: 'Tidak boleh sama sekali', correct: false }, { text: 'Hanya boleh di malam hari', correct: false }], explanation: 'Cium kening atau tangan diperbolehkan sebagai ungkapan kasih sayang.' },
                { id: 4, question: 'Apakah bercanda mesra dengan pasangan membatalkan puasa?', options: [{ text: 'Ya, pasti membatalkan', correct: false }, { text: 'Tidak, selama tidak keluar mani', correct: true }, { text: 'Membatalkan jika siang hari', correct: false }], explanation: 'Bercanda mesra tidak membatalkan selama tidak menyebabkan keluar mani.' },
                { id: 5, question: 'Bolehkah memegang tangan atau berpelukan ringan saat puasa?', options: [{ text: 'Boleh dengan syarat tidak membangkitkan syahwat', correct: true }, { text: 'Tidak boleh dalam keadaan apapun', correct: false }, { text: 'Hanya boleh setelah ashar', correct: false }], explanation: 'Memegang tangan atau pelukan ringan diperbolehkan sebagai kasih sayang.' },
                { id: 6, question: 'Apa yang membatalkan puasa menurut fiqih?', options: [{ text: 'Makan dan minum dengan sengaja', correct: true }, { text: 'Bercanda dengan istri', correct: false }, { text: 'Mimpi basah', correct: false }], explanation: 'Yang membatalkan puasa adalah makan, minum, atau hubungan seksual dengan sengaja.' },
                { id: 7, question: 'Bolehkah bercium bibir saat puasa?', options: [{ text: 'Boleh jika yakin tidak keluar mani', correct: true }, { text: 'Tidak boleh sama sekali', correct: false }, { text: 'Boleh bebas', correct: false }], explanation: 'Hukum asal bercium adalah makruh, namun jika dikhawatirkan membatalkan maka haram.' },
                { id: 8, question: 'Apakah mandi wajib karena mimpi basah wajib dilakukan segera?', options: [{ text: 'Ya, sebelum shalat', correct: true }, { text: 'Tidak, bisa ditunda', correct: false }, { text: 'Hanya jika shalat Jumat', correct: false }], explanation: 'Mandi wajib harus dilakukan sebelum shalat. Namun tidak membatalkan puasa.' },
                { id: 9, question: 'Bolehkah bersenda gawa dengan istri di siang hari Ramadhan?', options: [{ text: 'Boleh, selama tidak berlebihan', correct: true }, { text: 'Tidak boleh sama sekali', correct: false }, { text: 'Hanya boleh saat sahur', correct: false }], explanation: 'Bersenda gawa diperbolehkan sebagai wujud keharmonisan selama tidak melampaui batas.' },
                { id: 10, question: 'Apa hukum berhubungan suami istri di siang hari Ramadhan?', options: [{ text: 'Membatalkan puasa dan dikena kafarat', correct: true }, { text: 'Membatalkan saja', correct: false }, { text: 'Tidak membatalkan jika istri ridho', correct: false }], explanation: 'Hubungan suami istri di siang hari membatalkan puasa dan dikena kafarat.' },
                { id: 11, question: 'Bolehkah memeluk istri dari belakang saat puasa?', options: [{ text: 'Boleh jika tidak membangkitkan syahwat', correct: true }, { text: 'Tidak boleh', correct: false }, { text: 'Hanya boleh malam hari', correct: false }], explanation: 'Memeluk dari belakang diperbolehkan selama tidak membangkitkan syahwat.' },
                { id: 12, question: 'Apakah wajib mengqadha puasa jika bermimpi basah?', options: [{ text: 'Tidak wajib mengqadha', correct: true }, { text: 'Wajib mengqadha', correct: false }, { text: 'Tergantung ulama', correct: false }], explanation: 'Mimpi basah tidak membatalkan puasa, sehingga tidak wajib mengqadha.' },
                { id: 13, question: 'Bolehkah mencium istri saat puasa dengan niat berlebih?', options: [{ text: 'Tidak boleh jika dikhawatirkan membatalkan puasa', correct: true }, { text: 'Boleh, niat tidak pengaruh', correct: false }, { text: 'Tergantung situasi', correct: false }], explanation: 'Jika dikhawatirkan membatalkan puasa (keluar mani), maka haram mencium dengan niat berlebih.' },
                { id: 14, question: 'Apa yang harus dilakukan jika keluar mani saat bercanda dengan istri?', options: [{ text: 'Puasa batal, wajib mandi dan mengqadha', correct: true }, { text: 'Hanya mandi saja', correct: false }, { text: 'Puasa tidak batal', correct: false }], explanation: 'Jika keluar mani karena syahwat, puasa batal dan wajib mandi serta mengqadha.' },
                { id: 15, question: 'Bolehkah menatap istri dengan pandangan bernafsu saat puasa?', options: [{ text: 'Makruh, sebaiknya dijaga', correct: true }, { text: 'Boleh bebas', correct: false }, { text: 'Membatalkan puasa', correct: false }], explanation: 'Menatap dengan syahwat dianjurkan untuk dijaga untuk menjaga kekhusyukan puasa.' }
            ],

            start() {
                this.currentQuestion = 0;
                this.score = 0;
                this.answered = false;
                document.getElementById('kuisStart').style.display = 'none';
                document.getElementById('kuisResult').style.display = 'none';
                document.getElementById('kuisQuestion').classList.add('active');
                State.stats.gamesPlayed++;
                saveStats();
                this.showQuestion();
            },

            showQuestion() {
                const q = this.questions[this.currentQuestion];
                document.getElementById('questionNum').textContent = this.currentQuestion + 1;
                document.getElementById('questionProgress').style.width = ((this.currentQuestion + 1) / 15 * 100) + '%';
                document.getElementById('questionText').textContent = q.question;
                const optionsList = document.getElementById('optionsList');
                optionsList.innerHTML = '';
                q.options.forEach((opt, idx) => {
                    const btn = document.createElement('button');
                    btn.className = 'option-btn';
                    btn.textContent = opt.text;
                    btn.onclick = () => this.selectAnswer(idx, opt.correct);
                    optionsList.appendChild(btn);
                });
                document.getElementById('explanation').classList.remove('show');
                document.getElementById('nextQuestionBtn').classList.remove('show');
                this.answered = false;
            },

            selectAnswer(index, isCorrect) {
                if (this.answered) return;
                this.answered = true;
                const buttons = document.querySelectorAll('.option-btn');
                buttons.forEach((btn, idx) => {
                    btn.disabled = true;
                    if (idx === index) {
                        btn.classList.add(isCorrect ? 'correct' : 'wrong');
                    } else if (this.questions[this.currentQuestion].options[idx].correct) {
                        btn.classList.add('correct');
                    }
                });
                if (isCorrect) {
                    this.score++;
                }
                const explanation = document.getElementById('explanation');
                explanation.textContent = this.questions[this.currentQuestion].explanation;
                explanation.classList.add('show');
                document.getElementById('nextQuestionBtn').classList.add('show');
            },

            nextQuestion() {
                this.currentQuestion++;
                if (this.currentQuestion >= this.questions.length) {
                    this.showResult();
                } else {
                    this.showQuestion();
                }
            },

            showResult() {
                document.getElementById('kuisQuestion').classList.remove('active');
                document.getElementById('kuisResult').style.display = 'block';
                const score = this.score;
                const total = this.questions.length;
                const percentage = (score / total) * 100;
                document.getElementById('finalScore').textContent = score + '/' + total;
                let emoji, title, subtitle;
                if (percentage >= 80) {
                    emoji = '💚';
                    title = 'Pasangan Harmonis & Paham Batas';
                    subtitle = 'MasyaAllah! Kalian sangat memahami fiqih puasa!';
                    launchConfetti();
                } else if (percentage >= 60) {
                    emoji = '💛';
                    title = 'Masih Perlu Upgrade Ilmu';
                    subtitle = 'Bagus! Tinggal sedikit lagi untuk sempurna.';
                } else {
                    emoji = '❤️';
                    title = 'Wajib Diskusi Setelah Tarawih';
                    subtitle = 'Jangan menyerah! Diskusikan dengan pasangan.';
                }
                document.getElementById('resultEmoji').textContent = emoji;
                document.getElementById('resultTitle').textContent = title;
                document.getElementById('resultSubtitle').textContent = subtitle;
                State.stats.kuisScores.push({ score: score, total: total, date: new Date().toISOString() });
                saveStats();
            },

            restart() {
                this.start();
            },

            shareWhatsApp() {
                const score = this.score;
                const total = this.questions.length;
                const percentage = Math.round((score / total) * 100);
                let result = percentage >= 80 ? 'Pasangan Harmonis & Paham Batas 💚' : percentage >= 60 ? 'Masih Perlu Upgrade Ilmu 💛' : 'Wajib Diskusi Setelah Tarawih ❤️';
                const text = '🌙 *Ngabuburit Harmonis - Kuis Halal/Batal*\n\n' + result + '\n\nSkor: ' + score + '/' + total + ' (' + percentage + '%)\n\nYuk uji pengetahuan fiqih puasa bareng pasangan! 🔥\n\n' + window.location.href;
                window.open('https://wa.me/?text=' + encodeURIComponent(text), '_blank');
            },

            shareFacebook() {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank');
            },

            copyResult() {
                const score = this.score;
                const total = this.questions.length;
                const percentage = Math.round((score / total) * 100);
                let result = percentage >= 80 ? 'Pasangan Harmonis & Paham Batas' : percentage >= 60 ? 'Masih Perlu Upgrade Ilmu' : 'Wajib Diskusi Setelah Tarawih';
                const text = '🌙 Ngabuburit Harmonis - Kuis Halal/Batal\n\n' + result + '\n\nSkor: ' + score + '/' + total + ' (' + percentage + '%)';
                navigator.clipboard.writeText(text).then(() => {
                    const btn = document.querySelector('.share-btn.copy');
                    btn.innerHTML = '<span>✅</span> Tersalin!';
                    setTimeout(() => {
                        btn.innerHTML = '<span>📋</span> Copy';
                    }, 2000);
                });
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            initStars();
            TanggaCinta.init();
            LudoHarmoni.init();
            updateMaghribTimer();
            setInterval(updateMaghribTimer, 1000);
            document.getElementById('modalOverlay').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
            State.stats.couplesToday = Math.min(State.stats.couplesToday + 1, 999);
            saveStats();
        });
    </script>
</body>
</html>
