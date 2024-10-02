<div class="container">

	<?php
	// Define the number of posts per page
	$posts_per_page = 6; // Set to a multiple of 3 for three posts per row

	// Get the current page number
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	// Custom query for posts in ascending order
	$args = array(
		'post_type'      => 'post', // Change this if you're using a custom post type
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
		'orderby'        => 'date', // Order by date
		'order'          => 'ASC',   // Ascending order
	);

	$query = new WP_Query($args);

	// The Loop
	if ($query->have_posts()) :
		echo '<div class="row">'; // Start the row

		while ($query->have_posts()) : $query->the_post(); ?>
			<div class="col-lg-4 col-md-6 col-sm-12 p-0">
				<div class="m-2 p-3 border text-center">
					<a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php the_title(); ?>"></a>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php the_excerpt(); // Use the excerpt for a shorter summary ?></p>
				</div>
			</div>

		<?php 
		// Close the row after every third post
		if ($query->current_post % 3 == 2) {
			echo '</div><div class="row">'; // Close and open a new row after every 3 posts
		}
		endwhile; 

		echo '</div>'; // Close the last row

		// Pagination
		$big = 999999999; // an unlikely integer
		echo paginate_links(array(
			'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'current'   => max(1, get_query_var('paged')),
			'total'     => $query->max_num_pages,
			'prev_text' => __('« Previous'), // Text for the previous page link
			'next_text' => __('Next »'),      // Text for the next page link
		));

	else: 
		echo '<p>No posts found.</p>'; // Message if no posts are found
	endif;

	// Reset Post Data
	wp_reset_postdata();
	?>
</div>