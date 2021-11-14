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
    <div> Εμφάνιση της χρήσης κρυφών μνημών με βάση: </div>
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
                var max_age_video = [];
                var max_age_audio = [];
                var max_age_app = [];
                var max_age_image = [];
                var max_age_font = [];
                var max_age_text = [];
                var max_age_others = [];
                var max_stale_video = [];
                var max_stale_audio = [];
                var max_stale_app = [];
                var max_stale_image = [];
                var max_stale_font = [];
                var max_stale_text = [];
                var max_stale_others = [];
                var min_fresh_video = [];
                var min_fresh_audio = [];
                var min_fresh_app = [];
                var min_fresh_image = [];
                var min_fresh_font = [];
                var min_fresh_text = [];
                var min_fresh_others = [];
                var no_cache_video = [];
                var no_cache_audio = [];
                var no_cache_app = [];
                var no_cache_image = [];
                var no_cache_font = [];
                var no_cache_text = [];
                var no_cache_others = [];
                var no_store_video = [];
                var no_store_audio = [];
                var no_store_app = [];
                var no_store_image = [];
                var no_store_font = [];
                var no_store_text = [];
                var no_store_others = [];
                var public_video = [];
                var public_audio = [];
                var public_app = [];
                var public_image = [];
                var public_font = [];
                var public_text = [];
                var public_others = [];
                var private_video = [];
                var private_audio = [];
                var private_app = [];
                var private_image = [];
                var private_font = [];
                var private_text = [];
                var private_others = [];

                // console.log(data);
                for (var i in data) {
                    // MAX AGE
                    if (data[i].max_age_video !== undefined && data[i].max_age_video !== 'null') {
                        max_age_video.push(data[i].max_age_video);
                    }
                    if (data[i].max_age_app !== undefined && data[i].max_age_app !== 'null') {
                        max_age_app.push(data[i].max_age_app);
                    }
                    if (data[i].max_age_audio !== undefined && data[i].max_age_audio !== 'null') {
                        max_age_audio.push(data[i].max_age_audio);
                    }
                    if (data[i].max_age_image !== undefined && data[i].max_age_image !== 'null') {
                        max_age_image.push(data[i].max_age_image);
                    }
                    if (data[i].max_age_font !== undefined && data[i].max_age_font !== 'null') {
                        max_age_font.push(data[i].max_age_font);
                    }
                    if (data[i].max_age_text !== undefined && data[i].max_age_text !== 'null') {
                        max_age_text.push(data[i].max_age_text);
                    }
                    if (data[i].max_age_others !== undefined && data[i].max_age_others !== 'null') {
                        max_age_others.push(data[i].max_age_others);
                    }
                    // MAX STALES
                    if (data[i].max_stale_video !== undefined && data[i].max_stale_video !== 'null') {
                        max_stale_video.push(data[i].max_stale_video);
                    }
                    if (data[i].max_stale_app !== undefined && data[i].max_stale_app !== 'null') {
                        max_stale_app.push(data[i].max_stale_app);
                    }
                    if (data[i].max_stale_audio !== undefined && data[i].max_stale_audio !== 'null') {
                        max_stale_audio.push(data[i].max_stale_audio);
                    }
                    if (data[i].max_stale_image !== undefined && data[i].max_stale_image !== 'null') {
                        max_stale_image.push(data[i].max_stale_image);
                    }
                    if (data[i].max_stale_font !== undefined && data[i].max_stale_font !== 'null') {
                        max_stale_font.push(data[i].max_stale_font);
                    }
                    if (data[i].max_stale_text !== undefined && data[i].max_stale_text !== 'null') {
                        max_stale_text.push(data[i].max_stale_text);
                    }
                    if (data[i].max_stale_others !== undefined && data[i].max_stale_others !== 'null') {
                        max_stale_others.push(data[i].max_stale_others);
                    }
                    //  MIN FRESH
                    if (data[i].min_fresh_video !== undefined && data[i].min_fresh_video !== 'null') {
                        min_fresh_video.push(data[i].min_fresh_video);
                    }
                    if (data[i].min_fresh_app !== undefined && data[i].min_fresh_app !== 'null') {
                        min_fresh_app.push(data[i].min_fresh_app);
                    }
                    if (data[i].min_fresh_audio !== undefined && data[i].min_fresh_audio !== 'null') {
                        min_fresh_audio.push(data[i].min_fresh_audio);
                    }
                    if (data[i].min_fresh_image !== undefined && data[i].min_fresh_image !== 'null') {
                        min_fresh_image.push(data[i].min_fresh_image);
                    }
                    if (data[i].min_fresh_font !== undefined && data[i].min_fresh_font !== 'null') {
                        min_fresh_font.push(data[i].min_fresh_font);
                    }
                    if (data[i].min_fresh_text !== undefined && data[i].min_fresh_text !== 'null') {
                        min_fresh_text.push(data[i].min_fresh_text);
                    }
                    if (data[i].min_fresh_others !== undefined && data[i].min_fresh_others !== 'null') {
                        min_fresh_others.push(data[i].min_fresh_others);
                    }
                    //  NO CACHE
                    if (data[i].no_cache_video !== undefined && data[i].no_cache_video !== 'null') {
                        no_cache_video.push(data[i].no_cache_video);
                    }
                    if (data[i].no_cache_app !== undefined && data[i].no_cache_app !== 'null') {
                        no_cache_app.push(data[i].no_cache_app);
                    }
                    if (data[i].no_cache_audio !== undefined && data[i].no_cache_audio !== 'null') {
                        no_cache_audio.push(data[i].no_cache_audio);
                    }
                    if (data[i].no_cache_image !== undefined && data[i].no_cache_image !== 'null') {
                        no_cache_image.push(data[i].no_cache_image);
                    }
                    if (data[i].no_cache_font !== undefined && data[i].no_cache_font !== 'null') {
                        no_cache_font.push(data[i].no_cache_font);
                    }
                    if (data[i].no_cache_text !== undefined && data[i].no_cache_text !== 'null') {
                        no_cache_text.push(data[i].no_cache_text);
                    }
                    if (data[i].no_cache_others !== undefined && data[i].no_cache_others !== 'null') {
                        no_cache_others.push(data[i].no_cache_others);
                    }
                    //  NO STORE
                    if (data[i].no_store_video !== undefined && data[i].no_store_video !== 'null') {
                        no_store_video.push(data[i].no_store_video);
                    }
                    if (data[i].no_store_app !== undefined && data[i].no_store_app !== 'null') {
                        no_store_app.push(data[i].no_store_app);
                    }
                    if (data[i].no_store_audio !== undefined && data[i].no_store_audio !== 'null') {
                        no_store_audio.push(data[i].no_store_audio);
                    }
                    if (data[i].no_store_image !== undefined && data[i].no_store_image !== 'null') {
                        no_store_image.push(data[i].no_store_image);
                    }
                    if (data[i].no_store_font !== undefined && data[i].no_store_font !== 'null') {
                        no_store_font.push(data[i].no_store_font);
                    }
                    if (data[i].no_store_text !== undefined && data[i].no_store_text !== 'null') {
                        no_store_text.push(data[i].no_store_text);
                    }
                    if (data[i].no_store_others !== undefined && data[i].no_store_others !== 'null') {
                        no_store_others.push(data[i].no_store_others);
                    }
                    //  PUBLIC
                    if (data[i].public_video !== undefined && data[i].public_video !== 'null') {
                        public_video.push(data[i].public_video);
                    }
                    if (data[i].public_app !== undefined && data[i].public_app !== 'null') {
                        public_app.push(data[i].public_app);
                    }
                    if (data[i].public_audio !== undefined && data[i].public_audio !== 'null') {
                        public_audio.push(data[i].public_audio);
                    }
                    if (data[i].public_image !== undefined && data[i].public_image !== 'null') {
                        public_image.push(data[i].public_image);
                    }
                    if (data[i].public_font !== undefined && data[i].public_font !== 'null') {
                        public_font.push(data[i].public_font);
                    }
                    if (data[i].public_text !== undefined && data[i].public_text !== 'null') {
                        public_text.push(data[i].public_text);
                    }
                    if (data[i].public_others !== undefined && data[i].public_others !== 'null') {
                        public_others.push(data[i].public_others);
                    }
                    //  PRIVATE
                    if (data[i].private_video !== undefined && data[i].private_video !== 'null') {
                        private_video.push(data[i].private_video);
                    }
                    if (data[i].private_app !== undefined && data[i].private_app !== 'null') {
                        private_app.push(data[i].private_app);
                    }
                    if (data[i].private_audio !== undefined && data[i].private_audio !== 'null') {
                        private_audio.push(data[i].private_audio);
                    }
                    if (data[i].private_image !== undefined && data[i].private_image !== 'null') {
                        private_image.push(data[i].private_image);
                    }
                    if (data[i].private_font !== undefined && data[i].private_font !== 'null') {
                        private_font.push(data[i].private_font);
                    }
                    if (data[i].private_text !== undefined && data[i].private_text !== 'null') {
                        private_text.push(data[i].private_text);
                    }
                    if (data[i].private_others !== undefined && data[i].private_others !== 'null') {
                        private_others.push(data[i].private_others);
                    }
                }
                // SUM MAX AGE
                var sum_max_age_font = new Array();
                for (var i = 0; i < max_age_font.length; ++i) {
                    sum_max_age_font = max_age_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_audio = new Array();
                for (var i = 0; i < max_age_audio.length; ++i) {
                    sum_max_age_audio = max_age_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_app = new Array();
                for (var i = 0; i < max_age_app.length; ++i) {
                    sum_max_age_app = max_age_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_text = new Array();
                for (var i = 0; i < max_age_text.length; ++i) {
                    sum_max_age_text = max_age_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_video = new Array();
                for (var i = 0; i < max_age_video.length; ++i) {
                    sum_max_age_video = max_age_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_image = new Array();
                for (var i = 0; i < max_age_image.length; ++i) {
                    sum_max_age_image = max_age_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_age_others = new Array();
                for (var i = 0; i < max_age_others.length; ++i) {
                    sum_max_age_others = max_age_others.reduce((a, n) => (a + Number(n)), 0);
                }
                // SUM MAX STALE
                var sum_max_stale_font = new Array();
                for (var i = 0; i < max_stale_font.length; ++i) {
                    sum_max_stale_font = max_stale_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_audio = new Array();
                for (var i = 0; i < max_stale_audio.length; ++i) {
                    sum_max_stale_audio = max_stale_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_app = new Array();
                for (var i = 0; i < max_stale_app.length; ++i) {
                    sum_max_stale_app = max_stale_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_text = new Array();
                for (var i = 0; i < max_stale_text.length; ++i) {
                    sum_max_stale_text = max_stale_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_video = new Array();
                for (var i = 0; i < max_stale_video.length; ++i) {
                    sum_max_stale_video = max_stale_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_image = new Array();
                for (var i = 0; i < max_stale_image.length; ++i) {
                    sum_max_stale_image = max_stale_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_max_stale_others = new Array();
                for (var i = 0; i < max_stale_others.length; ++i) {
                    sum_max_stale_others = max_stale_others.reduce((a, n) => (a + Number(n)), 0);
                }
                // SUM MIN FRESH
                var sum_min_fresh_font = new Array();
                for (var i = 0; i < min_fresh_font.length; ++i) {
                    sum_min_fresh_font = min_fresh_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_audio = new Array();
                for (var i = 0; i < min_fresh_audio.length; ++i) {
                    sum_min_fresh_audio = min_fresh_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_app = new Array();
                for (var i = 0; i < min_fresh_app.length; ++i) {
                    sum_min_fresh_app = min_fresh_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_text = new Array();
                for (var i = 0; i < min_fresh_text.length; ++i) {
                    sum_min_fresh_text = min_fresh_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_video = new Array();
                for (var i = 0; i < min_fresh_video.length; ++i) {
                    sum_min_fresh_video = min_fresh_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_image = new Array();
                for (var i = 0; i < min_fresh_image.length; ++i) {
                    sum_min_fresh_image = min_fresh_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_min_fresh_others = new Array();
                for (var i = 0; i < min_fresh_others.length; ++i) {
                    sum_min_fresh_others = min_fresh_others.reduce((a, n) => (a + Number(n)), 0);
                }
                // SUM PRIVATE
                var sum_private_font = new Array();
                for (var i = 0; i < private_font.length; ++i) {
                    sum_private_font = private_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_audio = new Array();
                for (var i = 0; i < private_audio.length; ++i) {
                    sum_private_audio = private_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_app = new Array();
                for (var i = 0; i < private_app.length; ++i) {
                    sum_private_app = private_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_text = new Array();
                for (var i = 0; i < private_text.length; ++i) {
                    sum_private_text = private_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_video = new Array();
                for (var i = 0; i < private_video.length; ++i) {
                    sum_private_video = private_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_image = new Array();
                for (var i = 0; i < private_image.length; ++i) {
                    sum_private_image = private_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_private_others = new Array();
                for (var i = 0; i < private_others.length; ++i) {
                    sum_private_others = private_others.reduce((a, n) => (a + Number(n)), 0);
                }
               // SUM NO CACHE
                var sum_no_cache_font = new Array();
                for (var i = 0; i < no_cache_font.length; ++i) {
                    sum_no_cache_font = no_cache_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_audio = new Array();
                for (var i = 0; i < no_cache_audio.length; ++i) {
                    sum_no_cache_audio = no_cache_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_app = new Array();
                for (var i = 0; i < no_cache_app.length; ++i) {
                    sum_no_cache_app = no_cache_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_text = new Array();
                for (var i = 0; i < no_cache_text.length; ++i) {
                    sum_no_cache_text = no_cache_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_video = new Array();
                for (var i = 0; i < no_cache_video.length; ++i) {
                    sum_no_cache_video = no_cache_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_image = new Array();
                for (var i = 0; i < no_cache_image.length; ++i) {
                    sum_no_cache_image = no_cache_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_cache_others = new Array();
                for (var i = 0; i < no_cache_others.length; ++i) {
                    sum_no_cache_others = no_cache_others.reduce((a, n) => (a + Number(n)), 0);
                }
                // SUM NO STORE
                var sum_no_store_font = new Array();
                for (var i = 0; i < no_store_font.length; ++i) {
                    sum_no_store_font = no_store_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_audio = new Array();
                for (var i = 0; i < no_store_audio.length; ++i) {
                    sum_no_store_audio = no_store_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_app = new Array();
                for (var i = 0; i < no_store_app.length; ++i) {
                    sum_no_store_app = no_store_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_text = new Array();
                for (var i = 0; i < no_store_text.length; ++i) {
                    sum_no_store_text = no_store_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_video = new Array();
                for (var i = 0; i < no_store_video.length; ++i) {
                    sum_no_store_video = no_store_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_image = new Array();
                for (var i = 0; i < no_store_image.length; ++i) {
                    sum_no_store_image = no_store_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_no_store_others = new Array();
                for (var i = 0; i < no_store_others.length; ++i) {
                    sum_no_store_others = no_store_others.reduce((a, n) => (a + Number(n)), 0);
                }
                // SUM PUBLIC
                var sum_public_font = new Array();
                for (var i = 0; i < public_font.length; ++i) {
                    sum_public_font = public_font.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_audio = new Array();
                for (var i = 0; i < public_audio.length; ++i) {
                    sum_public_audio = public_audio.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_app = new Array();
                for (var i = 0; i < public_app.length; ++i) {
                    sum_public_app = public_app.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_text = new Array();
                for (var i = 0; i < public_text.length; ++i) {
                    sum_public_text = public_text.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_video = new Array();
                for (var i = 0; i < public_video.length; ++i) {
                    sum_public_video = public_video.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_image = new Array();
                for (var i = 0; i < public_image.length; ++i) {
                    sum_public_image = public_image.reduce((a, n) => (a + Number(n)), 0);
                }
                var sum_public_others = new Array();
                for (var i = 0; i < public_others.length; ++i) {
                    sum_public_others = public_others.reduce((a, n) => (a + Number(n)), 0);
                }
                var ttl = {
                        datasets: [
                        {
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_max_age_audio]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_max_age_video]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_max_age_others]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_max_age_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_max_age_text]
                        },{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_max_age_app]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_max_age_image]
                        }],
                        labels: ['Ιστόγραμμα κατανομής των TTL των ιστοαντικειμένων στην απόκριση, ανά CONTENT-TYPE']
                    }
                    var max_stale = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_max_stale_app]
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_max_stale_audio]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_max_stale_image]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_max_stale_video]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_max_stale_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_max_stale_text]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_max_stale_others]
                        }],
                        labels: ["Ποσοστό Max-Stale directives επί του συνόλου των αιτήσεων ανά CONTENT TYPE"]
                    }
                    var min_fresh = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_min_fresh_app]
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_min_fresh_audio]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_min_fresh_image]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_min_fresh_video]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_min_fresh_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_min_fresh_text]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_min_fresh_others]
                        }],
                        labels: ["Ποσοστό Min-Fresh directives επί του συνόλου των αιτήσεων ανά CONTENT-TYPE"]
                    }
                    var no_cache = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_no_cache_app]
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_no_cache_audio]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_no_cache_image]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_no_cache_video]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_no_cache_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_no_cache_text]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_no_cache_others]
                        }],
                        labels: ["Ποσοστό cache ability directives no-cache επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE"]
                    }
                    var no_store = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_no_store_app]
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_no_store_audio]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_no_store_image]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_no_store_video]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_no_store_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_no_store_text]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_no_store_others]
                        }],
                        labels: ["Ποσοστό cache ability directives no-store επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE"]
                    }
                    var public = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_public_app]
                        },{
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_public_audio]
                        },{
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_public_image]
                        },{
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_public_video]
                        },{
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_public_font]
                        },{
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_public_text]
                        },{
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_public_others]
                        }],
                        labels: ["Ποσοστό cache ability directives public επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE"]
                    }
                    var private = {
                        datasets: [{
                            label: 'Application',
                            backgroundColor: '#005f5c',
                            data: [sum_private_app]
                        }, {
                            label: 'Audio',
                            backgroundColor: '#551800',
                            data: [sum_private_audio]
                        }, {
                            label: 'Image',
                            backgroundColor: '#525800',
                            data: [sum_private_image]
                        }, {
                            label: 'Video',
                            backgroundColor: '#370055',
                            data: [sum_private_video]
                        }, {
                            label: 'Font',
                            backgroundColor: '#0c1d2d',
                            data: [sum_private_font]
                        }, {
                            label: 'Text',
                            backgroundColor: '#74a500',
                            data: [sum_private_text]
                        }, {
                            label: 'Others',
                            backgroundColor: '#cb592e',
                            data: [sum_private_others]
                        }],
                        labels: ["Ποσοστό cache ability directives private επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE"]
                    }

                    $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: ttl
                    })

                    $("#1").click(function() {
                        $('#graphCanvas').remove();
                        $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                        var graphTarget = $("#graphCanvas");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: ttl
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