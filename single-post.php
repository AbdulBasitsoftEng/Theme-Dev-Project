<?php
get_header();
?>

<div class="contaiiner">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-12 ">
            <div class="ms-1 p-3 border rounded">
            <h1 class="py-2"><?php the_title(); ?></h1>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid w-100">
            <div class="py-2">
                    <p><?php the_content(); ?></p>

                    
                
</div>

</div>
</div>


<div class="col-lg-3 col-md-4 col-12 ">
<div class="ms-1 p-3 border rounded">
    <h3>Recent posts</h3>

            <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 5,

        );
        $loop = new WP_Query($args);
        while ( $loop->have_posts() ) {
            $loop->the_post();
            ?>
            <div class="entry-content">
                <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php echo wp_trim_words(get_the_excerpt(), 9); ?>
            </div>
            <?php
        }
        ?>




</div>
</div>



    </div>
</div>




<?php
get_footer(); ?>