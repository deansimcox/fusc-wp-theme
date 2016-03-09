<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

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
			$meta = get_post_meta(get_the_ID());

			if ( array_key_exists('article-by', $meta) ) {
				echo '<p class="article_author"><strong>Article by ' . $meta['article-by'][0] . '</strong></p>';
			}
			

			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>',
				0,
				'btn'
			);
		?>
		</div><!-- .container -->
	</div><!-- .article-body -->
</article><!-- #post-## -->
