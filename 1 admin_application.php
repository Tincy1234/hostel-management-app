<?php
// Include the configuration file
require '../includes/config.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
</head>
<body>
<div>
<?php
// Functionality: Approve student's hostel application
if (isset($_POST['approved'])) {
    $query2 = "SELECT * FROM room WHERE Hostel_id = '" . $_POST['hstl_id'] . "'";
    $result2 = mysqli_query($conn, $query2);
    $row1 = mysqli_num_rows($result2);
    $flag = 0;
    while ($row2 = mysqli_fetch_assoc($result2)) {
        if ($row2['Allocated'] == 0) {
            $all_id = $row2['Room_id'];
            // Update student's approval status and allocated room
            $appUpdateQuery = "UPDATE student SET Approval_status= '1' , Room_id = '$all_id'  WHERE Student_id='" . $_POST['row_id'] . "'";
            $appUpdateResult = mysqli_query($conn, $appUpdateQuery);
            // Mark the room as allocated
            $appUpdateQuery1 = "UPDATE room SET Allocated= '1' WHERE Room_id='$all_id'";
            $appUpdateResult1 = mysqli_query($conn, $appUpdateQuery1);
            // Update the number of students in the hostel
            $appUpdateQuery2 = "UPDATE hostel SET No_of_students= No_of_students + 1 WHERE Hostel_id = '" . $_POST['hstl_id'] . "'";
            $appUpdateResult2 = mysqli_query($conn, $appUpdateQuery2);
            // Update the current number of available rooms in the hostel
            $appUpdateQuery3 = "UPDATE hostel SET current_no_of_rooms = No_of_rooms - No_of_students WHERE Hostel_id = '" . $_POST['hstl_id'] . "'";
            $appUpdateResult3 = mysqli_query($conn, $appUpdateQuery3);
            // Delete the application after allocation
            $del = "DELETE FROM application WHERE Student_id='" . $_POST['row_id'] . "'";
            $rdel = mysqli_query($conn, $del);
            $flag = 1;
            if ($rdel) {
                echo "<script type='text/javascript'>alert('Alloted Successfully')</script>";
                echo "<script type='text/javascript'>window.location.href = 'admin_application.php';</script>";
                exit; //
            }
        }
    }

    if ($flag == 0) {
        // If no available rooms, find the maximum room number and try to allocate the student to the next room if there's space.
        $query10 = "SELECT MAX(Room_No) AS max_room FROM room WHERE  Hostel_id = '" . $_POST['hstl_id'] . "'";
        $result10 = mysqli_query($conn, $query10);
        $result10f = mysqli_fetch_assoc($result10);
        $maxRoomNo = $result10f['max_room'];
        $query11 = "SELECT * FROM hostel WHERE  Hostel_id = '" . $_POST['hstl_id'] . "'";
        $result11 = mysqli_query($conn, $query11);
        $result11f = mysqli_fetch_assoc($result11);
        $noOfRooms = $result11f['No_of_rooms'];
        if ($maxRoomNo < $noOfRooms) {
            // Insert a new room for the student
            $query12 = "INSERT INTO room (Hostel_id, Room_No) VALUES ('" . $_POST['hstl_id'] . "', " . ($maxRoomNo + 1) . ")";
            $result12 = mysqli_query($conn, $query12);
            $maxRoomNo1 = $maxRoomNo + 1;
            $query13 = "SELECT * FROM room WHERE  Room_id = $maxRoomNo1 ";
            $result13 = mysqli_query($conn, $query13);
            $row5 = mysqli_fetch_assoc($result13);
            $all_id = $row5['Room_id'];
            // Update student's approval status and allocated room
            $appUpdateQuery = "UPDATE student SET Approval_status= '1' , Room_id = '$all_id'  WHERE Student_id='" . $_POST['row_id'] . "'";
            $appUpdateResult = mysqli_query($conn, $appUpdateQuery);
            // Mark the room as allocated
            $appUpdateQuery1 = "UPDATE room SET Allocated= '1' WHERE Room_id='$all_id'";
            $appUpdateResult1 = mysqli_query($conn, $appUpdateQuery1);
            // Update the number of students in the hostel
            $appUpdateQuery2 = "UPDATE hostel SET No_of_students= No_of_students + 1 WHERE Hostel_id = '" . $_POST['hstl_id'] . "'";
            $appUpdateResult2 = mysqli_query($conn, $appUpdateQuery2);
            // Update the current number of available rooms in the hostel
            $appUpdateQuery3 = "UPDATE hostel SET current_no_of_rooms = No_of_rooms - No_of_students WHERE Hostel_id = '" . $_POST['hstl_id'] . "'";
            $appUpdateResult3 = mysqli_query($conn, $appUpdateQuery3);
            // Delete the application after allocation
            $del = "DELETE FROM application WHERE Student_id='" . $_POST['row_id'] . "'";
            $rdel = mysqli_query($conn, $del);
            if ($rdel) {
                echo "<script type='text/javascript'>alert('Alloted Successfully')</script>";
                echo "<script type='text/javascript'>window.location.href = 'admin_application.php';</script>";
                exit;
            }
        } else {
            echo "<script type='text/javascript'>alert('Rooms not available')</script>";
            echo "<script type='text/javascript'>window.location.href = 'admin_application.php';</script>";
            exit();
        }
    }
}

// Functionality: Reject student's hostel application
if (isset($_POST['rejected'])) {
    // Update student's approval status to '2' (Rejected)
    $rejUpdateQuery = "UPDATE student SET Approval_status= '2' WHERE Student_id='" . $_POST['row_id'] . "'";
    $rejUpdateResult = mysqli_query($conn, $rejUpdateQuery);
    // Delete the application after rejection
    $del4 = "DELETE FROM application WHERE Student_id='" . $_POST['row_id'] . "'";
    $rdel4 = mysqli_query($conn, $del4);
    if ($rdel4) {
        echo "<script type='text/javascript'>alert('Application Rejected Successfully')</script>";
        echo "<script type='text/javascript'>window.location.href = 'admin_application.php';</script>";
        exit;
    }
}

// Functionality: Display a table of students with pending applications
$selectQuery = "SELECT * FROM student WHERE Student_id in(select Student_id from application )";
$sql = mysqli_query($conn, $selectQuery);
$count = mysqli_num_rows($sql);
$selectQueryn = "SELECT * FROM application";
$sqln = mysqli_query($conn, $selectQueryn);
if ($count > 0) {
    while ($row = mysqli_fetch_array($sql)) {
?>
        <tr>
            <td><?php echo $row['Student_id']; ?></td>
            <td><?php echo $row['Fname'] . " " . $row['Lname']; ?></td>
            <td><?php echo $row['Mob_no']; ?></td>
            <td><?php echo $row['Year_of_study']; ?></td>
            <td>
                <?php
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
                    <input type="hidden" name="hstl_id" value="<?= $row['Hostel_id']; ?>" />
                    <button type="submit" name="approved">Approve</button>
                </form><br>
                <form method="post" action="">
                    <input type="hidden" name="row_id" value="<?= $row['Student_id']; ?>" />
                    <button type="submit" name="rejected">Reject</button>
                </form>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td>No Record</td></tr>";
}
?>
</table>
</div>
</body>
</html>
