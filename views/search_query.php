<?php
require 'database.php'; // Your Medoo database configuration file

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('BASE_DIR') || die('Direct access denied');

// Sanitize and retrieve the search query
$searchQuery = isset($_GET['q']) ? trim(strip_tags(stripslashes($_GET['q']))) : '';

if (!$searchQuery) {
    die(json_encode(['status' => 'error', 'message' => 'No country specified']));
}
// All countries
$country_list = [
    'AF' => ['name' => 'Afghanistan', 'alpha_3' => 'AFG'],
    'AX' => ['name' => 'Åland Islands', 'alpha_3' => 'ALA'],
    'AL' => ['name' => 'Albania', 'alpha_3' => 'ALB'],
    'DZ' => ['name' => 'Algeria', 'alpha_3' => 'DZA'],
    'AS' => ['name' => 'American Samoa', 'alpha_3' => 'ASM'],
    'AD' => ['name' => 'Andorra', 'alpha_3' => 'AND'],
    'AO' => ['name' => 'Angola', 'alpha_3' => 'AGO'],
    'AI' => ['name' => 'Anguilla', 'alpha_3' => 'AIA'],
    'AQ' => ['name' => 'Antarctica', 'alpha_3' => 'ATA'],
    'AG' => ['name' => 'Antigua and Barbuda', 'alpha_3' => 'ATG'],
    'AR' => ['name' => 'Argentina', 'alpha_3' => 'ARG'],
    'AM' => ['name' => 'Armenia', 'alpha_3' => 'ARM'],
    'AW' => ['name' => 'Aruba', 'alpha_3' => 'ABW'],
    'AU' => ['name' => 'Australia', 'alpha_3' => 'AUS'],
    'AT' => ['name' => 'Austria', 'alpha_3' => 'AUT'],
    'AZ' => ['name' => 'Azerbaijan', 'alpha_3' => 'AZE'],
    'BS' => ['name' => 'Bahamas', 'alpha_3' => 'BHS'],
    'BH' => ['name' => 'Bahrain', 'alpha_3' => 'BHR'],
    'BD' => ['name' => 'Bangladesh', 'alpha_3' => 'BGD'],
    'BB' => ['name' => 'Barbados', 'alpha_3' => 'BRB'],
    'BY' => ['name' => 'Belarus', 'alpha_3' => 'BLR'],
    'BE' => ['name' => 'Belgium', 'alpha_3' => 'BEL'],
    'BZ' => ['name' => 'Belize', 'alpha_3' => 'BLZ'],
    'BJ' => ['name' => 'Benin', 'alpha_3' => 'BEN'],
    'BM' => ['name' => 'Bermuda', 'alpha_3' => 'BMU'],
    'BT' => ['name' => 'Bhutan', 'alpha_3' => 'BTN'],
    'BO' => ['name' => 'Bolivia (Plurinational State of)', 'alpha_3' => 'BOL'],
    'BA' => ['name' => 'Bosnia and Herzegovina', 'alpha_3' => 'BIH'],
    'BW' => ['name' => 'Botswana', 'alpha_3' => 'BWA'],
    'BV' => ['name' => 'Bouvet Island', 'alpha_3' => 'BVT'],
    'BR' => ['name' => 'Brazil', 'alpha_3' => 'BRA'],
    'IO' => ['name' => 'British Indian Ocean Territory', 'alpha_3' => 'IOT'],
    'BN' => ['name' => 'Brunei Darussalam', 'alpha_3' => 'BRN'],
    'BG' => ['name' => 'Bulgaria', 'alpha_3' => 'BGR'],
    'BF' => ['name' => 'Burkina Faso', 'alpha_3' => 'BFA'],
    'BI' => ['name' => 'Burundi', 'alpha_3' => 'BDI'],
    'CV' => ['name' => 'Cabo Verde', 'alpha_3' => 'CPV'],
    'KH' => ['name' => 'Cambodia', 'alpha_3' => 'KHM'],
    'CM' => ['name' => 'Cameroon', 'alpha_3' => 'CMR'],
    'CA' => ['name' => 'Canada', 'alpha_3' => 'CAN'],
    'BQ' => ['name' => 'Caribbean Netherlands', 'alpha_3' => 'BES'],
    'KY' => ['name' => 'Cayman Islands', 'alpha_3' => 'CYM'],
    'CF' => ['name' => 'Central African Republic', 'alpha_3' => 'CAF'],
    'TD' => ['name' => 'Chad', 'alpha_3' => 'TCD'],
    'CL' => ['name' => 'Chile', 'alpha_3' => 'CHL'],
    'CN' => ['name' => 'China', 'alpha_3' => 'CHN'],
    'CX' => ['name' => 'Christmas Island', 'alpha_3' => 'CXR'],
    'CC' => ['name' => 'Cocos (Keeling) Islands', 'alpha_3' => 'CCK'],
    'CO' => ['name' => 'Colombia', 'alpha_3' => 'COL'],
    'KM' => ['name' => 'Comoros', 'alpha_3' => 'COM'],
    'CG' => ['name' => 'Congo', 'alpha_3' => 'COG'],
    'CD' => ['name' => 'Congo, Democratic Republic of the', 'alpha_3' => 'COD'],
    'CK' => ['name' => 'Cook Islands', 'alpha_3' => 'COK'],
    'CR' => ['name' => 'Costa Rica', 'alpha_3' => 'CRI'],
    'HR' => ['name' => 'Croatia', 'alpha_3' => 'HRV'],
    'CU' => ['name' => 'Cuba', 'alpha_3' => 'CUB'],
    'CW' => ['name' => 'Curaçao', 'alpha_3' => 'CUW'],
    'CY' => ['name' => 'Cyprus', 'alpha_3' => 'CYP'],
    'CZ' => ['name' => 'Czech Republic', 'alpha_3' => 'CZE'],
    'CI' => ['name' => 'Côte d\'Ivoire', 'alpha_3' => 'CIV'],
    'DK' => ['name' => 'Denmark', 'alpha_3' => 'DNK'],
    'DJ' => ['name' => 'Djibouti', 'alpha_3' => 'DJI'],
    'DM' => ['name' => 'Dominica', 'alpha_3' => 'DMA'],
    'DO' => ['name' => 'Dominican Republic', 'alpha_3' => 'DOM'],
    'EC' => ['name' => 'Ecuador', 'alpha_3' => 'ECU'],
    'EG' => ['name' => 'Egypt', 'alpha_3' => 'EGY'],
    'SV' => ['name' => 'El Salvador', 'alpha_3' => 'SLV'],
    'GQ' => ['name' => 'Equatorial Guinea', 'alpha_3' => 'GNQ'],
    'ER' => ['name' => 'Eritrea', 'alpha_3' => 'ERI'],
    'EE' => ['name' => 'Estonia', 'alpha_3' => 'EST'],
    'SZ' => ['name' => 'Eswatini (Swaziland)', 'alpha_3' => 'SWZ'],
    'ET' => ['name' => 'Ethiopia', 'alpha_3' => 'ETH'],
    'FK' => ['name' => 'Falkland Islands (Malvinas)', 'alpha_3' => 'FLK'],
    'FO' => ['name' => 'Faroe Islands', 'alpha_3' => 'FRO'],
    'FJ' => ['name' => 'Fiji', 'alpha_3' => 'FJI'],
    'FI' => ['name' => 'Finland', 'alpha_3' => 'FIN'],
    'FR' => ['name' => 'France', 'alpha_3' => 'FRA'],
    'GF' => ['name' => 'French Guiana', 'alpha_3' => 'GUF'],
    'PF' => ['name' => 'French Polynesia', 'alpha_3' => 'PYF'],
    'TF' => ['name' => 'French Southern Territories', 'alpha_3' => 'ATF'],
    'GA' => ['name' => 'Gabon', 'alpha_3' => 'GAB'],
    'GM' => ['name' => 'Gambia', 'alpha_3' => 'GMB'],
    'GE' => ['name' => 'Georgia', 'alpha_3' => 'GEO'],
    'DE' => ['name' => 'Germany', 'alpha_3' => 'DEU'],
    'GH' => ['name' => 'Ghana', 'alpha_3' => 'GHA'],
    'GI' => ['name' => 'Gibraltar', 'alpha_3' => 'GIB'],
    'GR' => ['name' => 'Greece', 'alpha_3' => 'GRC'],
    'GL' => ['name' => 'Greenland', 'alpha_3' => 'GRL'],
    'GD' => ['name' => 'Grenada', 'alpha_3' => 'GRD'],
    'GP' => ['name' => 'Guadeloupe', 'alpha_3' => 'GLP'],
    'GU' => ['name' => 'Guam', 'alpha_3' => 'GUM'],
    'GT' => ['name' => 'Guatemala', 'alpha_3' => 'GTM'],
    'GG' => ['name' => 'Guernsey', 'alpha_3' => 'GGY'],
    'GN' => ['name' => 'Guinea', 'alpha_3' => 'GIN'],
    'GW' => ['name' => 'Guinea-Bissau', 'alpha_3' => 'GNB'],
    'GY' => ['name' => 'Guyana', 'alpha_3' => 'GUY'],
    'HT' => ['name' => 'Haiti', 'alpha_3' => 'HTI'],
    'HM' => ['name' => 'Heard Island and Mcdonald Islands', 'alpha_3' => 'HMD'],
    'HN' => ['name' => 'Honduras', 'alpha_3' => 'HND'],
    'HK' => ['name' => 'Hong Kong', 'alpha_3' => 'HKG'],
    'HU' => ['name' => 'Hungary', 'alpha_3' => 'HUN'],
    'IS' => ['name' => 'Iceland', 'alpha_3' => 'ISL'],
    'IN' => ['name' => 'India', 'alpha_3' => 'IND'],
    'ID' => ['name' => 'Indonesia', 'alpha_3' => 'IDN'],
    'IR' => ['name' => 'Iran', 'alpha_3' => 'IRN'],
    'IQ' => ['name' => 'Iraq', 'alpha_3' => 'IRQ'],
    'IE' => ['name' => 'Ireland', 'alpha_3' => 'IRL'],
    'IM' => ['name' => 'Isle of Man', 'alpha_3' => 'IMN'],
    'IL' => ['name' => 'Israel', 'alpha_3' => 'ISR'],
    'IT' => ['name' => 'Italy', 'alpha_3' => 'ITA'],
    'JM' => ['name' => 'Jamaica', 'alpha_3' => 'JAM'],
    'JP' => ['name' => 'Japan', 'alpha_3' => 'JPN'],
    'JE' => ['name' => 'Jersey', 'alpha_3' => 'JEY'],
    'JO' => ['name' => 'Jordan', 'alpha_3' => 'JOR'],
    'KZ' => ['name' => 'Kazakhstan', 'alpha_3' => 'KAZ'],
    'KE' => ['name' => 'Kenya', 'alpha_3' => 'KEN'],
    'KI' => ['name' => 'Kiribati', 'alpha_3' => 'KIR'],
    'KP' => ['name' => 'Korea, North', 'alpha_3' => 'PRK'],
    'KR' => ['name' => 'Korea, South', 'alpha_3' => 'KOR'],
    'XK' => ['name' => 'Kosovo', 'alpha_3' => 'XKX'],
    'KW' => ['name' => 'Kuwait', 'alpha_3' => 'KWT'],
    'KG' => ['name' => 'Kyrgyzstan', 'alpha_3' => 'KGZ'],
    'LA' => ['name' => 'Lao People\'s Democratic Republic', 'alpha_3' => 'LAO'],
    'LV' => ['name' => 'Latvia', 'alpha_3' => 'LVA'],
    'LB' => ['name' => 'Lebanon', 'alpha_3' => 'LBN'],
    'LS' => ['name' => 'Lesotho', 'alpha_3' => 'LSO'],
    'LR' => ['name' => 'Liberia', 'alpha_3' => 'LBR'],
    'LY' => ['name' => 'Libya', 'alpha_3' => 'LBY'],
    'LI' => ['name' => 'Liechtenstein', 'alpha_3' => 'LIE'],
    'LT' => ['name' => 'Lithuania', 'alpha_3' => 'LTU'],
    'LU' => ['name' => 'Luxembourg', 'alpha_3' => 'LUX'],
    'MO' => ['name' => 'Macao', 'alpha_3' => 'MAC'],
    'MK' => ['name' => 'Macedonia North', 'alpha_3' => 'MKD'],
    'MG' => ['name' => 'Madagascar', 'alpha_3' => 'MDG'],
    'MW' => ['name' => 'Malawi', 'alpha_3' => 'MWI'],
    'MY' => ['name' => 'Malaysia', 'alpha_3' => 'MYS'],
    'MV' => ['name' => 'Maldives', 'alpha_3' => 'MDV'],
    'ML' => ['name' => 'Mali', 'alpha_3' => 'MLI'],
    'MT' => ['name' => 'Malta', 'alpha_3' => 'MLT'],
    'MH' => ['name' => 'Marshall Islands', 'alpha_3' => 'MHL'],
    'MQ' => ['name' => 'Martinique', 'alpha_3' => 'MTQ'],
    'MR' => ['name' => 'Mauritania', 'alpha_3' => 'MRT'],
    'MU' => ['name' => 'Mauritius', 'alpha_3' => 'MUS'],
    'YT' => ['name' => 'Mayotte', 'alpha_3' => 'MYT'],
    'MX' => ['name' => 'Mexico', 'alpha_3' => 'MEX'],
    'FM' => ['name' => 'Micronesia', 'alpha_3' => 'FSM'],
    'MD' => ['name' => 'Moldova', 'alpha_3' => 'MDA'],
    'MC' => ['name' => 'Monaco', 'alpha_3' => 'MCO'],
    'MN' => ['name' => 'Mongolia', 'alpha_3' => 'MNG'],
    'ME' => ['name' => 'Montenegro', 'alpha_3' => 'MNE'],
    'MS' => ['name' => 'Montserrat', 'alpha_3' => 'MSR'],
    'MA' => ['name' => 'Morocco', 'alpha_3' => 'MAR'],
    'MZ' => ['name' => 'Mozambique', 'alpha_3' => 'MOZ'],
    'MM' => ['name' => 'Myanmar (Burma)', 'alpha_3' => 'MMR'],
    'NA' => ['name' => 'Namibia', 'alpha_3' => 'NAM'],
    'NR' => ['name' => 'Nauru', 'alpha_3' => 'NRU'],
    'NP' => ['name' => 'Nepal', 'alpha_3' => 'NPL'],
    'NL' => ['name' => 'Netherlands', 'alpha_3' => 'NLD'],
    'NC' => ['name' => 'New Caledonia', 'alpha_3' => 'NCL'],
    'NZ' => ['name' => 'New Zealand', 'alpha_3' => 'NZL'],
    'NI' => ['name' => 'Nicaragua', 'alpha_3' => 'NIC'],
    'NE' => ['name' => 'Niger', 'alpha_3' => 'NER'],
    'NG' => ['name' => 'Nigeria', 'alpha_3' => 'NGA'],
    'NU' => ['name' => 'Niue', 'alpha_3' => 'NIU'],
    'NF' => ['name' => 'Norfolk Island', 'alpha_3' => 'NFK'],
    'MP' => ['name' => 'Northern Mariana Islands', 'alpha_3' => 'MNP'],
    'NO' => ['name' => 'Norway', 'alpha_3' => 'NOR'],
    'OM' => ['name' => 'Oman', 'alpha_3' => 'OMN'],
    'PK' => ['name' => 'Pakistan', 'alpha_3' => 'PAK'],
    'PW' => ['name' => 'Palau', 'alpha_3' => 'PLW'],
    'PS' => ['name' => 'Palestine', 'alpha_3' => 'PSE'],
    'PA' => ['name' => 'Panama', 'alpha_3' => 'PAN'],
    'PG' => ['name' => 'Papua New Guinea', 'alpha_3' => 'PNG'],
    'PY' => ['name' => 'Paraguay', 'alpha_3' => 'PRY'],
    'PE' => ['name' => 'Peru', 'alpha_3' => 'PER'],
    'PH' => ['name' => 'Philippines', 'alpha_3' => 'PHL'],
    'PN' => ['name' => 'Pitcairn Islands', 'alpha_3' => 'PCN'],
    'PL' => ['name' => 'Poland', 'alpha_3' => 'POL'],
    'PT' => ['name' => 'Portugal', 'alpha_3' => 'PRT'],
    'PR' => ['name' => 'Puerto Rico', 'alpha_3' => 'PRI'],
    'QA' => ['name' => 'Qatar', 'alpha_3' => 'QAT'],
    'RE' => ['name' => 'Reunion', 'alpha_3' => 'REU'],
    'RO' => ['name' => 'Romania', 'alpha_3' => 'ROU'],
    'RU' => ['name' => 'Russian Federation', 'alpha_3' => 'RUS'],
    'RW' => ['name' => 'Rwanda', 'alpha_3' => 'RWA'],
    'BL' => ['name' => 'Saint Barthelemy', 'alpha_3' => 'BLM'],
    'SH' => ['name' => 'Saint Helena', 'alpha_3' => 'SHN'],
    'KN' => ['name' => 'Saint Kitts and Nevis', 'alpha_3' => 'KNA'],
    'LC' => ['name' => 'Saint Lucia', 'alpha_3' => 'LCA'],
    'MF' => ['name' => 'Saint Martin', 'alpha_3' => 'MAF'],
    'PM' => ['name' => 'Saint Pierre and Miquelon', 'alpha_3' => 'SPM'],
    'VC' => ['name' => 'Saint Vincent and the Grenadines', 'alpha_3' => 'VCT'],
    'WS' => ['name' => 'Samoa', 'alpha_3' => 'WSM'],
    'SM' => ['name' => 'San Marino', 'alpha_3' => 'SMR'],
    'ST' => ['name' => 'Sao Tome and Principe', 'alpha_3' => 'STP'],
    'SA' => ['name' => 'Saudi Arabia', 'alpha_3' => 'SAU'],
    'SN' => ['name' => 'Senegal', 'alpha_3' => 'SEN'],
    'RS' => ['name' => 'Serbia', 'alpha_3' => 'SRB'],
    'SC' => ['name' => 'Seychelles', 'alpha_3' => 'SYC'],
    'SL' => ['name' => 'Sierra Leone', 'alpha_3' => 'SLE'],
    'SG' => ['name' => 'Singapore', 'alpha_3' => 'SGP'],
    'SX' => ['name' => 'Sint Maarten', 'alpha_3' => 'SXM'],
    'SK' => ['name' => 'Slovakia', 'alpha_3' => 'SVK'],
    'SI' => ['name' => 'Slovenia', 'alpha_3' => 'SVN'],
    'SB' => ['name' => 'Solomon Islands', 'alpha_3' => 'SLB'],
    'SO' => ['name' => 'Somalia', 'alpha_3' => 'SOM'],
    'ZA' => ['name' => 'South Africa', 'alpha_3' => 'ZAF'],
    'GS' => ['name' => 'South Georgia and the South Sandwich Islands', 'alpha_3' => 'SGS'],
    'SS' => ['name' => 'South Sudan', 'alpha_3' => 'SSD'],
    'ES' => ['name' => 'Spain', 'alpha_3' => 'ESP'],
    'LK' => ['name' => 'Sri Lanka', 'alpha_3' => 'LKA'],
    'SD' => ['name' => 'Sudan', 'alpha_3' => 'SDN'],
    'SR' => ['name' => 'Suriname', 'alpha_3' => 'SUR'],
    'SJ' => ['name' => 'Svalbard and Jan Mayen', 'alpha_3' => 'SJM'],
    'SE' => ['name' => 'Sweden', 'alpha_3' => 'SWE'],
    'CH' => ['name' => 'Switzerland', 'alpha_3' => 'CHE'],
    'SY' => ['name' => 'Syria', 'alpha_3' => 'SYR'],
    'TW' => ['name' => 'Taiwan', 'alpha_3' => 'TWN'],
    'TJ' => ['name' => 'Tajikistan', 'alpha_3' => 'TJK'],
    'TZ' => ['name' => 'Tanzania', 'alpha_3' => 'TZA'],
    'TH' => ['name' => 'Thailand', 'alpha_3' => 'THA'],
    'TL' => ['name' => 'Timor-Leste', 'alpha_3' => 'TLS'],
    'TG' => ['name' => 'Togo', 'alpha_3' => 'TGO'],
    'TK' => ['name' => 'Tokelau', 'alpha_3' => 'TKL'],
    'TO' => ['name' => 'Tonga', 'alpha_3' => 'TON'],
    'TT' => ['name' => 'Trinidad and Tobago', 'alpha_3' => 'TTO'],
    'TN' => ['name' => 'Tunisia', 'alpha_3' => 'TUN'],
    'TR' => ['name' => 'Turkey (Türkiye)', 'alpha_3' => 'TUR'],
    'TM' => ['name' => 'Turkmenistan', 'alpha_3' => 'TKM'],
    'TC' => ['name' => 'Turks and Caicos Islands', 'alpha_3' => 'TCA'],
    'TV' => ['name' => 'Tuvalu', 'alpha_3' => 'TUV'],
    'UM' => ['name' => 'U.S. Outlying Islands', 'alpha_3' => 'UMI'],
    'UG' => ['name' => 'Uganda', 'alpha_3' => 'UGA'],
    'UA' => ['name' => 'Ukraine', 'alpha_3' => 'UKR'],
    'AE' => ['name' => 'United Arab Emirates', 'alpha_3' => 'ARE'],
    'GB' => ['name' => 'United Kingdom', 'alpha_3' => 'GBR'],
    'US' => ['name' => 'United States', 'alpha_3' => 'USA'],
    'UY' => ['name' => 'Uruguay', 'alpha_3' => 'URY'],
    'UZ' => ['name' => 'Uzbekistan', 'alpha_3' => 'UZB'],
    'VU' => ['name' => 'Vanuatu', 'alpha_3' => 'VUT'],
    'VA' => ['name' => 'Vatican City Holy See', 'alpha_3' => 'VAT'],
    'VE' => ['name' => 'Venezuela', 'alpha_3' => 'VEN'],
    'VN' => ['name' => 'Vietnam', 'alpha_3' => 'VNM'],
    'VG' => ['name' => 'Virgin Islands, British', 'alpha_3' => 'VGB'],
    'VI' => ['name' => 'Virgin Islands, U.S', 'alpha_3' => 'VIR'],
    'WF' => ['name' => 'Wallis and Futuna', 'alpha_3' => 'WLF'],
    'EH' => ['name' => 'Western Sahara', 'alpha_3' => 'ESH'],
    'YE' => ['name' => 'Yemen', 'alpha_3' => 'YEM'],
    'ZM' => ['name' => 'Zambia', 'alpha_3' => 'ZMB'],
    'ZW' => ['name' => 'Zimbabwe', 'alpha_3' => 'ZWE']
];


// Define a mapping of common abbreviations to full country names
$countryAliases = [
    'uae' => 'United Arab Emirates',
    'us'  => 'United States of America',
    'usa' => 'United States of America',
    'uk'  => 'United Kingdom',
    'gb'  => 'United Kingdom',
    'cn'  => 'China',
    'ru'  => 'Russia',
    'in'  => 'India'
];

// Match user input with the country list
$matched_country = null;
foreach ($country_list as $code => $country) {
    if (strcasecmp($country['name'], $searchQuery) == 0 || strcasecmp($code, $searchQuery) == 0) {
        $matched_country = $country;
        break;
    }
}

// Convert to lowercase for alias matching, but keep the original for display
$searchQueryLower = strtolower($searchQuery);
$resolvedQuery = $countryAliases[$searchQueryLower] ?? $searchQuery;

// Escape special characters for SQL wildcard searches
$escapedQuery = str_replace(['%', '_', '*', '?', '[', ']'], ['\%', '\_', '\*', '\?', '\[', '\]'], $resolvedQuery);

// Fetch countries from the database
$countries = !empty($escapedQuery)
    ? $database->select("countries", "*", [
        "AND" => [
            "country_name[~]" => "%{$escapedQuery}%",
            "is_active" => 1
        ]
    ])
    : [];

// Safely count results
$countriesCount = is_array($countries) ? count($countries) : 0;

// Page name fallback if not found
$pageTitle = !empty($resolvedQuery) ? $resolvedQuery : 'Page Not Found';

// Include required files
require 'inc/html_head.php';
require 'inc/html_foot.php';
require 'min.php';

// Output HTML head and scripts
echo html_head(htmlspecialchars('Searched for: ' . ucfirst($pageTitle), ENT_QUOTES, 'UTF-8'), null, true, ['assets/css/home.css']);

// Auth Key
$authKey = mt_rand(115521, 998989); // Generates a 5-digit random number

if (!isset($_SESSION['authKey'])) {
    $_SESSION['authKey'] = mt_rand(115521, 998989);
}


$hashInput = $_SESSION['authKey'] ?? '';
$secureHash = md5($hashInput);

?>

<!-- Navbar -->
<?php require isset($_SESSION['user_id']) ? 'components/LoggedinNavbar.php' : 'components/Navbar.php'; ?>
<!-- ./Navbar -->

<!-- Page Content section -->
<section class="container mt-2">
    <div class="row">
        <div class="col-12">
            <h1>
                <b>Searched for: <?= htmlspecialchars(ucfirst($pageTitle), ENT_QUOTES, 'UTF-8'); ?></b>
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/visa/" class="text-golden text-decoration-none"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="search" class="text-golden text-decoration-none"> Search</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars(ucfirst($pageTitle), ENT_QUOTES, 'UTF-8'); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Search results -->
<section class="container mt-2">
    <div class="row">
        <div class="col-12">
            <?php if ($countriesCount > 0): ?>
                <p class="alert alert-info"><i class="bi bi-info-circle"></i> Showing <?= $countriesCount; ?> results for <?= $pageTitle; ?></p>

                <div class="my-3 border border-bottom"></div>
                <?php require('components/VisaCard.php'); ?>
            <?php else: ?>
                <p class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> No results found for <?= ucfirst($pageTitle); ?></p>
                <?php if (!empty($matched_country['name'])): ?>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                Whoops! We currently do not provide visa processing services for <strong><?= $matched_country['name']; ?></strong>.
                                However, you can request our team to add this service. Click the button below to submit your request.

                            </p>
                            <button class="btn btn-blue rounded-pill mt-2 p-2" data-bs-toggle="modal" data-bs-target="#requestModal">
                                Request Service <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Request Visa Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="requestForm">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userMobile" class="form-label">Mobile Number (with country code)</label>
                        <input type="tel" class="form-control" id="userMobile" name="userMobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="requestedCountry" class="form-label">Country of Interest</label>
                        <input type="text" class="form-control" id="requestedCountry" name="requestedCountry" value="<?= $matched_country['name']; ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-golden rounded-pill">Submit Request</button>
                </form>
                <div id="responseMessage" class="mt-3"></div>
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
    includeSwal: true
);
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("requestForm").addEventListener("submit", async function(event) {
            event.preventDefault();

            let formData = {
                userName: document.getElementById("userName").value,
                userEmail: document.getElementById("userEmail").value,
                userMobile: document.getElementById("userMobile").value,
                requestedCountry: document.getElementById("requestedCountry").value
            };

            try {
                let response = await fetch("api/v1/submitRequest.php", {
                    method: "POST",
                    headers: {
                        "auth": "<?= $secureHash ?? ''; ?>"
                    },
                    body: JSON.stringify(formData)
                });

                let result = await response.json();
                let responseMessage = document.getElementById("responseMessage");

                if (response.ok) {
                    responseMessage.innerHTML = '<div class="alert alert-success">Request submitted successfully!</div>';
                    document.getElementById("requestForm").reset();
                    setTimeout(() => {
                        new bootstrap.Modal(document.getElementById("requestModal")).hide();
                    }, 2000);
                } else {
                    responseMessage.innerHTML = `<div class="alert alert-danger">Error: ${result.message || 'Something went wrong'}</div>`;
                }
            } catch (error) {
                document.getElementById("responseMessage").innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
            }
        });
    });
</script>

</body>

</html>