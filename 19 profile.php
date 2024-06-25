<?php
// Include the configuration file
require 'includes/config.inc.php';
?>

<form id="formElem" name="formElem" action="#" method="post" class="w3_form w3l_form_fancy">
    <legend>Personal Info</legend>
    <div class="abt-agile">
        <div class="abt-agile-left">
        </div>
        <div class="abt-agile-right">

            <!-- Display Student Information -->
            <h3><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></h3>
            <h5>Student</h5>
            <ul class="address">
                <li>
                    <ul class="address-text">
                        <li><b>Roll No </b></li>
                        <li>: <?php echo $_SESSION['roll']; ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>PHONE </b></li>
                        <li>: <?php echo $_SESSION['mob_no']; ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>DEPT </b></li>
                        <li>: <?php echo $_SESSION['department']; ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>YEAR OF STUDY </b></li>
                        <li>: <?php echo $_SESSION['year_of_study']; ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>Application Status </b></li>
                        <li>: <?php 
                            // Retrieve Approval Status
                            $selectQuery = "SELECT * FROM student WHERE Student_id= '".$_SESSION['roll']."'";
                            $rejUpdateResult = mysqli_query($conn,$selectQuery);
                            $count = mysqli_num_rows($rejUpdateResult);          
                            $row = mysqli_fetch_array($rejUpdateResult);
                            $Approval_status =  $row['Approval_status'];
                            
                            // Determine and display the Application Status
                            if($Approval_status == 1)
                                echo "Alloted";
                            elseif($Approval_status == 2)
                                echo "Rejected";
                            elseif($Approval_status == 3)
                                echo "Pending";
                            elseif($Approval_status == 0)
                                echo "_____";
                        ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>Hostel </b></li>
                        <li>: <?php 
                            // Determine and display the Hostel
                            if($row['Hostel_id'] == 1 && $row['Approval_status'] == 1 )
                                echo "A";
                            elseif($row['Hostel_id'] == 2  && $row['Approval_status'] == 1)
                                echo "B";
                            elseif($row['Hostel_id'] == 3  && $row['Approval_status'] == 1)
                                echo "C";
                            elseif($row['Hostel_id'] == 4  && $row['Approval_status'] == 1) 
                                echo "D"; 
                            else
                                echo "____";
                        ?></li>
                    </ul>
                </li>
                <li>
                    <ul class="address-text">
                        <li><b>Room No </b></li>
                        <li>: <?php 
                            // Determine and display the Room Number if available
                            if($row['Room_id'] != NULL)
                            {
                                $selectQuery2 = "SELECT * FROM room WHERE Room_id= ".$row['Room_id']."";
                                $rejUpdateResult2 = mysqli_query($conn,$selectQuery2);
                                $row2 = mysqli_fetch_array($rejUpdateResult2);
                                echo $row2['Room_No'];
                            }
                            else
                            {
                                echo "____";
                            }        
                        ?></li>
                    </ul></li></ul>
</form>
