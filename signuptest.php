<!DOCTYPE html>
<html>
<head>
	<title>SignUp Test</title>
	<style type="text/css">
		h2, h3 {font-size: 12px; line-height: 12px; margin: 0px;}
	</style>
</head>
<body>

<h1>This is what we're trying to reproduce</h1>

<h2><a href="http://www.tsn.ca/nhl/teams/statistics/?hubname=nhl-bruins" target="teamStats">Boston Bruins</a></h2>
<h3>David Krejci, C - <b>69 pts.</b> <input type="checkbox" name="signup[]" value="boston_krejci"></h3>
<h3 id="injured"><a href="http://www.tsn.ca/nhl/teams/players/bio/?id=3490" target="injuries">Patrice Bergeron, C</a> - <b>62 pts.</b> <input type="checkbox" name="signup[]" value="boston_bergeron"></h3>
<h3>Jarome Iginla, RW - <b>61 pts.</b> <input type="checkbox" name="signup[]" value="boston_iginla"></h3>
<h3>Milan Lucic, LW - <b>59 pts.</b> <input type="checkbox" name="signup[]" value="boston_lucic"></h3>
<h3>Brad Marchand, LW - <b>53 pts.</b> <input type="checkbox" name="signup[]" value="boston_marchand"></h3>
<h3>Reilly Smith, RW - <b>51 pts.</b> <input type="checkbox" name="signup[]" value="boston_smith"></h3>
<h3>Carl Soderberg, C - <b>48 pts.</b> <input type="checkbox" name="signup[]" value="boston_soderberg"></h3>
<h3>Zdeno Chara, D - <b>40 pts.</b> <input type="checkbox" name="signup[]" value="boston_chara"></h3>
<h3>Torey Krug, D - <b>40 pts.</b> <input type="checkbox" name="signup[]" value="boston_krug"></h3>
<h3>Loui Eriksson, RW - <b>37 pts.</b> <input type="checkbox" name="signup[]" value="boston_eriksson"></h3>

<hr />

<h1>Here we go... </h1>

<h3>Full Name, POS - <b>Season Points pts.</b> <input type="checkbox" name="signup[]" value="playerid_playerid"></h3>
<p>We need: Full Name, Position, Season Points, PlayerID</p>


<?php
	
outputTeamSignup("bos");
outputTeamSignup("sjs");


function outputTeamSignup( $nhlTeam ) {

	echo '<h2><a href="http://www.tsn.ca/nhl/teams" target="teamStats"> Team ' . $nhlTeam . '</a></h2>';

	// include the database variables
	require( "mySQL_info.php" );

	// attempt to connect to the database
	$connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
	if( !$connection ) { die( "could not connect to the database." ); }

	// select the database
	$dbSelect = mysql_select_db( $dbDatabase );
	if( !$dbSelect ) { die( "could not select the database." ); }

	$teamOutput_query = "
		SELECT nhlPlayers.name, nhlPlayers.position, nhlPlayers.seasonPoints, nhlPlayers.nhlPlayerID
		FROM nhlPlayers
		WHERE nhlPlayers.nhlTeamID = '" . $nhlTeam . "'";

	$teamOutput_result = mysql_query( $teamOutput_query );
	if( !$teamOutput_result ) {
		die( "could not get output team. $teamOutput_query" );
		//echo '<p>There was a problem with your request. please <a href="mailto:playoffpursuit@gmail.com?subject=StandingsProblem">contact us</a> if the problem continues</p>';
	} else {
		while( $teamOutput_resultRow = mysql_fetch_assoc( $teamOutput_result ) ) {
			echo '<h3>' . $teamOutput_resultRow['name'] . ', ' . $teamOutput_resultRow['position'] . ' - <b> ' . $teamOutput_resultRow['seasonPoints'] . ' pts.</b> <input type="checkbox" name="signup[]" value="' . $teamOutput_resultRow['nhlPlayerID'] . '"></h3>';
		}
	}

	echo '<br /><br />';
}

?>



</body>
</html>