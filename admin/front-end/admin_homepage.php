<?php
session_start();
include('navbar_admin.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Πρέπει πρώτα να συνδεθείτε!";
    header('location: ../../user/front-end/login_page.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: ../../user/front-end/login_page.php');
}

if ($_SESSION['admin'] == 0) {
    $_SESSION['msg'] = "Δεν έχετε δικαιώμα εισόδου!";
    header('location: ../../user/front-end/login_page.php');
}
?>
<?php include('footer.html'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Homepage</title>
    <style>
    #selector {
        position: center;
        width:46%;
    }
    </style>
</head>
<body>

<div style="text-align: center;">
        <img src="https://cdn.dribbble.com/users/44323/screenshots/10520067/1.gif" id="selector" />
</div>

</body>
</html>