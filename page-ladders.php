<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/content', 'head' ); ?>

<div class="container">

	<h2>Select team</h2>

	<div class="row">

	<?php

		$the_query = new WP_Query(
			array(
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'post_type' => 'sp_table',
				'orderBy' => 'date',
				'order' => 'DESC'
			)
		);

		// echo '<pre>' . var_export($the_query, true) . '</pre>';

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
	?>

		<div class="col-sm-4">
			<a href="<?php the_permalink(); ?>" class="btn -block"><?php the_title(); ?></a>
		</div>

	<?php
			}
		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	?>
		<div class="col-sm-4">
			<a href="http://www.foxsportspulse.com/comp_info.cgi?c=1-8273-0-389418-0&pool=0&a=LADDER" class="btn -block" target="_blank">Reserve team</a>
		</div>
		<div class="col-sm-4">
			<a href="http://www.foxsportspulse.com/comp_info.cgi?c=1-8273-0-389283-0&a=LADDER" class="btn -block" target="_blank">Under 18's</a>
		</div>

	</div><!-- .row -->

</div><!-- .container -->

<?php get_footer(); ?>
