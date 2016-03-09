<?php
/**
 * Event List
 *
 * @author 		ThemeBoy
 * @package 	SportsPress/Templates
 * @version     1.9.13
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$defaults = array(
	'id' => null,
	'title' => false,
	'status' => 'default',
	'date' => 'default',
	'date_from' => 'default',
	'date_to' => 'default',
	'league' => null,
	'season' => null,
	'number' => -1,
	'show_team_logo' => get_option( 'sportspress_event_list_show_logos', 'no' ) == 'yes' ? true : false,
	'link_events' => get_option( 'sportspress_link_events', 'yes' ) == 'yes' ? true : false,
	'link_teams' => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
	'link_venues' => get_option( 'sportspress_link_venues', 'yes' ) == 'yes' ? true : false,
	'sortable' => get_option( 'sportspress_enable_sortable_tables', 'yes' ) == 'yes' ? true : false,
	'scrollable' => get_option( 'sportspress_enable_scrollable_tables', 'yes' ) == 'yes' ? true : false,
	'paginated' => get_option( 'sportspress_event_list_paginated', 'yes' ) == 'yes' ? true : false,
	'rows' => get_option( 'sportspress_event_list_rows', 10 ),
	'order' => 'default',
	'columns' => null,
	'show_all_events_link' => false,
	'show_title' => get_option( 'sportspress_event_list_show_title', 'yes' ) == 'yes' ? true : false,
);

extract( $defaults, EXTR_SKIP );

$calendar = new SP_Calendar( $id );
if ( $status != 'default' )
	$calendar->status = $status;
if ( $date != 'default' )
	$calendar->date = $date;
if ( $date_from != 'default' )
	$calendar->from = $date_from;
if ( $date_to != 'default' )
	$calendar->to = $date_to;
if ( $league )
	$calendar->league = $league;
if ( $season )
	$calendar->season = $season;
if ( $order != 'default' )
	$calendar->order = $order;
$data = $calendar->data();
$usecolumns = $calendar->columns;
$title_format = get_option( 'sportspress_event_list_title_format', 'title' );
$time_format = get_option( 'sportspress_event_list_time_format', 'combined' );

if ( isset( $columns ) ):
	if ( is_array( $columns ) )
		$usecolumns = $columns;
	else
		$usecolumns = explode( ',', $columns );
endif;

if ( $show_title && false === $title && $id ):
	$caption = $calendar->caption;
	if ( $caption )
		$title = $caption;
	else
		$title = get_the_title( $id );
endif;
?>


<div class="sp-template sp-template-event-list">

	<?php if ( $title ) { ?>
		<h4 class="sp-table-caption"><?php echo $title; ?></h4>
	<?php } ?>

	<tbody>
		<?php
		$i = 0;

		if ( is_numeric( $number ) && $number > 0 )
			$limit = $number;

		foreach ( $data as $event ):
			if ( isset( $limit ) && $i >= $limit ) continue;

			$teams = get_post_meta( $event->ID, 'sp_team' );
			$video = get_post_meta( $event->ID, 'sp_video', true );

			$main_results = apply_filters( 'sportspress_event_list_main_results', sp_get_main_results( $event ), $event->ID );

			$teams_output = '';
			$teams_array = array();
			$team_logos = array();

			$teams = array_unique( get_post_meta( $event->ID, 'sp_team' ) );
			$teams = array_filter( $teams, 'sp_filter_positive' );
			$logos = array();

			$j = 0;
			foreach( $teams as $team ):
				$j++;
				if ( has_post_thumbnail ( $team ) ):
					if ( $link_teams ):
						$logo = '<a class="team-logo logo-' . ( $j % 2 ? 'odd' : 'even' ) . '" href="' . get_permalink( $team, false, true ) . '" title="' . get_the_title( $team ) . '">' . get_the_post_thumbnail( $team, 'sportspress-fit-icon' ) . '</a>';
					else:
						$logo = '<span class="team-logo logo-' . ( $j % 2 ? 'odd' : 'even' ) . '" title="' . get_the_title( $team ) . '">' . get_the_post_thumbnail( $team, 'sportspress-fit-icon' ) . '</span>';
					endif;
					$logos[] = $logo;
				endif;
			endforeach;

			if ( $teams ):
				foreach ( $teams as $team ):
					$name = get_the_title( $team );
					if ( $name ):

						if ( $show_team_logo ):
							$name = sp_get_logo( $team, 'mini' ) . ' ' . $name;
							$team_logos[] = sp_get_logo( $team, 'mini' );
						endif;

						if ( $link_teams ):
							$team_output = '<a href="' . get_post_permalink( $team ) . '">' . $name . '</a>';
						else:
							$team_output = $name;
						endif;

						$team_result = sp_array_value( $main_results, $team, null );

						if ( $team_result != null ):
							if ( $usecolumns != null && ! in_array( 'time', $usecolumns ) ):
								$team_output .= ' (' . $team_result . ')';
							endif;
						endif;

						$teams_array[] = $team_output;

						$teams_output .= $team_output . '<br>';
					endif;
				endforeach;
			else:
				$teams_output .= '&mdash;';
			endif;

			$date_html = get_post_time( get_option( 'date_format' ), false, $event, true );

			echo '<p class="data-date text-center">' . $date_html . '</p>';
			?>

			<div class="fixture-small">
				<div class="fixture-small_home">
					<div class="fixture-small_home-crest">
						<?php echo($logos[0]) ?>
					</div>
					<p class="fixture-small_home-name"><?php echo get_the_title( $teams[0] ) ?></p>
				</div>
				<?php 
					$teamOutput = null;
					$results = sp_get_main_results( $event );
					if ( sizeof( $results ) ) {
						$teamOutput = '<div class="fixture-small_center"> <span class="score -home">' . $results[0] . '</span> <span class="separator">-</span> <span class="score -away">' . $results[1] . '</span> </div>';
					} else {
						$teamOutput = '<div class="fixture-small_center">Vs</div>';
					}
					echo $teamOutput;
				?>
				<div class="fixture-small_away">
					<div class="fixture-small_away-crest">
						<?php echo($logos[1]) ?>
					</div>
					<p class="fixture-small_away-name"><?php echo get_the_title( $teams[1] ) ?></p>
				</div>
			</div>

			<?php 

			if ( sp_column_active( $usecolumns, 'article' ) ):
				echo '<p> <a href="' . get_post_permalink( $event->ID, false, true ) . '" class="btn -block">Match details</a> </p>';
			endif;

			$i++;
		endforeach;
		?>
	</tbody>

	<?php
	if ( $id && $show_all_events_link )
		echo '<p> <a href="' . get_permalink( $id ) . '" class="btn -block">' . __( 'View all events', 'sportspress' ) . '</a> </p>';
	?>
</div>