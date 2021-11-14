<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'web2021');

$data = array();
$total_users = null;
$diff_isp = null;
$diff_domain = null;
$get_count = null;
$post_count = null;

$user_check_query = "SELECT count(*) as total from users";
$result = mysqli_query($db, $user_check_query);
$users = mysqli_fetch_assoc($result);
$total_users = $users['total'] - 1;
array_push($data,$total_users);

$user_check_query = "SELECT count(DISTINCT(isp)) as isp from headers";
$result = mysqli_query($db, $user_check_query);
$userdata = mysqli_fetch_assoc($result);
$diff_isp = $userdata['isp'];
array_push($data,$diff_isp);

$user_check_query = "SELECT count(DISTINCT(url)) as domain from userdata";
$result = mysqli_query($db, $user_check_query);
$userdata = mysqli_fetch_assoc($result);
$diff_domain = $userdata['domain'];
array_push($data,$diff_domain);

$user_check_query = "SELECT count(*) as method_get from headers WHERE method='GET'";
$result = mysqli_query($db, $user_check_query);
$userdata = mysqli_fetch_assoc($result);
$get_count = $userdata['method_get'];
array_push($data,$get_count);

$user_check_query = "SELECT count(*) as method_post from headers WHERE method='POST'";
$result = mysqli_query($db, $user_check_query);
$userdata = mysqli_fetch_assoc($result);
$post_count = $userdata['method_post'];
array_push($data,$post_count);

$query = "SELECT startedDateTime, lastmodified, contenttype, count(*) AS counter FROM headers GROUP BY contenttype";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)) {
    $startedDateTime = strtotime($row['startedDateTime']);
    $lastmodified = strtotime($row['lastmodified']);
    $mesos_oros = ($startedDateTime - $lastmodified) / $row['counter'];
    $days = $mesos_oros / 86400;
    $content_type =  "Για '" . $row['contenttype'] . "' η μέση ηλικία (σε ημέρες) των ιστοαντικειμένων τη στιγμή που ανακτήθηκαν είναι";
    array_push($data, $content_type);
    array_push($data, $days);;
}

$query = "SELECT status, count(*) AS counter FROM userdata GROUP BY status";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)) {
    $status_count = "Το πλήθος των εγγραφών στη βάση με κωδικό (status) απόκρισης " . $row['status'] . " είναι";
    $status_count2 = $row['counter'];
    if (isset($row['status'])){
        array_push($data, $status_count);
        array_push($data, $status_count2);
    }
}

//error_log(print_r($data,TRUE));

echo json_encode($data);
exit();