<?php
defined('BASE_DIR') || die('Direct access denied');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require 'inc/html_head.php';
require 'inc/html_foot.php';
require 'database.php';
require 'PageCache.php'; // Include the PageCache class
require 'min.php';



// Output HTML head and scripts
echo html_head('Log in', null, true, ['assets/css/signup.css'], true);
?>
<!-- Navbar -->
<?php require 'components/SimpleNavbar.php'; ?>
<!-- ./Navbar -->


<!-- Login Section -->
<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="form-container my-2">
                <?php if (isset($_GET['goto'])): ?>
                    <p class="alert alert-warning text-center mb-4"><i class="bi bi-exclamation-circle"></i> Please log in first.</p>
                <?php endif; ?>
                <?php if (isset($_GET['through']) && $_GET['through'] === 'new_password'): ?>
                    <p class="alert alert-warning text-center mb-4"><i class="bi bi-exclamation-circle"></i> Welcome! Please log in.</p>
                <?php endif; ?>
                <?php if (isset($_GET['through']) && $_GET['through'] === 'new_signup'): ?>
                    <p class="alert alert-success text-center mb-4"><i class="bi bi-person-circle"></i> Congratulations! Your account has been created and verified successfully. Please log in.</p>
                <?php endif; ?>

                <!-- Icon and Header -->
                <div class="text-center">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-person fs-4"></i>
                    </div>
                    <h4 class="text-brown mb-2">Log in swiftly</h4>
                    <p class="text-muted mb-4">Get your visa quickly!</p>
                </div>

                <!-- Google Login -->
                <a href="google" class="btn btn-outline-golden w-100">
                    <img src="assets/images/google.png" alt="Google logo" class="me-2">
                    Continue with Google
                </a>

                <div class="divider">
                    <span class="px-2 bg-white text-muted fw-bold">OR</span>
                </div>

                <!-- Login Form -->
                <form novalidate autocomplete="off" id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">Please provide your password.</div>
                    </div>

                    <button type="submit" class="btn cta-button w-100 btn-lg rounded-pill p-2 plexFont fw-bold">Log In</button>
                </form>

                <div class="divider">
                    <span class="px-2 bg-white text-muted fw-bold">OR</span>
                </div>

                <p class="card-text fw-bold">New here?
                    <?php if (isset($_GET['o']) && !empty(trim(strip_tags(stripslashes($_GET['o']))))) : ?>
                        <a href="auth/signup?o=<?= trim(strip_tags(stripslashes($_GET['o']))) ?>">Sign up</a>
                    <?php else : ?>
                        <a href="auth/signup">Sign up</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>



<?php
// Output HTML scripts
echo html_scripts(
    includeJQuery: false,
    includeBootstrap: true,
    customScripts: [],
    includeSwal: false,
    includeNotiflix: true
);
?>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("loginForm");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            form.classList.add("was-validated");

            if (!form.checkValidity()) return;

            const jsonData = Object.fromEntries(new FormData(form));

            try {
                const res = await fetch("api/v1/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "HU": "<?= $hu; ?>"
                    },
                    body: JSON.stringify(jsonData),
                });

                const {
                    success,
                    error
                } = await res.json();

                if (success) {
                    Notiflix.Notify.success(success);
                    form.reset();
                    form.classList.remove("was-validated");

                    const params = new URLSearchParams(window.location.search);
                    const goto = params.get("goto");
                    const o = params.get("o");

                    location.href = goto ?
                        `application/${goto}/persona` :
                        o ?
                        `application/${o}/persona?through=login` :
                        "home";

                } else {
                    Notiflix.Notify.failure(error || "Login failed. Please try again.");
                }
            } catch {
                Notiflix.Notify.failure("An error occurred. Please try again.");
            }
        });
    });
</script>

</body>

</html>