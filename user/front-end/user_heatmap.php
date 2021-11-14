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
    <title>Οπτικοποίηση δεδομένων</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>leaflet Thermodynamic chart</title>
    <link href="../../leaflet.css" rel="stylesheet" />
    <style>
        #map{
            height: 400px;
            width: 1000px;
            margin-right: auto;
            margin-left: auto;
            text-align: center;
        }
    </style>
    <script src="../../leaflet.js"></script>
    <script src="../../heatmap.min.js"></script>
    <script src="../../leaflet-heatmap.js"></script>
</head>
<body>
<div style="text-align: center;" class='container mt-5'>
    <h5>Η οπτικοποίηση των δεδομένων σας σε heatmap:</h5>
    <div id="map"></div>
</div>
<script type="text/javascript">
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../back-end/return_user_heatmap.php", true);
    ajax.send();
    ajax.onreadystatechange = function() {
        if(this.responseText.length === 0){
            // EMPTY
        }else{
            var heat_Data = JSON.parse(this.responseText);
            heatmapLayer.setData({max: 8, data: heat_Data['data']});
        }
    }

    var cfg = {
        "radius": 0.5,
        "maxOpacity": .8,
        "scaleRadius": true,
        "useLocalExtrema": true,
        latField: 'lat',
        lngField: 'lng',
        valueField: 'count'
    };
    var heatmapLayer = new HeatmapOverlay(cfg);
    var baseLayer = L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '...',
            maxZoom: 18
        }
    );
    var map = new L.Map('map', {
        center: new L.LatLng(37.9842, 23.7353),
        zoom: 4,
        layers: [baseLayer, heatmapLayer]
    });
</script>
</body>
</html>