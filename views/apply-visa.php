<?php if (isset($params['country'])) : ?>
    <?php $countryName = e($params['country']) ?>
<?php else : ?>
    <h1 class="error">Country Missing</h1>
    <?php exit; ?>
<?php endif; ?>

<?php
function countryToEmoji($countryName)
{
    // Full list of country names mapped to ISO 3166-1 alpha-2 codes
    $countries = [
        "Afghanistan" => "AF",
        "Albania" => "AL",
        "Algeria" => "DZ",
        "Andorra" => "AD",
        "Angola" => "AO",
        "Antigua and Barbuda" => "AG",
        "Argentina" => "AR",
        "Armenia" => "AM",
        "Australia" => "AU",
        "Austria" => "AT",
        "Azerbaijan" => "AZ",
        "Bahamas" => "BS",
        "Bahrain" => "BH",
        "Bangladesh" => "BD",
        "Barbados" => "BB",
        "Belarus" => "BY",
        "Belgium" => "BE",
        "Belize" => "BZ",
        "Benin" => "BJ",
        "Bhutan" => "BT",
        "Bolivia" => "BO",
        "Bosnia and Herzegovina" => "BA",
        "Botswana" => "BW",
        "Brazil" => "BR",
        "Brunei" => "BN",
        "Bulgaria" => "BG",
        "Burkina Faso" => "BF",
        "Burundi" => "BI",
        "Cabo Verde" => "CV",
        "Cambodia" => "KH",
        "Cameroon" => "CM",
        "Canada" => "CA",
        "Central African Republic" => "CF",
        "Chad" => "TD",
        "Chile" => "CL",
        "China" => "CN",
        "Colombia" => "CO",
        "Comoros" => "KM",
        "Congo (Congo-Brazzaville)" => "CG",
        "Congo (Congo-Kinshasa)" => "CD",
        "Costa Rica" => "CR",
        "Croatia" => "HR",
        "Cuba" => "CU",
        "Cyprus" => "CY",
        "Czechia" => "CZ",
        "Denmark" => "DK",
        "Djibouti" => "DJ",
        "Dominica" => "DM",
        "Dominican Republic" => "DO",
        "Ecuador" => "EC",
        "Egypt" => "EG",
        "El Salvador" => "SV",
        "Equatorial Guinea" => "GQ",
        "Eritrea" => "ER",
        "Estonia" => "EE",
        "Eswatini" => "SZ",
        "Ethiopia" => "ET",
        "Fiji" => "FJ",
        "Finland" => "FI",
        "France" => "FR",
        "Gabon" => "GA",
        "Gambia" => "GM",
        "Georgia" => "GE",
        "Germany" => "DE",
        "Ghana" => "GH",
        "Greece" => "GR",
        "Grenada" => "GD",
        "Guatemala" => "GT",
        "Guinea" => "GN",
        "Guinea-Bissau" => "GW",
        "Guyana" => "GY",
        "Haiti" => "HT",
        "Honduras" => "HN",
        "Hungary" => "HU",
        "Iceland" => "IS",
        "India" => "IN",
        "Indonesia" => "ID",
        "Iran" => "IR",
        "Iraq" => "IQ",
        "Ireland" => "IE",
        "Israel" => "IL",
        "Italy" => "IT",
        "Jamaica" => "JM",
        "Japan" => "JP",
        "Jordan" => "JO",
        "Kazakhstan" => "KZ",
        "Kenya" => "KE",
        "Kiribati" => "KI",
        "Kuwait" => "KW",
        "Kyrgyzstan" => "KG",
        "Laos" => "LA",
        "Latvia" => "LV",
        "Lebanon" => "LB",
        "Lesotho" => "LS",
        "Liberia" => "LR",
        "Libya" => "LY",
        "Liechtenstein" => "LI",
        "Lithuania" => "LT",
        "Luxembourg" => "LU",
        "Madagascar" => "MG",
        "Malawi" => "MW",
        "Malaysia" => "MY",
        "Maldives" => "MV",
        "Mali" => "ML",
        "Malta" => "MT",
        "Mauritania" => "MR",
        "Mauritius" => "MU",
        "Mexico" => "MX",
        "Moldova" => "MD",
        "Monaco" => "MC",
        "Mongolia" => "MN",
        "Montenegro" => "ME",
        "Morocco" => "MA",
        "Mozambique" => "MZ",
        "Myanmar" => "MM",
        "Namibia" => "NA",
        "Nauru" => "NR",
        "Nepal" => "NP",
        "Netherlands" => "NL",
        "New Zealand" => "NZ",
        "Nicaragua" => "NI",
        "Niger" => "NE",
        "Nigeria" => "NG",
        "North Korea" => "KP",
        "North Macedonia" => "MK",
        "Norway" => "NO",
        "Oman" => "OM",
        "Pakistan" => "PK",
        "Palau" => "PW",
        "Panama" => "PA",
        "Papua New Guinea" => "PG",
        "Paraguay" => "PY",
        "Peru" => "PE",
        "Philippines" => "PH",
        "Poland" => "PL",
        "Portugal" => "PT",
        "Qatar" => "QA",
        "Romania" => "RO",
        "Russia" => "RU",
        "Rwanda" => "RW",
        "Saudi Arabia" => "SA",
        "Senegal" => "SN",
        "Serbia" => "RS",
        "Seychelles" => "SC",
        "Sierra Leone" => "SL",
        "Singapore" => "SG",
        "Slovakia" => "SK",
        "Slovenia" => "SI",
        "Solomon Islands" => "SB",
        "Somalia" => "SO",
        "South Africa" => "ZA",
        "South Korea" => "KR",
        "Spain" => "ES",
        "Sri Lanka" => "LK",
        "Sudan" => "SD",
        "Sweden" => "SE",
        "Switzerland" => "CH",
        "Syria" => "SY",
        "Tajikistan" => "TJ",
        "Tanzania" => "TZ",
        "Thailand" => "TH",
        "Togo" => "TG",
        "Tonga" => "TO",
        "Tunisia" => "TN",
        "Turkey" => "TR",
        "Uganda" => "UG",
        "Ukraine" => "UA",
        "United Arab Emirates" => "AE",
        "United Kingdom" => "GB",
        "United States" => "US",
        "Uruguay" => "UY",
        "Uzbekistan" => "UZ",
        "Vanuatu" => "VU",
        "Vatican City" => "VA",
        "Venezuela" => "VE",
        "Vietnam" => "VN",
        "Yemen" => "YE",
        "Zambia" => "ZM",
        "Zimbabwe" => "ZW"
    ];

    // Normalize input
    $countryName = ucwords(strtolower(trim($countryName)));

    // Check if country exists
    if (!isset($countries[$countryName])) {
        return "❓"; // Return unknown emoji if not found
    }

    // Get ISO code
    $countryCode = strtoupper($countries[$countryName]);

    // Convert to emoji flag using mb_chr
    $emojiFlag = '';
    foreach (str_split($countryCode) as $letter) {
        $emojiFlag .= mb_chr(ord($letter) - ord('A') + 0x1F1E6, 'UTF-8');
    }

    return $emojiFlag;
}
?>

<?php
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Get the slug from the URL (e.g. "apply-for-united-arab-emirates-visa-online")
$slug = basename(parse_url($current_url, PHP_URL_PATH));

// Remove the "apply-for-" prefix
$slug = preg_replace('/^apply-for-/', '', $slug);

// Extract the part before "-visa"
$countrySlug = explode('-visa', $slug)[0];

// Replace hyphens with spaces and capitalize words
$country_name = ucwords(str_replace('-', ' ', trim($countrySlug)));

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
echo html_head($country_name . ' Visa Online &mdash; Fees, Requirements & Application Process', null, true, ['assets/css/visa.css'], true);

/**
 * Fetch country details and images by country name.
 *
 * @param string $countryName The name of the country to fetch.
 * @return array Country data with images.
 */
function fetchCountryDetails($countryName, $includeImages = false)
{
    global $database;

    try {
        // Fetch country details
        $countryDetails = $database->select(
            'countries',
            [
                '[>]visa_types' => ['visa_type' => 'id']
            ],
            [
                'countries.id',
                'countries.country_name',
                'countries.serviceability',
                'countries.stay_duration',
                'countries.visa_validity',
                'countries.visa_validity_unit',
                'countries.approval_rate',
                'countries.embassy_fee',
                'countries.visa_entry',
                'countries.portify_fees',
                'countries.vfs_service_fees',
                'countries.processing_time_value',
                'countries.processing_time_unit',
                'visa_types.visa_type(vtype)'
            ],
            [
                'countries.country_name' => $countryName
            ]
        );

        // Check if country details exist
        if (empty($countryDetails)) {
            throw new Exception("No country found with the specified name.");
        }

        $countryData = $countryDetails[0];

        // Fetch images if requested
        if ($includeImages) {
            $countryId = $countryData['id'];
            $countryImages = $database->select(
                'country_images',
                [
                    'fallback_url',
                    'photo_path'
                ],
                [
                    'country_id' => $countryId
                ]
            );

            $countryData['images'] = $countryImages;
        }

        return $countryData;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }
}

// Fetch country details
$countryData = fetchCountryDetails($country_name);

// Redirect to 404 if country not found
if (empty($countryData)) {
    header("Location: ../404");
    exit;
}
?>

<?php
// Check if user is logged in, then fetch the latest unfinished order for the given country
if (isset($_SESSION['user_id'])) {
    $orders = $database->get('orders', ['is_finished', 'is_processing', 'order_id'], [
        'ORDER' => ['id' => 'DESC'],
        'LIMIT' => 1,
        'AND' => [
            'order_user_id' => $_SESSION['user_id'],
            'is_finished' => 0,
            'is_archive' => 0,
            'country_id' => $countryData['id'],
        ]
    ]);
}
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

<!-- country details -->
<?php if (isset($orders)): ?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($orders['is_finished'] == 1 && $orders['is_processing'] == 1): ?>
                    <div class="alert alert-warning mt-3 mb-0 d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-info-circle"></i> You have already applied for <?= $country_name; ?> visa.
                        </span>
                        <a href="visa-status?order_id=<?= $orders['order_id']; ?>"
                            class="btn btn-blue rounded-pill px-4 py-2 d-flex align-items-center">
                            Check Visa Status
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($orders['is_finished'] == 0): ?>
                    <div class="alert alert-warning mt-3 mb-0 d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-info-circle"></i> You are in the process of applying for <?= $country_name; ?> visa.
                        </span>
                        <a href="application/<?= $orders['order_id']; ?>/persona"
                            class="btn btn-blue rounded-pill px-4 py-2 d-flex align-items-center">
                            Complete your visa application
                        </a>
                    </div>



                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="container mt-2">
    <div class="row">
        <?php
        // Fetch country data with images
        $countryData = fetchCountryDetails($country_name, true);
        $visaDetail = fetchCountryDetails($country_name);
        ?>
        <div class="col-12 d-block d-lg-none">
            <!-- Mobile -->
            <!-- carousel -->
            <?php if (!empty($countryData['images'])): ?>
                <!-- Bootstrap Carousel -->
                <div id="countryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <?php foreach ($countryData['images'] as $index => $image): ?>
                            <button type="button" data-bs-target="#countryCarousel" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner  rounded-3">
                        <?php foreach ($countryData['images'] as $index => $image): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                <picture>
                                    <!-- AVIF format -->
                                    <source srcset="image.php?image=admin/<?= htmlspecialchars($image['photo_path']); ?>&width=auto&height=700&format=avif" type="image/avif">

                                    <!-- WebP format -->
                                    <source srcset="image.php?image=admin/<?= htmlspecialchars($image['photo_path']); ?>&width=auto&height=700&format=webp" type="image/webp">

                                    <!-- Fallback to JPEG format -->
                                    <img loading="lazy" src="image.php?image=admin/<?= htmlspecialchars($image['photo_path']); ?>&width=auto&height=700&format=jpeg" class="d-block w-100 carousel-image" alt="<?= htmlspecialchars($countryData['country_name']); ?> Visa Apply Online for Singapore">
                                </picture>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#countryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#countryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <!-- Fallback message if no images are found -->
                <div class="col-12">
                    <p>No images found for <?= htmlspecialchars($countryName); ?>.</p>
                </div>
            <?php endif; ?>
            <!-- ./carousel -->

            <h1 class="my-2"><b><?= $country_name; ?> Visa</b></h1>
            <div class="scrolling-wrapper" style="overflow-y: hidden;">
                <!-- <p class="text-muted nowrap-scroll mb-1">
                    <i class="bi bi-star-fill"></i> 0 | <i class="bi bi-chat-square-heart-fill me-2"></i> <a href="" class="text-golden">0 Reviews</a> |
                    <span class="badge bg-success"><i class="bi bi-patch-check-fill"></i> </?= $visaDetail['approval_rate']; ?>% Approval Rate</span> |
                    <span class="badge bg-danger"><i class="bi bi-arrow-up-right-circle-fill"></i> Trending</span>
                </p> -->

                <p class="text-muted nowrap-scroll mb-1">
                    <span class="badge bg-success"><i class="bi bi-patch-check-fill"></i> <?= $visaDetail['approval_rate']; ?>% Approval Rate</span> |
                    <span class="badge bg-danger"><i class="bi bi-arrow-up-right-circle-fill"></i> Trending</span>
                </p>
            </div>
        </div>
        <div class="col-12 d-none d-lg-block">
            <!-- Desktop -->
            <section class="container mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="grid-container">
                            <?php if (!empty($countryData['images'])): ?>
                                <!-- Loop through each image and add it to the grid -->
                                <?php foreach ($countryData['images'] as $index => $image): ?>
                                    <div class="grid-item <?php echo $index === 0 ? 'large' : ''; ?>">
                                        <picture>
                                            <!-- AVIF format -->
                                            <source srcset="image.php?image=admin/<?php echo htmlspecialchars($image['photo_path']); ?>&width=auto&height=650&format=avif" type="image/avif">

                                            <!-- WebP format -->
                                            <source srcset="image.php?image=admin/<?php echo htmlspecialchars($image['photo_path']); ?>&width=auto&height=650&format=webp" type="image/webp">

                                            <!-- Fallback to JPEG format -->
                                            <img priority="low"
                                                loading="lazy" src="image.php?image=admin/<?php echo htmlspecialchars($image['photo_path']); ?>&width=auto&height=650&format=jpeg" alt="<?php echo htmlspecialchars($countryData['country_name']); ?> Visa Apply Online for Singapore" />
                                        </picture>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Fallback message if no images are found -->
                                <div class="col-12">
                                    <p>No images found for <?php echo htmlspecialchars($countryName); ?>.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <h1><b><?= $country_name; ?> Visa</b></h1>
            <!-- <p class="text-muted"><i class="bi bi-star-fill"></i> 0 | <i class="bi bi-chat-square-heart-fill me-2"></i> <a href="" class="text-golden">0 Reviews</a> | <span class="badge bg-success"><i class="bi bi-patch-check-fill"></i> </?= $visaDetail['approval_rate']; ?>% Approval Rate</span> | <span class="badge bg-danger"><i class="bi bi-arrow-up-right-circle-fill"></i> Trending</span></p> -->
            <p class="text-muted"><span class="badge bg-success"><i class="bi bi-patch-check-fill"></i> <?= $visaDetail['approval_rate']; ?>% Approval Rate</span> | <span class="badge bg-danger"><i class="bi bi-arrow-up-right-circle-fill"></i> Trending</span></p>
        </div>
    </div>
</section>
<!-- ./country details -->

<!-- Visa Details -->
<section class="container mt-2">
    <div class="row d-flex flex-column-reverse flex-xl-row">
        <div class="col-12 col-xl-8 col-xxl-8">

            <!-- content area -->
            <h2 class="heading-underline fw-bold"><?= $country_name; ?> Visa Information</h2>
            <!-- grid visa details -->
            <div class="row g-3">
                <!-- Visa Type -->
                <div class="col-6 col-md-3">
                    <div class="card info-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-light rounded-3 me-3">
                                <i class="bi bi-person-badge-fill fs-4 text-golden"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Visa Type:</div>
                                <div class="fw-semibold"><?= $visaDetail['vtype']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Length of Stay -->
                <div class="col-6 col-md-3">
                    <div class="card info-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-light rounded-3 me-3">
                                <i class="bi bi-calendar3 fs-4 text-golden"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Length of Stay:</div>
                                <div class="fw-semibold popover-trigger" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="The maximum duration that you are allowed to remain in a country after entering with that particular visa." style="text-decoration: underline; cursor: pointer;">
                                    <?= $visaDetail['stay_duration']; ?> Days
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validity -->
                <div class="col-6 col-md-3">
                    <div class="card info-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-light rounded-3 me-3">
                                <i class="bi bi-clock-fill fs-4 text-golden"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Validity:</div>
                                <div class="fw-semibold popover-trigger" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="The number of days your visa is active after the date of issuance. We ensure your visa is valid based on your travel dates." style="text-decoration: underline; cursor: pointer;">
                                    <?= $visaDetail['visa_validity']; ?> <?= $visaDetail['visa_validity_unit']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Entry -->
                <div class="col-6 col-md-3">
                    <div class="card info-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-light rounded-3 me-3">
                                <i class="bi bi-door-open-fill fs-4 text-golden"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Entry:</div>
                                <?php
                                $visaEntry = $countryData['visa_entry'];
                                $popoverContent = '';

                                switch ($visaEntry) {
                                    case 'single':
                                        $popoverContent = 'You can enter the country only once during the visa\'s validity period and cannot re-enter using the same visa once you\'ve exited.';
                                        break;
                                    case 'multiple':
                                        $popoverContent = 'You can enter the country multiple times during the visa\'s validity period, with no restrictions on re-entry.';
                                        break;
                                    case 'multiple_entry':
                                        $popoverContent = 'You are allowed multiple entries during the visa\'s validity period. Each stay will be subject to the visa duration limit.';
                                        break;
                                    case 'transit':
                                        $popoverContent = 'This is a transit visa. You can only stay in the country for a short duration, typically up to 72 hours, while passing through.';
                                        break;
                                    case 'long_term':
                                        $popoverContent = 'This visa allows for long-term stay. Ensure you adhere to all conditions for extended stays.';
                                        break;
                                    case 'evisa':
                                        $popoverContent = 'This is an electronic visa. Ensure to carry a printout when entering the country, as you will be required to show it at the border.';
                                        break;
                                    default:
                                        $popoverContent = 'Visa entry type is not specified or is different. Please check with the embassy or relevant authorities.';
                                        break;
                                }
                                ?>

                                <div class="fw-semibold popover-trigger" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="<?= htmlspecialchars($popoverContent); ?>" style="text-decoration: underline; cursor: pointer;">
                                    <?= htmlspecialchars(ucfirst($visaEntry)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./visa grid details -->

            <h2 class="heading-underline fw-bold mt-3">Visa Processing Timeline</h2>
            <p>The visa Processing Timeline for <?= $country_name; ?> is <?= $visaDetail['processing_time_value']; ?> <?= $visaDetail['processing_time_unit']; ?>.</p>


            <h2 class="heading-underline fw-bold mt-3">Required Documents</h2>
            <?php
            // Fetch the required documents JSON for the given country
            $countryInfo = $database->get("countries", "required_documents", ["id" => $countryData['id'], "is_active" => 1]);

            // Decode JSON to get an array of document IDs
            $documentIds = json_decode($countryInfo, true);

            // Check if there are valid document IDs
            if (!empty($documentIds) && is_array($documentIds)) {
                // Fetch document names based on IDs
                $documents = $database->select("required_documents", ["required_document_name"], ["id" => $documentIds]);
            } else {
                $documents = [];
            }

            if (!empty($documents)): ?>
                <ul class="list-group">
                    <li class="list-group-item bg-light">
                        <p class="mb-0"><b><?= countryToEmoji($country_name); ?> Required documents for <?= htmlspecialchars($country_name); ?> Visa</b></p>
                    </li>
                    <?php foreach ($documents as $document): ?>
                        <li class="list-group-item"><?= htmlspecialchars($document['required_document_name']); ?> <span class="badge bg-success rounded-pill float-end">Mandatory</span></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No documents required for <?= htmlspecialchars($countryData['country_name']); ?>.</p>
            <?php endif; ?>

            <h2 class="heading-underline fw-bold mt-3">Frequently Asked Questions</h2>

            <?php
            // Fetch the active FAQs for the selected country
            $faqs = $database->select("faq", ["id", "faqQuestion", "faqAnswer"], [
                "faqCountry" => $countryData['id'],
                "is_active" => 1
            ]);

            if (!empty($faqs)): ?>
                <div class="accordion" id="faqAccordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $faq['id']; ?>">
                                <button class="accordion-button <?= $index === 0 ? '' : 'collapsed'; ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq['id']; ?>"
                                    aria-expanded="<?= $index === 0 ? 'true' : 'false'; ?>"
                                    aria-controls="collapse<?= $faq['id']; ?>">
                                    <?= htmlspecialchars($faq['faqQuestion']); ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $faq['id']; ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : ''; ?>"
                                aria-labelledby="heading<?= $faq['id']; ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <?= nl2br(htmlspecialchars($faq['faqAnswer'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No FAQs available for this country.</p>
            <?php endif; ?>

            <!--<div>
                <h2 class="heading-underline fw-bold mt-3">Rate Our Service</h2>
                <p class="text-muted">Your rating helps others better understand your experience with us.</p>
                //Star Rating
                <div id="star-container">
                    <i class="bi bi-star stars" data-value="1"></i>
                    <i class="bi bi-star stars" data-value="2"></i>
                    <i class="bi bi-star stars" data-value="3"></i>
                    <i class="bi bi-star stars" data-value="4"></i>
                    <i class="bi bi-star stars" data-value="5"></i>
                </div>
                // Star Rating
                <div class="card card-rating p-4 mt-3 rounded-3">
                    // Overall Rating
                    <div class="d-flex align-items-center">
                        <h2 class="mb-0 display-5 fw-bold">4.0</h2>
                        <i class="bi bi-star-fill text-warning fs-3 ms-2"></i>
                    </div>
                    <p class="text-muted mb-3">67,817 ratings and 13,302 reviews</p>

                    // Rating Breakdown
                    <div id="ratings-container"></div>
                </div>
                // Ratings 
                // Review Modal
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Write a Review</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p id="thankYouMessage" class="fw-bold text-success"></p>
                                <textarea
                                    id="reviewText"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Write your review here..."></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-golden rounded-pill" id="submitReview">
                                    Submit Review <i class="bi bi-arrow-right-circle ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                // Logout Alert Modal
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Login Required</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="loginForm" autocomplete="off" novalidate>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" required>
                                        <div class="invalid-feedback">Please enter a valid email.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" required>
                                        <div class="invalid-feedback">Password is required.</div>
                                    </div>
                                    <button type="submit" class="btn btn-golden rounded-pill">Log in <i class="bi bi-arrow-right-circle"></i></button>
                                    <div id="loginMessage" class="mt-3"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="heading-underline fw-bold mt-3">Review (0)</h2>
                <p class="text-muted">Your feedback helps us improve and ensures others receive reliable visa assistance.</p>
                // Review Form
                <form action="">
                    <div class="editor-container">
                        <div class="editor-toolbar">
                            <div class="btn-group" role="group" aria-label="Text formatting">
                                <button type="button" class="btn btn-secondary border-0 bg-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Bold (Ctrl + B)" onclick="formatText('bold')">
                                    <b>B</b>
                                </button>
                                <button type="button" class="btn btn-secondary border-0 bg-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Italic (Ctrl + I)" onclick="formatText('italic')">
                                    <i>I</i>
                                </button>
                                <button type="button" class="btn btn-secondary  border-0 bg-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Underline (Ctrl + U)" onclick="formatText('underline')">
                                    <u>U</u>
                                </button>
                                <button type="button" class="btn btn-secondary bg-gradient border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Numbered List (Ctrl + L)" onclick="formatText('insertOrderedList')">
                                    <i class="bi bi-list-ol"></i>
                                </button>
                                <button type="button" class="btn btn-secondary border-0 bg-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Bullet List (Ctrl + M)" onclick="formatText('insertUnorderedList')">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                                // Help Button
                                <button type="button" class="btn btn-secondary border-0 bg-gradient" data-bs-toggle="modal" data-bs-target="#shortcutsModal">
                                    <i class="bi bi-question-circle"></i>
                                </button>
                            </div>
                        </div>

                        // Editable Text Area
                        <div contenteditable="true" id="review" class="editor-content"></div>

                        // Hidden input to store the formatted content
                        <input type="hidden" name="reviewContent" id="reviewContent">

                        // Submit Button
                    </div>
                    <button type="submit" class="btn btn-golden mt-2 rounded-pill" onclick="submitReview()">Post <i class="bi bi-arrow-right-circle"></i></button>
                </form>
                // ./Review Form
            </div>

            // Bootstrap Modal for Shortcuts 
            <div class="modal fade" id="shortcutsModal" tabindex="-1" aria-labelledby="shortcutsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shortcutsModalLabel"> <i class="bi bi-keyboard"></i>
                                Keyboard Shortcuts</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"><b>Ctrl + B</b>: Bold</li>
                                <li class="list-group-item"><b>Ctrl + I</b>: Italic</li>
                                <li class="list-group-item"><b>Ctrl + U</b>: Underline</li>
                                <li class="list-group-item"><b>Ctrl + L</b>: Numbered List</li>
                                <li class="list-group-item"><b>Ctrl + M</b>: Bullet List</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div> -->



            <!-- ./content area -->
        </div>
        <div class="col-12 col-xl-4 col-xxl-4 mb-3">
            <?php if (isset($orders) && (isset($orders['is_finished']) && $orders['is_finished'] == 1 || isset($orders['is_processing']) && $orders['is_processing'] == 0)): ?>
                <!-- Calculator is hidden -->
            <?php else: ?>
                <?php require 'components/Calculator.php'; ?>
            <?php endif; ?>

            <!-- ./visa calculator -->
        </div>
    </div>
</section>
<!-- ./Visa Details -->


<!-- Modal -->
<div class="modal fade" id="travellerLimitModal" tabindex="-1" aria-labelledby="travellerLimitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header text-white" style="background-color: var(--golden);">
                <h5 class="modal-title" id="travellerLimitModalLabel">Traveller Limit Exceeded</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4">You can only select up to 6 travellers.</p>

                <form action="/submit" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text" id="countryCode">+1</span>
                            <input type="tel" class="form-control form-control-lg" id="mobile" name="mobile" required>
                        </div>
                    </div>

                    <!-- Hidden field for the current page name -->
                    <input type="hidden" id="currentPage" name="currentPage">

                    <!-- Optionally, you can use JavaScript to get the user's IP address (if required for your use case) -->
                    <input type="hidden" id="userIP" name="userIP">
                    <input type="hidden" id="stateName" name="stateName">
                    <input type="hidden" id="cityName" name="cityName">
                    <input type="hidden" id="countryName" name="countryName">

                    <button type="submit" class="btn btn-golden btn-lg w-100 mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php require 'components/Footer.php'; ?>

<?php
// Output HTML scripts
echo html_scripts(
    includeJQuery: true,
    includeBootstrap: true,
    customScripts: ['https://cdn.jsdelivr.net/npm/canvas-confetti'],
    includeSwal: false,
    includeNotiflix: true
);
?>
<!-- Bootstrap Popover Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var popoverTriggerList = document.querySelectorAll('.popover-trigger');

        popoverTriggerList.forEach(function(popoverTriggerEl) {
            var popover = new bootstrap.Popover(popoverTriggerEl);

            // Hide popover on click outside
            document.addEventListener("click", function(event) {
                if (!popoverTriggerEl.contains(event.target)) {
                    popover.hide();
                }
            });
        });
    });
</script>

<script>
    // Dynamically injecting PHP values into JavaScript variables
    const embassyFeePerTraveller = <?= (float) ($visaDetail['embassy_fee'] ?? 0); ?>;
    const portifyFees = <?= isset($visaDetail['portify_fees']) ? (float) $visaDetail['portify_fees'] : 0; ?>;
    const vfsFees = <?= isset($visaDetail['vfs_service_fees']) ? (float) $visaDetail['vfs_service_fees'] : 0; ?>;
    const ourFeePerTraveller = portifyFees + vfsFees;
    const applyButton = document.querySelector('#applyButton');

    let travellerCount = 1;

    const updateTravellers = (amount) => {
        travellerCount = Math.min(6, Math.max(1, travellerCount + amount)); // Ensure between 1 and 6 travellers
        if (travellerCount === 6 && amount > 0) showModal(); // Show modal if count exceeds 6
        updateUI();
    };

    const updateUI = () => {
        document.getElementById('travellerCount').textContent = travellerCount;
        document.getElementById('travellerInput').value = travellerCount;
        document.getElementById('embassyFeeMultiplier').textContent = travellerCount;

        // Only update the fee multipliers if they exist in the DOM
        if (document.getElementById('ourFeeMultiplier')) {
            document.getElementById('ourFeeMultiplier').textContent = travellerCount;
        }
        if (document.getElementById('vfsFeeMultiplier')) {
            document.getElementById('vfsFeeMultiplier').textContent = travellerCount;
        }

        document.getElementById('totalAmount').textContent = formatCurrency((embassyFeePerTraveller + ourFeePerTraveller) * travellerCount);

        applyButton.disabled = travellerCount > 5;
    };

    const showModal = () => {
        // Use Bootstrap's modal functionality to show the modal
        new bootstrap.Modal(document.getElementById('travellerLimitModal')).show();
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('en-SG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    };
</script>

<!-- 
<script>
    // Dynamically injecting PHP values into JavaScript variables
    const embassyFeePerTraveller = </?= (float) $visaDetail['embassy_fee']; ?>;
    const ourFeePerTraveller = </?= (float) $visaDetail['portify_fees'] + (float) $visaDetail['vfs_service_fees']; ?>;
    const applyButton = document.querySelector('#applyButton');

    let travellerCount = 1;

    const updateTravellers = (amount) => {
        travellerCount = Math.min(6, Math.max(1, travellerCount + amount)); // Ensure between 1 and 6 travellers
        if (travellerCount === 6 && amount > 0) showModal(); // Show modal if count exceeds 6
        updateUI();
    };

    const updateUI = () => {
        document.getElementById('travellerCount').textContent = travellerCount;
        document.getElementById('travellerInput').value = travellerCount;
        document.getElementById('embassyFeeMultiplier').textContent = travellerCount;
        document.getElementById('ourFeeMultiplier').textContent = travellerCount;
        document.getElementById('vfsFeeMultiplier').textContent = travellerCount;
        document.getElementById('totalAmount').textContent = formatCurrency((embassyFeePerTraveller + ourFeePerTraveller) * travellerCount);

        if (travellerCount > 5) {
            applyButton.disabled = true;
        } else {
            applyButton.disabled = false;
        }
    };
    const showModal = () => {
        // Use Bootstrap's modal functionality to show the modal
        new bootstrap.Modal(document.getElementById('travellerLimitModal')).show();
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('en-SG').format(amount);
    };
</script>
 -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.needs-validation');
        const journeyDate = document.getElementById('dateOfJourney');
        const arrivalDate = document.getElementById('dateOfArrival');

        // Set minimum date as today
        const today = new Date().toISOString().split('T')[0];
        journeyDate.min = today;
        arrivalDate.min = today;

        // Update arrival date min when journey date changes
        journeyDate.addEventListener('change', function() {
            arrivalDate.min = this.value;
            if (arrivalDate.value && arrivalDate.value < this.value) {
                arrivalDate.value = this.value;
            }
            validateDates();
        });

        arrivalDate.addEventListener('change', validateDates);

        function validateDates() {
            if (journeyDate.value && arrivalDate.value) {
                if (new Date(arrivalDate.value) < new Date(journeyDate.value)) {
                    arrivalDate.setCustomValidity('Arrival date must be after journey date');
                } else {
                    arrivalDate.setCustomValidity('');
                }
            }
        }

        // Prevent form submission if validation fails
        form.addEventListener('submit', function(event) {
            if (!journeyDate.value || !arrivalDate.value) {
                event.preventDefault();
                event.stopPropagation();
                Notiflix.Notify.failure('Please choose both Journey Date and Arrival Date.');
                journeyDate.classList.add('is-invalid');
                arrivalDate.classList.add('is-invalid');
                return;
            } else {
                journeyDate.classList.remove('is-invalid');
                arrivalDate.classList.remove('is-invalid');
                journeyDate.classList.add('is-valid');
                arrivalDate.classList.add('is-valid');
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                Notiflix.Notify.failure('Please fill out all required fields correctly.');
            }

            form.classList.add('was-validated');
        }, false);
    });
</script>



<!-- <script>
    document.getElementById('loginForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        event.stopPropagation();

        const form = this;
        form.classList.add('was-validated');

        if (!form.checkValidity()) return;

        const email = document.getElementById('exampleInputEmail1').value;
        const password = document.getElementById('exampleInputPassword1').value;
        const loginMessage = document.getElementById('loginMessage');

        loginMessage.innerHTML = "Logging in...";

        try {
            const response = await fetch('api/v1/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'HU': '</?= $hu; ?>'
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            const data = await response.json();

            if (response.ok) {
                // loginMessage.innerHTML = `<div class="alert alert-success">Login successful! Welcome back.</div>`;
                Notiflix.Notify.success('Login successful! Welcome back.');
                setTimeout(() => {
                    location.reload(); // Reload the same page after successful login
                }, 1500);
            } else {
                Notiflix.Notify.failure(`${data.error}`);
                // loginMessage.innerHTML = `<div class="alert alert-danger">}</div>`;
            }
        } catch (error) {
            // loginMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
            Notiflix.Notify.failure('An error occurred. Please try again.');

        }
    });
</script> -->

</body>

</html>