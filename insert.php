<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['Gender'];
$email = $_POST['Email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['Phone'];
$First = $_POST['First'];
$Last = $_POST['Last'];
$Streetad1 = $_POST['Streetad1'];
$Streetad2 = $_POST['Streetad2'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zip = $_POST['Zip'];
$Birthdate = $_POST['Birthdate'];
$4digSSN = $_POST['4digSSN'];
$PayPlan = $_POST['PayPlan'];
$Goals = $_POST['Goals'];
$FinCircumstances = $_POST['FinCircumstances'];
$ExtraInfo = $_POST['ExtraInfo'];
$GoalSchool = $_POST['GoalSchool'];
$AdminStatus = $_POST['AdminStatus'];
$AnticipProg = $_POST['AnticipProg'];
$ProgCost = $_POST['ProgCost'];
$StartDate = $_POST['StartDate'];
$1PayDate = $_POST['1PayDate'];
$CurrentDate = $_POST['CurrentDate'];


 
 
 
if (!empty($username) || !empty($password) || !empty($Gender) || !empty($Email) || !empty($phoneCode) || !empty($Phone)||
    !empty($First)|| !empty($Last)|| !empty($Streetad1)|| !empty($Streetad2)|| !empty($City)|| !empty($State)|| !empty($Zip)
   || !empty($Birthdate)|| !empty($4digSSN)|| !empty($PayPlan)|| !empty($Goals)|| !empty($FinCircumstances)|| !empty($ExtraInfo)|| !empty($GoalSchool)
   || !empty($AdminStatus)|| !empty($AnticipProg)|| !empty($ProgCost)|| !empty($StartDate)|| !empty($1PayDate)|| !empty($CurrentDate)) {
 $host = "localhost";
    $dbUsername = "lobo1";
    $dbPassword = "S217115";
    $dbname = "CommunityScholarship";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From CentralDatabase Where email = ? Limit 1";
     $INSERT = "INSERT Into CentralDatabase (username, password, Gender, Email, phoneCode, Phone, First, Last, Streetad1, Streetad2,
     City, State, Zip, Birthdate, 4digSSN, PayPlan, Goals, FinCircumstances, ExtraInfo, GoalSchool, AdminStatus, AnticipProg,
     ProgCost, StartDate, 1PayDate, CurrentDate) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $password, $Gender, $Email, $phoneCode, $Phone, $First, $Last, $Streetad1, $Streetad2,
     $City, $State, $Zip, $Birthdate, $4digSSN, $PayPlan, $Goals, $FinCircumstances, $ExtraInfo, $GoalSchool, $AdminStatus, $AnticipProg,
     $ProgCost, $StartDate, $1PayDate, $CurrentDate);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already registered using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
