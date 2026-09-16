<?php
include_once("../../../database.php");

$where = '';

if(isset($_GET['username'])){
  $username = $_GET['username'];
  $where .= " AND username = '$username'";
}

if(isset($_GET['email'])){
  $email = $_GET['email'];
  $where .= " AND email like '$email%'";
}

if(isset($_GET['first_name'])){
  $first_name = $_GET['first_name'];
  $where .= " AND first_name like '$first_name%'";
}

if(isset($_GET['last_name'])){
  $last_name = $_GET['last_name'];
  $where .= " AND last_name like '$last_name%'";
}

if(isset($_GET['phone_number'])){
  $phone_number = $_GET['phone_number'];
  $where .= " AND phone_number like '$phone_number%'";
}


if(isset($_GET['hobbies'])){
  $hobbies = $_GET['hobbies'];
  $where .= " AND hobbies like '$hobbies%'";
}



$users_query = "SELECT username, email, first_name, last_name,
                       phone_number, hobbies
                FROM users
                WHERE 1=1 $where
                ORDER BY username
                ";

$users_result = mysqli_query($conn,$users_query);

$users_data = mysqli_fetch_all($users_result);

if($users_data){
  json_response('200', 'OK', $users_data);
}else{
  json_response('404', 'data not found', NULL);
}


function json_response($status, $message, $data){
  header('HTTP/1.1 ' . $message);
  $response['status'] = $status;
  $response['message'] = $message;
  $response['data'] = $data;

  echo json_encode($response);

}
