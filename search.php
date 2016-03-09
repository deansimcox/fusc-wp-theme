<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="page-head_shade"></div>
		<h1 class="page-head_title"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<em>' . esc_html( get_search_query() ) . '</em>' ); ?></h1>		
	</div>
</div>

<div class="container">
	<div class="news-list">

		<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			?>

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
						<p class="excerpt-more"><span>Go to page</span><span class="fa fa-arrow-right"></span></p>
					</div>
				</div>
			</a>

			<?php
			// End the loop.
			endwhile;

			// Previous/next page navigation.
			wp_pagenavi();


		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


	</div><!-- .news-list -->
</div><!-- .container -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
