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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">
		<?php the_title( '<h1 class="article_title">', '</h1>' ); ?>
		<p class="article_date"><?php the_date(); ?></p>
	</div>

	<?php if ( has_post_thumbnail() ) {?>
	<div class="article_img">
		<div class="container">
			<?php
				twentysixteen_post_thumbnail('news-item');
				$get_description = get_post(get_post_thumbnail_id())->post_excerpt;
				if(!empty($get_description)){
					echo '<p class="article_img-caption">' . $get_description . '</p>';
				}
			?>
		</div>
	</div>
	<?php } ?>

	<div class="article_body">
		<div class="container">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			the_content();
			
		// End of the loop.
		endwhile;
		?>
		</div><!-- .container -->
	</div><!-- .article-body -->

</article><!-- #post-## -->

<?php get_footer(); ?>
