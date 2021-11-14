<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'web2021');
$id=$_SESSION['myid'];
$query = "SELECT * FROM userdata";
$query2 = "SELECT * FROM users";
$resultsdb = mysqli_query($db, $query);
$resultsdb2 = mysqli_query($db, $query2);
$data = array();
$last_upload = null;
$header_id = null;

if (mysqli_num_rows($resultsdb) != null) {
    $stmt = $db->prepare("SELECT headers_id FROM userdata WHERE userid='$id' ORDER BY a_inc DESC LIMIT 1");
    $stmt->execute();
    $resultdb = $stmt->get_result();
    $valuedb = $resultdb->fetch_object();
    if ($valuedb){
        $header_id = $valuedb->headers_id;
    }
}

if (mysqli_num_rows($resultsdb2) != null) {
    $stmt = $db->prepare("SELECT last_upload FROM users WHERE id='$id'");
    $stmt->execute();
    $resultdb2 = $stmt->get_result();
    $valuedb = $resultdb2->fetch_object();
    $last_upload = $valuedb->last_upload;
}
$data = array_merge($data, array("1"=>$last_upload,"0"=>$header_id));
echo json_encode($data);
exit();