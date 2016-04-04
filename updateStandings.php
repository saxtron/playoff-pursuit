<!-- updateStandings.php -->
<?php

// include the database variables
require_once( "mySQL_info.php" );

// attempt to connect to the database
$connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
if( !$connection ) { die( "could not connect to the database." ); }

// select the database
$dbSelect = mysql_select_db( $dbDatabase );
if( !$dbSelect ) { die( "could not select the database." ); }

// clear the standings table
$clearStandings_query = "DELETE FROM standings";
$clearStandings_result = mysql_query( $clearStandings_query );
if( !$clearStandings_result ) { 
	die( "could not clear standings table. $clearStandings_query" );
}

// ----------- calculate the points for all teams -------------------

// get all the signupIDs
$allSignups_query = "SELECT signupID FROM signups";
$allSignups_result = mysql_query( $allSignups_query );
if( !$allSignups_result ) {
	die( "could not get all signupIDs. $allSignups_query" );
}

// process each signup.  calculate points, update standings
while( $allSignups_resultRow = mysql_fetch_assoc( $allSignups_result ) ) {
	$currentSignupID = $allSignups_resultRow['signupID'];
	$teamScoring_query = "
		SELECT signups.signupID, nhlPlayers.nhlPlayerID, nhlPlayers.goals, nhlPlayers.assists, nhlPlayers.gwg, nhlTeams.active
		FROM signups
		INNER JOIN selections ON signups.signupID = selections.signupID
		INNER JOIN nhlPlayers ON selections.nhlPlayerID = nhlPlayers.nhlPlayerID
		INNER JOIN nhlTeams ON nhlPlayers.nhlTeamID = nhlTeams.nhlTeamID
		WHERE signups.signupID = " . $currentSignupID;
	$teamScoring_result = mysql_query( $teamScoring_query );
	if( !$teamScoring_result ) {
		die( "could not get players for specified team. $teamScoring_query" );
	}
	
	// calculate the points and players remaining for the current team
	$teamTotalPoints = 0;
	$playersRemaining = 0;
	while( $teamScoring_resultRow = mysql_fetch_assoc( $teamScoring_result ) ) {
		$teamTotalPoints += 
			$teamScoring_resultRow['goals'] +
			$teamScoring_resultRow['assists'] +
			$teamScoring_resultRow['gwg'];
		$playersRemaining += $teamScoring_resultRow['active'];
	}
	echo "<p>currentSignupID: $currentSignupID, teamTotalPoints: $teamTotalPoints</p>";
	
	// add the results to the standings table
	$insertStandings_query = "INSERT INTO standings ( signupID, pointTotal, playersRemaining ) VALUES ( $currentSignupID, $teamTotalPoints, $playersRemaining )";
	$insertStandings_result = mysql_query( $insertStandings_query );
	if( !$insertStandings_result ) {
		die( "could not insert into standings table. $insertStandings_query" );
	}
	
}

// close the database connection
mysql_close( $connection );

echo "<p>reached the end</p>";

?>

