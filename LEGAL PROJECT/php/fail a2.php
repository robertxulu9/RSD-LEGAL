<?php

$connect = mysqli_connect("Localhost","root", "", "user");

if(isset($_POST['users'])){
    $gender = $_POST['gender'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$addinfo = $_POST['additional'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$country = $_POST['country'];
$number = $_POST['number'];

$query - "INSERT INTO users(fname, lname, gender, position, email, password, address, additional,
 zipcode,city,country, number)
VALUES('$fname', '$lname', '$gender', '$position', '$email', '$password', '$address', '$additional',
 '$zipcode','$city','$country', '$number')";

$result = mysqli_query($connect,$query);

if($result){
    echo "<script>alert('you have successfully registered')</script>";
}else{
    echo "script>alert('failed to register')</script>";
}
}



?>