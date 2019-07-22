<?php
    $bool = 0;
    session_start();
    $sid= $_SESSION['roll'];
    $fine = 0; 
    if(isset($_GET['bacc']))
    {
        
        $bacc = $_GET['bacc'];
        $dbusername = 'root';
        $dbpassword = '';
        $mysqli = new mysqli('localhost', 'root', '','library');

        /* check connection */
        if($mysqli->connect_errno){
            die('Unable to connect to database [' . $mysqli->connect_error . ']');
        }
        
        $renew_query = "update issue set issuedate = CURRENT_TIMESTAMP where accno=$bacc;";
        $query = "select sid from issue where accno = $bacc;";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        if($row['sid']==$sid){
            date_default_timezone_set('Asia/Kolkata');
            $time_query = "select issuedate from issue where accno = $bacc;";
            $result = $mysqli->query($time_query);
            $row = $result->fetch_assoc();
            $idate =$row['issuedate'];
   
            $date1Timestamp = strtotime($idate);
            $now = time();
 
            //Calculate the difference.
            $difference = $now - $date1Timestamp;
 
            //Convert seconds into days.
            $days = floor($difference / (60*60*24) );
            //fine
             $fine_query = "select fine from issue where accno=$bacc;";
            $r1 = $mysqli->query($fine_query);
            $r2 = $r1->fetch_assoc();
            $fine = $r2['fine'];  
            if($days>14){
             
            $fine = $fine + $days-14;
            $update_fine = "update issue set fine=$fine where accno=$bacc;";
            $mysqli->query($update_fine);  
            $fine_student = "select fine from student where sid=$sid;";
            $sres = $mysqli->query($fine_student);
            $sr = $sres->fetch_assoc();
            $sfine = $sr['fine'];  
            $sfine = $sfine + $days-14;
            $update_sfine = "update student set fine=$sfine where sid=$sid;";
            $mysqli->query($update_sfine); 
            $mysqli->query($renew_query);
            }
            
            $bool=1;
        }
        else{
            $bool=2;
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style type = "text/css">
    	

        #heading{
           margin-left: 26%;
       }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
        <div class="container">
        <?php
            if($bool==1){
            echo '<div class="alert alert-success fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Successful!</strong> Book renewed successfully.<strong>Your fine is: '.$fine.'</strong>
</div>';}
            if($bool==2){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Error!</strong> Book couldnt be renewed.
</div>';
            }
        ?>    
        <h1 id="heading">Renew an existing book </h1>
		   <form class="form-horizontal">
			  <div class="form-group">
			    <label for="inputaccountnumber" class="col-sm-2 control-label" >Account Number</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="baccountno" name="bacc" placeholder="Enter the book account number">
			    </div>
			  </div>
			 
                          
                          
			  <div class="form-group text-center">
			    <div class="col-sm-offset-2 col-sm-10" id="btnRegister">
			      <button type="submit" class="btn btn-primary">Renew</button>
                    <a class="btn btn-primary" href="issue-return.php" role="button">Back</a>
			    </div>
			  </div>
			</form>

         </div>
		    <!-- jQuery first, then Tether, then Bootstrap JS. -->
		    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>



