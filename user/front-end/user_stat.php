<?php
session_start();
include('navbar.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Πρέπει να εισέλθετε πρώτα!";
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
    <title>Βασικά στατιστικά</title>
    <script type="text/javascript">
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "../back-end/return_user_stat.php", true);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var data = JSON.parse(this.responseText);
                // console.log(data);

                var html = "";
                var html2 = "";
                var lastUpload = data[0];
                var headers = data[1];
                if (lastUpload != null) {
                    html = "Η ημερομηνία που ανεβάσατε τελευταία φορά αρχείο ήταν στις <b>" + lastUpload + "</b>.";
                } else {
                    html = "Δεν έχετε ανεβάσει στο παρελθόν κάποιο αρχείο.";
                }
                if (headers != null) {
                    html2 = "Έχετε ανεβάσει συνολικά <b>" + headers + "</b> εγγραφές.";
                } else {
                    html2 = "Δεν υπάρχει κάποια εγγραφή στο ιστορικό σας.";
                }
             }
                 document.getElementById("lastupload").innerHTML = html;
                 document.getElementById("headers").innerHTML = html2;
        };
    </script>
</head>
<body>

<div style="text-align: center;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>
                <p id="lastupload"></p>
            </h5>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>
            <p id="headers"></p>
            </h5>
        </div>
    </div>
</div>
</body>
</html>