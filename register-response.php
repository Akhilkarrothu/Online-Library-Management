<?php
$bool=0;
if(isset($_POST['sid']) && isset($_POST['sname']) && isset($_POST['sdept'])){
    $sid = $_POST['sid'];
$sname = $_POST['sname'];

$sdept = $_POST['sdept'];
$dbusername = 'root';
$dbpassword = '';



$mysqli = new mysqli('localhost', 'root', '','library');

/* check connection */
if($mysqli->connect_errno){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$insert_row = $mysqli->query("insert into student(sid,sname,dept) values('".$sid."','".$sname."','".$sdept."');");

if($insert_row){
$bool=1;    
}
else{
    $bool=2;
    
}
$mysqli->close();
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
  </head>
  <body>
    <div class="container" >
    <?php
      if($bool==1){
          echo'<div class="alert alert-success" role="alert">
  <strong>Registered Sucessfully!</strong> Go to  <a href="login.php" class="alert-link">login page</a>.
</div>';
      }
      elseif($bool==2){
          echo'<div class="alert alert-danger" role="alert">
  <strong>Oh snap!</strong> <a href="studentregister.html" class="alert-link">Please try again.</a> 
</div>';
      }
      ?>
    </div>     

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

