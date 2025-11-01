<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - SMK N 2 Siatas Barita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroon: #800020;
            --gold: #D4AF37;
            --black: #1A1A1A;
            --cream: #F5F5F0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--black) 0%, var(--maroon) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            padding: 20px;
            color: var(--cream);
            overflow: hidden;
        }
        
        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            max-width: 1000px;
            width: 100%;
            background: rgba(26, 26, 26, 0.9);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 
                0 20px 40px rgba(0,0,0,0.3),
                0 0 0 1px rgba(212, 175, 55, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            animation: heroSlideIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .left-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--maroon), var(--gold));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--black);
            font-size: 1.5rem;
            animation: logoGlow 3s ease-in-out infinite;
        }
        
        .school-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--gold);
            font-weight: 700;
        }
        
        .maintenance-badge {
            background: linear-gradient(135deg, var(--maroon), transparent);
            border: 2px solid var(--gold);
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            animation: badgePulse 2s ease-in-out infinite;
        }
        
        .main-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--cream), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .main-message {
            color: rgba(245, 245, 240, 0.8);
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 2rem;
        }
        
        .right-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .gear-animation {
            position: relative;
            height: 200px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .main-gear {
            font-size: 6rem;
            color: var(--gold);
            animation: rotate 8s linear infinite;
            filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.3));
        }
        
        .small-gear {
            position: absolute;
            font-size: 2.5rem;
            color: var(--maroon);
            animation: rotateReverse 6s linear infinite;
        }
        
        .small-gear.top {
            top: 20px;
            right: 40px;
        }
        
        .small-gear.bottom {
            bottom: 20px;
            left: 40px;
        }
        
        .countdown-section {
            text-align: center;
        }
        
        .countdown-label {
            color: var(--gold);
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .countdown-timer {
            font-family: 'Courier New', monospace;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--cream);
            background: rgba(128, 0, 32, 0.3);
            padding: 1rem;
            border-radius: 15px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 1.5rem;
            animation: countdownGlow 2s ease-in-out infinite;
        }
        
        .progress-section {
            margin-top: 1rem;
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            color: rgba(245, 245, 240, 0.7);
        }
        
        .progress-bar {
            height: 6px;
            background: rgba(128, 0, 32, 0.3);
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--maroon), var(--gold));
            border-radius: 3px;
            width: 70%;
            position: relative;
            animation: progressAnimation 3s ease-in-out infinite;
        }
        
        .contact-info {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }
        
        .contact-text {
            font-size: 0.85rem;
            color: rgba(245, 245, 240, 0.6);
        }
        
        .email {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .email:hover {
            color: var(--cream);
        }
        
        /* Animations */
        @keyframes heroSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes logoGlow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
                transform: scale(1.05);
            }
        }
        
        @keyframes badgePulse {
            0%, 100% {
                box-shadow: 0 0 0 rgba(212, 175, 55, 0.4);
            }
            50% {
                box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
            }
        }
        
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        @keyframes rotateReverse {
            from {
                transform: rotate(360deg);
            }
            to {
                transform: rotate(0deg);
            }
        }
        
        @keyframes countdownGlow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(212, 175, 55, 0.1);
            }
            50% {
                box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
            }
        }
        
        @keyframes progressAnimation {
            0%, 100% {
                width: 65%;
            }
            50% {
                width: 72%;
            }
        }
        
        /* Responsive Design */
        @media (max-width: 968px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem;
            }
            
            .main-title {
                font-size: 2.2rem;
            }
            
            .main-gear {
                font-size: 4rem;
            }
            
            .small-gear {
                font-size: 2rem;
            }
            
            .countdown-timer {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-container {
                padding: 1.5rem;
            }
            
            .main-title {
                font-size: 1.8rem;
            }
            
            .logo-container {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .maintenance-badge {
                padding: 0.6rem 1.2rem;
                font-size: 0.8rem;
            }
            
            .main-gear {
                font-size: 3rem;
            }
            
            .small-gear {
                font-size: 1.5rem;
            }
            
            .countdown-timer {
                font-size: 1.5rem;
                padding: 0.8rem;
            }
            
            .gear-animation {
                height: 150px;
            }
        }
        
        /* No scroll bar */
        body::-webkit-scrollbar {
            display: none;
        }
        
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body>
    <div class="hero-container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="school-name">SMK N 2 SIATAS BARITA</div>
            </div>
            
            <div class="maintenance-badge">
                <i class="fas fa-tools"></i>
                MAINTENANCE MODE
            </div>
            
            <h1 class="main-title">
                Sistem Sedang<br>
                Dalam<br>
                Pemeliharaan
            </h1>
            
            <p class="main-message">
                Kami sedang melakukan peningkatan sistem untuk pengalaman yang lebih baik. 
                Terima kasih atas pengertian dan kesabaran Anda.
            </p>
        </div>
        
        <!-- Right Section -->
        <div class="right-section">
            <div class="gear-animation">
                <i class="fas fa-cog main-gear"></i>
                <i class="fas fa-cog small-gear top"></i>
                <i class="fas fa-cog small-gear bottom"></i>
            </div>
            
            <div class="countdown-section">
                <div class="countdown-label">
                    <i class="fas fa-clock me-2"></i>
                    Estimasi Selesai
                </div>
                <div class="countdown-timer" id="countdown">
                    00:00:00
                </div>
                
                <div class="progress-section">
                    <div class="progress-label">
                        <span>Progress</span>
                        <span id="progress-percent">70%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>
                </div>
            </div>
            
            <div class="contact-info">
                <div class="contact-text">
                    Untuk informasi lebih lanjut:<br>
                    <a href="mailto:admin@smkn2siatasbarita.sch.id" class="email">
                        admin@smkn2siatasbarita.sch.id
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Countdown Timer
        function updateCountdown() {
            const endTime = new Date('{{ $schedule['end'] ?? new Date(Date.now() + 2 * 60 * 60 * 1000) }}').getTime();
            const now = new Date().getTime();
            const distance = endTime - now;
            
            if (distance < 0) {
                document.getElementById('countdown').innerHTML = 'SELESAI';
                document.getElementById('countdown').style.color = '#90EE90';
                document.getElementById('progress-percent').textContent = '100%';
                document.querySelector('.progress-fill').style.width = '100%';
                return;
            }
            
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            const formatTime = (time) => time.toString().padStart(2, '0');
            
            document.getElementById('countdown').innerHTML = 
                `${formatTime(hours)}:${formatTime(minutes)}:${formatTime(seconds)}`;
            
            // Update progress
            const totalTime = 2 * 60 * 60 * 1000; // 2 hours
            const elapsed = totalTime - distance;
            const progress = Math.min(95, Math.max(5, (elapsed / totalTime) * 100));
            
            document.getElementById('progress-percent').textContent = Math.round(progress) + '%';
            document.querySelector('.progress-fill').style.width = Math.round(progress) + '%';
        }
        
        // Auto refresh every 30 seconds
        setInterval(updateCountdown, 1000);
        updateCountdown();
        
        setTimeout(() => {
            window.location.reload();
        }, 30000);
        
        // Check if maintenance is over
        setInterval(() => {
            fetch(window.location.href, { method: 'HEAD' })
                .then(response => {
                    if (response.status !== 503) {
                        document.querySelector('.main-title').innerHTML = 
                            'Sistem<br>Kembali<br>Online!';
                        document.querySelector('.main-message').textContent = 
                            'Pemeliharaan telah selesai. Mengarahkan...';
                        document.querySelector('.main-gear').className = 'fas fa-check-circle main-gear';
                        document.querySelector('.main-gear').style.color = '#90EE90';
                        document.querySelector('.maintenance-badge').innerHTML = 
                            '<i class="fas fa-check"></i> MAINTENANCE SELESAI';
                        
                        setTimeout(() => window.location.reload(), 2000);
                    }
                })
                .catch(() => {});
        }, 10000);
    </script>
</body>
</html>