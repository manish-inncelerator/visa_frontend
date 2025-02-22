<?php
// Define the search condition (if $escapedQuery is set)
$searchCondition = !empty($escapedQuery) ? ["countries.country_name[~]" => "%{$escapedQuery}%"] : [];

// Fetch destinations from the database with images
try {
    $destinations = $database->select('countries', [
        '[>]country_images' => ['id' => 'country_id'],
        '[>]visa_types' => ['visa_type' => 'id']
    ], [
        'countries.id',
        'countries.country_name',
        'countries.serviceability',
        'countries.embassy_fee',
        'countries.portify_fees',
        'countries.vfs_service_fees',
        'countries.processing_time_value',
        'countries.processing_time_unit',
        'visa_types.visa_type(vtype)',
        'country_images.fallback_url',
        'country_images.photo_path'
    ], array_merge([
        'GROUP' => 'countries.id' // Group by country ID to ensure unique countries
    ], $searchCondition)); // Add search condition dynamically

    // Check if destinations were fetched successfully
    if (empty($destinations)) {
        throw new Exception("No destinations found.");
    }
} catch (Exception $e) {
    $destinations = []; // Ensure $destinations is an array to avoid issues in the foreach loop
}
?>


<?php foreach ($destinations as $destination): ?>
    <div class="col-12 col-lg-4 col-xxl-4">
        <div class="visa-card mx-auto mb-3">
            <div class="position-relative">
                <!-- Ensure the image path is correct -->
                <picture>
                    <!-- AVIF format -->
                    <source srcset="image.php?image=admin/<?= $destination['photo_path']; ?>&width=auto&height=500&quality=80&format=avif" type="image/avif">

                    <!-- WebP format -->
                    <source srcset="image.php?image=admin/<?= $destination['photo_path']; ?>&width=auto&height=500&quality=80&format=webp" type="image/webp">

                    <!-- Fallback to JPEG format -->
                    <img loading="lazy"
                        src="image.php?image=admin/<?= $destination['photo_path']; ?>&width=auto&height=500&quality=80&format=jpeg"
                        class="card-img-top img-fluid"
                        alt="<?= htmlspecialchars($destination['country_name']); ?>"
                        style="object-fit: cover; width: 100%; height: 280px;">
                </picture>
                <span class="notification-badge"><i class="bi bi-people"></i> 0 Issued Recently</span>
            </div>


            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0 fw-bold" style="color: var(--blue);"><?= htmlspecialchars($destination['country_name']); ?></h2>
                    <span class="visa-type-badge badge rounded-pill p-2"><?= $destination['vtype']; ?></span>
                </div>

                <hr class="card-divider" style="border-color: var(--blue-light);">

                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <?php
                        $totalFee = (float) $destination['portify_fees'] + (float) $destination['vfs_service_fees'];
                        ?>
                        <div class="price-display fw-bold plexFont" style="color: var(--blue-dark);">S$<?= $destination['embassy_fee']; ?></div>
                        <div class="fees-text alterFont" style="color: var(--blue-light);">+S$<?= $totalFee; ?> <small class="text-muted">(Our Fee + VFS Service Fee)</small></div>
                    </div>

                    <div class="text-end">
                        <div class="processing-time mb-1 alterFont small" style="color: var(--blue-light);">Get Visa in</div>
                        <div class="days-display alterFont fw-bold" style="color: var(--blue-dark);"><?= $destination['processing_time_value']; ?> <?= $destination['processing_time_unit']; ?></div>
                    </div>
                </div>

                <!-- Apply Now CTA Button -->
                <?php
                $country_slug = strtolower(str_replace(' ', '-', $destination['country_name']));
                ?>
                <a href="country/apply-for-<?= $country_slug; ?>-visa-online" class="btn cta-button p-3 d-grid btn-lg rounded-pill p-2 fw-bold">Apply Now</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>