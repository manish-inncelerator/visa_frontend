<?php
$pages = $database->select('pages', '*', [
    'pagePosition' => 'footer',
    'is_active' => 1
]);
?>
<!-- Footer 2 - Footer Component -->
<footer class="footer mt-5">

    <!-- Widgets - Footer Component -->
    <section class="bg-light py-4 py-md-5 py-xl-8 border-top">
        <div class="container overflow-hidden">
            <div class="row gy-4 gy-lg-0 justify-content-xl-between">
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <a href="#!">
                            <img src="assets/images/main-logo.png" alt="Fayyaz Travels Logo" width="175" height="57">
                        </a>
                        <h5 class="text-muted">Dedicated Service, Tailored for you </h5>
                        <!-- <p class="text-muted small">Visas, forms - oh, what a bore!<br>
                            Paperwork piling on the floor.<br>
                            Stand in line? Wait all day?<br>
                            Nope! We've got a better way!</p>

                        <p class="text-muted small">No more stress, no more pain,<br>
                            We'll do the work - you just gain!<br>
                            Pack your bags, sip some tea,<br>
                            Your visa's done - who needs a queue? Not me! 🛫👜🎒💼</p> -->

                        <p class="text-muted small">Founded on our own love of travel, Fayyaz Travels continues to welcome travelers consumed by wanderlust into the family, keeping that streak of passion burning bright.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Get in Touch</h4>
                        <address class="mb-4">435 Orchard Rd, #11-00 Wisma Atria, Singapore 238877</address>
                        <p class="mb-1">
                            <a class="link-secondary text-decoration-none" href="tel:+6562352900">+65 6235 2900</a>
                        </p>
                        <p class="mb-0">
                            <a class="link-secondary text-decoration-none" href="mailto:info@fayyaztravels.com">info@fayyaztravels.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Learn More</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a target="_blank" href="https://fayyaztravels.com/about" class="link-secondary text-decoration-none">About Us</a>
                            </li>
                            <li class="mb-2">
                                <a target="_blank" href="https://fayyaztravels.com/contact" class="link-secondary text-decoration-none">Contact Us</a>
                            </li>
                            <li class="mb-2">
                                <a target="_blank" href="https://fayyaztravels.com/csr" class="link-secondary text-decoration-none">Corporate Social Responsibility</a>
                            </li>
                            <li class="mb-2">
                                <a target="_blank" href="https://fayyaztravels.com/testimonials" class="link-secondary text-decoration-none">Testimonials</a>
                            </li>
                            <li class="mb-2">
                                <a target="_blank" href="https://fayyaztravels.com/terms-and-conditions" class="link-secondary text-decoration-none">Terms and Conditions</a>
                            </li>
                            <li class="mb-0">
                                <a target="_blank" href="https://fayyaztravels.com/privacy-policy" class="link-secondary text-decoration-none">Privacy Policy</a>
                            </li>
                            <?php
                            foreach ($pages as $page):
                            ?>
                                <li class="mb-0  mt-2">
                                    <a href="pages/<?= $page['pageSlug']; ?>" class="link-secondary text-decoration-none"><?= $page['pageName']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-4">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Our Newsletter</h4>
                        <p class="mb-4">Subscribe to our newsletter to get our news & discounts delivered to you.</p>
                        <form id="subsForm">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="email-newsletter-addon">
                                            <i class="bi bi-envelope-heart fs-4"></i>
                                        </span>
                                        <input type="email" name="subemail" class="form-control-lg form-control" id="email-newsletter" value="" placeholder="Email Address" aria-label="email-newsletter" aria-describedby="email-newsletter-addon" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-blue btn-lg rounded-pill" type="submit">Subscribe <i class="bi bi-arrow-up-right-circle"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright - Footer Component -->
    <div class="bg-light py-4 py-md-5 py-xl-8 border-top border-light-subtle">
        <div class="container overflow-hidden">
            <div class="row gy-4 gy-md-0 align-items-md-center">
                <div class="col-xs-12 col-md-7 order-1 order-md-0">
                    <div class="credits text-secondary text-center text-md-start mt-2 fs-8">
                        Built for 🌍 by <a href="https://inncelerator.com" class="link-secondary text-decoration-none">Inncelerator</a> with <i class="bi bi-heart-fill text-danger"></i> in 🇸🇬 Singapore.
                    </div>
                    <div class="copyright text-center text-md-start">
                        <?= date('Y'); ?> &copy; Fayyaz Travels. All Rights Reserved.
                    </div>
                </div>

                <div class="col-xs-12 col-md-5 order-0 order-md-1">
                    <div class="social-media-wrapper">
                        <ul class="list-unstyled m-0 p-0 d-flex justify-content-center justify-content-md-end">
                            <li class="me-3">
                                <a href="https://www.facebook.com/FayyazTravels/" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-facebook fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://www.instagram.com/fayyaztravels/" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-instagram fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://x.com/FayyazTravels" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-twitter-x fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://sg.linkedin.com/company/fayyaz-travels-pte-ltd" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-linkedin fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://www.youtube.com/@fayyaztravels" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-youtube fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://www.pinterest.com/fayyaztravels/" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-pinterest fs-4"></i>
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://www.tiktok.com/@fayyaztravels" class="link-dark link-opacity-75-hover">
                                    <i class="bi bi-tiktok fs-4"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <p class="text-center text-muted small">Version MMXXV-II-XXVII: <a class="text-decoration-none text-golden" href=" changelog">Changelog</a> &bullet; Powered by <a target="_blank" class="text-decoration-none text-golden" href="https://inncelerator.com">Inncelerator</a></p>
                </div>
            </div>
        </div>
    </div>

</footer>

<script src="assets/js/mailchimp.js"></script>