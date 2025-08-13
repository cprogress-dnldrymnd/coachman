<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
	$_post = get_post($post_id);
	echo '<pre>';
	var_dump(get_post_meta($post_id));
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
