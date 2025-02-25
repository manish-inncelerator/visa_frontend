<?php
$pages = $database->select('pages', '*', [
    'pagePosition' => 'header',
    'is_active' => 1
]);
?>
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top d-none d-lg-block">
    <div class="container-fluid">
        <a class="navbar-brand" href="/visa_f/"><img src="assets/images/main-logo.png" alt="Fayyaz Travels" height="36px"></a>

        <!-- Desktop Navbar Menu -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link plexFont text-uppercase fw-bold" aria-current="page" href="#">Home</a>
            </li>
            <?php
            foreach ($pages as $page):
            ?>
                <li class="nav-item">
                    <a class="nav-link plexFont text-uppercase fw-bold" href="pages/<?= $page['pageSlug']; ?>"><?= $page['pageName']; ?></a>
                </li>
            <?php endforeach; ?>
            <li class="nav-item">
                <a class="nav-link plexFont text-uppercase fw-bold" aria-current="page" href="home#how-it-works">How it Works?</a>
            </li>
        </ul>

        <div class="d-flex ">
            <a target="_blank" href="https://api.whatsapp.com/send/?phone=6594314389&text=Hi!%20I%20am%20interested%20in%20visa%20processing&type=phone_number&app_absent=0" class="btn rounded-pill btn-blue me-2">
                <i class="bi bi-whatsapp"></i> Chat
            </a>
            <a href="auth/signup" class="btn rounded-pill btn-golden me-2">
                <i class="bi bi-person-plus"></i> Sign Up
            </a>
            <a href="auth/login" class="btn rounded-pill btn-light border">
                <i class="bi bi-box-arrow-in-right"></i> Log in
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top d-block d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="/visa_f/"><img src="assets/images/main-logo.png" alt="Fayyaz Travels" height="36px"></a>

        <!-- Offcanvas trigger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" style="outline: none !important; box-shadow: none !important; border: none !important;">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- Offcanvas Menu -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="assets/images/main-logo.png" alt="Fayyaz Travels" height="36px"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link plexFont text-uppercase fw-bold" aria-current="page" href="#">Home</a>
                    </li>
                    <?php

                    foreach ($pages as $page):
                    ?>

                        <li class="nav-item">
                            <a class="nav-link plexFont text-uppercase fw-bold" href="pages/<?= $page['pageSlug']; ?>"><?= $page['pageName']; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="nav-item">
                        <a class="nav-link plexFont text-uppercase fw-bold" aria-current="page" href="#">How it Works?</a>
                    </li>
                </ul>
                <div class="d-flex flex-column mt-auto">
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone=6594314389&text=Hi!%20I%20am%20interested%20in%20visa%20processing&type=phone_number&app_absent=0" class="btn rounded-pill btn-blue mb-2">
                        <i class="bi bi-whatsapp"></i> Chat
                    </a>
                    <a href="auth/signup" class="btn rounded-pill btn-golden mb-2">
                        <i class="bi bi-person-plus"></i> Sign Up
                    </a>
                    <a href="auth/login" class="btn rounded-pill btn-light border">
                        <i class="bi bi-box-arrow-in-right"></i> Log in
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>