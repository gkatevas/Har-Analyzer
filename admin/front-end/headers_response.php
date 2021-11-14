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
    <title>Xρόνοι απόκρισης σε αιτήσεις</title>
    <style type="text/css">
        #chart-container {
            width: 1000px;
            height: 500px;
            margin-right: auto;
            margin-left: auto;
            text-align: center;
        }
    </style>
    <script type="text/javascript" src="../../jquery.min.js"></script>
    <script type="text/javascript" src="../../chart.min.js"></script>
</head>
<body>
<div id="chart-container">
    <button id="0" type="button" class='btn btn-outline-dark btn-sm'>Ανά ώρα της ημέρας</button>
    <button id="1" type="button" class='btn btn-outline-dark btn-sm'>Είδος ιστοαντικειμένου</button>
    <button id="2" type="button" class='btn btn-outline-dark btn-sm'>Ημέρα της εβδομάδας</button>
    <button id="3" type="button" class='btn btn-outline-dark btn-sm'>Είδος HTTP μεθόδου κατά την αίτηση</button>
    <button id="4" type="button" class='btn btn-outline-dark btn-sm'>Πάροχος συνδεσιμότητας</button>
</div>
<script>
    $(document).ready(function () {
        showGraph();
    });

    function showGraph()
    {
            $.post("../back-end/return_headers_response.php",
                function (data) {
                    var wait = [];
                    var wait_post = [];
                    var wait_get = [];
                    var wait_mon = [];
                    var wait_tue = [];
                    var wait_wed = [];
                    var wait_thu = [];
                    var wait_fri = [];
                    var wait_sat = [];
                    var wait_sun = [];
                    var wait_video = [];
                    var wait_audio = [];
                    var wait_app = [];
                    var wait_image = [];
                    var wait_font = [];
                    var wait_text = [];
                    var wait_others = [];
                    var hour = [];
                    var wait_wind = [];
                    var wait_cosmote = [];
                    var wait_vodafone = [];
                    var wait_forthnet = [];

                    for (var i in data) {
                        if (data[i].wait !== undefined && data[i].wait !== 'null') {
                            wait.push(data[i].wait);
                        }

                        // POST / GET
                        if (data[i].wait_post !== undefined && data[i].wait_post !== 'null') {
                            wait_post.push(data[i].wait_post);
                        }
                        if (data[i].wait_get !== undefined && data[i].wait_get !== 'null') {
                            wait_get.push(data[i].wait_get);
                        }

                        // ISP
                        if (data[i].wait_cosmote !== undefined && data[i].wait_cosmote !== 'null') {
                            wait_cosmote.push(data[i].wait_cosmote);
                        }
                        if (data[i].wait_forthnet !== undefined && data[i].wait_forthnet !== 'null') {
                            wait_forthnet.push(data[i].wait_forthnet);
                        }
                        if (data[i].wait_vodafone !== undefined && data[i].wait_vodafone !== 'null') {
                            wait_vodafone.push(data[i].wait_vodafone);
                        }
                        if (data[i].wait_wind !== undefined && data[i].wait_wind !== 'null') {
                            wait_wind.push(data[i].wait_wind);
                        }

                        // DAYS
                        if (data[i].wait_mon !== undefined && data[i].wait_mon !== 'null') {
                            wait_mon.push(data[i].wait_mon);
                        }
                        if (data[i].wait_tue !== undefined && data[i].wait_tue !== 'null') {
                            wait_tue.push(data[i].wait_tue);
                        }
                        if (data[i].wait_wed !== undefined && data[i].wait_wed !== 'null') {
                            wait_wed.push(data[i].wait_wed);
                        }
                        if (data[i].wait_thu !== undefined && data[i].wait_thu !== 'null') {
                            wait_thu.push(data[i].wait_thu);
                        }
                        if (data[i].wait_fri !== undefined && data[i].wait_fri !== 'null') {
                            wait_fri.push(data[i].wait_fri);
                        }
                        if (data[i].wait_sat !== undefined && data[i].wait_sat !== 'null') {
                            wait_sat.push(data[i].wait_sat);
                        }
                        if (data[i].wait_sun !== undefined && data[i].wait_sun !== 'null') {
                            wait_sun.push(data[i].wait_sun);
                        }

                        // CONTENT TYPE
                        if (data[i].wait_video !== undefined && data[i].wait_video !== 'null') {
                            wait_video.push(data[i].wait_video);
                        }
                        if (data[i].wait_app !== undefined && data[i].wait_app !== 'null') {
                            wait_app.push(data[i].wait_app);
                        }
                        if (data[i].wait_audio !== undefined && data[i].wait_audio !== 'null') {
                            wait_audio.push(data[i].wait_audio);
                        }
                        if (data[i].wait_image !== undefined && data[i].wait_image !== 'null') {
                            wait_image.push(data[i].wait_image);
                        }
                        if (data[i].wait_font !== undefined && data[i].wait_font !== 'null') {
                            wait_font.push(data[i].wait_font);
                        }
                        if (data[i].wait_text !== undefined && data[i].wait_text !== 'null') {
                            wait_text.push(data[i].wait_text);
                        }
                        if (data[i].wait_others !== undefined && data[i].wait_others !== 'null') {
                            wait_others.push(data[i].wait_others);
                        }
                        // OTHERS
                        if (data[i].hour !== undefined && data[i].hour !== 'null') {
                            hour.push(data[i].hour);
                        }
                    }
                    var hours = {
                        datasets: [
                            {
                                label: 'Ανάλυση χρόνων απόκρισης σε αιτήσεις με βάση την ώρα',
                                backgroundColor: '#77ad93',
                                data: wait
                            }],
                        labels: hour
                    }
                    var days = {
                        datasets: [{
                            label: 'Δευτέρα',
                            backgroundColor: '#005f5c',
                            data: wait_mon
                        },{
                            label: 'Τρίτη',
                            backgroundColor: '#551800',
                            data: wait_tue
                        },{
                            label: 'Τετάρτη',
                            backgroundColor: '#525800',
                            data: wait_wed
                        },{
                            label: 'Πέμπτη',
                            backgroundColor: '#370055',
                            data: wait_thu
                        },{
                            label: 'Παρασκευη',
                            backgroundColor: '#0c1d2d',
                            data: wait_fri
                        },{
                            label: 'Σάββατο',
                            backgroundColor: '#74a500',
                            data: wait_sat
                        },{
                            label: 'Κυριακή',
                            backgroundColor: '#cb592e',
                            data: wait_sun
                        }],
                        labels: ["Ημέρα της εβδομάδας"]
                    }
                    var contenttype = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: wait_app
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: wait_audio
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: wait_image
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: wait_video
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: wait_font
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: wait_text
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: wait_others
                        }],
                        labels: ["Είδος ιστοαντικειμένου"]
                    }
                    var isps = {
                        datasets: [{
                            label: 'COSMOTE',
                            backgroundColor: '#007d02',
                            data: wait_cosmote
                        },
                        //     {
                        //     label: 'FORTHNET',
                        //     backgroundColor: '#cb5800',
                        //     data: wait_forthnet
                        // },
                            {
                            label: 'VODAFONE',
                            backgroundColor: '#c60000',
                            data: wait_vodafone
                        },{
                            label: 'WIND',
                            backgroundColor: '#1a3ec4',
                            data: wait_wind
                        }],
                        labels: ["Πάροχος συνδεσιμότητας"]
                    }
                    var methods = {
                        datasets: [{
                            label: 'GET',
                            backgroundColor: '#000447FF',
                            data: wait_get
                        },{
                            label: 'POST',
                            backgroundColor: '#006A6AFF',
                            data: wait_post
                        }],
                        labels: ['Είδος HTTP μεθόδου κατά την αίτηση']
                    }

                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: hours
                    })

                    $("#0").click(function() {
                        $('#graphCanvas').remove(); // this is my <canvas> element
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: hours
                        })
                    });
                    $("#1").click(function() {
                        $('#graphCanvas').remove(); // this is my <canvas> element
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: contenttype
                        })
                    });
                    $("#2").click(function() {
                        $('#graphCanvas').remove(); // this is my <canvas> element
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: days
                        })
                    });
                    $("#3").click(function() {
                        $('#graphCanvas').remove(); // this is my <canvas> element
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: methods
                        })
                    });
                    $("#4").click(function() {
                        $('#graphCanvas').remove(); // this is my <canvas> element
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: isps
                        })
                    });
                })
    }
</script>
</body>
</html>