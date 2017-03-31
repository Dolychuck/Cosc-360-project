function userpass() {
	var user = document.getElementById('user').value;
	var pass = document.getElementById('pass').value;
	
	if(user.length < 5 || user.length > 40) {
		document.getElementsByClassName('invaliduser')[0].innerHTML = 'Invalid username. must be between 5 and 40 characters';
		return false;
	} else {
		document.getElementsByClassName('invaliduser')[0].innerHTML = '';
	}
	if(pass.length < 7 || pass.length > 40) {
		document.getElementsByClassName('invalidpass')[0].innerHTML = 'Invalid post. Must be betweem 7 and 40 characters';
		return false;
	} else {
		document.getElementsByClassName('invalidpass')[0].innerHTML = '';
	}
	return true;
}

function empty() {
	document.getElementById('user').value = "";
	document.getElementById('pass').value = "";
}