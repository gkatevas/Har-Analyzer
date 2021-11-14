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
    <div> H χρήση κρυφών μνημών, με Vodafone ως πάροχο, με βάση: </div>
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
                var max_age_video_vodafone = [];
                var max_age_audio_vodafone = [];
                var max_age_app_vodafone = [];
                var max_age_image_vodafone = [];
                var max_age_font_vodafone = [];
                var max_age_text_vodafone = [];
                var max_age_others_vodafone = [];
                var max_stale_video_vodafone = [];
                var max_stale_audio_vodafone = [];
                var max_stale_app_vodafone = [];
                var max_stale_image_vodafone = [];
                var max_stale_font_vodafone = [];
                var max_stale_text_vodafone = [];
                var max_stale_others_vodafone = [];
                var min_fresh_video_vodafone = [];
                var min_fresh_audio_vodafone = [];
                var min_fresh_app_vodafone = [];
                var min_fresh_image_vodafone = [];
                var min_fresh_font_vodafone = [];
                var min_fresh_text_vodafone = [];
                var min_fresh_others_vodafone = [];
                var no_cache_video_vodafone = [];
                var no_cache_audio_vodafone = [];
                var no_cache_app_vodafone = [];
                var no_cache_image_vodafone = [];
                var no_cache_font_vodafone = [];
                var no_cache_text_vodafone = [];
                var no_cache_others_vodafone = [];
                var no_store_video_vodafone = [];
                var no_store_audio_vodafone = [];
                var no_store_app_vodafone = [];
                var no_store_image_vodafone = [];
                var no_store_font_vodafone = [];
                var no_store_text_vodafone = [];
                var no_store_others_vodafone = [];
                var public_video_vodafone = [];
                var public_audio_vodafone = [];
                var public_app_vodafone = [];
                var public_image_vodafone = [];
                var public_font_vodafone = [];
                var public_text_vodafone = [];
                var public_others_vodafone = [];
                var private_video_vodafone = [];
                var private_audio_vodafone = [];
                var private_app_vodafone = [];
                var private_image_vodafone = [];
                var private_font_vodafone = [];
                var private_text_vodafone = [];
                var private_others_vodafone = [];

                // console.log(data);
                for (var i in data) {
                    // MAX AGE
                    if (data[i].max_age !== undefined && data[i].max_age !== 'null') {
                        max_age.push(data[i].max_age);
                    }
                    // MAX AGE BY ISP
                    if (data[i].max_age_video !== undefined && data[i].max_age_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_video_vodafone.push(data[i].max_age_video);
                        }
                    }
                    if (data[i].max_age_app !== undefined && data[i].max_age_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_app_vodafone.push(data[i].max_age_app);
                        }
                    }
                    if (data[i].max_age_audio !== undefined && data[i].max_age_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_audio_vodafone.push(data[i].max_age_audio);
                        }
                    }
                    if (data[i].max_age_image !== undefined && data[i].max_age_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_image_vodafone.push(data[i].max_age_image);
                        }
                    }
                    if (data[i].max_age_font !== undefined && data[i].max_age_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_font_vodafone.push(data[i].max_age_font);
                        }
                    }
                    if (data[i].max_age_text !== undefined && data[i].max_age_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_text_vodafone.push(data[i].max_age_text);
                        }
                    }
                    if (data[i].max_age_others !== undefined && data[i].max_age_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_age_others_vodafone.push(data[i].max_age_others);
                        }
                    }
                    // MAX STALES
                    if (data[i].max_stale_video !== undefined && data[i].max_stale_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_video_vodafone.push(data[i].max_stale_video);
                        }
                    }
                    if (data[i].max_stale_app !== undefined && data[i].max_stale_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_app_vodafone.push(data[i].max_stale_app);
                        }
                    }
                    if (data[i].max_stale_audio !== undefined && data[i].max_stale_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_audio_vodafone.push(data[i].max_stale_audio);
                        }
                    }
                    if (data[i].max_stale_image !== undefined && data[i].max_stale_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_image_vodafone.push(data[i].max_stale_image);
                        }
                    }
                    if (data[i].max_stale_font !== undefined && data[i].max_stale_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_font_vodafone.push(data[i].max_stale_font);
                        }
                    }
                    if (data[i].max_stale_text !== undefined && data[i].max_stale_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_text_vodafone.push(data[i].max_stale_text);
                        }
                    }
                    if (data[i].max_stale_others !== undefined && data[i].max_stale_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            max_stale_others_vodafone.push(data[i].max_stale_others);
                        }
                    }
                    //  MIN FRESH
                    if (data[i].min_fresh_video !== undefined && data[i].min_fresh_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_video_vodafone.push(data[i].min_fresh_video);
                        }
                    }
                    if (data[i].min_fresh_app !== undefined && data[i].min_fresh_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_app_vodafone.push(data[i].min_fresh_app);
                        }
                    }
                    if (data[i].min_fresh_audio !== undefined && data[i].min_fresh_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_audio_vodafone.push(data[i].min_fresh_audio);
                        }
                    }
                    if (data[i].min_fresh_image !== undefined && data[i].min_fresh_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_image_vodafone.push(data[i].min_fresh_image);
                        }
                    }
                    if (data[i].min_fresh_font !== undefined && data[i].min_fresh_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_font_vodafone.push(data[i].min_fresh_font);
                        }
                    }
                    if (data[i].min_fresh_text !== undefined && data[i].min_fresh_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_text_vodafone.push(data[i].min_fresh_text);
                        }
                    }
                    if (data[i].min_fresh_others !== undefined && data[i].min_fresh_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            min_fresh_others_vodafone.push(data[i].min_fresh_others);
                        }
                    }
                    //  NO CACHE
                    if (data[i].no_cache_video !== undefined && data[i].no_cache_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_video_vodafone.push(data[i].no_cache_video);
                        }
                    }
                    if (data[i].no_cache_app !== undefined && data[i].no_cache_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_app_vodafone.push(data[i].no_cache_app);
                        }
                    }
                    if (data[i].no_cache_audio !== undefined && data[i].no_cache_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_audio_vodafone.push(data[i].no_cache_audio);
                        }
                    }
                    if (data[i].no_cache_image !== undefined && data[i].no_cache_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_image_vodafone.push(data[i].no_cache_image);
                        }
                    }
                    if (data[i].no_cache_font !== undefined && data[i].no_cache_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_font_vodafone.push(data[i].no_cache_font);
                        }
                    }
                    if (data[i].no_cache_text !== undefined && data[i].no_cache_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_text_vodafone.push(data[i].no_cache_text);
                        }
                    }
                    if (data[i].no_cache_others !== undefined && data[i].no_cache_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_cache_others_vodafone.push(data[i].no_cache_others);
                        }
                    }
                    //  NO STORE

                    if (data[i].no_store_video !== undefined && data[i].no_store_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_video_vodafone.push(data[i].no_store_video);
                        }
                    }
                    if (data[i].no_store_app !== undefined && data[i].no_store_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_app_vodafone.push(data[i].no_store_app);
                        }
                    }
                    if (data[i].no_store_audio !== undefined && data[i].no_store_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_audio_vodafone.push(data[i].no_store_audio);
                        }
                    }
                    if (data[i].no_store_image !== undefined && data[i].no_store_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_image_vodafone.push(data[i].no_store_image);
                        }
                    }
                    if (data[i].no_store_font !== undefined && data[i].no_store_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_font_vodafone.push(data[i].no_store_font);
                        }
                    }
                    if (data[i].no_store_text !== undefined && data[i].no_store_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_text_vodafone.push(data[i].no_store_text);
                        }
                    }
                    if (data[i].no_store_others !== undefined && data[i].no_store_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            no_store_others_vodafone.push(data[i].no_store_others);
                        }
                    }
                    //  PUBLIC
                    if (data[i].public_video !== undefined && data[i].public_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_video_vodafone.push(data[i].public_video);
                        }
                    }
                    if (data[i].public_app !== undefined && data[i].public_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_app_vodafone.push(data[i].public_app);
                        }
                    }
                    if (data[i].public_audio !== undefined && data[i].public_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_audio_vodafone.push(data[i].public_audio);
                        }
                    }
                    if (data[i].public_image !== undefined && data[i].public_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_image_vodafone.push(data[i].public_image);
                        }
                    }
                    if (data[i].public_font !== undefined && data[i].public_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_font_vodafone.push(data[i].public_font);
                        }
                    }
                    if (data[i].public_text !== undefined && data[i].public_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_text_vodafone.push(data[i].public_text);
                        }
                    }
                    if (data[i].public_others !== undefined && data[i].public_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            public_others_vodafone.push(data[i].public_others);
                        }
                    }
                    //  PRIVATE
                    if (data[i].private_video !== undefined && data[i].private_video !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_video_vodafone.push(data[i].private_video);
                        }
                    }
                    if (data[i].private_app !== undefined && data[i].private_app !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_app_vodafone.push(data[i].private_app);
                        }
                    }
                    if (data[i].private_audio !== undefined && data[i].private_audio !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_audio_vodafone.push(data[i].private_audio);
                        }
                    }
                    if (data[i].private_image !== undefined && data[i].private_image !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_image_vodafone.push(data[i].private_image);
                        }
                    }
                    if (data[i].private_font !== undefined && data[i].private_font !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_font_vodafone.push(data[i].private_font);
                        }
                    }
                    if (data[i].private_text !== undefined && data[i].private_text !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_text_vodafone.push(data[i].private_text);
                        }
                    }
                    if (data[i].private_others !== undefined && data[i].private_others !== 'null') {
                        if (data[i].isp === 'vodafone') {
                            private_others_vodafone.push(data[i].private_others);
                        }
                    }
                }

                var ttl_vodafone = {
                    datasets: [
                    {
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: max_age_audio_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: max_age_video_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: max_age_others_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: max_age_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: max_age_text_vodafone
                    },{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: max_age_app_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: max_age_image_vodafone
                    }],
                        labels: ['Ιστόγραμμα κατανομής των TTL των ιστοαντικειμένων στην απόκριση, ανά CONTENT-TYPE, με πάροχο Vodafone']
                }
                var max_stale = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: max_stale_app_vodafone
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: max_stale_audio_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: max_stale_image_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: max_stale_video_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: max_stale_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: max_stale_text_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: max_stale_others_vodafone
                    }],
                    labels: ["Ποσοστό Max-Stale directives επί του συνόλου των αιτήσεων ανά CONTENT TYPE, με πάροχο Vodafone"]
                }
                var min_fresh = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: min_fresh_app_vodafone
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: min_fresh_audio_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: min_fresh_image_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: min_fresh_video_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: min_fresh_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: min_fresh_text_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: min_fresh_others_vodafone
                    }],
                    labels: ["Ποσοστό Min-Fresh directives επί του συνόλου των αιτήσεων ανά CONTENT-TYPE, με πάροχο Vodafone"]
                }
                var no_cache = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: no_cache_app_vodafone
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: no_cache_audio_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: no_cache_image_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: no_cache_video_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: no_cache_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: no_cache_text_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: no_cache_others_vodafone
                    }],
                    labels: ["Ποσοστό cache ability directives no-cache επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Vodafone"]
                }
                var no_store = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: no_store_app_vodafone
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: no_store_audio_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: no_store_image_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: no_store_video_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: no_store_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: no_store_text_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: no_store_others_vodafone
                    }],
                    labels: ["Ποσοστό cache ability directives no-store επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Vodafone"]
                }
                var public = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: public_app_vodafone
                    },{
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: public_audio_vodafone
                    },{
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: public_image_vodafone
                    },{
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: public_video_vodafone
                    },{
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: public_font_vodafone
                    },{
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: public_text_vodafone
                    },{
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: public_others_vodafone
                    }],
                    labels: ["Ποσοστό cache ability directives public επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Vodafone"]
                }
                var private = {
                    datasets: [{
                        label: 'Application',
                        backgroundColor: '#005f5c',
                        data: private_app_vodafone
                    }, {
                        label: 'Audio',
                        backgroundColor: '#551800',
                        data: private_audio_vodafone
                    }, {
                        label: 'Image',
                        backgroundColor: '#525800',
                        data: private_image_vodafone
                    }, {
                        label: 'Video',
                        backgroundColor: '#370055',
                        data: private_video_vodafone
                    }, {
                        label: 'Font',
                        backgroundColor: '#0c1d2d',
                        data: private_font_vodafone
                    }, {
                        label: 'Text',
                        backgroundColor: '#74a500',
                        data: private_text_vodafone
                    }, {
                        label: 'Others',
                        backgroundColor: '#cb592e',
                        data: private_others_vodafone
                    }],
                    labels: ["Ποσοστό cache ability directives private επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE, με πάροχο Vodafone"]
                }

                $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                var graphTarget = $("#graphCanvas");
                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: ttl_vodafone
                })

                $("#1").click(function() {
                    $('#graphCanvas').remove();
                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: ttl_vodafone
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