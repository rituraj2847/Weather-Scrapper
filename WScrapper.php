<?php
    $error = "";
    $weather = "";
    if($_GET['city']){
      $json = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=4f2d94d126d0d40fb449482fa90855e9");
        
       $obj = json_decode($json, true);
        if($obj['cod'] == "200"){
             $weather .= "<b>Weather Description:</b>  ".$obj['weather'][0]['description']."<br>";
	        $temp = $obj['main']['temp'] - 273;
	        $weather .= "<b>Temperature:</b>  ".$temp."&deg;C<br>";
	        $weather .= "<b>Wind speed:</b>  ".$obj['wind']['speed']." m/s<br><hr>";
	        $sunrise = date("H:i", $obj['sys']['sunrise']);
	        $sunset = date("H:i", $obj['sys']['sunset']);
	        $weather .= "<b>Sunrise:</b>  ".$sunrise." Hrs<br>";
	        $weather .= "<b>Sunset:</b>  ".$sunset." Hrs<br>";
        }
        else{
            $error .= "That city couldn't be found<br>";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow|Karla|Roboto+Mono" rel="stylesheet">
      <style type = "text/css">
      
    html { 
      background: url(back.png) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
         body{
             background: none;
              
          }
          .container{
              color:brown;
              text-align: center;
              margin-top: 200px;
              width: 450px;
          }
          #weather{
              margin-top: 20px;
              
          }
          .alert{
              padding: 0;
              width: 100%;
            background: rgba(240, 248, 245, 0.7);
              font-size: 150%;
              font-family: 'ARCHIVO NARROW',monospace;
          }
      </style>
  </head>
  <body>
  <div class="container">
    <h1>What's The Weather?</h1>
      <form>
      <div class="form-group">
        <label for="city">Enter the name of your city</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Eg. London, New York" value="<?php echo $_GET['city']; ?>">
      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      <div id="weather">
              <?php 
            if($weather){
                echo "<div class=\"alert alert-success\">"
      				  .$weather." </div>";
            }
            else if($error){
                echo "<div class=\"alert alert-danger\">
      				  <strong>".$error."</strong> </div>";
            }
            ?>  
       </div>
</div>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      
  </body>
</html>

