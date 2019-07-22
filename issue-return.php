<?php
    session_start();
    $_SESSION['roll']=$_SESSION['roll'];
    $roll = $_SESSION['roll'];
    $dbusername = 'root';
    $dbpassword = '';
    $mysqli = new mysqli('localhost', 'root', '','library');
    /* check connection */
if($mysqli->connect_errno){
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}
    $query_sfine = "select * from student where sid=$roll;";
    $sres = $mysqli->query($query_sfine);
    $sr = $sres->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style type = "text/css">
    	#btnRegister{
            margin-left: 400px;
         }

        #heading{
           margin-left: 30%;
       }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
                  <div class="container">
			<div class="row">
  <div class="col-sm-4">
    <form action="issue.php" >  
    <div class="card">
       <img class="card-img-top" src="Bodmin-library-008.jpg" alt="Card image cap">
      <div class="card-block">
        <h3 class="card-title">Issue a Book</h3>
        <p class="card-text">Issue book------------Issue book</p>
        <a href="issue.php" class="btn btn-primary">Issue</a>
      </div>
    </div>
    </form>
  </div>

  <div class="col-sm-4">
    <form action="renew.php" >  
    <div class="card">
       <img class="card-img-top" src="renew.png" alt="Card image cap">
      <div class="card-block">
        <h3 class="card-title">Renew a book</h3>
        <p class="card-text">Renew book---------Renew book</p>
        <a href="renew.php" class="btn btn-primary">Renew</a>
      </div>
    </div>
    </form>    
  </div>
  <div class="col-sm-4">
    <form action="return.php" >
    <div class="card">
       <img class="card-img-top" src="5528462_please_return_your_library_books.jpg" alt="Card image cap">
      <div class="card-block">
        <h3 class="card-title">Return a Book</h3>
        <p class="card-text">Return Book---------Return Book</p>
        <a href="return.php" class="btn btn-primary">Return</a>
      </div>
    </div>
    </form>     
  </div>
</div>
                      <hr class="my-4"> 
                      <?php
                      $query1 = "select accno,fine from issue where sid=$roll;";
                      $r1=$mysqli->query($query1);
                      
                      if ($r1->num_rows > 0) {
                      echo '<div class="scrollit">';
               echo '<table class="table table-striped">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Book Name</th>
              <th>Book Account Number</th>    
              <th>Fine</th>
            </tr>
          </thead>';
          echo '<tbody>';
            
                while($res1 = $r1->fetch_assoc()){
                    $acc = $res1["accno"];
                    $query2="select bname from books where accno=$acc;";
                    $r2 = $mysqli->query($query2);
                    $i=1;
                    $res2 = $r2->fetch_assoc();
                echo '<tr>
                  <th class="bg-success" scope="row">'.$i.'</th>
                  <td class="bg-success">'.$res2["bname"].'</td>
                  <td class="bg-success">'.$res1["accno"].'</td>
                  <td class="bg-success">'.$res1["fine"].'</td>   
                </tr>';
                    $i=$i+1;}
                
            
    
          echo '</tbody>
        </table>
       </div>';}
                      ?>
                      <hr class="my-4"> 
                      <table class="table table-striped">
          <thead class="thead-inverse">
            <tr>
              <th>Student Roll Number</th>
              <th>Student Name</th>
              <th>Total fine</th>    
            </tr>
          </thead>
          <tbody>
                     <?php
                        echo '<tr>
                  <td class="bg-warning">'.$roll.'</td>
                  <td class="bg-warning">'.$sr["sname"].'</td>
                  <td class="bg-warning">'.$sr["fine"].'</td>  
                </tr>';
              
                    ?>
                          
                          </tbody>         
                      </table>
                 </div>
		    <!-- jQuery first, then Tether, then Bootstrap JS. -->
		    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>



