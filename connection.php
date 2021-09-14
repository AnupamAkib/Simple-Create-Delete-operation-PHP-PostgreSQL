<?php
//$_server = "ec2-18-235-45-217.compute-1.amazonaws.com";
//$_username = "jritwupgvioezj";
//$_password = "0e9c39cdd7df700da0e1536caf670ebfb8586f47b46ee8fcd300eed8b964580c";
//$_database = "ddn865lov6362s";

//$connection = mysqli_connect($_server, $_username, $_password) or die("<script>msg('Could not connect to database', 'red')</script>");
//$db = mysqli_select_db($connection, $_database) or die("<script>msg('Could not connect to database', 'red')</script>");

//postgresql
$conn_string = "host=ec2-18-235-45-217.compute-1.amazonaws.com port=5432 dbname=ddn865lov6362s user=jritwupgvioezj password=0e9c39cdd7df700da0e1536caf670ebfb8586f47b46ee8fcd300eed8b964580c";
$conn = pg_connect($conn_string);


 ?>
