<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$course = $_POST['course'];
if( !empty($username) || !empty($email) || !empty($password) || !empty($gender)
 || !empty($course) )
{
    $host = "localhost";
    $dbusername = "root";
     $dbpassword = "";
    $dbname = "signup";
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error())
    {
        die('connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT email From registration where email=? Limit 1";
        $INSERT = "INSERT into registration (username,email,password,gender,course) values(?,?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if($rnum==0)
        {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param ("ssiss", $username, $email, $password, $gender, $course);
            $stmt->execute();
            echo "new record insert successfully";
        }else{
        echo "already register using this email";
    }
    $stmt->close();
    $conn->close();
}
}
 else
{
    echo "all field are required";
    die();
}
?>
