<?php
// Include the configuration file
require '../includes/config.inc.php';
// Check if the 'approved' button is clicked
if (isset($_POST['approved'])) {
    // Get the room ID and student ID from the form
    $room_id = $_POST['room_id'];
    $roll = $_POST['row_id'];

    // Update the room allocation status to 'vacated'
    $query3 = "UPDATE room SET Allocated = '0' WHERE Room_id = '$room_id'";
    $result3 = mysqli_query($conn, $query3);

    // Update the student record to set Hostel_id, Room_id, and Approval_status back to default values
    $query4 = "UPDATE Student SET Hostel_id = NULL, Room_id = NULL, Approval_status = '0' WHERE Student_id = '$roll'";
    $result4 = mysqli_query($conn, $query4);

    // Delete the student's vacate request
    $del = "DELETE FROM vacate WHERE Student_id= '$roll'";
    $rdel = mysqli_query($conn, $del);

    // Update the hostel's student count and available rooms count
    $appUpdateQuery2 = "UPDATE hostel SET No_of_students= No_of_students - 1 WHERE Hostel_id = '".$_POST['hstl_id']."'";
    $appUpdateResult2 = mysqli_query($conn, $appUpdateQuery2);
    $appUpdateQuery3 = "UPDATE hostel SET current_no_of_rooms = current_no_of_rooms + 1 WHERE Hostel_id = '".$_POST['hstl_id']."'";
    $appUpdateResult3 = mysqli_query($conn, $appUpdateQuery3);

    // Display a success message if the operation is successful
    if ($result4) {
        echo "<script type='text/javascript'>alert('Vacated Successfully')</script>";
    }
}
?>
<table class="styled-table">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Year</th>
        <th>Hostel</th>
        <th>Action</th>
    </tr>

    <?php
    // Select students who have requested to vacate
    $selectQuery = "SELECT * FROM student WHERE Student_id IN (SELECT Student_id FROM vacate)";
    $sql = mysqli_query($conn, $selectQuery);
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        while ($row = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td><?php echo $row['Student_id']; ?></td>
                <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
                <td><?php echo $row['Mob_no']; ?></td>
                <td><?php echo $row['Year_of_study']; ?></td>
                <td>
                    <?php 
                    // Display hostel name based on Hostel_id
                    if ($row['Hostel_id'] == 1)
                        echo "A";
                    elseif ($row['Hostel_id'] == 2)
                        echo "B";
                    elseif ($row['Hostel_id'] == 3)
                        echo "C";
                    elseif ($row['Hostel_id'] == 4)
                        echo "D";
                    ?>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="row_id" value="<?= $row['Student_id']; ?>" />
                        <input type="hidden" name="room_id" value="<?= $row['Room_id']; ?>" />
                        <input type="hidden" name="hstl_id" value="<?= $row['Hostel_id']; ?>" />
                        <button type="submit" name="approved">Approve</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td><?php
                echo "No Record";
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
