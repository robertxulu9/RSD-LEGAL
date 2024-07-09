<?php
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

if(!empty($gender) || !empty($fname) || !empty($lname) || !empty($password) || !empty($position) || !empty($email) ||
 !empty($address) || !empty($addinfo) || !empty($zipcode) || !empty($city) || !empty($country) || !empty($number)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "legal";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }else{
        $SELECT =   "SELECT email From users Where email = ? Limit 1";
        $INSERT = "INSERT Into users 
        (fname, lname, gender, position, email, password, address, additional, zipcode,city,country, number)
        Values (?,?,?,?,?,?,?,?,?,?,?,?)";

        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt ->bind_param("s", $email);
        $stmt->execute();
     //   $stmt->bind_result();
        $stmt ->store_result();
        $rnum = $stmt->num_rows;

        if($rnum == 0){
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssssissi", $fname, $lname, $gender, $position, $email, $password, $address, $additional, $zipcode,$city,$country, $number);
            $stmt->execute();
            echo "New record inserted successfullty";
        }else{
            echo "email already registered";
        }
        $stmt->close();
        $conn->close();
    }
    echo "All fields are required";
    die();
 }
?>