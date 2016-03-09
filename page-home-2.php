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

<div class="container">

	<div class="carousel-container-wrap">
		<div data-carousel="{ &quot;speed&quot;: 800, &quot;pause&quot;: 6000, &quot;mode&quot;: &quot;horizontal&quot;, &quot;auto&quot;: true, &quot;autoControls&quot;: true, &quot;autoControlsCombine&quot;: true, &quot;autoStart&quot;: true, &quot;autoHover&quot;: true }" class="carousel-container">
			<?php

				$the_query = new WP_Query(
					array(
						'posts_per_page' => 5,
						'post_status' => 'publish',
						'post_type' => array(
							'sp_event',
							'post'
						),
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
			<div class="carousel-slide">
				<div class="carousel-slide_image" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)"></div>
				<div class="carousel-slide-caption">
					<p class="carousel-slide-caption-title"><?php echo get_the_title(); ?></p>
					<?php the_excerpt(); ?>
					<p><a href="<?php echo get_permalink(); ?>" class="btn">Read more <span class="fa fa-arrow-right"></span></a>
					</p>
				</div>
			</div>
			<?php
					}
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
		</div>
	</div>

	<div class="pod-row">
		<?php if ( is_active_sidebar( 'home-pod-1' )  ) : ?>
			<div class="pod">
				<?php dynamic_sidebar( 'home-pod-1' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'home-pod-2' )  ) : ?>
			<div class="pod">
				<?php dynamic_sidebar( 'home-pod-2' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'home-pod-3' )  ) : ?>
			<div class="pod">
				<?php dynamic_sidebar( 'home-pod-3' ); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="pod">
		<div class="pod_body-inner">

			<p class="pod_title">Forrestfield United - Driven by the Community</p>

			<p>Forrestfield United Soccer Club is one of the biggest Football (Soccer) Clubs in Perth Western Australia. It is a regional community club situated at Hartfield Park in the foothills of picturesque Darling Ranges.</p>

			<p>The club has a long history in WA football (soccer), and was originally known as Cottesloe SC when first admitted into the State League competition in 1962.</p>

			<p>Cottesloe SC then merged with SMA (Swan Migrant Association) in 1971 to become SMA Cottesloe SC. As SMA were based in the Ascot area it was decided to change the club name to Ascot Soccer Club" the following year.</p>

			<p>In 1974 the club became WA Champions when we took out the State Premier Division title by nine points. In 1978 Ascot won the last Ampol Cup, and that trophy is proudly on display in the Forrestfield United’s club house at Hartfield Park.</p>

			<p>Later stages of 1978 is probably the most significant part of the clubs history as this was the time Ascot SC were in merger discussions with fourth division club, Kalamunda United SC, who were based at Hartfield Park, Forrestfield.</p>

			<p>The merger went ahead entering State Competition in 1979 as Forrestfield United SC.</p>

			<p>We have had many highs and lows since 1979, which included a stint in the Amateur League from 1993 to 2004. But the club is now riding high not only on the playing surface but more importantly behind the scenes as well, ensuring longevity and financial stability of the club.</p>

			<p>Being a football club, the emphasis is on providing a pathway to the National Team representation for our most talented within the Eastern Corridor, but just as important we provide facilities and cater for all levels of ability within our community, ranging from Discovery Phase all the way to through our Veterans (Masters).</p>

			<p><strong>Our Moto is:-</strong><br>
			" If for whatever reason our youngsters don't become elite footballers, there is no doubt that they will become healthy and well balanced members of our community taking into consideration the mentoring and education they receive in a safe fun loving environment of Hartfield Park, where Football is first and foremost fun. "</p>
			
		</div>
	</div>

</div>

<?php get_footer(); ?>
