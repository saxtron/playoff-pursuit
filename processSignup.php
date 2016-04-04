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

         // --------------- Validate the signup --------------------

         //trust in JavaScript

         // ---------------- Add signup info to the database -------------------

         // setup the database connection
         $dbError = 0;      // tracks where DB errors occur
         $currentSignupID;  // the current signupID

         // include the database variables
         require_once( "mySQL_info.php" );

         // attempt to connect to the database
         $connection = mysql_connect( $dbHost, $dbUsername, $dbPassword );
         if( !$connection ) {
            //die( "could not connect to the database." );
            $dbError = 1;
         }

         // select the database
         $dbSelect = mysql_select_db( $dbDatabase );
         if( !$dbSelect ) {
            //die( "could not select the database." );
            $dbError = 2;
         }

         // insert personal info into the signups table
         $insertSignups_query = "INSERT INTO signups ( fullName, teamName, email ) VALUES ( '" . $_POST["fullName"] . "', '" . $_POST["teamName"] . "', '" . $_POST["email"] . "' )";
         //echo "<p>insertSignups_query: $insertSignups_query</p>\n";
         $insertSignups_result = mysql_query( $insertSignups_query );
         if( !$insertSignups_result ) {
            //die( "could not insert into the database. $insertSignups_query" );
            $dbError = 3;
         }

         // get the signupID using the email
         $getSignupID_query = "SELECT signupID FROM signups WHERE teamName='". $_POST["teamName"] . "'";
         //echo "<p>getSignupID_query: $getSignupID_query</p>\n";
         $getSignupID_result = mysql_query( $getSignupID_query );
         if( !$getSignupID_result ) {
            //die( "could not query the database. $getSignupID_query" );
            $dbError = 4;
         }
         while( $resultRow = mysql_fetch_array( $getSignupID_result ) ) {
            $currentSignupID = $resultRow['signupID'];
         }
         //echo "<p>currentSignupID: $currentSignupID</p>\n";

         // insert picks (if they are available) into the selection table
         $playerPicks = $_POST["signup"];
         foreach( $playerPicks as $nowPlayer ) {
            if( strcmp( substr( $nowPlayer, 0, 17 ), "additional_player") ) {
               // not an additional player
               $insertPicks_query = "INSERT INTO selections ( signupID, nhlPlayerID ) VALUES ( " . $currentSignupID . ", '" . $nowPlayer . "' )";
               $insertPicks_result = mysql_query( $insertPicks_query );
               if( !$insertPicks_result ) {
                  //die( "could not insert into the database. $insertPicks_query" );
                  $dbError = 5;
               }
            } else {
               // additional player selected
               // can't do anything now, will have to be added manually later
            }
         }

         // close the database connection
         //echo "<h1>dbError: $dbError</h1>\n";
         mysql_close( $connection );

         // display webpage content (what if something goes wrong?)
         echo "<h2>Congratulations, welcome to the Pursuit!</h2>\n";
         echo "<p>Your sign-up information has been e-mailed to you.</p>\n";
         echo "<p>Check back once the playoffs start for updated pool standings.</p>\n";
         echo "<hr />\n";

         // --------------- Send emails to the user and the admin -----------------------

         // build email content
         $emailContent = "";

         $emailContent .= "Congratulations, welcome to the Pursuit!\n\n";

         $emailContent .= "Here is the information collected from your entry:\n\n";

         $emailContent .= "Name: " . $_POST["fullName"] . "\n";
         $emailContent .= "Team Name: " . $_POST["teamName"] . "\n";
         $emailContent .= "Email: " . $_POST["email"] . "\n\n";

         $emailContent .= "Players:\n";
         $signupPlayers = $_POST["signup"];
         foreach( $signupPlayers as $selectedPlayer ) {
            
            if( strcmp( substr( $selectedPlayer, 0, 17 ), "additional_player") ) {
               // not an additional player
               $emailContent .= $selectedPlayer . "\n";
            } else {
               // additional player selected
               $emailContent .= $_POST[$selectedPlayer] . "\n";
            }
         }

         $emailContent .= "\n\nIf this is incorrect please email playoffpursuit@gmail.com\n\n";

         $emailContent .= "Check back at www.playoffpursuit.com once the playoffs start for updated pool standings.\n\n";

         $emailContent .= "Reminder: The entry fee to the pool is $10.  Please coordinate with Mike Saxton, Scott Gutcher, or Matt White to make your payment.  The deadline for payment is Wednesday April 22nd; if payment is not received your entry is invalid. If you would like to pay through the post or by email money transfer please contact us at playoffpursuit@gmail.com \n\n";

         //echo "emailContent: $emailContent";

         // send email to the user
         $userEmail = $_POST["email"];
         $userSubject = "Playoff Pursuit Entry Info";
         $userHeaders = "From: playoffpursuit@gmail.com";
         mail( $userEmail, $userSubject, $emailContent, $userHeaders );


         // send email to the admin
         $adminEmail = "playoffpursuit@gmail.com";
         $adminSubject = "Playoff Pursuit Signup";
         $adminHeaders = "From: " . $_POST["email"];
         mail( $adminEmail, $adminSubject, $emailContent, $adminHeaders );

      ?>

   </div>
</body>
</html>
