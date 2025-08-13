<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
	$_post = get_post($post_id);
	$stocks = carbon_get_post_meta($post_id, 'stock');
	$wpsl_phone = get__post_meta_by_id($post_id, 'wpsl_phone');
	$wpsl_email = get__post_meta_by_id($post_id, 'wpsl_email');
	$wpsl_url = get__post_meta_by_id($post_id, 'wpsl_url');
	echo '<pre>';
	var_dump(get_post_meta($post_id));

	var_dump($stocks);
	echo '</pre>';
?>
	<div class="dealer--details">
		<h3 class="mb-4"><?= $_post->post_title ?></h3>
		<div class="dealer--desc">
			<?= $_post->post_content ?>
		</div>
	</div>
<?php
	die();
}
