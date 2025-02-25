<?php
$pages = $database->select('pages', '*', [
    'pagePosition' => 'header',
    'is_active' => 1
]);
?>
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top d-none d-lg-block">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="assets/images/main-logo.png" alt="Fayyaz Travels" height="36px"></a>

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
        </ul>

        <div class="d-flex">
            <!-- Profile Dropdown -->
            <div class="dropdown me-2">
                <button class="btn btn-white dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                    <img src="assets/images/dp/no-user.jpg" alt="Profile" class="rounded-circle" width="30" height="30">
                </button>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <!-- <li><a class="dropdown-item" href="profile">Profile</a></li> -->
                    <li><a class="dropdown-item" href="settings">Settings</a></li>
                    <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
            </div>
            <a target="_blank" href="https://api.whatsapp.com/send/?phone=6594314389&text=Hi!%20I%20am%20interested%20in%20visa%20processing&type=phone_number&app_absent=0" class="btn btn-blue rounded-pill me-2" type="submit" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                <i class="bi bi-whatsapp" style="margin-right: 8px;"></i> Chat
            </a>
            <a href="applications" class="btn btn-golden rounded-pill me-2" type="submit" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                <i class="bi bi-file-earmark" style="margin-right: 8px;"></i> My Applications
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top d-block d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="assets/images/main-logo.png" alt="Fayyaz Travels" height="36px"></a>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-auto me-2">
            <button class="btn btn-white dropdown-toggle" type="button" id="profileDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                <img src="assets/images/dp/no-user.jpg" alt="Profile" class="rounded-circle" width="30" height="30">
            </button>
            <ul class="dropdown-menu" aria-labelledby="profileDropdownMobile">
                <!-- <li><a class="dropdown-item" href="profile">Profile</a></li> -->
                <li><a class="dropdown-item" href="settings">Settings</a></li>
                <li><a class="dropdown-item" href="logout">Logout</a></li>
            </ul>
        </div>

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
                </ul>
                <div class="d-flex flex-column mt-auto">
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone=6594314389&text=Hi!%20I%20am%20interested%20in%20visa%20processing&type=phone_number&app_absent=0" class="btn btn-blue me-2 mb-2" type="submit" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                        <i class="bi bi-whatsapp" style="margin-right: 8px;"></i> Chat
                    </a><a href="auth/register" class="btn btn-info me-2 mb-2" type="submit" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem;">
                        <i class="bi bi-file-earmark" style="margin-right: 8px;"></i> My Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>