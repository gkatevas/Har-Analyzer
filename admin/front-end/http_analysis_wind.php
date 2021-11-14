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
    <title>Ανάλυση κεφαλίδων HTTP</title>
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
    <div> H χρήση κρυφών μνημών, με Wind ως πάροχο, με βάση: </div>
    <button id="1" type="button" class='btn btn-outline-dark btn-sm'>Ιστόγραμμα κατανομής των TTL</button>
    <button id="2" type="button" class='btn btn-outline-dark btn-sm'>Max-Stale</button>
    <button id="3" type="button" class='btn btn-outline-dark btn-sm'>Min-Fresh</button>
    <button id="4" type="button" class='btn btn-outline-dark btn-sm'>Public</button>
    <button id="5" type="button" class='btn btn-outline-dark btn-sm'>Private</button>
    <button id="6" type="button" class='btn btn-outline-dark btn-sm'>No-Cache</button>
    <button id="7" type="button" class='btn btn-outline-dark btn-sm'>No-Store</button>
    <input type="button" class='btn btn-outline-dark btn-sm' onclick="location.href='http_analysis.php';" value="All in one" />
    <input type="button" class='btn btn-outline-dark btn-sm' onclick="location.href='http_analysis_ote.php';" value="Cosmote" />
    <input type="button" class='btn btn-outline-dark btn-sm' onclick="location.href='http_analysis_vodafone.php';" value="Vodafone" />
    <input type="button" class='btn btn-outline-dark btn-sm' onclick="location.href='http_analysis_wind.php';" value="Wind" />
</div>
<script>
    $(document).ready(function () {
        showGraph();
    });

    function showGraph()
    {
        $.post("../back-end/return_http_analysis.php",
            function (data) {
                var max_age = [];
                var max_age_video_wind = [];
                var max_age_audio_wind = [];
                var max_age_app_wind = [];
                var max_age_image_wind = [];
                var max_age_font_wind = [];
                var max_age_text_wind = [];
                var max_age_others_wind = [];
                var max_stale_video_wind = [];
                var max_stale_audio_wind = [];
                var max_stale_app_wind = [];
                var max_stale_image_wind = [];
                var max_stale_font_wind = [];
                var max_stale_text_wind = [];
                var max_stale_others_wind = [];
                var min_fresh_video_wind = [];
                var min_fresh_audio_wind = [];
                var min_fresh_app_wind = [];
                var min_fresh_image_wind = [];
                var min_fresh_font_wind = [];
                var min_fresh_text_wind = [];
                var min_fresh_others_wind = [];
                var no_cache_video_wind = [];
                var no_cache_audio_wind = [];
                var no_cache_app_wind = [];
                var no_cache_image_wind = [];
                var no_cache_font_wind = [];
                var no_cache_text_wind = [];
                var no_cache_others_wind = [];
                var no_store_video_wind = [];
                var no_store_audio_wind = [];
                var no_store_app_wind = [];
                var no_store_image_wind = [];
                var no_store_font_wind = [];
                var no_store_text_wind = [];
                var no_store_others_wind = [];
                var public_video_wind = [];
                var public_audio_wind = [];
                var public_app_wind = [];
                var public_image_wind = [];
                var public_font_wind = [];
                var public_text_wind = [];
                var public_others_wind = [];
                var private_video_wind = [];
                var private_audio_wind = [];
                var private_app_wind = [];
                var private_image_wind = [];
                var private_font_wind = [];
                var private_text_wind = [];
                var private_others_wind = [];

                // console.log(data);
                for (var i in data) {
                    // MAX AGE
                    if (data[i].max_age !== undefined && data[i].max_age !== 'null') {
                        max_age.push(data[i].max_age);
                    }
                    // MAX AGE BY ISP
                    if (data[i].max_age_video !== undefined && data[i].max_age_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_video_wind.push(data[i].max_age_video);
                        }
                    }
                    if (data[i].max_age_app !== undefined && data[i].max_age_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_app_wind.push(data[i].max_age_app);
                        }
                    }
                    if (data[i].max_age_audio !== undefined && data[i].max_age_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_audio_wind.push(data[i].max_age_audio);
                        }
                    }
                    if (data[i].max_age_image !== undefined && data[i].max_age_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_image_wind.push(data[i].max_age_image);
                        }
                    }
                    if (data[i].max_age_font !== undefined && data[i].max_age_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_font_wind.push(data[i].max_age_font);
                        }
                    }
                    if (data[i].max_age_text !== undefined && data[i].max_age_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_text_wind.push(data[i].max_age_text);
                        }
                    }
                    if (data[i].max_age_others !== undefined && data[i].max_age_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_age_others_wind.push(data[i].max_age_others);
                        }
                    }
                    // MAX STALES
                    if (data[i].max_stale_video !== undefined && data[i].max_stale_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_video_wind.push(data[i].max_stale_video);
                        }
                    }
                    if (data[i].max_stale_app !== undefined && data[i].max_stale_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_app_wind.push(data[i].max_stale_app);
                        }
                    }
                    if (data[i].max_stale_audio !== undefined && data[i].max_stale_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_audio_wind.push(data[i].max_stale_audio);
                        }
                    }
                    if (data[i].max_stale_image !== undefined && data[i].max_stale_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_image_wind.push(data[i].max_stale_image);
                        }
                    }
                    if (data[i].max_stale_font !== undefined && data[i].max_stale_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_font_wind.push(data[i].max_stale_font);
                        }
                    }
                    if (data[i].max_stale_text !== undefined && data[i].max_stale_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_text_wind.push(data[i].max_stale_text);
                        }
                    }
                    if (data[i].max_stale_others !== undefined && data[i].max_stale_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            max_stale_others_wind.push(data[i].max_stale_others);
                        }
                    }
                    //  MIN FRESH
                    if (data[i].min_fresh_video !== undefined && data[i].min_fresh_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_video_wind.push(data[i].min_fresh_video);
                        }
                    }
                    if (data[i].min_fresh_app !== undefined && data[i].min_fresh_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_app_wind.push(data[i].min_fresh_app);
                        }
                    }
                    if (data[i].min_fresh_audio !== undefined && data[i].min_fresh_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_audio_wind.push(data[i].min_fresh_audio);
                        }
                    }
                    if (data[i].min_fresh_image !== undefined && data[i].min_fresh_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_image_wind.push(data[i].min_fresh_image);
                        }
                    }
                    if (data[i].min_fresh_font !== undefined && data[i].min_fresh_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_font_wind.push(data[i].min_fresh_font);
                        }
                    }
                    if (data[i].min_fresh_text !== undefined && data[i].min_fresh_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_text_wind.push(data[i].min_fresh_text);
                        }
                    }
                    if (data[i].min_fresh_others !== undefined && data[i].min_fresh_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            min_fresh_others_wind.push(data[i].min_fresh_others);
                        }
                    }
                    //  NO CACHE
                    if (data[i].no_cache_video !== undefined && data[i].no_cache_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_video_wind.push(data[i].no_cache_video);
                        }
                    }
                    if (data[i].no_cache_app !== undefined && data[i].no_cache_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_app_wind.push(data[i].no_cache_app);
                        }
                    }
                    if (data[i].no_cache_audio !== undefined && data[i].no_cache_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_audio_wind.push(data[i].no_cache_audio);
                        }
                    }
                    if (data[i].no_cache_image !== undefined && data[i].no_cache_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_image_wind.push(data[i].no_cache_image);
                        }
                    }
                    if (data[i].no_cache_font !== undefined && data[i].no_cache_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_font_wind.push(data[i].no_cache_font);
                        }
                    }
                    if (data[i].no_cache_text !== undefined && data[i].no_cache_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_text_wind.push(data[i].no_cache_text);
                        }
                    }
                    if (data[i].no_cache_others !== undefined && data[i].no_cache_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_cache_others_wind.push(data[i].no_cache_others);
                        }
                    }
                    //  NO STORE
                    if (data[i].no_store_video !== undefined && data[i].no_store_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_video_wind.push(data[i].no_store_video);
                        }
                    }
                    if (data[i].no_store_app !== undefined && data[i].no_store_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_app_wind.push(data[i].no_store_app);
                        }
                    }
                    if (data[i].no_store_audio !== undefined && data[i].no_store_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_audio_wind.push(data[i].no_store_audio);
                        }
                    }
                    if (data[i].no_store_image !== undefined && data[i].no_store_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_image_wind.push(data[i].no_store_image);
                        }
                    }
                    if (data[i].no_store_font !== undefined && data[i].no_store_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_font_wind.push(data[i].no_store_font);
                        }
                    }
                    if (data[i].no_store_text !== undefined && data[i].no_store_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_text_wind.push(data[i].no_store_text);
                        }
                    }
                    if (data[i].no_store_others !== undefined && data[i].no_store_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            no_store_others_wind.push(data[i].no_store_others);
                        }
                    }
                    //  PUBLIC
                    if (data[i].public_video !== undefined && data[i].public_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_video_wind.push(data[i].public_video);
                        }
                    }
                    if (data[i].public_app !== undefined && data[i].public_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_app_wind.push(data[i].public_app);
                        }
                    }
                    if (data[i].public_audio !== undefined && data[i].public_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_audio_wind.push(data[i].public_audio);
                        }
                    }
                    if (data[i].public_image !== undefined && data[i].public_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_image_wind.push(data[i].public_image);
                        }
                    }
                    if (data[i].public_font !== undefined && data[i].public_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_font_wind.push(data[i].public_font);
                        }
                    }
                    if (data[i].public_text !== undefined && data[i].public_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_text_wind.push(data[i].public_text);
                        }
                    }
                    if (data[i].public_others !== undefined && data[i].public_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            public_others_wind.push(data[i].public_others);
                        }
                    }
                    //  PRIVATE
                    if (data[i].private_video !== undefined && data[i].private_video !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_video_wind.push(data[i].private_video);
                        }
                    }
                    if (data[i].private_app !== undefined && data[i].private_app !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_app_wind.push(data[i].private_app);
                        }
                    }
                    if (data[i].private_audio !== undefined && data[i].private_audio !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_audio_wind.push(data[i].private_audio);
                        }
                    }
                    if (data[i].private_image !== undefined && data[i].private_image !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_image_wind.push(data[i].private_image);
                        }
                    }
                    if (data[i].private_font !== undefined && data[i].private_font !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_font_wind.push(data[i].private_font);
                        }
                    }
                    if (data[i].private_text !== undefined && data[i].private_text !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_text_wind.push(data[i].private_text);
                        }
                    }
                    if (data[i].private_others !== undefined && data[i].private_others !== 'null') {
                        if (data[i].isp === 'wind') {
                            private_others_wind.push(data[i].private_others);
                        }
                    }
                }

                var ttl_wind = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: max_age_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: max_age_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: max_age_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: max_age_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: max_age_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: max_age_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: max_age_others_wind
                    }],
                    labels: ['Ιστόγραμμα κατανομής των TTL των ιστοαντικειμένων στην απόκριση, ανά CONTENT-TYPE, με πάροχο Wind']
                }
                var max_stale = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: max_stale_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: max_stale_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: max_stale_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: max_stale_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: max_stale_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: max_stale_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: max_stale_others_wind
                    }],
                    labels: ["Ποσοστό Max-Stale directives επί του συνόλου των αιτήσεων ανά CONTENT TYPE, με πάροχο Wind"]
                }
                var min_fresh = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: min_fresh_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: min_fresh_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: min_fresh_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: min_fresh_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: min_fresh_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: min_fresh_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: min_fresh_others_wind
                    }],
                    labels: ["Ποσοστό Min-Fresh directives επί του συνόλου των αιτήσεων ανά CONTENT-TYPE, με πάροχο Wind"]
                }
                var no_cache = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: no_cache_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: no_cache_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: no_cache_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: no_cache_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: no_cache_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: no_cache_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: no_cache_others_wind
                    }],
                    labels: ["Ποσοστό cache ability directives no-cache επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Wind"]
                }
                var no_store = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: no_store_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: no_store_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: no_store_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: no_store_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: no_store_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: no_store_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: no_store_others_wind
                    }],
                    labels: ["Ποσοστό cache ability directives no-store επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Wind"]
                }
                var public = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: public_app_wind
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: public_audio_wind
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: public_image_wind
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: public_video_wind
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: public_font_wind
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: public_text_wind
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: public_others_wind
                    }],
                    labels: ["Ποσοστό cache ability directives public επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Wind"]
                }
                var private = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: private_app_wind
                    }, {
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: private_audio_wind
                    }, {
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: private_image_wind
                    }, {
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: private_video_wind
                    }, {
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: private_font_wind
                    }, {
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: private_text_wind
                    }, {
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: private_others_wind
                    }],
                    labels: ["Ποσοστό cache ability directives private επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Wind"]
                }

                $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                var graphTarget = $("#graphCanvas");
                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: ttl_wind
                })

                $("#1").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: ttl_wind
                    })
                });

                $("#2").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: max_stale
                    })
                });
                $("#3").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: min_fresh
                    })
                });
                $("#4").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: public
                    })
                });
                $("#5").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: private
                    })
                });
                $("#6").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: no_cache
                    })
                });
                $("#7").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: no_store
                    })
                });
            })
    }
</script>
</body>
</html>