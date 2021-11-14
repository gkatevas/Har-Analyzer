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
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Upload Har File</title>
    <style>
        .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 30px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn:hover {
            background-color: RoyalBlue;
        }
        #file-selector {
            width: 500px;
            height:200px;
            margin-right: auto;
            margin-left: auto;
            text-align: center;
            border:1px solid #404040;
        }
    </style>
</head>

<body>
<div style="text-align: center;" class='container mt-5'>
    <h5>Παρακαλώ επιλέξτε το αρχείο σας!</h5>

    <input type="file" id="file-selector" accept=".har">
    <p>
        <br>
        <button id="uploadData" onclick="uploadData();" class='btn btn-primary' name="uploadData">Ανέβασμα του τροποποιημένου αρχείου</button>
    </p>
    <p>
        <br>
        <a id="exportJSON" onclick="exportJson(this);" ><i class="fa fa-download"></i>  Κατέβασμα του τροποποιημένου αρχείου</a>
    </p>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    var files = [];
    const fileSelector = document.getElementById('file-selector');

    fileSelector.addEventListener('change', (event) => {
        const fileList = event.target.files[0];
        var reader = new FileReader();

        reader.readAsText(fileList);

        reader.onload=function(){

            // Save har to array
            files[0] = reader.result;

            // Convert har to json
            var obj = JSON.parse(files[0]);

            // Clear the file

            delete obj["log"]["pages"];
            delete obj["log"]["version"];
            delete obj["log"]["creator"];
            var count_entries = Object.keys(obj["log"]["entries"]).length;

            var url;
            for (var i = 0; i < count_entries; i++) {
                delete obj["log"]["entries"][i]["_initiator"];
                delete obj["log"]["entries"][i]["_priority"];
                delete obj["log"]["entries"][i]["_resourceType"];
                delete obj["log"]["entries"][i]["cache"];
                delete obj["log"]["entries"][i]["pageref"];
                delete obj["log"]["entries"][i]["time"];
                delete obj["log"]["entries"][i]["connection"];
                delete obj["log"]["entries"][i]["_fromCache"];
                delete obj["log"]["entries"][i]["postData"];
                delete obj["log"]["entries"][i]["request"]["httpVersion"];
                delete obj["log"]["entries"][i]["request"]["queryString"];
                delete obj["log"]["entries"][i]["request"]["cookies"];
                delete obj["log"]["entries"][i]["request"]["headersSize"];
                delete obj["log"]["entries"][i]["request"]["bodySize"];
                delete obj["log"]["entries"][i]["request"]["bodySize"];
                delete obj["log"]["entries"][i]["response"]["httpVersion"];
                delete obj["log"]["entries"][i]["response"]["cookies"];
                delete obj["log"]["entries"][i]["response"]["content"];
                delete obj["log"]["entries"][i]["response"]["redirectURL"];
                delete obj["log"]["entries"][i]["response"]["headersSize"];
                delete obj["log"]["entries"][i]["response"]["bodySize"];
                delete obj["log"]["entries"][i]["response"]["_transferSize"];
                delete obj["log"]["entries"][i]["response"]["_error"];
                delete obj["log"]["entries"][i]["timings"]["blocked"];
                delete obj["log"]["entries"][i]["timings"]["dns"];
                delete obj["log"]["entries"][i]["timings"]["ssl"];
                delete obj["log"]["entries"][i]["timings"]["connect"];
                delete obj["log"]["entries"][i]["timings"]["send"];
                delete obj["log"]["entries"][i]["timings"]["receive"];
                delete obj["log"]["entries"][i]["timings"]["_blocked_queueing"];

                var count_response_headers = Object.keys(obj["log"]["entries"][i]["response"]["headers"]).length;
                for (var k = 0; k < count_response_headers; k++) {
                    if ((obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "content-type") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Content-Type") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "cache-control") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Cache-Control") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "pragma") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Pragma") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "expires") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Expires") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "age") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Age") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "last-modified") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Last-Modified") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "Host") &&
                        (obj["log"]["entries"][i]["response"]["headers"][k]["name"] !== "host")) {
                        delete obj["log"]["entries"][i]["response"]["headers"][k];
                    }
                }

                var count_request_headers = Object.keys(obj["log"]["entries"][i]["request"]["headers"]).length;
                for (var j = 0; j < count_request_headers; j++) {
                    url = obj["log"]["entries"][i]["request"]["url"];

                    if ((obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "content-type") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Content-Type") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "cache-control") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Cache-Control") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "pragma") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Pragma") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "expires") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Expires") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "age") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Age") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "last-modified") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Last-Modified") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "Host") &&
                        (obj["log"]["entries"][i]["request"]["headers"][j]["name"] !== "host"))
                    {
                        delete obj["log"]["entries"][i]["request"]["headers"][j];
                         }
                }
            }
                console.log(obj.log);
                files[0] = obj.log;
            }
    })

    function exportJson(el) {
        var data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(files[0]));
        el.setAttribute("href", "data:" + data);
        el.setAttribute("download", "data.json");
    }

    function uploadData() {
        var str_json = JSON.stringify(files[0]);

        $.ajax({
            type: "POST",
            url: "../back-end/data_upload.php",
            data: {myData: str_json},
            success: function(response) {
                if (response === 'successful') {
                    alert("Το ανέβασμα ολοκληρώθηκε επιτυχώς!");
                }
                else {
                    alert("Το ανέβασμα απέτυχε να πραγματοποιηθεί, προσπαθήστε ξανά παρακαλώ!");
                }
            }
        })
    }
</script>
</body>
</html>