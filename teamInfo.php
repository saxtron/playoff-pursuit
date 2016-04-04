<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
 
   <!-- !!! Google Analytics Tracking Code !!! -->

   <link rel="stylesheet" type="text/css" href="includes/styles.css" />
   <title>Playoff Pursuit</title>
</head>
<body>
   <div class="wrapper">

      <div class="header">
         <h5>New look.........same noble Pursuit</h5>
         <h1>Playoff Pursuit</h1>
      </div>


      
         <?php

            // include the database variables
            require_once( "mySQL_info.php" );

            // attempt to connect to the database
            $connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
            if( !$connection ) { die( "could not connect to the database." ); }

            // select the database
            $dbSelect = mysql_select_db( $dbDatabase );
            if( !$dbSelect ) { die( "could not select the database." ); }


            // display the team info
            $teamInfo_query = "
            	SELECT signups.signupID, signups.fullName, signups.teamName
            	FROM signups
            	WHERE signups.signupID = " . $_GET["teamID"];
            $teamInfo_result = mysql_query( $teamInfo_query );
            if( !$teamInfo_result ) {
            	//die( "could not get info for specified team. $teamInfo_query" );
            	echo '<p>There was a problem with your request. please <a href="mailto:playoffpursuit@gmail.com?subject=StandingsProblem">contact us</a> if the problem continues</p>';
            } else {

            	while( $teamInfo_resultRow = mysql_fetch_assoc( $teamInfo_result ) ) {
            		echo "<h1>Team Name: " . $teamInfo_resultRow['teamName'] . "</h1>";
                  echo '<div class="teamInfo">';
            		echo "<h2>Team Manager: " . $teamInfo_resultRow['fullName'] . "</h2>";
            	}
            	
            }

            // display the team scoring
            $teamScoring_query = "
            	SELECT nhlPlayers.name, nhlPlayers.goals, nhlPlayers.assists, nhlPlayers.gwg, SUM( nhlPlayers.goals + nhlPlayers.assists + nhlPlayers.gwg ) AS playoffPoints
            	FROM signups
            	INNER JOIN selections ON signups.signupID = selections.signupID
            	INNER JOIN nhlPlayers ON selections.nhlPlayerID = nhlPlayers.nhlPlayerID
            	WHERE signups.signupID = " . $_GET["teamID"] . "
            	GROUP BY nhlPlayers.name
            	ORDER BY playoffPoints DESC";
            $teamScoring_result = mysql_query( $teamScoring_query );
            if( !$teamScoring_result ) {
            	//die( "could not get scoring for specified team. $teamScoring_query" );
            	// probably already displayed above
            	//echo '<p>There was a problem with your request. please <a href="mailto:playoffpursuit@gmail.com?subject=StandingsProblem">contact us</a> if the problem continues</p>';
            } else {

            	// create table headers
            	echo '<table width="400" border="0" cellpadding="0" cellspacing="0">
            		<tr>
            			<td width="200" class="teamInfoHeader"><h5>Player</h5></td>
            			<td width="50" align="right" class="teamInfoHeader"><h5>Goals</h5></td>
            			<td width="50" align="right" class="teamInfoHeader"><h5>Assists</h5></td>
            			<td width="50" align="right" class="teamInfoHeader"><h5>GWG</h5></td>
            			<td width="50" align="right" class="teamInfoHeader"><h5>Points</h5></td>
            		</tr>';
            		
            	$rowNumber = 1;
            	while( $teamScoring_resultRow = mysql_fetch_assoc( $teamScoring_result ) ) {
            		echo '<tr>
            			<td width="200" class="teamInfoRow' . $rowNumber . '"><p>' . $teamScoring_resultRow['name'] . '</p></td>
            			<td width="50" align="right" class="teamInfoRow' . $rowNumber . '"><p>' . $teamScoring_resultRow['goals'] . '</p></td>
            			<td width="50" align="right" class="teamInfoRow' . $rowNumber . '"><p>' . $teamScoring_resultRow['assists'] . '</p></td>
            			<td width="50" align="right" class="teamInfoRow' . $rowNumber . '"><p>' . $teamScoring_resultRow['gwg'] . '</p></td>
            			<td width="50" align="right" class="teamInfoRow' . $rowNumber . '"><p>' . $teamScoring_resultRow['playoffPoints'] . '</p></td>
            		</tr>';
            		$rowNumber = ( $rowNumber == 1 ? 2 : 1 );
            	}
            	echo '</table>';
               echo '</div>';

            }


         ?>

      </div>
  </div>

</body>
</html>