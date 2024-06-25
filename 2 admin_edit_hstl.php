<?php
// Include the configuration file
require '../includes/config.inc.php';
?>

<body>
<?php
// Check if 'id' is set in the URL (GET request)
if (isset($_GET['id'])) {
    $hostel_id = $_GET['id'];

    // Handle the form submission when 'submit' button is clicked
    if (isset($_POST['submit'])) {
        // Retrieve the updated values from the form
        $current_no_of_rooms = $_POST['current_no_of_rooms'];
        $no_of_rooms = $_POST['no_of_rooms'];
        $No_of_students = $_POST['No_of_students'];

        // Update the hostel details in the database
        $query = "UPDATE hostel SET current_no_of_rooms = '$current_no_of_rooms', No_of_rooms = '$no_of_rooms', No_of_students = '$No_of_students' WHERE Hostel_id = '$hostel_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script type='text/javascript'>alert('Hostel details updated successfully')</script>";
            echo "<script type='text/javascript'>window.location.href = 'admin_hostelDetails.php';</script>";
            exit; // Make sure to exit after redirection
        } else {
            echo "Error updating hostel details: " . mysqli_error($conn);
        }
    }

    // Fetch the existing hostel details from the database
    $query = "SELECT * FROM hostel WHERE Hostel_id = '$hostel_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
?>
    <div class="container">
        <div class="text">
            Update Hostel
        </div>
        <form method="post">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="Hostel_name" value="<?php echo "Hostel Name : " . $row['Hostel_name']; ?>" disabled="disabled">
                    <div class="underline"></div>
                </div>
                <div class="input-data">
                    <input type="text" name="No_of_students" value="<?php echo $row['No_of_students']; ?>">
                    <div class="underline"></div>
                    <label for="">No. of Students :</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="no_of_rooms" value="<?php echo $row['No_of_rooms']; ?>"><br>
                    <div class="underline"></div>
                    <label for="">No. of Rooms :</label>
                </div>
                <div class="input-data">
                    <input type="text" name="current_no_of_rooms" value="<?php echo $row['current_no_of_rooms']; ?>">
                    <div class="underline"></div>
                    <label for="">Current no. of Rooms :</label>
                </div>
            </div>
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" name="submit" value="Update">
                </div>
            </div>
        </form>
    </div>
<?php
} else {
    echo "Invalid request.";
}
?>
</body>
</html>
