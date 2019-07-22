<?php

$bool=0;
if(isset($_GET['lid']))
{
session_start();
$_SESSION['lid'] = $_GET['lid'];    
$lid = $_GET['lid'];
$dbusername = 'root';
$dbpassword = '';


$mysqli = new mysqli('localhost', 'root', '','library');
    
    
    
    /* check connection */
if($mysqli->connect_errno){
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}
    
    
if($result = $mysqli->query("select lid from librarian where lid= $lid;")){
    
    if(mysqli_num_rows($result)>0){
    print_r($result);    
    $bool=2;
    }
    else{
        $bool = 3;
    }
    
}
else{
    
    
}   
/*while(
$row = $result->fetch_assoc();){
    
    echo $row['sid'];
    echo $row['name'] . '<br />';
}
*/
    

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
      <style type="text/css">
  
          
          html { 
  background: url("clarisse-meyer-162874.jpg") no-repeat center center fixed; 
  webkit-background-size: cover;
  moz-background-size: cover;
  o-background-size: cover;
  background-size: cover;
}
          body{
              background: none;
          }  
         
          .container{
              text-align: center;
              margin-top: 8%;
              width: 60%;
          }
          h1{
              margin-bottom: 4%;
          }  
          a{
              margin-top: 1%;
          }
}        
      </style>
  </head>
  <body>
      <div class="container">
     
        
            <div class="jumbotron">
                <h1>Librarian Login Here</h1>
                <form >
              <div class="form-group row" >
                    <label for="lid" class="col-sm-2 col-form-label">Librarian Number</label>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter librarain number" name="lid">
                    </div>    
              </div>
                <button type="submit" class="btn btn-primary">Next</button>
                       
              </form>
                <a href="librarian-register.php" class="btn btn-link">
                      Dont have account?Register Here
                    </a> 
                <hr class="my-4">
                
                <div> <?php 
                    if($bool==3){
                        echo'<div class="alert alert-danger" role="alert">
               <strong>Oh snap!</strong>Librarian number doesnt exist.
                    </div>';    
                    }
                    if($bool==2){
                        echo'<form action="bookregister.php" method="post">
                        </form>' ;
                        header("Location: http://localhost/anits/Library/bookregister.php"); 
                          
                    }
                    ?>
                    </div> 
            </div>

              
        
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>