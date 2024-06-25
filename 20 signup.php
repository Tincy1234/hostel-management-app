<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIGNUP PAGE</title>
</head>
<body>
    <h1>Hostel Room Allocation System</h1>
    <h2>Sign Up Here</h2>
    <form action="includes/signup.inc.php" method="POST">
        <!-- Student Roll Number Input -->
        <div class=" w3l-form-group">
            <label>Student Roll No</label>
            <input type="text" class="form-control" name="student_roll_no" placeholder="Roll No" required="required" />
        </div>
        
        <!-- First Name Input -->
        <div class=" w3l-form-group">
            <label>First Name</label>
            <div class="group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" name="student_fname" placeholder="First Name" required="required" />
            </div>
        </div>
        
        <!-- Last Name Input -->
        <div class=" w3l-form-group">
            <label>Last Name</label>
            <div class="group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" name="student_lname" placeholder="Last Name" required="required" />
            </div>
        </div>
        
        <!-- Mobile Number Input -->
        <div class=" w3l-form-group">
            <label>Mobile No</label>
            <div class="group">
                <i class="fas fa-phone"></i>
                <input type="text" class="form-control" name="mobile_no" placeholder="Mobile No : 7394746738" required="required" />
            </div>
        </div>
        
        <!-- Department Input -->
        <div class=" w3l-form-group">
            <label>Department</label>
            <div class="group">
                <i class="fas fa-graduation-cap"></i>
                <input type="text" class="form-control" name="department" placeholder="Department" required="required" />
            </div>
        </div>
        
        <!-- Year of Study Input -->
        <div class=" w3l-form-group">
            <label>Year of Study</label>
            <div class="group">
                <i class="fas fa-calendar"></i>
                <input type="text" class="form-control" name="year_of_study" placeholder="Year of Study" required="required" />
            </div>
        </div>
        
        <!-- Password Input -->
        <div class=" w3l-form-group">
            <label>Password:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" class="form-control" name="pwd" placeholder="Password" required="required" />
            </div>
        </div>
        
        <!-- Confirm Password Input -->
        <div class=" w3l-form-group">
            <label>Confirm Password:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" class="form-control" name="confirmpwd" placeholder="Confirm Password" required="required" />
            </div>
        </div>
        
        <!-- Sign Up Button -->
        <button type="submit" name="signup-submit">Sign Up</button>
    </form>
    
    <!-- Login Link -->
    <p class=" w3l-register-p">Already a member?<a href="index.php" class="register"> Login</a></p>
</body>
</html>
