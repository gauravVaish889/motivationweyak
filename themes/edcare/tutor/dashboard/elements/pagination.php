<?php
/**
 * Global Pagination Template for Backend Pages
 *
 * @package Tutor\Templates
 * @subpackage Dashboard\Elements
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.0
 */

// Pagination.
$paged = $data['paged'];
$per_page = $data['per_page'];
$big = 999999999;
$total_page = isset($data['total_page']) ? $data['total_page'] : ceil($data['total_items'] / $per_page);
$pagination_enabled_class = wp_doing_ajax() ? ' is-ajax-pagination-enabled ' : '';

// Prepare data set attribute string.
$dataset = isset($data['data_set']) ? $data['data_set'] : array();
$dataset_attr = '';
foreach ($dataset as $key => $value) {
	$dataset_attr .= ' data-' . $key . '="' . esc_attr($value) . '" ';
}

// @todo: conditions are incorrect.

if (isset($data['layout']) && 'load_more' == $data['layout']['type']) {
	$current_url = tutor()->current_url;

	echo '<nav ' . (isset($data['ajax']) ? ' data-tutor_pagination_ajax="' . esc_attr(json_encode($data['ajax'])) . '" ' : '') . ' data-tutor_pagination_layout="' . esc_attr(json_encode($data['layout'])) . '" class="' . $pagination_enabled_class . '" ' . $dataset_attr . '>';//phpcs:ignore

	if ($paged < $total_page) {
		echo '<a class="tutor-btn tutor-btn-outline-primary page-numbers tutor-mr-16" href="' . esc_url(add_query_arg(array('current_page' => $paged + 1), $current_url)) . '">' .
			esc_html($data['layout']['load_more_text'])
			. '</a>';
	}

	echo '</nav>';

	return;
}
?>
<div class="tp-event-inner-pagination">
	<div class="tp-dashboard-pagination pt-20">
		<div class="tp-pagination">
			<?php

			if ((isset($data['total_page']) && $data['total_page']) || (isset($data['total_items']) && $data['total_items'])): ?>
				<nav class="edcare-pagination-ul  <?php echo esc_attr($pagination_enabled_class); ?>" <?php
				   echo isset($data['ajax']) ? ' data-tutor_pagination_ajax="' . esc_attr(json_encode($data['ajax'])) . '" ' : '';
				   echo edcare_kses($dataset_attr); //phpcs:ignore
			   	?>>

					<div class="justify-content-center tutor-pagination-numbers edcare-pagination-li">
						<ul>
							<li>
								<?php
								//phpcs:ignore
							
								echo paginate_links(
									array(
										'format' => '?current_page=%#%',
										'current' => $paged,
										'total' => $total_page,
										'prev_text' => '<i class="fa-regular fa-arrow-left icon"></i>',
										'next_text' => '<i class="fa-regular fa-arrow-right icon"></i>',
									)
								);

								?>
							</li>
						</ul>
					</div>
				</nav>
			<?php endif; ?>

		</div>
	</div>
</div>