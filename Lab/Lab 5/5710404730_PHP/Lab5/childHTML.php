<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" media="screen" href="child.css">
	<title>Children Form</title>
</head>
<body>
<form class = "Cform" id = "child">
<br>
<h1>Province Information</h1>
<br>
<br>
<!-- <p id = province></p> -->
<!-- <br> -->
<!-- <div id="div1"><h2>Province</h2></div>
<br>
<br>
<input type=button id="show" value = "show">
<br>
<br> -->

<?php
    $provinceGet = $_GET['province'];
    $filename = "$provinceGet.txt";
    $filename = iconv("utf-8", "tis-620", $filename );

    echo "$provinceGet</br></br>";

    $myfile = fopen("$filename", "r") or die("Unable to open file!");
    echo fgets($myfile);
    echo "</br></br>";
?>


</form>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	
	document.getElementById("provinceGet").innerHTML = localStorage.getItem('province');
	
	$(document).ready(function(){

    $("#show").click(function(){
    	var file  = localStorage.getItem('province');
        $("#div1").load(file+".txt", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                alert("External content loaded successfully!");
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
});

</script> -->
</body>
</html>