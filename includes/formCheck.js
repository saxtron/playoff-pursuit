//formCheck.js

// ******** VARIABLES ********




// ******** FUNCTIONS ********

// change to pass the form name in jsValidateSignup()
function jsValidate() {
	var userInfoError = 0;
	var playerCount = 0;
	
	// check the user info
	if( isInputEmpty( 'fullName' ) ) { userInfoError++; }
	if( isInputEmpty( 'teamName' ) ) { userInfoError++; }
	if( !( validateEmail( 'email' ) ) ) { userInfoError++; }
	
	if( userInfoError > 0 ) {
		alert( 'The User Information section is incomplete.  Please address all fields marked in red.' );
		return false;
	}
	
	// check that 10 players have been selected
	var playerBoxes = document.signupForm['signup[]'];
	for( i = 0; i < playerBoxes.length; i++ ) {
		if( playerBoxes[i].checked == true ) {
			playerCount++;
		}
		//put all the names into an arrays? needed?	
	}
	//alert( 'playerCount:' + playerCount );
	
	if( playerCount < 10 ) {
		alert( 'Only ' + playerCount + ' players have been selected.  Please select 10 players.' );
		return false;
	} else if( playerCount > 10 ) {
		alert( playerCount + ' players have been selected.  Please select only 10 players.' );
		return false;	
	}
	
	//alert('This signup is ready for launch.' );
	return true;
}

// check the additional player box when a name is entered
function checkAdditionalBox( checkBoxID ) {
	var additionalPlayer_textBoxElement = document.getElementById( 'additional_player' + checkBoxID + '_text' );
	var additionalPlayer_checkBoxElement = document.getElementById( 'additional_player' + checkBoxID + '_check' );
	if( additionalPlayer_textBoxElement.value == null || additionalPlayer_textBoxElement.value == '' ) {
		//alert( 'turn #' + checkBoxID + ' off' );
		additionalPlayer_checkBoxElement.checked = false;
	} else {
		//alert( 'turn #' + checkBoxID + ' on' );
		additionalPlayer_checkBoxElement.checked = true;
	}
}


// form checking functions
function isInputEmpty( fieldName ) {
	var inputName = document.getElementById( fieldName );
	var labelName = document.getElementById( fieldName + '_label');
	if( inputName.value == null || inputName.value == '' ) {
		labelName.className = 'error';
		return true;
	}
	labelName.className = null;
	return false;
}

function isDropDownEmpty( fieldName ) {
	var teamName = fieldName;
	var selectBox = document.getElementById( fieldName );
	var labelName = document.getElementById( fieldName + '_label');
	var ranking = selectBox.options[selectBox.selectedIndex].value;	
	
	if( ranking == null || ranking == '' ) {
		labelName.className = 'error';
		return true;
	}
	
	labelName.className = null;
	return false;
}

function isCheckBoxOff( checkBoxID ) {
	var checkBoxElement = document.getElementById( checkBoxID );
	var labelName = document.getElementById( checkBoxID + '_label');
	if( checkBoxElement.checked ) {
		labelName.className = 'error'; 
		return false;
	}
	labelName.className = null; 
	return true;
	
}

function validateEmail( fieldName ) {
	// check that the email field is not blank
	if( isInputEmpty( fieldName ) ) {
		return false;	
	}
	
	var usersEmail = document.getElementById( fieldName ).value;
	var emailLabel = document.getElementById( fieldName + '_label');
	
	// check the email field with regular expressions (see FormMailAndLog1.92.pl for description)
	var valTest1 = usersEmail.search( /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/ );     //check for some invalid syntax
	var valTest2 = usersEmail.search( /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z0-9]+)(\]?)$/ );    // check for overall valid syntax
	
	if( valTest1 == -1 && valTest2 >= 0 ) {
		//alert('the email address was valid, valTest1:' + valTest1 + ' valTest2:' + valTest2);
		emailLabel.className = null;
		return true;
	}
	//alert('the email address was NOT valid, valTest1:' + valTest1 + ' valTest2:' + valTest2);
	emailLabel.className = 'error';
	return false; 

}






