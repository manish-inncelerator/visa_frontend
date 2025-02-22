<?php // views/404.php 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Magical Journey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --gradient-start: #7FD8E3;
            --gradient-end: #F7AEF8;
            --accent-pink: #FF90B3;
            --accent-yellow: #FFE74C;
        }

        body {
            background: linear-gradient(135deg,
                    rgba(127, 216, 227, 0.15) 0%,
                    rgba(247, 174, 248, 0.15) 100%);
            min-height: 100vh;
        }

        .error-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .error-card {
            padding: 3rem;
            border-radius: 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(127, 216, 227, 0.1);
            position: relative;
            z-index: 2;
            transform-style: preserve-3d;
            animation: float 6s ease-in-out infinite;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            font-size: 1.75rem;
            color: #6C757D;
            letter-spacing: 0.5px;
        }

        .btn-magic {
            background: linear-gradient(45deg, var(--accent-pink), var(--accent-yellow));
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-magic:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 24px rgba(255, 144, 179, 0.3);
        }

        .btn-magic::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg,
                    transparent 25%,
                    rgba(255, 255, 255, 0.3) 50%,
                    transparent 75%);
            animation: sparkle 2s infinite linear;
        }

        .magic-dust {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .fairy {
            position: absolute;
            width: 100px;
            height: 100px;
            animation: fairyFly 15s linear infinite;
            opacity: 0.8;
            z-index: 1;
        }

        .fairy svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 8px rgba(247, 174, 248, 0.6));
            animation: fairyFloat 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(-1deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes sparkle {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes fairyFly {
            0% {
                transform: translate(-100px, 100vh) rotate(0deg);
            }

            100% {
                transform: translate(150vw, -100px) rotate(360deg);
            }
        }


        @keyframes fairyFloat {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.1);
            }
        }

        .floating-shape {
            position: absolute;
            background: rgba(127, 216, 227, 0.1);
            border-radius: 50%;
            animation: float 4s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 20%;
            left: 10%;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 30%;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <!-- Floating Background Shapes -->
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <!-- Flying Fairy -->
        <div class="fairy">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#F7AEF8">
                <path d="M12 2c-.96 0-1.88.23-2.7.64l1.48 1.48C11.28 4.05 11.64 4 12 4c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8c0-.36.05-.72.12-1.06l-1.48-1.48C2.23 10.12 2 11.04 2 12c0 5.52 4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm3 8h-2V7h-2v3H9v2h3v3h2v-3h3v-2z" />
            </svg>
        </div>

        <div class="error-card text-center">
            <div class="error-code mb-4">404</div>
            <h1 class="error-message mb-4">✨ Oops! Lost in the Clouds ✨</h1>
            <p class="lead mb-4 text-muted">
                The page you seek has floated away<br>
                Like a balloon on a sunny day!
            </p>
            <button class="btn btn-magic mb-3">
                <i class="bi bi-stars me-2"></i>Back to Safety
            </button>

            <div class="mt-4">
                <small class="text-muted">
                    Follow the fairy dust to our
                    <a href="/" class="text-decoration-none" style="color: var(--accent-pink)">
                        home page
                    </a>
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>