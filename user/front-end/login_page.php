<?php
include('../back-end/server.php');
include('navbar.php');
include('footer.html');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Είσοδος</title>
</head>
<body>
<div class='container mt-5'>
    <h1>Είσοδος</h1>
    <p>Εισέλθετε στον λογαριασμό σας</p>
    <form method="post" action="login_page.php">
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
                type='password'
                placeholder='Κωδικός'
                name='password'
                required
            />
        </div>
        <button class='btn btn-primary' name="login_user" type='submit'>Είσοδος</button>
    </form>
    <p class='mt-3'>
    Δεν έχετε λογαριασμό; <a href="register_page.php">Εγγραφή</a>
    </p>
</div>

