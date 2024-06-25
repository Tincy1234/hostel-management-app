<?php
// Include the configuration file
require '../includes/config.inc.php';
?>

<?php
// Query to retrieve all hostel data
$query = "SELECT * FROM hostel";
$result = mysqli_query($conn, $query);

// Check if any data is returned
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' class='styled-table'>
            <tr>
                <th>Hostel ID</th>
                <th>Hostel Name</th>
                <th>Available Rooms</th>
                <th>No. of Rooms</th>
                <th>No. of Students</th>
                <th>Edit</th>
            </tr>";
    
    // Loop through the fetched data and display it in a table
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['Hostel_id'] . "</td>
                <td>" . $row['Hostel_name'] . "</td>
                <td>" . $row['current_no_of_rooms'] . "</td>
                <td>" . $row['No_of_rooms'] . "</td>
                <td>" . $row['No_of_students'] . "</td>
                <td><a href='admin_edit_hstl.php?id=" . $row['Hostel_id'] . "'>Update</a></td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No data found.";
}
?>
