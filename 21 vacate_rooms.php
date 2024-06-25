<?php
require 'includes/config.inc.php';
?>

<h2 class="heading text-capitalize mb-sm-5 mb-4"> Application Form </h2>
<form action="vacate_rooms.php" method="post">
    <input type="text" name="Name" placeholder="Name" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>" required="" disabled="disabled">
    <input type="text" name="roll_no" placeholder="Roll Number" value="<?php echo $_SESSION['roll']?>" required="" disabled="disabled">
    <input type="password" name="pwd" placeholder="Password" required="">
    <input type="submit" name="submit" value="Click to Apply">
</form>

<?php
if(isset($_POST['submit']))
{
    // Get user input
    $roll = $_SESSION['roll'];
    $password = $_POST['pwd'];

    // Check if the student exists
    $query = "SELECT * FROM Student WHERE Student_id = '$roll'";
    $result = mysqli_query($conn, $query);
    if($row = mysqli_fetch_assoc($result))
    {
        // Check if there is no existing vacate request
        $query2 = "SELECT * FROM vacate WHERE Student_id = '$roll'";
        $result2 = mysqli_query($conn, $query2);

        if(mysqli_num_rows($result2) == 0)
        {
            // Verify the password
            $pwdCheck = password_verify($password, $row['Pwd']);
            if($pwdCheck == false)
            {
                echo "<script type='text/javascript'>alert('Incorrect Password!!')</script>";
            }
            else if($pwdCheck == true && $row['Approval_status'] == '1') 
            {
                // Insert a vacate request
                $query3 = "INSERT INTO vacate (Student_id) VALUES ('$roll')";
                $result3 = mysqli_query($conn, $query3);
                if($result3)
                {
                    echo "<script type='text/javascript'>alert('Application sent successfully')</script>";
                }
            }
            else if($row['Approval_status'] == '0' || is_null($row['Approval_status']) || $row['Approval_status'] == '2' || $row['Approval_status'] == '3')
            {
                echo "<script type='text/javascript'>alert('You don\\'t have an Allocated Room')</script>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Error')</script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('You have Already applied for vacating the Room')</script>";
        }	
    }
}
?>
