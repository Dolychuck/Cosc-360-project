window.onload = function() {
	document.getElementById('firstname').addEventListener('click', function(e) {
		document.getElementById('firstname').value = '';
	});
	
	document.getElementById('lastname').addEventListener('click', function(e) {
		document.getElementById('lastname').value = '';
	});
	
	document.getElementById('username').addEventListener('click', function(e) {
		document.getElementById('username').value = '';
	});
	
	document.getElementById('email').addEventListener('click', function(e) {
		document.getElementById('email').value = '';
	});
	
	document.getElementById('password').addEventListener('click', function(e) {
		document.getElementById('password').value = '';
	});
	
	document.getElementById('confpassword').addEventListener('click', function(e) {
		document.getElementById('confpassword').value = '';
	});
}

function myFunction() {
	var fname = document.getElementById('firstname').value;
	var lname = document.getElementById('lastname').value;
	var uname = document.getElementById('username').value;
	var email = document.getElementById('email').value;
	var pass = document.getElementById('password').value;
	var confpassword = document.getElementById('confpassword').value;
	if(fname == "") {
		document.getElementsByClassName('invalidfirstname')[0].innerHTML = 'Must enter name';
		return false;
	} else {
		document.getElementsByClassName('invalidfirstname')[0].innerHTML = '';
	}
	if(lname == "") {
		document.getElementsByClassName('invalidlastname')[0].innerHTML = 'Must enter lastname';
		return false;
	} else {
		document.getElementsByClassName('invalidlastname')[0].innerHTML = '';
	}
	if(uname.length < 5) {
		document.getElementsByClassName('invalidusername')[0].innerHTML = 'name must be 5 charaters or longer';
		return false;
	} else {
		document.getElementsByClassName('invalidusername')[0].innerHTML = '';
	}
	if(!email.includes("@") || email.length < 3) {
		document.getElementsByClassName('invalidemail')[0].innerHTML = 'invalid email';
		return false;
	} else {
		document.getElementsByClassName('invalidemail')[0].innerHTML = '';
	}
	
	if(pass.length < 7) {
		document.getElementsByClassName('invalidpass')[0].innerHTML = 'password must be 7 charaters or longer';
		return false;
	} else {
		document.getElementsByClassName('invalidpass')[0].innerHTML = '';
	}
		
	if(pass != confpassword) {
		document.getElementsByClassName('invalidpass')[0].innerHTML = 'Passwords do not match';
		document.getElementsByClassName('invalidpass')[1].innerHTML = 'Passwords do not match';
	    return false;
	} else {
		document.getElementsByClassName('invalidpass')[0].innerHTML = '';
		document.getElementsByClassName('invalidpass')[1].innerHTML = '';
	}
	return true;
}