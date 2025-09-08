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

?>
	<div class="dealer--details">
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
		<?php if ($stocks) { ?>
			<?php
			$years = [];
			foreach ($stocks as $stock) {
				foreach ($stock['years'] as $year) {
					if (!in_array($year['year'], $years)) {
						$years[] = $year['year'];
					}
				}
			}
			sort($years);

			?>

			<div class="listings--posts mt-4">
				<h4 class="fw-semibold mb-3">Caravans In Stock</h4>
				<table class="table">
					<?php
					echo '<tr>';
					echo '<th>Model</th>';
					foreach ($years as $year) {
						echo '<th class="text-center">' . $year . '</th>';
					}
					echo '</tr>';

					$stock_years = [];
					foreach ($stocks as $stock) {

						foreach ($stock['years'] as $year) {
							$stock_years[] = $year['year'];
						}
						echo '<tr>';
						echo '<td>' . $stock['listing_name'] . '</td> ';
						foreach ($years as $year) {
							if (in_array($year, $stock_years)) {
								echo '<td class="tick-icon text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg></td>';
							} else {
								echo '<td></td>';
							}
						}
						echo '</tr>';
						$stock_years = [];
					}
					?>
				</table>
			</div>
		<?php } ?>

	</div>
<?php
	die();
}
