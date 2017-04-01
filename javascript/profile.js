function comment() {
	var theme = document.getElementById('theme').value;
	var post = document.getElementById('userpost').value;

	if(theme.length < 1 || theme.length > 40) {
		document.getElementsByClassName('invalidtheme')[0].innerHTML = 'Invalid theme. must be none empty and less than 40 characters';
		return false;
	} else {
		document.getElementsByClassName('invalidtheme')[0].innerHTML = '';
	}
	if(post.length < 1 || post.length > 1000) {
		document.getElementsByClassName('invaliduserpost')[0].innerHTML = 'Invalid post. Must be none empty and less than 1000 characters';
		return false;
	} else {
		document.getElementsByClassName('invaliduserpost')[0].innerHTML = '';
	}
	return true;
}
