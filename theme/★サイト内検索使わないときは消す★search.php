<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php echo get_search_query(); ?>の検索結果　<?php echo sprintf( '%s 件', $wp_query->found_posts );?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
