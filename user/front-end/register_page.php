<?php
include('../back-end/server.php');
include('navbar.php');
include('footer.html');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Εγγραφή</title>
</head>
<body>
<div class='container mt-5'>
    <h1>Εγγραφή</h1>
    <p>Δημιουργήστε τον λογαριασμό σας</p>
    <form method="post" action="register_page.php">
        <div class='form-group'>
            <input
                class='form-control'
                type='text'
                placeholder='Όνομα χρήστη'
                name='username'
                required
                />
        </div>
        <div class='form-group'>
            <input
                class='form-control'
                type='email'
                placeholder='Email'
                name='email'
                required
                />
        </div>
        <div class='form-group'>
            <input
                class='form-control'
                type='password'
                placeholder='Κωδικός πρόσβασης'
                name='password_1'
                minLength='8'
                required
                />
        </div>
        <div class='form-group'>
            <input
                class='form-control'
                type='password'
                placeholder='Επιβεβαίωση κωδικού πρόσβασης'
                name='password_2'
                minLength='6'
                required
                />
        </div>
        <button class='btn btn-primary' name="reg_user" type='submit'>Εγγραφή</button>
    </form>
    <p class='mt-3'>
        Έχετε ήδη λογαριασμό; <a href="login_page.php">Εισέλθετε</a>
    </p>
</div>