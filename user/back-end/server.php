<?php
session_start();

$username = "";
$email    = "";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'web2021');

/*================================================ Register ==========================================================*/
if (isset($_POST['reg_user'])) {
    // Λήψη των τιμών από τις input forms
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Επιβεβαίωση ότι έχουν συμπληρωθεί τα πεδία
    if (empty($username)) { array_push($errors, "Απαιτείται όνομα χρήστη"); }
    if (empty($email)) { array_push($errors, "Απαιτείται email"); }
    if (empty($password_1)) { array_push($errors, "Απαιτείται κωδικός πρόσβασης"); }
    if ($password_1 != $password_2) {
        array_push($errors, "Οι κωδικοί δε ταιριάζουν");
    }

    // Έλεγχος ισχυρότητας κωδικού
    $uppercase = preg_match('@[A-Z]@', $password_1);
    $number    = preg_match('@[0-9]@', $password_1);
    $specialChars = preg_match('@[^\w]@', $password_1);

    if(!$uppercase || !$number || !$specialChars || strlen($password_1) < 8) {
        array_push($errors, "Ο κωδικός πρέπει να αποτελείται απο 8 τουλάχιστον χαρακτήρες και να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα, έναν αριθμό και ειδικό χαρακτήρα.");
//            error_log( 'Ο κωδικός πρέπει να αποτελείται απο 8 τουλάχιστον χαρακτήρες και να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα, έναν αριθμό και ειδικό χαρακτήρα.',0);
    }else{
        error_log('Ισχυρός κωδικός πρόσβασης.',0);
    }

    // Έλεγχος στη ΒΔ οτι δεν υπάρχει ήδη χρήστης με τα ίδια στοιχεία
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // αν υπάρχει ήδη χρήστης
        if ($user['username'] === $username) {
            array_push($errors, "Το όνομα χρήστη υπάρχει ήδη.");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Το email υπάρχει ήδη.");
        }
    }

    // Εγγραφή χρήστη αν δεν υπάρχουν errors
    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        header('location: ../front-end/login_page.php');
    }
}


/*================================================== Login ===========================================================*/
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password1 = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Απαιτείται όνομα χρήστη");
    }
    if (empty($password1)) {
        array_push($errors, "Απαιτείται κωδικός πρόσβασης");
    }

    $stmt = $db->prepare("SELECT password FROM users WHERE username = '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();
    $hashed_password = $value->password;

    if (count($errors) == 0) {
        if (password_verify($password1, $hashed_password)){
            $query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Επιτυχής σύνδεση!";
                $stmt = $db->prepare("SELECT * FROM users WHERE username=? limit 1");
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $value = $result->fetch_object();
                $id = $value->id;
                $lastUpload = $value->last_upload;
                $username_2 = $value->username;
                $admin = $value->admin;
                $_SESSION['admin'] = $admin;
                $_SESSION['myid'] = $id;
                $_SESSION['lastUpload'] = $lastUpload;
                $_SESSION['username_2'] = $username_2;

                if ($admin == 0) {
                    header('location: ../front-end/homepage.php');
                } elseif ($admin == 1){
                    header('location: ../../admin/front-end/admin_homepage.php');
                }
            }
        }
    }
}

/*=========================================== Αλλαγή ονόματος χρήστη =================================================*/
if (isset($_POST['username_update'])) {
    $old_username = mysqli_real_escape_string($db, $_POST['old_username']);
    $username = mysqli_real_escape_string($db, $_POST['username']);

    if (empty($old_username)) {
        array_push($errors, "Απαιτείται το τρέχων όνομα χρήστη");
    }
    if (empty($username)) {
        array_push($errors, "Απαιτείται το νέο όνομα χρήστη");
    }

    // Έλεγχος στη ΒΔ οτι δεν υπάρχει ήδη χρήστης με τα ίδια στοιχεία
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $username_2 = $_SESSION['username_2'];

    if ($user) { // αν υπάρχει ήδη χρήστης με το ίδιο username
        if ($user['username'] === $username AND $user['username'] !== $username_2) {
            array_push($errors, "Το όνομα χρήστη υπάρχει ήδη.");
        }
    }

    $id2 = $_SESSION['myid'];
    $query = "SELECT * FROM users WHERE username='$old_username' AND id='$id2'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
        // Αλλαγή ονόματος χρήστη αν δεν υπάρχουν errors
        if (count($errors) == 0) {
            $sql = "UPDATE users SET username= '$username' WHERE id='$id2' ";
            mysqli_query($db, $sql);
            header('location: ../front-end/homepage.php');
        }
    }
}

/*============================================= Αλλαγή κωδικού πρόσβασης =============================================*/
if (isset($_POST['password_update'])) {
    $current_pass = mysqli_real_escape_string($db, $_POST['current_pass']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($current_pass)) {
        array_push($errors, "Απαιτείται ο τρέχων κωδικός πρόσβασης.");
    }
    if (empty($password_1)) {
        array_push($errors, "Απαιτείται κωδικός πρόσβασης.");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Οι κωδικοί δε ταιριάζουν.");
    }

    // Έλεγχος ισχυρότητας κωδικού
    $uppercase = preg_match('@[A-Z]@', $password_1);
    $number = preg_match('@[0-9]@', $password_1);
    $specialChars = preg_match('@[^\w]@', $password_1);

    if (!$uppercase || !$number || !$specialChars || strlen($password_1) < 8) {
        array_push($errors, "Ο κωδικός πρέπει να αποτελείται απο 8 τουλάχιστον χαρακτήρες και να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα, έναν αριθμό και ειδικό χαρακτήρα.");
//        error_log('Ο κωδικός πρέπει να αποτελείται απο 8 τουλάχιστον χαρακτήρες και να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα, έναν αριθμό και ειδικό χαρακτήρα.', 0);
    } else {
        error_log('Ισχυρός κωδικός.', 0);
    }

    $id2 = $_SESSION['myid'];
    $username = $_SESSION['username'];
    $stmt = $db->prepare("SELECT password FROM users WHERE username = '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();
    $hashed_password = $value->password;
    if (password_verify($current_pass, $hashed_password)){ //έλεγχος τρέχων κωδικού πρόσβασης
        $query = "SELECT * FROM users WHERE id='$id2' AND password='$hashed_password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            // Αλλαγή κωδικού πρόσβασης αν δεν υπάρχουν errors
            if (count($errors) == 0) {
                $password = password_hash($password_1, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = '$password' WHERE id='$id2' ";
                mysqli_query($db, $sql);
                header('location: ../front-end/homepage.php');
            }
        }
    } else{
        array_push($errors, "Ο τρέχων κωδικός πρόσβασης είναι λάθος");
    }
}
