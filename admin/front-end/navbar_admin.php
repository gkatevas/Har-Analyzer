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

<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin_homepage.php">Har Analyzer</a>
        </div>
        <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ) {?>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="statistics.php">Βασικές Πληροφοριές</a></li>
                <li><a href="headers_response.php">Χρόνοι απόκρισης σε αιτήσεις</a></li>
                <li><a href="http_analysis.php">Ανάλυση κεφαλίδων HTTP</a></li>
                <li><a href="entries_map.php">Οπτικοποίηση δεδομένων</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a <span> Έχετε συνδεθεί ως: <?php echo ucfirst($_SESSION['username']) ?> </span></a></li>
                <li><a href="../../user/front-end/homepage.php?logout='1'"><span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a></li>
            </ul>
                <?php }
                else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../user/front-end/register_page.php"><span class="glyphicon glyphicon-user"></span> Εγγραφή</a></li>
                    <li><a href="../../user/front-end/login_page.php"><span class="glyphicon glyphicon-log-in"></span> Είσοδος</a></li>
                </ul>
                <?php } ?>
        </div>
    </div>
</nav>
</body>
</html>
