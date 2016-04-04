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

      <div class="rules">
         <p>Pick any 10 players. A point is awarded for every <strong>GOAL, ASSIST, and GAME-WINNING GOAL</strong>. The deadline to submit picks is Wednesday April 15th at 7pm. <a id="moreRules">More Rules</a></p>

         <div class="rulesDrawer">
            <h3>Instructions</h3>
            <p>Choose any 10 players to create your fantasy playoff team! The top 10 scoring leaders on each team are listed. Don't forget to check the <a href="http://www.tsn.ca/nhl/injuries/" target="injries">injury list</a> before making your picks! If you wish to choose a player not listed, please fill in his name under the Additional Players heading.</p>

            <h3>Scoring</h3>
            <p>A point is awarded for a goal, an assist, and a game-winning goal. (If a player you selected gets a game-winning goal, you will score 2 points total.  One for a goal, one for a game-winning goal)</p>

            <h3>Entry Fee</h3>
            <p>The entry fee to the pool is $10.  Please coordinate with Mike Saxton, Scott Gutcher, or Matt White to make your payment.  The deadline for payment is Wednesday April 22nd; if payment is not received your entry is invalid. If you would like to pay through the post or by email money transfer please <a href="mailto:playoffpursuit@gmail.com?subject=Entry%20Fee">contact us</a>.</p></p>

            <h3>Prizes</h3>
            <p>To be determined based on number of participants.  At minimum, there will be prizes for the top three finishers.  100% of entry fees will go towards prizes. (Last year's prizes were: 1st: $500, 2nd: $300, 3rd: $100, 4th: $50, 5th: $30)</p>

            <h3>Help</h3>
            <p>If you have any questions or comments please <a href="mailto:playoffpursuit@gmail.com?subject=Help">contact us</a>.</p>

            <h3>Tie-Breaking Procedure</h3>
            <p>Ties in the final point standings will be settled first by most total goals, and then by most total assists.  If a tie persists, the teams will reamin tied, and any prizes will be split equally.</p>
         </div>
      </div>      

      <form name="signupForm" onsubmit="return jsValidate()" method="post" action="processSignup.php">
      
         <div class="signup">
               <p><label id="fullName_label">Name: <input type="text" id="fullName" name="fullName" /></label></p>
               <p><label id="teamName_label">Team Name: <input type="text" id="teamName" name="teamName" /></label></p>
               <p><label id="email_label">Email: <input type="text" id="email" name="email" /></label></p>
         </div>

         <div class="selection">
            <div class="conference western">
               <?php
                  outputTeamSignup("ana", "west", "Anaheim Mighty Ducks");
                  outputTeamSignup("stl", "west", "St. Louis Blues");
                  outputTeamSignup("nsh", "west", "Nashville Predators");
                  outputTeamSignup("chi", "west", "Chicago Blackhawks");

                  outputTeamSignup("van", "west", "Vancouver Canucks");
                  outputTeamSignup("min", "west", "Minnesota Wild");
                  outputTeamSignup("wpg", "west", "Winnipeg Jets");
                  outputTeamSignup("cgy", "west", "Calgary Flames");
               ?>
            </div>
            <div class="conference eastern">
               <?php
                  outputTeamSignup("nyr", "east", "New York Rangers");
                  outputTeamSignup("mtl", "east", "Montreal Canadiens");
                  outputTeamSignup("tbl", "east", "Tampa Bay Lightning");
                  outputTeamSignup("wsh", "east", "Washington Capitals");

                  outputTeamSignup("nyi", "east", "New York Islanders");
                  outputTeamSignup("det", "east", "Detroit Red Wings");
                  outputTeamSignup("ott", "east", "Ottawa Senators");
                  outputTeamSignup("pit", "east", "Pittsburgh Penguins");
               ?>
            </div>
            <div class="additional">
               <h2>Additional Players</h2>
               <p><input type="checkbox" name="signup[]" value="additional_player01" id="additional_player01_check"> <input type="text" name="additional_player01" id="additional_player01_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player02" id="additional_player02_check"> <input type="text" name="additional_player02" id="additional_player02_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player03" id="additional_player03_check"> <input type="text" name="additional_player03" id="additional_player03_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player04" id="additional_player04_check"> <input type="text" name="additional_player04" id="additional_player04_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player05" id="additional_player05_check"> <input type="text" name="additional_player05" id="additional_player05_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player06" id="additional_player06_check"> <input type="text" name="additional_player06" id="additional_player06_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player07" id="additional_player07_check"> <input type="text" name="additional_player07" id="additional_player07_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player08" id="additional_player08_check"> <input type="text" name="additional_player08" id="additional_player08_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player09" id="additional_player09_check"> <input type="text" name="additional_player09" id="additional_player09_text" /></p>
               <p><input type="checkbox" name="signup[]" value="additional_player10" id="additional_player10_check"> <input type="text" name="additional_player10" id="additional_player10_text" /></p>

               <input type="submit" value="Submit" class="submit">
               <p>Check the <a href="http://www.tsn.ca/nhl/injuries/" target="injries">injury list</a> before submitting!</p>
            </div>
         </div>

      </form>

   </div>

<script type="text/javascript" language="JavaScript1.2" src="includes/formCheck.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
   (function() {      
      // Rules Drawer
      $('#moreRules').click( function() {
         $this = $(this);
         if ( $this.text() == "More Rules") {
            $('.rulesDrawer').slideDown(300);
            $this.text("Hide Rules");
         } else {
            $('.rulesDrawer').slideUp(300);
            $this.text("More Rules");
         }
      });
   })();
</script>

<?php
function outputTeamSignup( $nhlTeam, $conference, $fullNhlTeamName ) {

   echo '<h2>' . $fullNhlTeamName . '</h2>';

   // include the database variables
   require( "mySQL_info.php" );

   // attempt to connect to the database
   $connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
   if( !$connection ) { die( "could not connect to the database." ); }

   // select the database
   $dbSelect = mysql_select_db( $dbDatabase );
   if( !$dbSelect ) { die( "could not select the database." ); }

   $teamOutput_query = "
      SELECT nhlPlayers.name, nhlPlayers.postion, nhlPlayers.seasonPoints, nhlPlayers.nhlPlayerID
      FROM nhlPlayers
      WHERE nhlPlayers.nhlTeamID = '" . $nhlTeam . "'
      ORDER BY nhlPlayers.seasonPoints DESC";

   $teamOutput_result = mysql_query( $teamOutput_query );
   if( !$teamOutput_result ) {
      die( "could not get output team. $teamOutput_query" );
      //echo '<p>There was a problem with your request. please <a href="mailto:playoffpursuit@gmail.com?subject=StandingsProblem">contact us</a> if the problem continues</p>';
   } else {
      while( $teamOutput_resultRow = mysql_fetch_assoc( $teamOutput_result ) ) {
         echo '<p><label>';
         if ($conference == "west") {
            echo $teamOutput_resultRow['name'] . ', ' . $teamOutput_resultRow['postion'] . ' - <strong> ' . $teamOutput_resultRow['seasonPoints'] . ' pts.</strong>';
            echo' <input type="checkbox" name="signup[]" value="' . $teamOutput_resultRow['nhlPlayerID'] . '">';
         } else {
            echo' <input type="checkbox" name="signup[]" value="' . $teamOutput_resultRow['nhlPlayerID'] . '">';
            echo $teamOutput_resultRow['name'] . ', ' . $teamOutput_resultRow['postion'] . ' - <strong> ' . $teamOutput_resultRow['seasonPoints'] . ' pts.</strong>';
         }
         echo '</label></p>';
      }
   }

   echo '<br /><br />';
}
?>

</body>
</html>