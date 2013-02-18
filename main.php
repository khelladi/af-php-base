<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<html>
<head>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
 <script type="text/javascript" src="md5-min.js"></script>
 <script>
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
	  
	  function cry(p) {
	  document.getElementById('pwd').value = MD5(p);
	  //p=MD5(p);
	  //alert(document.getElementById('pwd').value);
	  //alert(p);
	  } 
	  
    </script>

</head>
<body onload="initialize()">

<?php 
if(isset($_SESSION['id1']) && isset($_GET['r']) && $_SESSION['id1']===$_GET['r']) {
echo 'You are connected Num : ',$_SESSION['iduser'];
//echo '<a href=\'\' onClick=\'deconnect()\'> Deconnect</a>';
echo "<form method='post' action='deconnect.php'>
  <input type='submit' value='Se dconnecter!' /><br>
 </form>";
 
echo '<br>';
echo '<a href=\'add.php?r=',$_SESSION['id1'],'\'> Add an offer of a car pooling</a>';
echo '<br>';
echo '<a href=\'look.php?r=',$_SESSION['id1'],'\'> Look for an offer of a car pooling</a>';
echo '<br>';

}
else{
echo "<form method='post' action='auth.php'>
 User : <input type='text' id='user' name='u' size='32'/><br>
 Password : <input type='password' id='pwd' name='p' size='32'/><br>
  <input type='submit' value='submit!' onClick='cry(this.form.p.value);'/><br>
 </form>";


echo "<form method='post' action='"; echo $_SERVER['PHP_SELF'];
echo "'>
    <p>
        <!-- Image dynamique -->
        <img src='captcha.php' alt='Captcha' id='captcha' />
 
        <!-- (JavaScript) Recharge l'image car elle n'existe pas dans le cache du navigateur, grâce à l'id généré  -->
        <img src='reload.png' alt='Recharger l'image' title='Recharger l'image' style='cursor:pointer;position:relative;top:-7px;' 
		onclick='document.images.captcha.src=\"captcha.php?id=\"+Math.round(Math.random(0)*1000)' />
    </p>
    <p>";
        
        $class = 'empty';
        // Si le formulaire a été soumis
        if(isset($_REQUEST['submit'])) {
            // Si l'utilisateur a bien entré un code
            if (!empty($_REQUEST['code'])) {
                // Conversion en majuscules
                $code = strtoupper($_REQUEST['code']);
 
                // Cryptage et comparaison avec la valeur stockée dans $_SESSION['captcha']
                if( md5($code) == $_SESSION['captcha'] ) {
                    $class = 'correct'; // Le code est bon
					header('Location: lookpublic.php');     
					echo '<h3>captach success</h3>';
                } else {
                    $class = 'incorrect'; // Le code est erroné
					echo '<h3>captach NOT success</h3>';
                }
            } else {
                $class = 'incorrect'; // Aucun code
				echo '<h3>captach VIDE</h3>';
            }
        }
        echo '<input name=\'code\' class=\'' . $class . '\' type=\'text\' />';
        
        echo "<br><input type='submit' name='submit' value='Look for an offer of a car pooling!' />
    </p>
</form>";
}
?>
</body>
</html>
