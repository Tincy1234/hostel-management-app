<?php
// Include the configuration file
require 'includes/config.inc.php';
?>

<h2 class="heading text-capitalize mb-sm-5 mb-4"> Application Form </h2>
<form action="application_formB.php?id=<?php echo $_GET['id']?>" method="post">
    <input type="text" name="Name" placeholder="Name" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname']?>" required="" disabled="disabled">
    <!-- Other input fields here -->
    <input type="submit" name="submit" value="Click to Apply">
</form>

<?php
// Handle form submission
if(isset($_POST['submit'])){
    $roll = $_SESSION['roll'];
    $password = $_POST['pwd'];
    $hostel = $_GET['id'];
    
    // Check if the student has a room already
    $query_imp = "SELECT * FROM Student WHERE Student_id = '$roll'";
    $result_imp = mysqli_query($conn,$query_imp);
    $row_imp = mysqli_fetch_assoc($result_imp);
    $room_id = $row_imp['Room_id'];
    
    if(is_null($room_id)){
        // Check if the student has an existing application
        $query_imp2 = "SELECT * FROM Application WHERE Student_id = '$roll'";
        $result_imp2 = mysqli_query($conn,$query_imp2);
        
        if(mysqli_num_rows($result_imp2)==0){
            // Verify the student's password
            $query = "SELECT * FROM Student WHERE Student_id = '$roll'";
            $result = mysqli_query($conn,$query);
            
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['Pwd']);
                
                if($pwdCheck == false){
                    echo "<script type='text/javascript'>alert('Incorrect Password!!')</script>";
                }
                else if($pwdCheck == true) {
                    // Fetch the hostel ID for the given hostel name
                    $query2 = "SELECT * FROM Hostel WHERE Hostel_name = '$hostel'";
                    $result2 = mysqli_query($conn,$query2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $hostel_id = $row2['Hostel_id'];
                    
                    // Insert the application and update student details
                    $query3 = "INSERT INTO Application (Student_id,Hostel_id) VALUES ('$roll','$hostel_id')";
                    $result3 = mysqli_query($conn,$query3);
                    $query4 = "UPDATE student SET Hostel_id = '$hostel_id', Approval_status = '3' WHERE Student_id = '$roll'";
                    $result4 = mysqli_query($conn,$query4);
                    
                    if($result3){
                        echo "<script type='text/javascript'>alert('Application sent successfully')</script>";
                    }
                }
            }
        }
        else{
            echo "<script type='text/javascript'>alert('You have Already applied for a Room')</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('You have Already been allotted a Room')</script>";
    }
}
?>
