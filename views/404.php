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

        /* Realistic Balloon Styles */
        .balloon {
            position: absolute;
            width: 60px;
            height: 80px;
            background: radial-gradient(circle at 50% 20%, rgba(255, 255, 255, 0.6), transparent 70%);
            border-radius: 50% 50% 40% 40% / 70% 70% 30% 30%;
            opacity: 0.7;
            animation: balloonFloat 10s ease-in-out infinite;
            z-index: 0;
        }

        .balloon::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 50%;
            width: 2px;
            height: 30px;
            background: rgba(0, 0, 0, 0.3);
            transform: translateX(-50%);
        }

        .balloon-1 {
            top: 10%;
            left: 15%;
            background-color: rgba(255, 144, 179, 0.6);
            /* Pink */
            animation-duration: 12s;
        }

        .balloon-2 {
            top: 50%;
            right: 20%;
            background-color: rgba(127, 216, 227, 0.6);
            /* Cyan */
            animation-duration: 8s;
        }

        .balloon-3 {
            bottom: 15%;
            left: 40%;
            background-color: rgba(255, 231, 76, 0.6);
            /* Yellow */
            animation-duration: 10s;
        }

        .balloon-4 {
            top: 30%;
            right: 10%;
            background-color: rgba(247, 174, 248, 0.6);
            /* Purple */
            animation-duration: 14s;
        }

        /* Bird Styles */
        .bird {
            position: absolute;
            width: 50px;
            height: 50px;
            animation: birdFly 20s linear infinite;
            opacity: 0.6;
            z-index: 1;
        }

        .bird svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 4px rgba(127, 216, 227, 0.5));
            animation: birdFlap 0.5s infinite;
        }

        .bird-1 {
            top: 20%;
            left: -50px;
            animation-duration: 18s;
        }

        .bird-2 {
            top: 70%;
            right: -50px;
            animation-duration: 22s;
            animation-direction: reverse;
        }

        /* Blob Styles */
        .blob {
            position: absolute;
            width: 70px;
            height: 70px;
            background: radial-gradient(circle, rgba(247, 174, 248, 0.4), transparent 70%);
            border-radius: 60% 40% 30% 70% / 50% 60% 40% 50%;
            opacity: 0.5;
            animation: blobFloat 15s ease-in-out infinite;
            z-index: 0;
        }

        .blob-1 {
            top: 25%;
            left: 5%;
            animation-duration: 13s;
        }

        .blob-2 {
            bottom: 10%;
            right: 25%;
            animation-duration: 17s;
        }

        /* Animations */
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

        @keyframes balloonFloat {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            25% {
                transform: translateY(-60px) translateX(15px);
            }

            50% {
                transform: translateY(-100px) translateX(-10px);
            }

            75% {
                transform: translateY(-40px) translateX(20px);
            }
        }

        @keyframes birdFly {
            0% {
                transform: translateX(-100px);
            }

            100% {
                transform: translateX(150vw);
            }
        }

        @keyframes birdFlap {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            50% {
                transform: rotate(-10deg) scale(1.05);
            }
        }

        @keyframes blobFloat {

            0%,
            100% {
                transform: translateY(0) translateX(0) rotate(0deg);
            }

            25% {
                transform: translateY(-40px) translateX(30px) rotate(45deg);
            }

            50% {
                transform: translateY(-80px) translateX(-20px) rotate(90deg);
            }

            75% {
                transform: translateY(-30px) translateX(25px) rotate(135deg);
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
        <!-- Realistic Balloons -->
        <div class="balloon balloon-1"></div>
        <div class="balloon balloon-2"></div>
        <div class="balloon balloon-3"></div>
        <div class="balloon balloon-4"></div>
        <!-- Flying Birds -->
        <div class="bird bird-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#6C757D">
                <path d="M20.5 4.5c-.3-.6-.9-1-1.6-1h-5.3l-1.4-2.3c-.3-.5-.9-.8-1.5-.8H5.6c-.7 0-1.3.4-1.6 1L1.5 6.3c-.3.5-.3 1.2 0 1.7l3.7 6.5c.3.5.9.8 1.5.8h2.7l2.6 4.3c.3.5.9.8 1.5.8h5c.7 0 1.3-.4 1.6-1l2.5-4.8c.3-.5.3-1.2 0-1.7L20.5 4.5z" />
            </svg>
        </div>
        <div class="bird bird-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#6C757D">
                <path d="M20.5 4.5c-.3-.6-.9-1-1.6-1h-5.3l-1.4-2.3c-.3-.5-.9-.8-1.5-.8H5.6c-.7 0-1.3.4-1.6 1L1.5 6.3c-.3.5-.3 1.2 0 1.7l3.7 6.5c.3.5.9.8 1.5.8h2.7l2.6 4.3c.3.5.9.8 1.5.8h5c.7 0 1.3-.4 1.6-1l2.5-4.8c.3-.5.3-1.2 0-1.7L20.5 4.5z" />
            </svg>
        </div>
        <!-- Floating Blobs -->
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>

        <div class="error-card text-center">
            <div class="error-code mb-4">404</div>
            <h1 class="error-message mb-4">✨ Oops! Lost in the Clouds ✨</h1>
            <p class="lead mb-4 text-muted">
                This page went on a little vacation without telling us. <br>
                It's probably off having fun while you’re stuck here. 😅 <br>
                Let's go find it—follow the breadcrumbs! 🍞
            </p>
            <a href="/visa/" class="btn btn-magic mb-3">
                <i class="bi bi-stars me-2"></i>Back to Safety
            </a>
            <div class="mt-4">
                <small class="text-muted">
                    Follow the fairy dust to our
                    <a href="/visa/" class="text-decoration-none" style="color: var(--accent-pink)">
                        home page
                    </a>
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>