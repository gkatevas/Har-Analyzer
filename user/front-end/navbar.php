<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php">Har Analyzer</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ) {?>
                <li><a href="homepage.php">Αρχική σελίδα</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Δεδομένα <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="user_stat.php">Βασικά στατιστικά</a></li>
                        <li><a href="upload_page.php">Ανάλυση αρχείου HAR</a></li>
                        <li><a href="user_heatmap.php">Οπτικοποίηση δεδομένων</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Προφίλ <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="username_update.php">Αλλαγή ονόματος χρήστη</a></li>
                        <li><a href="password_update.php">Αλλαγή κωδικού πρόσβασης</a></li>
                    </ul>
                </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a <span> Έχετε συνδεθεί ως: <?php echo ucfirst($_SESSION['username']) ?> </span></a></li>
                    <li><a href="homepage.php?logout='1'"><span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a></li>
                </ul>
            <?php }
            else { ?>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="register_page.php"><span class="glyphicon glyphicon-user"></span> Εγγραφή</a></li>
                <li><a href="login_page.php"><span class="glyphicon glyphicon-log-in"></span> Είσοδος</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
</body>
</html>
