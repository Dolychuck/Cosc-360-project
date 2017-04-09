function search(str) {
 if (str == "") {
     document.getElementById("leftside").innerHTML = "";
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
             document.getElementById("leftside").innerHTML = this.responseText;
         }
     };
     xmlhttp.open("GET","search.php?textsearch="+str,true);
     xmlhttp.send();
 }
}

$('#search').submit(function(e) {
e.preventDefault();

  var commentpost = document.getElementById("textsearch").value;
  search(commentpost);
});
