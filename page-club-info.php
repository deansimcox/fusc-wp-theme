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

<div class="content-area">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'template-parts/content', 'head' ); ?>

		<div class="container entry-content">
			<?php

			$fields = get_fields();

			if( $fields ) {
				foreach( $fields as $field_name => $value )	{
					echo $value;
				}
			}

			?>

			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
						get_the_title()
					),
					'<footer class="entry-footer"><span class="edit-link">',
					'</span></footer><!-- .entry-footer -->',
					0,
					'btn'
				);
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->

	<?php
		// End of the loop.
	endwhile;
	?>

</div><!-- .content-area -->

<?php get_footer(); ?>
