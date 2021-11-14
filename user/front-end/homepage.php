<?php
session_start();
include('navbar.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Πρέπει πρώτα να συνδεθείτε!";
    header('location: login_page.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login_page.php");
}
?>
<?php include('footer.html'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Αρχική σελίδα</title>
</head>
<body>

<div class="content">
    <div style="text-align: center;">
        <span style="display: inline-block; width: 300px; vertical-align: top;">
            <button id="myButton" class='btn btn-primary' style="width: 250px;"> Αλλαγή ονόματος χρήστη</button>
            <br>
            <br>
            <button id="myButton_2" class='btn btn-primary' style="width: 250px;"> Αλλαγή κωδικού πρόσβασης</button>
        </span>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "username_update.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("myButton_2").onclick = function () {
        location.href = "password_update.php";
    };
</script>
</body>
</html>