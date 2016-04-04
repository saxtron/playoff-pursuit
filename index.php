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

      <div class="lastUpdate">
         <p>Last Updated: June 16th</p>
         <p>Prizes: 1st: $500, 2nd: $250, 3rd: $150, 4th: $100, 5th: $60</p>
      </div>

      <div class="standings">

         <?php
   
            // include the database variables
            require_once( "mySQL_info.php" );

            // attempt to connect to the database
            $connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
            if( !$connection ) { die( "could not connect to the database." ); }

            // select the database
            $dbSelect = mysql_select_db( $dbDatabase );
            if( !$dbSelect ) { die( "could not select the database." ); }

            $standings_query = "
               SELECT signups.signupID, signups.fullName, signups.teamName, standings.pointTotal, standings.playersRemaining
               FROM standings
               INNER JOIN signups ON standings.signupID = signups.signupID
               ORDER BY standings.pointTotal DESC, standings.playersRemaining DESC";
            $standings_result = mysql_query( $standings_query );
            if( !$standings_result ) {
               //die( "could not get standings results. $standings_query" );
               echo '<p>The Standings are unavailable</p>';
            } else {
               
               $rank = 1;  // assign rank on the go (good?  I'll tell you whats not good, the ever increasing standingID values.  its not used anywhere, get rid of it!)
                  
               // create table headers (none really needed in this case)
               echo '<table>';
               
               while( $standings_resultRow = mysql_fetch_assoc( $standings_result ) ) {
                  echo '<tr>
                     <td><h2>' . $rank . ' - <a href="/teamInfo.php?teamID=' . $standings_resultRow['signupID'] . '">' . $standings_resultRow['teamName'] . '</a> <span class="fullName">('. $standings_resultRow['fullName'] .')</span></h2></td>
                     <td><h2>' . $standings_resultRow['pointTotal'] . 'pts.</h2></td>
                     <td><h2>(' . $standings_resultRow['playersRemaining'] . ' Remaining)</h2></td>
                  </tr>';
                  $rank++;
               }
               echo '</table>';

               $rank++;
               
            }

         ?>

      </div>

   </div>




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



</body>
</html>