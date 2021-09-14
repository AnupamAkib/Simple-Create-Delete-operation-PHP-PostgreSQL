<?php
class student{
  private $name, $id, $section, $email, $phone, $found;
  function __construct($id){
    include "connection.php";
    $this -> id = $id;
    $sql = "SELECT * from student_info where id = '$id'";
    $query_run = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query_run)){
      $this -> found = true;
      while($row = mysqli_fetch_array($query_run)){
        $this -> name = $row['name'];
        $this -> section = $row['section'];
        $this -> email = $row['email'];
        $this -> phone = $row['phone'];
      }
    }
    else{
      $this -> found = false;
    }
  }
  function getID(){
    return nl2br(htmlentities($this -> id));
  }
  function getName(){
    return nl2br(htmlentities(ucwords($this -> name)));
  }
  function getSection(){
    return $this -> section;
  }
  function getEmail(){
    return nl2br(htmlentities($this -> email));
  }
  function getPhone(){
    return nl2br(htmlentities($this -> phone));
  }

  function setName($name){
    return $this -> name = $name;
  }
  function setSection($section){
    return $this -> section = $section;
  }
  function setEmail($email){
    return $this -> email = $email;
  }
  function setPhone($phone){
    return $this -> phone = $phone;
  }

  function isExist(){
    return $this -> found;
  }

  function insert(){
    include "connection.php";
    $_id = $this -> getID();
    $_name = $this -> getName();
    $_section = $this -> getSection();
    $_email = $this -> getEmail();
    $_phone = $this -> getPhone();
    $sql = "INSERT into student_info VALUES('$_id', '$_name', '$_section', '$_email', '$_phone');";
    $query_run = mysqli_query($connection, $sql);
  }

  function delete(){
    include "connection.php";
    $_id = $this -> getID();
    $sql = "DELETE from student_info where id='$_id'";
    $query_run = mysqli_query($connection, $sql);
  }

}

 ?>
