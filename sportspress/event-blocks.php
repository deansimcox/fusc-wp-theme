<?php
/**
 * Event Blocks
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
	'link_teams' => get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false,
	'link_events' => get_option( 'sportspress_link_events', 'yes' ) == 'yes' ? true : false,
	'paginated' => get_option( 'sportspress_event_blocks_paginated', 'yes' ) == 'yes' ? true : false,
	'rows' => get_option( 'sportspress_event_blocks_rows', 10 ),
	'order' => 'default',
	'show_all_events_link' => false,
	'show_title' => get_option( 'sportspress_event_blocks_show_title', 'no' ) == 'yes' ? true : false,
	'show_league' => get_option( 'sportspress_event_blocks_show_league', 'no' ) == 'yes' ? true : false,
	'show_season' => get_option( 'sportspress_event_blocks_show_season', 'no' ) == 'yes' ? true : false,
	'show_venue' => get_option( 'sportspress_event_blocks_show_venue', 'no' ) == 'yes' ? true : false,
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

if ( $show_title && false === $title && $id ):
	$caption = $calendar->caption;
	if ( $caption )
		$title = $caption;
	else
		$title = get_the_title( $id );
endif;

if ( isset( $columns ) ) {
	$usecolumns = $columns;
}

if ( $title ) {
	echo '<h4 class="sp-table-caption">' . $title . '</h4>';
}

?>

<div class="fixtures-list">
	<?php
	$i = 0;

	if ( intval( $number ) > 0 )
		$limit = $number;

	// echo '<pre>' . var_export($data, true) . '</pre>';

	foreach ( $data as $event ):
		if ( isset( $limit ) && $i >= $limit ) continue;

		$permalink = get_post_permalink( $event, false, true );
		$results = get_post_meta( $event->ID, 'sp_results', true );

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
		?>
		<div class="fixtures-list_row">
			<time class="col col-when" datetime="<?php echo $event->post_date; ?>">				
				<span class="col-when_date"><?php echo get_the_time( get_option( 'date_format' ), $event ); ?></span>
				<span class="col-when_time"><?php echo sp_get_time( $event ); ?></span>
			</time>
			<div class="col col-match">
				<div class="col col-team -home">
					<span class="col-team_crest">
						<?php echo($logos[0]) ?>
					</span>
					<span class="home-team"><?php echo get_the_title( $teams[0] ) ?></span>
				</div>
				<?php 
					$teamOutput = null;
					$results = sp_get_main_results( $event );
					if ( sizeof( $results ) ) {
						$teamOutput = '<div class="col col-scores"> <span class="score -home">' . $results[0] . '</span> <span class="separator">-</span> <span class="score -away">' . $results[1] . '</span> </div>';
					} else {
						$teamOutput = '<div class="col col-versus">Vs</div>';
						// return array( sp_get_time( $event ) );
					}
					echo $teamOutput;
				?>
				<div class="col col-team -away">
					<span class="away-team"><?php echo get_the_title( $teams[1] ) ?></span>
					<span class="col-team_crest">
						<?php echo($logos[1]) ?>
					</span>
				</div>
			</div>
			<div class="col col-ctas">
				<a href="<?php echo $permalink ?>" class="cta">Match Details</a>
			</div>
		</div>
		<?php
		$i++;
	endforeach;
	?>
</div>