<?php
    
    $bool = 0;
    session_start();
    $sid= $_SESSION['roll'];
    
     
     $dbusername = 'root';
        $dbpassword = '';
        $mysqli = new mysqli('localhost', 'root', '','library');
    $r = $mysqli->query("select * from books where bavailability=1;");
    
   /* while(
$res = $r->fetch_assoc()){
    
    echo $res['bname']." ".$res['accno']." ".$res['edition']." ".$res['author']." ".'<br />';
    echo $res['accno']. '<br />';
    echo $res['edition']. '<br />';
    echo $res['author'] . '<br />';
}*/
    
    if(isset($_GET['bacc']))
    {
        
        $bacc = $_GET['bacc'];

        /* check connection */
        if($mysqli->connect_errno){
            die('Unable to connect to database [' . $mysqli->connect_error . ']');
        }
        if($result = $mysqli->query("select accno,bavailability from books where accno= $bacc;")){
            $row = $result->fetch_assoc();
            if(mysqli_num_rows($result)>0 and $row['bavailability']==1){
                $insert_row = $mysqli->query("insert into issue(sid,accno,issuedate) values('".$sid."','".$bacc."',CURRENT_TIMESTAMP);");

                if($insert_row){
                    $mysqli->query("update books set bavailability=0 where accno=$bacc;");
                    $bool=1;    
                }
                else{
                    echo "Error inserting";
                    $bool=2;
    
                }
            }
            else{
                $bool = 3;
            }   
    
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
        .container{
            align-content: center;
        }

        #heading{
           margin-left: 33%;
       }
        .scrollit {
    overflow:scroll;
    height: 40%;
}
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
       <div class="container">
        <?php
            if($bool==1){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Successful!</strong> Book issued successful.
</div>';
            }    
            if($bool==3){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Oh snap!</strong> Book doesnt exist.
</div>';
            }
           if($bool==0 or $bool==1 or $bool==2){
               echo '<div class="scrollit">';
               echo '<table class="table table-striped">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Book Name</th>
              <th>Book Account Number</th>    
              <th>Author</th>
              <th>Edition</th>
            </tr>
          </thead>';
          echo '<tbody>';
            
                while($res = $r->fetch_assoc()) {
                    $i=1;
                echo '<tr>
                  <th scope="row">'.$i.'</th>
                  <td>'.$res["bname"].'</td>
                  <td>'.$res["accno"].'</td>
                  <td>'.$res["author"].'</td>
                  <td>'.$res["edition"].'</td>    
                </tr>';
                    $i=$i+1;
              }
            
    
          echo '</tbody>
        </table>
       </div>';
           }
           
        ?>
        <hr class="my-4">   
        <h1 id="heading">Issue a Book </h1>
  	
		   <form class="form-horizontal " action="issue.php" method="get">
			  <div class="form-group">
			    <label for="inputaccountnumber" class="col-sm-2 control-label" >Account Number</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="baccountno" name="bacc" placeholder="Enter the book account number">
			    </div>
			  </div>
			 
                          
                          
			  <div class="form-group text-center">
			    <div class="col-sm-offset-2 col-sm-10" id="btnRegister">
			      <button type="submit" class="btn btn-primary">Issue</button>
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



