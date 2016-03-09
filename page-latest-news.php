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
	<div class="news-list">


<?php 

	$query_args = array(
		'posts_per_page' => 10,
		'post_status' => 'publish',
		'post_type' => array(
			'sp_event',
			'post'
		),
		'orderBy' => 'date',
		'order' => 'DESC'
	);

	$query_args['paged'] = get_query_var( 'paged' ) 
		? get_query_var( 'paged' ) 
		: 1;

	// the query
	$the_query = new WP_Query( $query_args );
?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<a href="<?php the_permalink(); ?>" class="news-item">
			<div class="news-item_img-container">
				<?php if ( has_post_thumbnail() ) {?>
				<div style="background-image: url(<?php the_post_thumbnail_url(); ?>);" class="news-item_img"></div>
				<?php } else { ?>
				<div class="news-item_img-none"></div>
				<?php } ?>
			</div>
			<div class="news-item_content">
				<p class="news-item_title"><?php the_title(); ?></p>
				<p class="news-item_date"><?php the_time('F jS, Y'); ?></p>
				<div class="news-item_body"> 
					<?php the_excerpt(); ?>
					<p class="excerpt-more"><span>Read more</span><span class="fa fa-arrow-right"></span></p>
				</div>
			</div>
		</a>

	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php

		// hack to fix pagination problem with custom query
		// http://wordpress.stackexchange.com/questions/120407/how-to-fix-pagination-for-custom-loops/120408#120408
		$temp_query = $wp_query;
		$wp_query   = NULL;
		$wp_query   = $the_query;

		// Previous/next page navigation.
		wp_pagenavi();

		// reset main query
		$wp_query = NULL;
		$wp_query = $temp_query;
	?>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


	</div><!-- .news-list -->
</div><!-- .container -->

<?php get_footer(); ?>
