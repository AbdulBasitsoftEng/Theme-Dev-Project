<?php


if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}


// for Featured image
add_theme_support('post-thumbnails');
// for logo
add_theme_support('custom-header');

//create main Sidebar
register_sidebar(
    array(
        'name'=>'Main Sidebar',
        'id'=> 'sidebar'
    )
);

//create  footer section in widget
register_sidebar(
   
    array(
        'name'=>'Footer 1',
        'id'=> 'sidebar_footer-1'
    )
);
register_sidebar(
   
    array(
        'name'=>'Footer 2',
        'id'=> 'sidebar_footer-2'
    )
);
register_sidebar(
   
    array(
        'name'=>'Footer 3',
        'id'=> 'sidebar_footer-3'
    )
);
register_sidebar(
   
    array(
        'name'=>'Footer 4',
        'id'=> 'sidebar_footer-4'
    )
);
register_sidebar(
   
    array(
        'name'=>'Copy Right',
        'id'=> 'copy-right'
    )
);


// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp-bootstrap-navwalker-footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}

function httplocalhostcustom_scripts_loader() {
	// 1. Styles.
	 wp_enqueue_style( 'main', get_theme_file_uri( 'build/main.css' ), array(), null, 'all' );

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'build/main.js' ), array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'httplocalhostcustom_scripts_loader' );



//Adding Custom post type
function create_project_post_type() {
    register_post_type('project',
        array(
            'labels'      => array(
                'name'          => __('Projects'),
                'singular_name' => __('Project'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title','thumbnail',),
            'rewrite'     => array('slug' => 'projects'),
            'show_in_rest' => true,
			'menu_icon'   => 'dashicons-portfolio',
        )
    );
}
add_action('init', 'create_project_post_type');

//Adding Taxonomy for Projects
function create_project_type_taxonomy() {
    register_taxonomy(
        'project_type',
        'project', // The custom post type to associate the taxonomy with
        array(
            'labels' => array(
                'name' => __('Project Types'),
                'singular_name' => __('Project Type'),
            ),
            'hierarchical' => true,
            'show_in_rest' => true, // Enable Gutenberg editor
            'rewrite' => array('slug' => 'project-type'),
        )
    );
}
add_action('init', 'create_project_type_taxonomy');




// Register custom REST API endpoint for Projects with ACF fields
function register_projects_api() {
    register_rest_route('custom-api/v1', '/projects/', array(
        'methods'  => 'GET',
        'callback' => 'get_projects_with_acf',
    ));
}
add_action('rest_api_init', 'register_projects_api');

// Callback function to retrieve projects and ACF fields
function get_projects_with_acf() {
    // Query custom post type 'project'
    $projects_query = new WP_Query(array(
        'post_type' => 'project',
        'posts_per_page' => -1, // Get all projects
    ));

    // Array to hold project data
    $projects = array();

    // Loop through each project
    if ($projects_query->have_posts()) {
        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            $project_id = get_the_ID();

            // Fetch ACF fields
            $project_name = get_field('project_name', $project_id);
            $project_url = get_field('project_url', $project_id);
            $start_date = get_field('start_date', $project_id);
            $end_date = get_field('end_date', $project_id);

            // Add project details to the array
            $projects[] = array(
                'ID'           => $project_id,
                'title'        => get_the_title(),
                'content'      => get_the_content(),
                'project_name' => $project_name,
                'project_url'  => $project_url,
                'start_date'   => $start_date,
                'end_date'     => $end_date,
                'thumbnail'    => get_the_post_thumbnail_url($project_id),
            );
        }
        wp_reset_postdata();
    }

    return rest_ensure_response($projects);
}


//http://localhost/custom/wp-json/custom-api/v1/projects/