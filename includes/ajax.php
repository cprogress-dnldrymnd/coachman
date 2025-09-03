<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
	$_post = get_post($post_id);
	$stocks = carbon_get_post_meta($post_id, 'stocks');
	$wpsl_phone = get_post_meta($post_id, 'wpsl_phone', true);
	$wpsl_email = get_post_meta($post_id, 'wpsl_email', true);
	$wpsl_url = get_post_meta($post_id, 'wpsl_url', true);

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
		<?php
		if(current_user_can('administrator')) {
			echo '<pre>';
			var_dump($stocks_ids);
			echo '</pre>';
		}
		?>
		<h3 class="mb-4 fw-semibold"><?= $_post->post_title ?></h3>
		<div class="dealer--desc">
			<?= $_post->post_content ?>
		</div>

		<ul class="meta--details mt-4">
			<?php if ($wpsl_phone) { ?>
				<li>
					<span class="label">Phone:</span>
					<span class="value"><a href="tel:<?= $wpsl_phone ?>"><?= $wpsl_phone ?></a></span>
				</li>
			<?php } ?>
			<?php if ($wpsl_email) { ?>
				<li>
					<span class="label">Email:</span>
					<span class="value"><a href="mailto:<?= $wpsl_email ?>"><?= $wpsl_email ?></a></span>
				</li>
			<?php } ?>
			<?php if ($wpsl_url) { ?>
				<li>
					<span class="label">Website:</span>
					<span class="value"><a href="<?= $wpsl_url ?>" target="_blank"><?= $wpsl_url ?></a></span>
				</li>
			<?php } ?>
		</ul>

		<div class="listings--posts mt-4">
			<h4 class="fw-semibold mb-3">Caravans In Stock</h4>
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
