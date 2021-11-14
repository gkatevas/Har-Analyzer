<?php
$db = mysqli_connect('localhost', 'root', '', 'web2021');
$query = "SELECT contenttype, SUM(wait) AS wait FROM headers GROUP BY contenttype";
$result = mysqli_query($db, $query);
$json = array();

while ($row = mysqli_fetch_array($result) ) {
    $wait = $row['wait'];
    $content_type = $row['contenttype'];
    $video = 'video';
    $application ='application';
    $audio = 'audio';
    $image = 'image';
    $font = 'font';
    $text = 'text';
    if (strpos($content_type,$video) !== false) {
        $data = array(
            'wait_video' => $row['wait'],
            'contenttype' => $content_type,
        );
    } else if (strpos($content_type,$application) !== false){
        $data = array(
            'wait_app' => $row['wait'],
            'contenttype' => $content_type,
        );
    } else if (strpos($content_type,$audio) !== false){
        $data = array(
            'wait_audio' => $row['wait'],
            'contenttype' => $content_type,
        );
    } else if (strpos($content_type,$image) !== false){
        $data = array(
            'wait_image' => $row['wait'],
            'contenttype' => $content_type,
        );
    } else if (strpos($content_type,$font) !== false){
        $data = array(
            'wait_font' => $row['wait'],
            'contenttype' => $content_type,
        );
    } else if (strpos($content_type,$text) !== false){
        $data = array(
            'wait_text' => $row['wait'],
            'contenttype' => $content_type,
        );
    }else {
        $data = array(
            'wait_others' => $row['wait'],
            'contenttype' => $content_type,
        );
    }
    array_push($json, $data);
}

$query = "SELECT SUM(wait) AS wait, DAYNAME(startedDateTime) AS startedDateTime FROM headers GROUP BY DAYNAME(startedDateTime)";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result) ) {
    $wait = $row['wait'];
    $date = $row['startedDateTime'];
    if ($date === "Monday") {
        $data = array(
            'wait_mon' => $wait,
            'Monday' => $date,
        );
    }else if ($date === "Tuesday") {
        $data = array(
            'wait_tue' => $wait,
            'Tuesday' => $date,
        );
    }else if ($date === "Wednesday") {
        $data = array(
            'wait_wed' => $wait,
            'Wednesday' => $date,
        );
    }else if ($date === "Thursday") {
        $data = array(
            'wait_thu' => $wait,
            'Thursday' => $date,
        );
    }else if ($date === "Friday") {
        $data = array(
            'wait_fri' => $wait,
            'Friday' => $date,
        );
    }else if ($date === "Saturday") {
        $data = array(
            'wait_sat' => $wait,
            'Saturday' => $date,
        );
    }else if ($date === "Sunday") {
        $data = array(
            'wait_sun' => $wait,
            'Sunday' => $date,
        );
    }
    array_push($json, $data);
}
$query = "SELECT SUM(wait) AS wait, HOUR(startedDateTime) AS startedDateTime FROM headers GROUP BY HOUR(startedDateTime)";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result) ) {
    $wait = $row['wait'];
    $hour = $row['startedDateTime'];
    $data = array(
        'wait' => $wait,
        'hour' => $hour,
    );
    array_push($json, $data);
}
$query = "SELECT SUM(wait) AS wait, isp FROM headers GROUP BY isp";
$result = mysqli_query($db, $query);
$wait_cosmote = 0;
$wait_wind = 0;
$wait_vodafone = 0;
$wait_forthnet = 0;

while ($row = mysqli_fetch_array($result) ) {
    $wait = $row['wait'];
    $isp = strtolower($row['isp']);
    $wind = 'wind';
    $cosmote = 'ote';
    $vodafone = 'vodafone';
    $hellas = 'hellas';
    $forthnet = 'forthnet';
    if (strpos($isp,$wind) !== false) {
        $wait_wind += $wait;
    } elseif (strpos($isp,$cosmote) !== false) {
        $wait_cosmote += $wait;
    } elseif (strpos($isp,$vodafone) !== false) {
        $wait_vodafone += $wait;
    } elseif (strpos($isp,$hellas) !== false) {
        $wait_vodafone += $wait;
    }elseif (strpos($isp,$forthnet) !== false) {
        $wait_forthnet += $wait;
    }
}
$data = array(
    'wait_wind' => $wait_wind,
    'wait_forthnet' => $wait_forthnet,
    'wait_vodafone' => $wait_vodafone,
    'wait_cosmote' => $wait_cosmote,
);
array_push($json, $data);

$query = "SELECT SUM(wait) AS wait, method FROM headers GROUP BY method";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result) ) {
    $wait = $row['wait'];
    $method = $row['method'];
    if ($method === "GET") {
        $data = array(
            'wait_get' => $wait,
            'get' => $method,
        );
    }else if ($method === "POST") {
        $data = array(
            'wait_post' => $wait,
            'post' => $method,
        );
    }
    array_push($json, $data);
}

//error_log(print_r($json,TRUE));

header('Content-type: application/json');
echo json_encode($json);
