<?php
$Gender = $_POST['Gender'];
$email = $_POST['email'];
$Phone = $_POST['Phone'];
$First = $_POST['First'];
$Last = $_POST['Last'];
$Streetad1 = $_POST['Streetad1'];
$Streetad2 = $_POST['Streetad2'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zip = $_POST['Zip'];
$Birthdate = $_POST['Birthdate'];
$Last4SSN = $_POST['Last4SSN'];
$PayPlan = $_POST['PayPlan'];
$Goals = $_POST['Goals'];
$FinCircumstances = $_POST['FinCircumstances'];
$ExtraInfo = $_POST['ExtraInfo'];
$GoalSchool = $_POST['GoalSchool'];
$AdminStatus = $_POST['AdminStatus'];
$AnticipProg = $_POST['AnticipProg'];
$ProgCost = $_POST['ProgCost'];
$StartDate = $_POST['StartDate'];
$FirstPayDate = $_POST['FirstPayDate'];
$CurrentDate = $_POST['CurrentDate'];


 
 
 
if (!empty($Gender) || !empty($email) || !empty($Phone)||
    !empty($First)|| !empty($Last)|| !empty($Streetad1)|| !empty($Streetad2)|| !empty($City)|| !empty($State)|| !empty($Zip)
   || !empty($Birthdate)|| !empty($Last4SSN)|| !empty($PayPlan)|| !empty($Goals)|| !empty($FinCircumstances)|| !empty($ExtraInfo)|| !empty($GoalSchool)
   || !empty($AdminStatus)|| !empty($AnticipProg)|| !empty($ProgCost)|| !empty($StartDate)|| !empty($FirstPayDate)|| !empty($CurrentDate)) {
 $host = "localhost";
    $dbUsername = "lobo1";
    $dbPassword = "S217115";
    $dbname = "CommunityScholarship";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	 echo "Connect Error";
    } else {
     $SELECT = "SELECT email From CentralDatabase Where email = ? Limit 1";
     $INSERT = "INSERT Into CentralDatabase (First, Last, Streetad1, Streetad2, City, State, Zip, Phone, email, Birthdate, Gender, Last4SSN, 
	 PayPlan, Goals, FinCircumstances, ExtraInfo, GoalSchool, AdminStatus, AnticipProg,
     ProgCost, StartDate, FirstPayDate, CurrentDate) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
      $stmt->bind_param("ssssssiisssisssssssisss", $First, $Last, $Streetad1, $Streetad2, $City, $State, $Zip, $Phone, $email, $Birthdate, $Gender, $Last4SSN, 
	  $PayPlan, $Goals, $FinCircumstances, $ExtraInfo, $GoalSchool, $AdminStatus, $AnticipProg,
      $ProgCost, $StartDate, $FirstPayDate, $CurrentDate);
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
