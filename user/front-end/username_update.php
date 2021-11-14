<?php
include('../back-end/server.php');
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
    <title>Αλλαγή ονόματος χρήστη</title>
</head>
<body>
<div class='container mt-5'>
    <h1>Αλλαγή ονόματος χρήστη</h1>
    <p>Καταχωρίστε το νέο σας ονόμα χρήστη</p>
    <form method="post" action="username_update.php">
        <div class='form-group'>
            <input
                class='form-control'
                type='text'
                placeholder='Τρέχων όνομα χρήστη'
                name='old_username'
                required
            />
        </div><div class='form-group'>
            <input
                class='form-control'
                type='text'
                placeholder='Νέο όνομα χρήστη'
                name='username'
                required
            />
        </div>
        <button class='btn btn-primary' name="username_update" type='submit'>ΥΠΟΒΟΛΗ</button>
    </form>
</div>