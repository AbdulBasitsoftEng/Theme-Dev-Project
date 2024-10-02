<div class="container">
    <div class="row">

    <?php
    // Define the number of posts per page
    $posts_per_page = -1;

    // Get the current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Custom query for posts in ascending order
    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'meta_query'     => array('relation' => 'AND'),
    );

    if (!empty($start_date_value) && !empty($end_date_value)) {
        // Query posts where the start_date falls between the provided dates
        $args['meta_query'][] = array(
            'key'     => 'start_date',
            'value'   => array($start_date_value, $end_date_value),
            'type'    => 'DATE',
            'compare' => 'BETWEEN'
        );
        // Query posts where the end_date falls between the provided dates
        $args['meta_query'][] = array(
            'key'     => 'end_date',
            'value'   => array($start_date_value, $end_date_value),
            'type'    => 'DATE',
            'compare' => 'BETWEEN'
        );
    } else {
        // If only the start date is provided, fetch posts after or on the start date
        if (!empty($start_date_value)) {
            $args['meta_query'][] = array(
                'key'     => 'start_date',
                'value'   => $start_date_value,
                'type'    => 'DATE',
                'compare' => '>='
            );
        }

        // If only the end date is provided, fetch posts before or on the end date
        if (!empty($end_date_value)) {
            $args['meta_query'][] = array(
                'key'     => 'end_date',
                'value'   => $end_date_value,
                'type'    => 'DATE',
                'compare' => '<='
            );
        }
    }

    // The query
    $query = new WP_Query($args);

    // The Loop
    if ($query->have_posts()) :
        echo '<div class="row">'; // Start the row

        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-lg-4 col-md-6 col-sm-12 p-0">
                <div class="m-2 p-3 border">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php the_title(); ?>"></a>
                    <h2 class="pt-2"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php if (get_field('project_name')) : ?>
                        <p><strong>Project Name : </strong><?php the_field('project_name'); ?></p>
                    <?php endif; ?>

                    <?php if (get_field('start_date')) : ?>
                        <p><strong>Project Start Date : </strong><?php the_field('start_date'); ?></p>
                    <?php endif; ?>

                    <?php if (get_field('end_date')) : ?>
                        <p><strong>Project End Date : </strong><?php the_field('end_date'); ?></p>    
                    <?php endif; ?>

                    <?php if (get_field('project_url')) : ?>
                        <p><strong>Project URL: </strong>
                        <a href="<?php the_field('project_url'); ?>"><?php the_field('project_url'); ?></a></p>
                    <?php endif; ?>

                    <span><strong>Project Description :</strong></span>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 19); ?></p>
                </div>
            </div>

        <?php 
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
            'prev_text' => __('« Previous'),
            'next_text' => __('Next »'),
        ));

    else: 
        echo '<p>No posts found.</p>';
    endif;

    // Reset Post Data
    wp_reset_postdata();
    ?>

</div>
</div>