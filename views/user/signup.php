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
echo html_head('Sign Up', null, true, ['assets/css/signup.css'], true);
?>
<!-- Navbar -->
<?php require 'components/SimpleNavbar.php'; ?>
<!-- ./Navbar -->

<!-- Signup Section -->
<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="form-container my-2">
                <!-- Icon and Header -->
                <div class="text-center">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-person fs-4"></i>
                    </div>
                    <h4 class="text-brown mb-2">Visas on time</h4>
                    <p class="text-muted mb-4">And sign ups in no time.</p>
                </div>

                <!-- Sign Up Form -->


                <a href="google" class="btn btn-outline-golden w-100">
                    <img src="assets/images/google.png" alt="">
                    Continue with Google
                </a>


                <div class="divider">
                    <span class="px-2 bg-white text-muted fw-bold">OR</span>
                </div>

                <form novalidate autocomplete="off" id="regForm">
                    <div class="row">
                        <!-- First Name and Last Name in a row -->
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                            <div class="invalid-feedback">Please provide your first name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" required>
                            <div class="invalid-feedback">Please provide your last name.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">Please provide a password.</div>
                    </div>

                    <div class="mb-4">
                        <label for="repeatPassword" class="form-label">Repeat Password</label>
                        <input type="password" name="repeatPassword" id="repeatPassword" class="form-control form-control-lg" required>
                        <div class="invalid-feedback" id="passwordMismatchFeedback" style="display: none;">
                            Passwords do not match.
                        </div>
                    </div>

                    <button type="submit" class="btn cta-button w-100 btn-lg rounded-pill p-2 plexFont fw-bold">Sign Up</button>
                </form>


                <div class="divider">
                    <span class="px-2 bg-white text-muted fw-bold">OR</span>
                </div>

                <p class="card-text">Already signed up? <a href="auth/login">Log in</a></p>
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


<script>
    const hu = '<?= $hu; ?>';
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("regForm");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            form.classList.add("was-validated");

            if (!form.checkValidity() || form.password.value !== form.repeatPassword.value) {
                form.repeatPassword.classList.toggle("is-invalid", form.password.value !== form.repeatPassword.value);
                return;
            }

            const jsonData = Object.fromEntries(new FormData(form));

            try {
                const res = await fetch("api/v1/signup", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "HU": "<?= $hu; ?>"
                    },
                    body: JSON.stringify(jsonData)
                });
                const data = await res.json();
                if (data.success) {
                    // alert("Log in successful!");

                    Notiflix.Notify.success(data.success);
                    form.reset();
                    form.classList.remove("was-validated");
                    location.href = 'auth/login?through=new_signup';
                } else {
                    // alert(data.error || "Login failed. Please try again.");
                    Notiflix.Notify.failure(data.error || "Login Failed. Please try again.");
                }
            } catch (err) {
                // alert("An error occurred. Please try again.");

                Notiflix.Notify.failure('An error occurred. Please try again.');
            }
        });
    });
</script>
</body>

</html>