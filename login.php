<?php
$Emailname = $_POST['Emailname'];
$Password = $_POST['Password'];



if (!empty($Emailname) || !empty($Password))
{

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "Imran123";
    $dbname = "muscle max";

    //create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
    $SELECT = "SELECT Emailname From login  Where Emailname = ? Limit 1";
    $INSERT = "INSERT Into login ( Emailname, Password )values(?,?)";
  
  //Prepare statement
       $stmt = $conn->prepare($SELECT);
       $stmt->bind_param("s", $Emailname);
       $stmt->execute();
       $stmt->bind_result($Emailname);
       $stmt->store_result();
       $rnum = $stmt->num_rows;
  
       //checking Emailname
        if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ss", $Emailname,$Password );
        $stmt->execute();
        echo "<script>alert('New record inserted sucessfully');</script>";
       } else {
        echo "<script>alert('Someone already register using this email');</script>";
       }
       $stmt->close();
       $conn->close();
      }
}else{
    echo "All field are required";
 die();
}

?>