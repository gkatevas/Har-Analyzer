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
    <title>Οπτικοποίηση δεδομένων</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        #map{
            height: 500px;
            width: 1200px;
            margin-right: auto;
            margin-left: auto;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css">
    <script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body>
<div style="text-align: center;" class='container mt-5'>
    <h5>Οι τοποθεσίες των IPs στις οποίες έχουν αποσταλεί HTTP αιτήσεις:</h5>
    <div id="map" ></div>
</div>

<script type="text/javascript">
    let geojson;

    $.getJSON("../back-end/return_entries_map.php", function(data) {
        geojson = data;
        const dataPoint = geojson.data;
        let coordinates = [];

        for (let i = 0; i < dataPoint.length; i++) {
            coordinates.push([Number(dataPoint[i].lat), Number(dataPoint[i].lng)],[Number(dataPoint[i].lat_dest), Number(dataPoint[i].lng_dest)]);
        }

        // visualize the markers on the map
        for (let i = 0; i < coordinates.length; i++) {
            L.marker(coordinates[i]).addTo(map)
                .bindPopup("<b>Latitude:</b> " + coordinates[i][0] + " <b>Longitude:</b> " + coordinates[i][1]);
        }

        var count_max = 0;
        dataPoint.forEach(function (item) {
            var count = item.count;
            if (count_max < count){
                count_max = count;
            }
        })

        var color;
        dataPoint.forEach(function (item) {
            var origin = new L.LatLng(item.lat, item.lng);
            var dest = new L.LatLng(item.lat_dest, item.lng_dest);
            var count = item.count/count_max;
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            color= "rgb("+r+" ,"+g+","+ b+")";
            L.polyline([origin, dest], { color: color, weight: count}).addTo(map);
        });

        map.setView(new L.LatLng(38.3886, 21.8287), 2);
    });

    const map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

</script>
</body>
</html>