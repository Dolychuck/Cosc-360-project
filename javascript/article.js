function comment(str) {
 if (str == "") {
     document.getElementById("results").innerHTML = "";
     return;
 } else {
     if (window.XMLHttpRequest) {
         // code for IE7+, Firefox, Chrome, Opera, Safari
         xmlhttp = new XMLHttpRequest();
     } else {
         // code for IE6, IE5
         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
     xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("comments").innerHTML = this.responseText;
         }
     };
     xmlhttp.open("GET","comment.php?commentpost="+str,true);
     xmlhttp.send();
 }
}

$('#input').submit(function(e) {
e.preventDefault();

  var commentpost = document.getElementById("commentpost").value;
  document.getElementById("commentpost").value = "";
  comment(commentpost);
});
