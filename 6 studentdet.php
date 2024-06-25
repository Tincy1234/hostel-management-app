<?php
// Include the configuration file
require '../includes/config.inc.php';
?>

<!-- The following code displays student information for each hostel that has been approved. -->

<!-- Hostel A -->
<button class="accordion">Hostel A</button>
<div class="panel">
    <!-- Create a table to display student information for Hostel A -->
    <table class="styled-table">
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Year</th>
        </tr>
        <?php
        // Retrieve and display student information for Hostel A who have been approved
        $sql = "SELECT * FROM student WHERE Hostel_id = 1 AND Approval_status = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['Student_id']; ?></td>
                    <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
                    <td><?php echo $row['Mob_no']; ?></td>
                    <td><?php echo $row['Year_of_study']; ?></td>
                </tr>
                <?php
            }
        } else {
            // Display a message if there are no records for Hostel A
            ?>
            <tr>
                <td><?php echo "No Record"; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<!-- Repeat the above code for Hostel B, Hostel C, and Hostel D (similar functionality for different hostels) -->

<button class="accordion">Hostel B</button>
<div class="panel">
    <table class="styled-table">
        <!-- Code for Hostel B -->
    </table>
</div>

<button class="accordion">Hostel C</button>
<div class="panel">
    <table class="styled-table">
        <!-- Code for Hostel C -->
    </table>
</div>

<!-- Display student information for Hostel D -->
<table class="styled-table">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Year</th>
    </tr>
    <?php
    $sql = "SELECT * FROM student WHERE Hostel_id = 4 AND Approval_status = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['Student_id']; ?></td>
                <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
                <td><?php echo $row['Mob_no']; ?></td>
                <td><?php echo $row['Year_of_study']; ?></td>
            </tr>
            <?php
        }
    } else {
        // Display a message if there are no records for Hostel D
        ?>
        <tr>
            <td><?php echo "No Record"; ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
