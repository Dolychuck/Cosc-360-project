function comment() {
	var headline = document.getElementById('headline').value;
	var post = document.getElementById('userpost').value;
	var image = document.getElementById('userImage').value;
	if(image.length == 0) {
		document.getElementsByClassName('invalidtheme')[0].innerHTML = 'empty image';
		return false;
	}  else {
		document.getElementsByClassName('invalidtheme')[0].innerHTML = '';
	}

	if(headline.length < 1 || headline.length > 40) {
		document.getElementsByClassName('invalidtheme')[0].innerHTML = 'Invalid title. must be none empty and less than 40 characters';
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
