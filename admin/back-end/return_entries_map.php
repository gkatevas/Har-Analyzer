<?php
$db = mysqli_connect('localhost', 'root', '', 'web2021');
$query = "SELECT server_lat, server_lon, latitude, longitude, count(*) AS counter FROM headers GROUP BY server_lat, server_lon, latitude, longitude, userid ORDER BY userid";
$result = mysqli_query($db, $query);

$json = array(
    'data'  => array()
);

while ($row = mysqli_fetch_array($result)) {
    $lat = $row['latitude'];
    $lon = $row['longitude'];
    $server_lat = $row['server_lat'];
    $server_lon = $row['server_lon'];
    $count = $row['counter'];
    if ($server_lon != null and $server_lat != null) {
        $data = array(
            'lat_dest' => $row['server_lat'],
            'lng_dest' => $row['server_lon'],
            'lat' => $row['latitude'],
            'lng' => $row['longitude'],
            'count' => $row['counter'],
        );
        array_push($json['data'], $data);
    }
}
//error_log(print_r($json,TRUE));

header('Content-type: application/json');
echo json_encode($json, JSON_NUMERIC_CHECK);
exit();