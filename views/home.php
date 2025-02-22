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
echo html_head('Home', null, true, ['assets/css/home.css']);

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
                <form action="search_query" method="get" class="mx-auto" id="searchForm" style="width:300px;" autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false">
                    <!-- Search -->
                    <div class="custom-search-card">
                        <div class="custom-input-wrapper">
                            <span class="custom-input-icon"><i class="bi bi-geo-alt-fill"></i></span>
                            <input autofocus type="text" id="searchDestination" class="custom-input" name="q" placeholder="Search here" required>
                            <div class="custom-buttons">
                                <button class="custom-btn-search rounded-pill" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                                <button class="custom-btn-voice" type="button">
                                    <i class="bi bi-mic"></i>
                                </button>
                            </div>
                            <label for="searchDestination" class="custom-input-label">Where to?</label>
                        </div>
                    </div>
                    <!-- ./Search -->

                    <div class="trending-places">
                        <strong class="me-2 mt-2">Trending places</strong>
                        <br class="d-block d-lg-none">
                        <a class="text-golden me-2" href="country/apply-for-singapore-visa-online">Singapore</a>
                        <a class="text-golden me-2" href="country/apply-for-tokyo-visa-online">Tokyo</a>
                        <a class="text-golden me-2" href="country/apply-for-paris-visa-online">Paris</a>
                        <a class="text-golden me-2" href="country/apply-for-new-york-visa-online">New York</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<!-- Shuffle Section -->
<section class="container my-3">
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
</section>

<!-- Places section -->
<section class="container">
    <div class="row">
        <?php require 'components/VisaCard.php'; ?>
    </div>
</section>

<!-- Footer -->
<?php require 'components/Footer.php'; ?>

<?php
echo html_scripts(
    includeJQuery: false,
    includeBootstrap: true,
    customScripts: [],
    includeSwal: false
);
?>
<script>
    function loadSearchPage() {
        location.href = 'search';
    }
</script>

</body>

</html>