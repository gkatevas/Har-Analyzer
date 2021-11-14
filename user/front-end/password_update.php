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
    <title>Αλλαγή κωδικού πρόσβασης</title>
</head>
<body>
<div class='container mt-5'>
    <h1>Αλλαγή κωδικού πρόσβασης</h1>
    <p>Καταχωρίστε το νέο σας κωδικό πρόσβασης</p>
    <form method="post" action="password_update.php">
        <div class='form-group'>
            <input
                    class='form-control'
                    type='password'
                    placeholder='Τρέχων Κωδικός Πρόσβασης'
                    name='current_pass'
                    minLength='8'
                    required
            />
        </div>        <div class='form-group'>
            <input
                    class='form-control'
                    type='password'
                    placeholder='Νέος Κωδικός Πρόσβασης'
                    name='password_1'
                    minLength='8'
                    required
            />
        </div>
        <div class='form-group'>
            <input
                    class='form-control'
                    type='password'
                    placeholder='Επιβεβαίωση Νέου Κωδικού Πρόσβασης'
                    name='password_2'
                    minLength='8'
                    required
            />
        </div>
        <button class='btn btn-primary' name="password_update" type='submit'>ΥΠΟΒΟΛΗ</button>
    </form>
</div>