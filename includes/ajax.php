<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
	$_post = get_post($post_id)
?>
	<div class="dealer--details">
		<h3><?= $_post->post_title ?></h3>
		<?= $_post->post_content ?>
	</div>
<?php
	die();
}
