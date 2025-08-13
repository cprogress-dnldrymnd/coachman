<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
	$_post = get_post($post_id);
	$stocks = carbon_get_post_meta($post_id, 'stocks');
	$wpsl_phone = get__post_meta_by_id($post_id, 'wpsl_phone');
	$wpsl_email = get__post_meta_by_id($post_id, 'wpsl_email');
	$wpsl_url = get__post_meta_by_id($post_id, 'wpsl_url');
	echo '<pre>';
	var_dump(get_post_meta($post_id));

	var_dump($stocks);
	echo '</pre>';
	$stocks_ids = [];
	foreach ($stocks as $stock) {
		$stocks_ids[] = $stock['id'];
	}

	$args = array(
		'post_type' => array('motorhome', 'caravan'),
		'numberposts' => -1,
		'include' => $stocks_ids

	);
	$posts_listings = get_posts($args);
?>
	<div class="dealer--details">
		<h3 class="mb-4 fw-semibold"><?= $_post->post_title ?></h3>
		<div class="dealer--desc">
			<?= $_post->post_content ?>
		</div>

		<div class="listings--posts mt-5">
			<h4 class="fw-semibold mb-4">Caravans In Stock</h4>
			<div class="row g-3">
				<?php foreach ($posts_listings as $posts_listing) { ?>
					<div class="col-lg-6">
						<div class="listings--posts--grid bg-lightgray-2 p-4">
							<h3 class="fs-24"><?= __listing_title($posts_listing->ID) ?></h3>
							<div class="image-box image-style image-style-2 mb-3" style="--fit: contain">
								<?= get_the_post_thumbnail($posts_listing->ID, 'medium') ?>
							</div>
							<?= __listing_features($posts_listing->ID) ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
	die();
}
