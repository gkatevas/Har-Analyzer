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
?>
<?php include('footer.html'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Στατιστικά</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        td, th {
            border: 2px solid #dddddd;
            text-align: left;
            padding: 6px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <script type="text/javascript">
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "../back-end/return_statistics.php", true);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var data = JSON.parse(this.responseText);
                var html0 = "";
                var html1 = "";
                var html2 = "";
                var html3 = "";
                var html4 = "";

                var total_users = data[0];
                var diff_isp = data[1];
                var diff_domain = data[2];
                var get_count = data[3];
                var post_count = data[4];

                var text = new Array();
                var value = new Array();
                var html_text = new Array();
                var html_value = new Array();
                var html_text2 = new Array();
                var html_value2 = new Array();
                var i = 0;
                for(var a = 7; a < data.length; a+=2) {
                    text[i] = data[a];
                    value[i] = data[a+1]
                    i +=1;
                }

                for(var a = 0; a < text.length; a++) {
                    if (text[a].indexOf('η μέση ηλικία') > -1) {
                        html_text2 += text[a];
                        html_text2 += "<br>";
                    } else {
                        html_text += text[a];
                        html_text += "<br>";
                    }

                }
                for(var a = 0; a < value.length; a++) {
                    if (text[a].indexOf('η μέση ηλικία') > -1) {
                        html_value2 += value[a];
                        html_value2 += "<br>";
                    } else {
                        html_value += value[a];
                        html_value += "<br>";
                    }
                }
                document.getElementById("status_text").innerHTML += html_text;
                document.getElementById("status_value").innerHTML += html_value;
                document.getElementById("status_text2").innerHTML += html_text2;
                document.getElementById("status_value2").innerHTML += html_value2;

                if (total_users != null) {
                    html0 = total_users;
                } else {
                    html0 = "0";
                }
                if (diff_isp != null) {
                    html1 = diff_isp;
                } else {
                    html1 = "0";
                }
                if (diff_domain != null) {
                    html2 = diff_domain;
                } else {
                    html2 = "0";
                }
                if (get_count != null) {
                    html3 = get_count;
                } else {
                    html3 = "0";
                }
                if (post_count != null) {
                    html4 = post_count;
                } else {
                    html4 = "0";
                }
            }
            document.getElementById("total_users").innerHTML = html0;
            document.getElementById("diff_isp").innerHTML = html1;
            document.getElementById("diff_domain").innerHTML = html2;
            document.getElementById("get_count").innerHTML = html3;
            document.getElementById("post_count").innerHTML = html4;

        };
    </script>
</head>
<body>
<div>
    <div id="body" style="text-align: center;">
        <table class="center">
            <tr>
                <th>Περιγραφή</th>
                <th>Σύνολο</th>
            </tr>
            <tr>
                <td>Το πλήθος των εγγεγραμμένων χρηστών είναι</td>
                <td id="total_users"></td>
            <tr>
                <td>Το πλήθος των μοναδικών παρόχων συνδεσιμότητας που υπάρχουν στη βάση είναι</td>
                <td id="diff_isp"></td>
            </tr>
            <tr>
                <td>Το πλήθος των μοναδικών domains που υπάρχουν στη βάση είναι</td>
                <td id="diff_domain"></td>
            </tr>
            <tr>
                <td>Το πλήθος των εγγραφών στη βάση τύπου GET είναι</td>
                <td id="get_count"></td>
            <tr>
                <td>Το πλήθος των εγγραφών στη βάση τύπου POST είναι</td>
                <td id="post_count"></td>
            </tr>
            <tr>
                <td id="status_text2"></td>
                <td id="status_value2"></td>
            </tr>
            <tr>
                <td id="status_text"></td>
                <td id="status_value"></td>
            </tr>
        </table>
</div>
</body>
</html>