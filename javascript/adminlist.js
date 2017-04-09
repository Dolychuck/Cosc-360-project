
function showUser(str) {
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
             document.getElementById("invalid").innerHTML = "";
             document.getElementById("results").innerHTML = this.responseText;
         }
     };
     xmlhttp.open("GET","adminSearch.php?"+str,true);
     xmlhttp.send();
 }
}

$('#input').submit(function(e) {
e.preventDefault();
var searchby = document.getElementById("searchby").value;
var adminsearch = document.getElementById("adminsearch").value;
var theme = document.getElementById("theme").value;
if(theme != "none" && searchby != "none" ) {
  document.getElementById("invalid").innerHTML = "Cannot search by theme and user at once";
} else if(searchby != "none" && adminsearch == "") {
  document.getElementById("invalid").innerHTML = "Cannot be empty";
} else if(theme == "none" && searchby == "none" && adminsearch == "" ){
  document.getElementById("invalid").innerHTML = "Must enter fields";
} else {
  showUser("theme="+theme+"&adminsearch="+adminsearch+"&searchby="+searchby)
}
});

function enable(str) {
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
             document.getElementById("results").innerHTML = this.responseText;
         }
     };
     xmlhttp.open("GET","enable.php?a="+str,true);
     xmlhttp.send();
 }
}

function deletePost(str) {
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
             document.getElementById("results").innerHTML = this.responseText;
         }
     };
     xmlhttp.open("GET","close.php?a="+str,true);
     xmlhttp.send();
 }
}
