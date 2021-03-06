<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="wrapper">
				<?php
				$args = array(
					'orderby'			=>	'menu_order',
					'order'				=>	'ASC',
					'post_type'		=>	'page',
					'post_status'	=>	'publish'
				);
				$pages = get_posts($args);
				foreach ($pages as $page_data) {
				    $content = apply_filters('the_content', $page_data->post_content);
				    $title = $page_data->post_title;
				    $slug = $page_data->post_name;
				?>
				<div class='<?php echo "$slug" ?>'>
					<div class="container">
						<a name='<?php echo "$slug" ?>'></a>
						<h1 class="section-title"><?php echo "$title" ?></h1>
						<?php if(!empty($content)) : echo '<p>'.$content.'</p>'; endif; ?>
						<?php require __DIR__ . '/page-' . $slug . '.php'; ?>
					</div>
				</div>
				<?php } ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
