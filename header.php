<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<?php wp_body_open(); ?>


<div id="wrapper">
	<header>
		<nav id="header" class="navbar navbar-expand-md">
			<div class="container">
			<a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
				<?php
				$logo = get_header_image(); // Get the header image URL

				if (!empty($logo)) { // Check if the logo exists
					echo '<img src="' . esc_url($logo) . '" class="img-fluid" alt="' . esc_attr(get_bloginfo('name')) . '">';
				} else {
					// Display the blog name if no logo is available
					echo esc_html(get_bloginfo('name'));
				}
				?>
			</a>


				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'httplocalhostcustom' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div id="navbar" class="collapse navbar-collapse">
					<?php
						// Loading WordPress Custom Menu (theme_location).
						wp_nav_menu(
							array(
								'menu_class'     => 'navbar-nav me-auto',
								'container'      => '',
								'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
								'walker'         => new WP_Bootstrap_Navwalker(),
								'theme_location' => 'main-menu',
							)
						);

						
					?>
						
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav><!-- /#header -->
	</header>

	<main id="main" class="container-fluid py-lg-5 py-3">
		
		
