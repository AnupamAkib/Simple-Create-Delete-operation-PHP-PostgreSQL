<?php
session_start();
include "student.php";
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Quiz 3 (191-35-2640)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  </head>
  <body>
    <div class="container" style="margin-top:30px">
      <?php
      if(isset($_SESSION['student_exist'])){
        echo "<div class='alert alert-danger'><strong>Sorry!</strong> This student is already added. Check the list below!</div>";
        unset($_SESSION['student_exist']);
      }
      if(isset($_SESSION['student_added'])){
        echo "<div class='alert alert-success'><strong>Success!</strong> Student successfully inserted.</div>";
        unset($_SESSION['student_added']);
      }
      if(isset($_SESSION['student_deleted'])){
        echo "<div class='alert alert-success'><strong>Success!</strong> Student has been deleted.</div>";
        unset($_SESSION['student_deleted']);
      }
       ?>
      <font size="6">All Students </font>
      <button type="button" name="button" class="btn btn-primary btn-lg" style="float:right" data-target="#myModal" data-toggle="modal">ADD Student</button><br><br>
      <div class="table-responsive fixed-table-body">
        <table class="table table-hover" style="font-size:large">
          <?php
            include "connection.php";
            $sql = "SELECT id FROM student_info order by id ASC";
            $query_run = pg_query($conn, $sql);
            ?>
            <tr><th>Student ID</th><th>Name</th><th>Section</th><th>Email</th><th>Phone</th><th>Action</th></tr>
            <?php
            $cnt = 0;
            while($row = pg_fetch_array($query_run)){
              $std = new student($row['id']);
              ?>
              <tr>
                <td><?php echo $std->getID() ?></td>
                <td><?php echo $std->getName() ?></td>
                <td><?php echo $std->getSection() ?></td>
                <td><?php echo $std->getEmail() ?></td>
                <td><?php echo $std->getPhone() ?></td>
                <td>
                  <form class="" action="" method="post">
                    <input type="submit" name="delete_student<?php echo $cnt ?>" value="DELETE" class="btn btn-danger"/>
                  </form>
                  <?php
                    $tmp = 'delete_student'.$cnt;
                    if(isset($_POST[$tmp])){
                      $std -> delete();
                      $_SESSION['student_deleted'] = true;
                      echo "<script>window.location.href='index.php'</script>";
                    }
                   ?>
                </td>
              </tr>
              <?php
              $cnt++;
            }
           ?>
        </table>
      </div>
    </div>

    <!-- Modal for adding students -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Add Student</h3>
          </div>
          <div class="modal-body">
            <form class="" action="" method="post">
              <label>Enter Name</label><br>
              <input type="text" name="name" placeholder="Enter student name" class="form-control"><br>
              <label>Enter ID</label><br>
              <input type="text" name="id" placeholder="Enter student ID" class="form-control"><br>
              <label>Enter Section</label><br>
              <select class="form-control" name="sec">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
              <label>Enter Email</label><br>
              <input type="email" name="email" placeholder="Enter email" class="form-control"><br>
              <label>Enter Phone</label><br>
              <input type="number" name="phn" placeholder="Enter phone number" class="form-control"><br>
              <input type="submit" name="submit" value="ADD data" class="btn btn-primary btn-lg"><br>
            </form>
            <?php
              if(isset($_POST['submit'])){
                $std = new student($_POST['id']);
                if($std -> isExist()){
                  $_SESSION['student_exist'] = true;
                  echo "<script>window.location.href='index.php'</script>";
                }
                else{
                  $std -> setName($_POST['name']);
                  $std -> setSection($_POST['sec']);
                  $std -> setEmail($_POST['email']);
                  $std -> setPhone($_POST['phn']);
                  $std -> insert();
                  $_SESSION['student_added'] = true;
                  echo "<script>window.location.href='index.php'</script>";
                }
              }
             ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>
