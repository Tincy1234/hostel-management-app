<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Room Allocation System</title>
</head>
<body>
    <h1>Hostel Room Allocation System</h1>
    <!-- Student Login Form -->
    <div class="w3l-login-form">
        <h2>Student Login</h2>
        <form action="includes/login.inc.php" method="POST">

            <!-- Student Roll Number Input -->
            <div class="w3l-form-group">
                <label>Student Roll No:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="student_roll_no" placeholder="Roll No" required="required" />
                </div>
            </div>

            <!-- Password Input -->
            <div class="w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" name="pwd" placeholder="Password" required="required" />
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" name="login-submit">Login</button>
        </form>

        <!-- Links for Admin Login and Sign Up -->
        <p class="w3l-register-p">Login as <a href="login-hostel_manager.php" class="register">Admin</a></p>
        <p class="w3l-register-p">Don't have an account? <a href="signup.php" class="register">Sign up</a></p>
    </div>
</body>
</html>
