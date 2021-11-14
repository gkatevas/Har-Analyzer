<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'web2021');
$id = $_SESSION['myid'];
$query = "SELECT server_lat, server_lon, count(*) AS counter FROM headers WHERE req_contenttype = 'text/html' AND userid='$id' GROUP BY server_lat, server_lon";
$result = mysqli_query($db, $query);
$json = array(
    'max'   => '8',
    'data'  => array()
);
while ($row = mysqli_fetch_array($result)) {
    $server_lat =  $row['server_lat'];
    $server_lon =  $row['server_lon'];
    $count = $row['counter'];
    $data = array(
        'lat' => $row['server_lat'],
        'lng' => $row['server_lon'],
        'count' => $row['counter'],
    );
    array_push($json['data'], $data);
}

//error_log(print_r($json,TRUE));

header('Content-type: application/json');
echo json_encode($json, JSON_NUMERIC_CHECK);
exit();