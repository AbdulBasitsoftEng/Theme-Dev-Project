<?php
get_header();
?>

<div class="container">

<div class="contaiiner">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-12 ">
            <div class="ms-1 p-3 border rounded">
            <h1 class="py-2"><?php the_title(); ?></h1>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid w-100">
            <div class="py-2">

                    <?php if (get_field('project_desc')) : ?>
                        <span><strong>Project Description :</strong></span>
                        <p><?php the_field('project_desc'); ?></p>
                    <?php endif; ?>

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

                    
                
</div>

</div>
</div>


<div class="col-lg-3 col-md-4 col-12 ">
<div class="ms-1 p-3 border rounded">
    <h3>Recent Projects</h3>

            <?php
        $args = array(
            'post_type'      => 'project',
            'posts_per_page' => 7,

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
</div>



<?php
get_footer(); ?>