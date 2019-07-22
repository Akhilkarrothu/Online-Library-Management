<?php
    $dbusername = 'root';
    $dbpassword = '';

    $bool=0;
    $mysqli = new mysqli('localhost', 'root', '','library');
    
    
    
    /* check connection */
    if($mysqli->connect_errno){
        die('Unable to connect to database [' . $mysqli->connect_error . ']');
    }
    $query = "select * from books where bavailability =1;";

    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $bool=1;
        // output data of each row
        /*while($row = $result->fetch_assoc()) {
            echo $row["accno"]. "  " . $row["bname"]. " " . $row["author"]. " " .$row["edition"]. "<br>";
        }*/
    } else {
        $bool=2;
    }
    $mysqli->close();
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
      
      <?php
              if($bool==1){
      echo '<div class="container">
              <table class="table table-hover table-striped">
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
            
                while($row = $result->fetch_assoc()) {
                    $i=1;
                echo '<tr>
                  <th scope="row">'.$i.'</th>
                  <td>'.$row["bname"].'</td>
                  <td>'.$row["accno"].'</td>
                  <td>'.$row["author"].'</td>
                  <td>'.$row["edition"].'</td>    
                </tr>';
                    $i=$i+1;
              }
            
    
          echo '</tbody>
        </table>
      </div>';
              }
      else{
          echo '<div class = "container">';
          echo '<div class="alert alert-warning" role="alert">
  <strong>Warning!</strong>No books are available <a href="homepage.html" class="alert-link">go to homepage</a>.
</div>';
          echo '</div>';
      }
    ?>
      
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>