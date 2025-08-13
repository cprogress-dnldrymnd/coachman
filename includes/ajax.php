<?php
add_action('wp_ajax_nopriv_dealer_details_ajax', 'dealer_details_ajax'); // for not logged in users
add_action('wp_ajax_dealer_details_ajax', 'dealer_details_ajax');
function dealer_details_ajax()
{
	$post_id = $_POST['post_id'];
?>
	<div class="dealer--details">
		<h3><?= get_the_title($post_id) ?></h3>
	</div>
<?php
	die();
}
