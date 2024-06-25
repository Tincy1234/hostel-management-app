<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Room Allocation System</title>
</head>
<body>
    <h1>Hostel Room Allocation System</h1>
    <!-- Admin Login Form -->
    <div class="w3l-login-form">
        <h2>Admin Login</h2>
        <form action="includes/login-hm.inc.php" method="POST">

            <!-- Username Input -->
            <div class="w3l-form-group">
                <label>Username:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required" />
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

        <!-- Link to Student Login Page -->
        <p class="w3l-register-p">Login as <a href="index.php" class="register">Student</a></p>
    </div>
</body>
</html>
