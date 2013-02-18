<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<html>
<head>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
 
 <script>

var callback = function () {
     document.getElementById('res').innerHTML=this.responseText;
}
var call = function () {
 var xmlhttp = new XMLHttpRequest();
var url = "lookdb.php?r=<?php echo $_SESSION['id1'];?>&d="+document.getElementById('start').value+"&a="+document.getElementById('end').value;
           xmlhttp.open('GET',url, true);
	   xmlhttp.onreadystatechange = callback;
           xmlhttp.send(null);
           }

      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;

      function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var paris = new google.maps.LatLng(48.8566667, 2.3509871);
        var mapOptions = {
          zoom:7,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: paris
        }
        map = new google.maps.Map(document.getElementById('map_div'), mapOptions);
        directionsDisplay.setMap(map);
      }

      function calcRoute(dep,arr) {
	  //alert(dep);
	  //alert(arr);
        var start = dep;//document.getElementById('start').value;
        var end = arr;//document.getElementById('end').value;
		
        var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
      }
	  
    </script>
</head>
<body onload="initialize()">
<p>
<?php
// On démarre la session AVANT d'écrire du code HTML
if (isset($_SESSION['id1']) && isset($_GET['r']) && $_SESSION['id1']===$_GET['r']){

echo '<br><a href=\'main.php?r=',$_SESSION['id1'],'\'>back to Main!</a><br>';
 include 'lookInclude.html'; 
}
else {
echo 'you are not authorized to be here , please do log in';
header("Location: main.php");
}
?>
</p>
</body>
</html>
