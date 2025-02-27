<?php

defined('BASE_DIR') || die('Direct access denied');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require 'inc/html_head.php';
require 'inc/html_foot.php';
require 'database.php';
require 'min.php';
require 'imgClass.php';


// Output HTML head and scripts
echo html_head('Home', null, true, ['assets/css/home.css'], true);

?>
<!-- Navbar -->
<?php
if (isset($_SESSION['user_id'])) {

    require 'components/LoggedinNavbar.php';
} else {

    require 'components/Navbar.php';
}
?>
<!-- ./Navbar -->

<!-- Hero Section -->
<section class="container-fluid hero-section text-white" id="heroSection">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1>Your Visa, Simplified!</h1>
                <h2 class="mb-4 h4 alterFont">Your visa process, simplified with expert guidance at each stage</h2>
                <!-- Search Form -->
                <form action="search" method="get" class="mx-auto" id="searchForm" autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false">
                    <div class="custom-search-card">
                        <div class="custom-input-wrapper">
                            <span class="custom-input-icon"><i class="bi bi-geo-alt-fill"></i></span>
                            <input autofocus type="text" id="searchDestination" class="custom-input" name="q" placeholder="Search a Country" required>
                            <div class="custom-buttons">
                                <button class="custom-btn-search rounded-pill" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button class="custom-btn-voice" type="button">
                                    <i class="bi bi-mic"></i>
                                </button>
                            </div>
                            <label for="searchDestination" class="custom-input-label">Where to?</label>
                        </div>
                    </div>
                </form>
                <!-- ./Search Form -->
                <div class="trending-places">
                    <strong class="me-2 mt-2">Trending places</strong>
                    <br class="d-block d-lg-none">
                    <a class="text-golden me-2" href="country/apply-for-singapore-visa-online">🇸🇬 Singapore</a>
                    <a class="text-golden me-2" href="country/apply-for-united-arab-emirates-visa-online">🇦🇪 United Arab Emirates</a>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Shuffle Section -->
<!-- <section class="container my-3">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="scroll-nav-container rounded-3 border p-1">
                <ul class="custom-nav nav nav-pills">
                    <li class="custom-nav-item nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Popular</a>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="nav-link" href="#">In a Week</a>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="nav-link" href="#">In a Month</a>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="nav-link" href="#">Seasonal</a>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="nav-link" href="#">Schengen Visa</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

<!-- Places section -->
<section class="container mt-3">
    <div class="row">
        <?php require 'components/VisaCard.php'; ?>
    </div>
</section>

<!-- Why Book With Us -->
<section class="container my-5">
    <div class="row">
        <div class="col">
            <div class="text-center section-title">
                <h2 class="fw-bold mt-5">Why Choose Us?</h2>
                <p class="subtitle fs-5">Why trust us for your visa requirements</p>







            </div>
            <div class="row g-4">
                <!-- Experience Card -->
                <div class="col-lg-3 col-12">
                    <div class="booking-feature border text-center">
                        <div class="booking-feature-body">
                            <div class="icon-wrapper">
                                <!-- Bootstrap Icon for "Star" -->
                                <i class="bi bi-star feature-icon fs-1"></i>
                            </div>
                            <h5 class="mb-3">Proven Experience</h5>
                            <p class="text-muted">Trusted by thousands of travelers for 15 years</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="booking-feature border text-center">
                        <div class="booking-feature-body">
                            <div class="icon-wrapper">
                                <!-- Bootstrap Icon for "Check Circle" -->
                                <i class="bi bi-people feature-icon fs-1"></i>
                            </div>
                            <h5 class="mb-3">Expert Team</h5>
                            <p class="text-muted">Our team consists of highly experienced professionals.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="booking-feature border text-center">
                        <div class="booking-feature-body">
                            <div class="icon-wrapper">
                                <!-- Bootstrap Icon for "Calendar" -->
                                <i class="bi bi-emoji-smile feature-icon fs-1"></i>
                            </div>
                            <h5 class="mb-3">End-to-End Visa Services</h5>
                            <p class="text-muted">Comprehensive visa assistance from application to approval, ensuring a hassle-free process.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="booking-feature border text-center">
                        <div class="booking-feature-body">
                            <div class="icon-wrapper">
                                <!-- Bootstrap Icon for "Shield Lock" -->
                                <i class="bi bi-shield-check feature-icon fs-1"></i>
                            </div>
                            <h5 class="mb-3">Safety and Privacy</h5>
                            <p class="text-muted">Your security is our priority with robust protection for your data.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ./Why Book With Us -->

<!-- How it Works section -->
<section class="visa-section my-5" id="how-it-works">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center section-title">
                <h2 class="fw-bold mt-5">Expert Visa Application with Fayyaz Travels</h2>
                <p class="subtitle fs-5">Your hassle-free journey begins with our 4-step process</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="step-card">
                    <div class="card-body text-center">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h3 class="step-title">Quick Application</h3>
                        <p class="step-description">Fill out your details & make a secure payment</p>
                        <ul class="feature-list">
                            <li>User-friendly form</li>
                            <li>Secure payment gateway</li>
                            <li>Saves your progress</li>
                        </ul>
                    </div>
                    <div class="card-glass-effect"></div>
                    <div class="card-shine"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="step-card">
                    <div class="card-body text-center">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h3 class="step-title">AI-Powered Processing</h3>
                        <p class="step-description">Speedy documentation with advanced AI</p>
                        <ul class="feature-list">
                            <li>Automated verification</li>
                            <li>Smart form completion</li>
                            <li>Rapid processing</li>
                        </ul>
                    </div>
                    <div class="card-glass-effect"></div>
                    <div class="card-shine"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="step-card">
                    <div class="card-body text-center">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h3 class="step-title">Expert Review</h3>
                        <p class="step-description">Double checked by our specialists and in-house AI</p>
                        <ul class="feature-list">
                            <li>Human and in-house AI expertise</li>
                            <li>99.5% approval rate</li>
                            <li>Error-free applications</li>
                        </ul>
                    </div>
                    <div class="card-glass-effect"></div>
                    <div class="card-shine"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="step-card">
                    <div class="card-body text-center">
                        <div class="step-number mb-3">4</div>
                        <div class="step-icon">
                            <i class="bi bi-airplane"></i>
                        </div>
                        <h3 class="step-title">Visa Delivery</h3>
                        <p class="step-description">Sit back as we deliver your visa on time</p>
                        <ul class="feature-list">
                            <li>On-time delivery</li>
                            <li>Status tracking</li>
                            <li>Travel support</li>
                        </ul>
                    </div>
                    <div class="card-glass-effect"></div>
                    <div class="card-shine"></div>
                </div>
            </div>
        </div>

        <div class="row cta-container">
            <div class="col-12 text-center">
                <!-- <button class="btn btn-primary btn-lg cta-button">Start Your Application Now</button> -->
                <p class="mt-3 fs-4 text-muted"><i class="bi bi-people"></i> Join thousands of travelers who trust Fayyaz Travels</p>
            </div>
        </div>
    </div>
</section>


<!-- Places section -->
<section class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card p-4 rounded-3 border-0">
                <div class="card-body">
                    <div class="row">
                        <!-- First Column: Text and Input Form -->
                        <div class="col-md-8">
                            <h5><b>Ready to get started? Enter your travel destination</b></h5>
                            <p class="text-muted">🚀 Visa Process Made Easy
                                📋 Get Your Checklist
                                💥 Sign Up FREE!</p>
                            <div class="row justify-content-left">
                                <div class="col-md-8">
                                    <form action="search" method="get" class="mb-4">
                                        <div class="input-group input-group-lg rounded-pill bg-white shadow-sm">
                                            <span class="input-group-text bg-white border-0 rounded-start-pill">
                                                <i class="bi bi-airplane-fill text-blue fs-4"></i>
                                            </span>
                                            <input type="text" name="q" class="form-control border-0 shadow-none" placeholder="Where to, captain?" required>
                                            <button class="btn btn-blue rounded-end-pill">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Second Column: Empty or Add Additional Content -->
                        <div class="col-md-4">
                            <div class="row">
                                <!-- First Card -->
                                <div class="col-12">
                                    <div class="card bg-light mb-3 rounded-pill">
                                        <div class="card-body text-center">
                                            <p class="fw-bold card-text">Faster than pizza delivery</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Card -->
                                <div class="col-12">
                                    <div class="card bg-light rounded-pill mb-3">
                                        <div class="card-body text-center">
                                            <p class="fw-bold card-text ">Easier than finding Wi-Fi</p>
                                        </div>
                                    </div>
                                </div>



                                <!-- third Card -->
                                <div class="col-12">
                                    <div class="card bg-light rounded-pill">
                                        <div class="card-body text-center">
                                            <p class="fw-bold card-text">Safer than your bank</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 col-xxl-4">
            <!-- Empty or additional content in the second column -->
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section position-relative my-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Get Your Visa Approved with Confidence</h1>
            </div>
        </div>
    </div>
    <div class="stats-overlay"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">

            <!-- Google Rating -->
            <div class="col-sm-6 col-md-3 rating-container">
                <div class="rating-value">4.7</div>
                <div class="stars">
                    <svg class="star-icon" viewBox="0 0 24 24">
                        <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z" />
                    </svg>
                    <svg class="star-icon" viewBox="0 0 24 24">
                        <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z" />
                    </svg>
                    <svg class="star-icon" viewBox="0 0 24 24">
                        <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z" />
                    </svg>
                    <svg class="star-icon" viewBox="0 0 24 24">
                        <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z" />
                    </svg>
                    <svg class="star-icon half-star" viewBox="0 0 24 24">
                        <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z" />
                    </svg>
                </div>
                <div class="rating-text">Google Rating</div>
            </div>

            <!-- Visa Approval Rate -->
            <div class="col-sm-6 col-md-3 rating-container">
                <div class="svg-container">
                    <svg class="progress-circle" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#e0e0e0" stroke-width="10" />
                        <path d="M 50,50 m -45,0 a 45,45 0 1,1 90,0 a 45,45 0 1,1 -90,0"
                            fill="none" stroke="#009a5d" stroke-width="10" stroke-dasharray="282.6" stroke-dashoffset="2.8" />
                        <text x="50" y="55" text-anchor="middle" font-size="18" font-weight="bold">99.5%</text>
                    </svg>
                </div>
                <div class="rating-text">Visa Approval Rate</div>
            </div>

            <!-- Visas Processed (Meter Style) -->
            <div class="col-sm-6 col-md-3 rating-container">
                <div class="flip-counter">
                    <div class="digit">1</div>
                    <div class="digit">0</div>
                    <div class="digit">0</div>
                    <div class="digit">0</div>
                    <div class="digit">0</div>
                    <div class="digit plus">+</div>
                </div>
                <div class="rating-text mt-2">Visas Processed</div>
            </div>

        </div>
    </div>
</section>


<!-- Reviews -->
<?php require 'components/Reviews.php'; ?>
<!-- Listening modal -->
<div class="modal fade" id="listeningModal" tabindex="-1" aria-labelledby="listeningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center mt-2">
                <p>Listening...</p>
            </div>
        </div>
    </div>
</div>



<!-- Footer -->
<?php require 'components/Footer.php'; ?>

<?php
echo html_scripts(
    includeJQuery: false,
    includeBootstrap: true,
    customScripts: [],
    includeSwal: false,
    includeNotiflix: true
);
?>

<script>
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en-US';
        recognition.interimResults = false;

        // Select modal elements
        const modalElement = document.getElementById('listeningModal');
        const modal = new bootstrap.Modal(modalElement);
        const modalBody = modalElement.querySelector('.modal-body p');
        const voiceButton = document.querySelector('.custom-btn-voice');

        // Event listener for when the modal is fully shown
        modalElement.addEventListener('shown.bs.modal', event => {
            modalBody.textContent = "Listening...";
            recognition.start(); // Start recognition only after modal is fully visible
        });

        // Event listener for the button to open modal
        voiceButton.addEventListener('click', function() {
            modal.show();
        });

        // When speech is detected
        recognition.onresult = function(event) {
            const spokenWord = event.results[0][0].transcript;
            modalBody.textContent = `Heard: "${spokenWord}"`;

            setTimeout(() => {
                modal.hide();
                window.location.href = `search?q=${encodeURIComponent(spokenWord)}`;
            }, 1000);
        };

        // Handle no speech detected
        recognition.onspeechend = function() {
            modalBody.textContent = "No speech detected";
            setTimeout(() => modal.hide(), 1000);
        };

        // Handle errors
        recognition.onerror = function(event) {
            modalBody.textContent = "Listening failed. Please try again.";
            setTimeout(() => modal.hide(), 1500);
            Notiflix.Notify.failure('Sorry, there was an error recognizing your voice.');
        };

        // Handle modal close event
        modalElement.addEventListener('hidden.bs.modal', event => {
            recognition.stop(); // Ensure recognition stops when modal is closed
            console.log("Modal closed. Speech recognition stopped.");
        });
    } else {
        // Hide voice button if speech recognition is not supported
        const voiceButton = document.querySelector('.custom-btn-voice');
        voiceButton.style.display = 'none';
        Notiflix.Notify.failure('Your browser does not support voice recognition.');
    }
</script>


<script>
    // How it works
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.nav-link[href*="how-it-works"]').addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            const target = document.querySelector("#how-it-works"); // Select target section
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 50, // Adjust 50px for fixed headers if needed
                    behavior: "smooth"
                });
            }
        });
    });
</script>

<script>
    // Optional: Add a flip animation effect dynamically (if needed)
    document.addEventListener("DOMContentLoaded", function() {
        let digits = document.querySelectorAll(".digit");
        digits.forEach((digit, index) => {
            setTimeout(() => {
                digit.classList.add("flip");
            }, index * 200);
        });
    });
</script>


</body>

</html>