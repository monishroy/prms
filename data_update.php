<?php
require ('connection.inc.php');
require ('functions.inc.php');

if(isset($_POST['update_student'])){
  
  $id = get_safe_value($con,$_POST['id']);
  $fname = get_safe_value($con, $_POST['fname']);
  $lname = get_safe_value($con, $_POST['lname']);
  $email = get_safe_value($con, $_POST['email']);
  $department = get_safe_value($con, $_POST['department']);
  $roll = get_safe_value($con, $_POST['roll']);
  $reg = get_safe_value($con, $_POST['reg']);
  $session = get_safe_value($con, $_POST['session']);
  $phone = get_safe_value($con, $_POST['phone']);
  $company = get_safe_value($con, $_POST['company']);

  $result = mysqli_query($con, "UPDATE `students` SET `fname`='$fname',`lname`='$lname',`email`='$email',`phone`='$phone',`roll`='$roll',`registration`='$reg',`session`='$session',`department`='$department',`company`='$company' WHERE `id` = '$id'");
  if($result){
    $_SESSION['student-success'] = "Update Successfully";
    header('location: students.php');
    exit(0);
  }else{
    $_SESSION['student-error'] = "Something is Worng";
    header('location: students.php');
    exit(0);
  }
}

//Update Department
if(isset($_POST['update_department'])){
  $department_name = get_safe_value($con,$_POST['department_name']);
  $id = get_safe_value($con,$_POST['id']);

  $result = mysqli_query($con, "UPDATE `department` SET `name`='$department_name' WHERE `id` = '$id'");
  if($result){
    $_SESSION['department-success'] = "Update Successfully";
    header('location: add_categories.php');
    exit(0);
  }else{
    $_SESSION['department-error'] = "Something is Worng";
    header('location: add_categories.php');
    exit(0);
  }
}

//Update Session
if(isset($_POST['update_session'])){
  $session_name = get_safe_value($con,$_POST['session_name']);
  $id = get_safe_value($con,$_POST['id']);

  $result = mysqli_query($con, "UPDATE `session` SET `name`='$session_name' WHERE `id` = '$id'");
  if($result){
    $_SESSION['session-success'] = "Update Successfully";
    header('location: add_categories.php');
    exit(0);
  }else{
    $_SESSION['session-error'] = "Something is Worng";
    header('location: add_categories.php');
    exit(0);
  }
}

//Update Company
if(isset($_POST['update_company'])){
  $company_name = get_safe_value($con,$_POST['company_name']);
  $id = get_safe_value($con,$_POST['id']);

  $result = mysqli_query($con, "UPDATE `company` SET `name`='$company_name' WHERE `id` = '$id'");
  if($result){
    $_SESSION['company-success'] = "Update Successfully";
    header('location: add_categories.php');
    exit(0);
  }else{
    $_SESSION['company-error'] = "Something is Worng";
    header('location: add_categories.php');
    exit(0);
  }
}

?>