<?php
// Include the configuration file
require '../includes/config.inc.php';
?>

<fieldset class="step agileinfo w3ls_fancy_step">
    <legend>Personal Info</legend>
    <div class="abt-agile">
        <div class="abt-agile-right">
            <!-- Display user information -->
            <h3><?php echo $_SESSION['adm_fname']." ".$_SESSION['adm_lname']; ?></h3>
            <h5>Admin</h5>
            <ul class="address">
                <li>
                    <ul class="address-text">
                        <li><b>Username </b></li>
                        <li>: <?php echo $_SESSION['username']; ?></li>
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
                        <li><b>Email </b></li>
                        <li>: <?php echo $_SESSION['email']; ?></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</fieldset>
