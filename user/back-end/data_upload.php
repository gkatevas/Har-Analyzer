<?php
session_start();

set_time_limit(0);
error_reporting(E_ALL);
ob_implicit_flush(TRUE);
ob_end_flush();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'web2021');

// GET USER ID
$get_id = $_SESSION['myid'];

// GET LAST HEADER ID
$query = "SELECT * FROM userdata";
$resultsdb = mysqli_query($db, $query);

if (mysqli_num_rows($resultsdb) != null) {
    $stmt = $db->prepare("SELECT headers_id FROM userdata WHERE userid='$get_id' ORDER BY a_inc DESC LIMIT 1");
    $stmt->execute();
    $resultdb = $stmt->get_result();
    $valuedb = $resultdb->fetch_object();
    $header_id = $valuedb->headers_id;
} else {
    $header_id = 0;
}
$temp_header_id = $header_id;

if (isset($_POST["myData"]) and ($get_id != 0) and (isset($temp_header_id))) {
//    $json = file_get_contents('php://input');
//    $dataObject = json_decode($json);
//    $dataArray = json_decode($json, true);
    $userdata = array();
    $response_header = array();
    $headers = array();
    $lat = "null";
    $lon = "null";
    $isp = "null";

    //GET DATA FROM CLIENT
    $dataObject = $_POST["myData"];
    $dataArray= json_decode($dataObject,true);

    $req_content_type="null";
    $req_cache_control="null";
    $req_pragma="null";
    $req_expires="null";
    $req_age="null";
    $req_last_modified="null";
    $req_host="null";
    $res_content_type="null";
    $res_cache_control="null";
    $res_pragma="null";
    $res_expires="null";
    $res_age="null";
    $res_last_modified="null";
    $res_host="null";
    //error_log(print_r($dataArray, TRUE));
    if (isset($dataArray['entries'])) {
        $date = date('Y-m-d H:i:s'); //date of upload
        $counter = 0;

        foreach ($dataArray['entries'] as $data) {
            $flag = 0;
            $data2 = $data;
            if (isset($data['serverIPAddress'])) {
                $serverIPAddress = $data['serverIPAddress'];
            } else {
                $serverIPAddress = null;
            }
            if (isset($data['startedDateTime'])) {
                $startedDateTime = $data['startedDateTime'];
                $time = date("Y-m-d H:i:s", strtotime($startedDateTime));
            } else {
                $startedDateTime = null;
            }
            if (isset($data['timings']['wait'])) {
                $wait = $data['timings']['wait'];
            } else {
                $wait = null;
            }
            if (isset($data['response']['statusText'])) {
                $statusText = $data['response']['statusText'];
            } else {
                $statusText = null;
            }
            if (isset($data['response']['status'])) {
                $status = $data['response']['status'];
            } else {
                $status = null;
            }
            if (isset($data['request']['url'])) {
                $url = $data['request']['url'];
                if (strpos($url, ".php") !== false) {
                    $flag = 1;
                }elseif (strpos($url, ".html") !== false) {
                    $flag = 1;
                }elseif (strpos($url, ".htm") !== false) {
                    $flag = 1;
                }elseif (strpos($url, ".jsp") !== false) {
                    $flag = 1;
                }
                $domain = parse_url($url, PHP_URL_HOST);
            } else {
                $domain = null;
            }

            if (isset($data['request']['method'])) {
                $method = $data['request']['method'];
            } else {
                $method = null;
            }

//          GET SYNTETAGMENES GIA UPLOAD
            if ($isp == "null" or $lat == "null" or $lon == "null") {
                $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $_REQUEST['REMOTE_ADDR']));
                if ($query && $query['status'] == 'success') {
                    $isp = $query['isp'];
                    $lat = $query['lat'];
                    $lon = $query['lon'];
                }
            }

            // GET SYNTETAGMENES GIA SERVER
//            if ($ip_server != null) {
//                $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip_server));
//                if ($query && $query['status'] == 'success') {
//                    $server_lat = $query['lat'];
//                    $server_lon = $query['lon'];
//                }
//            }

            // GET SYNTETAGMENES GIA SERVER
            if ($serverIPAddress != null) {
                $details = json_decode(file_get_contents("http://ipinfo.io/[$serverIPAddress]?token=3fdebe16ccdbad"));
                list($server_lat, $server_lon) = explode(',', $details->loc);
            } else {
                $server_lat = null;
                $server_lon = null;
            }

//            $access_key = '401203ccd2266eea86741916d9cba866';
//            $ipadrress = $_SERVER['REMOTE_ADDR'];
//            $ch = file_get_contents('http://api.ipstack.com/'.$ipadrress.'?access_key='.$access_key.'');
//            $result_data = json_decode($ch, true);
//            if (isset($result_data['connection']['isp'])){
//                $isp = $result_data['connection']['isp']; problem here
//            } else {
//                $isp = "null";
//            }
//            if (isset($result_data['latitude'])) {
//                $lat = $result_data['latitude'];
//            } else {
//                $lat = "null";
//            }
//            if (isset($result_data['longitude'])) {
//                $lon = $result_data['longitude'];
//            } else{
//                $lon = "null";
//            }
//
//            if ($ip_server != null) {
//                $access_key = '401203ccd2266eea86741916d9cba866';
//                $ch = file_get_contents('http://api.ipstack.com/'.$ip_server.'?access_key='.$access_key.'');
//                $result_d = json_decode($ch, true);
//                $server_lat = $result_d['latitude'];
//                $server_lon = $result_d['longitude'];
//            }

            // PREPARE: INSERT TO DATABASE THE VALUES FROM ENTRIES
            $temp_header_id = $temp_header_id + 1;

            $headers[$counter]['startedDateTime'] = $time;
            $userdata[$counter]['serverIPAddress'] = $serverIPAddress;
            $headers[$counter]['wait'] = $wait;
            $headers[$counter]['method'] = $method;
            $userdata[$counter]['domain'] = $domain;
            $userdata[$counter]['status'] = $status;
            $userdata[$counter]['statusText'] = $statusText;
            $headers[$counter]['isp'] = $isp;
            $userdata[$counter]['userid'] = $get_id;
            $userdata[$counter]['headers_id'] = $temp_header_id;
            $headers[$counter]['server_lat'] = $server_lat;
            $headers[$counter]['server_lon'] = $server_lon;
            $headers[$counter]['latitude'] = $lat;
            $headers[$counter]['longitude'] = $lon;

            // UPDATE THE DATE FOR LAST UPLOAD FROM USER
            $sql= "UPDATE users SET last_upload= '$date' WHERE id='$get_id' ";
            mysqli_query($db,$sql);

            if (isset($data['request']['headers'])) {
                foreach ($data['request']['headers'] as $data2 => $value) {
                    if ($value['name'] == "content-type" || $value['name'] == "Content-Type") {
                        $req_content_type = $value['value'];
                    }
                    if ($value['name'] == "cache-control" || $value['name'] == "Cache-Control") {
                        $req_cache_control = $value['value'];
                    }
                    if ($value['name'] == "pragma" || $value['name'] == "Pragma") {
                        $req_pragma = $value['value'];
                    }
                    if ($value['name'] == "expires" || $value['name'] == "Expires") {
                        $pattern = "/(?:\d*+[^\.])++/";
                        preg_match($pattern, $value['value'],$matches);
                        $temp_format = date_create_from_format("D, d M Y H:i:s e", $matches[0]);
                        $req_expires = date_format($temp_format, 'Y-m-d H:i:s');
                    }
                    if ($value['name'] == "age" || $value['name'] == "Age") {
                        $req_age = $value['value'];
                    }
                    if($value['name'] == "last-modified" || $value['name'] == "Last-Modified"){
                        $pattern = "/(?:\d*+[^\.])++/";
                        preg_match($pattern, $value['value'],$matches);
                        $temp_format = date_create_from_format("D, d M Y H:i:s e", $matches[0]);
                        $req_last_modified = date_format($temp_format, 'Y-m-d H:i:s');
                    }
                    if ($value['name'] == "host" || $value['name'] == "Host") {
                        $req_host = $value['value'];
                    }
                }
                    if (($req_content_type == "null") and ($flag==1)) {
                        $req_content_type = "text/html";
                    }
            }
            $headers[$counter]['req_contenttype'] = $req_content_type;
            $headers[$counter]['req_cachecontrol'] = $req_cache_control;
            $headers[$counter]['req_pragma'] = $req_pragma;
            $headers[$counter]['req_age'] = $req_age;
            $headers[$counter]['req_host'] = $req_host;

            if (isset($data['response']['headers'])) {
                foreach ($data['response']['headers'] as $data => $value) {
                    if ($value['name'] == "content-type" || $value['name'] == "Content-Type") {
                        $res_content_type = $value['value'];
                    }
                    if ($value['name'] == "cache-control" || $value['name'] == "Cache-Control") {
                        $res_cache_control = $value['value'];
                    }
                    if ($value['name'] == "pragma" || $value['name'] == "Pragma") {
                        $res_pragma = $value['value'];
                    }
                    if ($value['name'] == "expires" || $value['name'] == "Expires") {
                        $pattern = "/(?:\d*+[^\.])++/";
                        preg_match($pattern, $value['value'],$matches);
                        if (isset($matches[0])) {
                            $temp_format = date_create_from_format("D, d M Y H:i:s e", $matches[0]);
                        }
                        if ($temp_format) {
                            $res_expires = date_format($temp_format, 'Y-m-d H:i:s');
                        }
                    }
                    if ($value['name'] == "age" || $value['name'] == "Age") {
                        $res_age = $value['value'];
                    }
                    if ($value['name'] == "last-modified" || $value['name'] == "Last-Modified") {
                        $pattern = "/(?:\d*+[^\.])++/";
                        preg_match($pattern, $value['value'], $matches);
                        if (isset($matches[0])) {
                            $temp_format = date_create_from_format("D, d M Y H:i:s e", $matches[0]);
                        }
                        if ($temp_format) {
                            $res_last_modified = date_format($temp_format, 'Y-m-d H:i:s');
                        }
                    }
                    if ($value['name'] == "host" || $value['name'] == "Host") {
                        $res_host = $value['value'];
                    }
                    if (($res_content_type == "null") and ($flag==1)) {
                        $res_content_type = "text/html";
                    }
                }
            }

            $headers[$counter]['contenttype'] = $res_content_type;
            $headers[$counter]['cachecontrol'] = $res_cache_control;
            $headers[$counter]['pragma'] = $res_pragma;
            $headers[$counter]['expires'] = $res_expires;
            $headers[$counter]['age'] = $res_age;
            $headers[$counter]['lastmodified'] = $res_last_modified;
            $headers[$counter]['userid'] = $get_id;
            $headers[$counter]['headers_id'] = $temp_header_id;

            // RESET
            $req_content_type="null";
            $req_cache_control="null";
            $req_pragma="null";
            $req_expires="null";
            $req_age="null";
            $req_last_modified="null";
            $req_host="null";
            $res_content_type="null";
            $res_cache_control="null";
            $res_pragma="null";
            $res_expires="null";
            $res_age="null";
            $res_last_modified="null";
            $res_host="null";

            $counter = $counter + 1;
        }

        // CREATE USERDATA IMPORT VALUES
        $query = NULL;
        foreach($userdata as $value){
            $tmp = NULL;
            foreach($value as $v){
                $tmp .= ($v=='')? 'NULL,' : "'$v',";
            }
            $tmp = rtrim($tmp,',');
            $query .= "($tmp),";
        }
        $query = rtrim($query,',');
        $sql1 = "INSERT INTO userdata (serverIPAddress, url, status, statusText, userid, headers_id ) VALUES $query";

        // CREATE HEADERS IMPORT VALUES
        $query = NULL;
        foreach($headers as $value){
            $tmp = NULL;
            foreach($value as $v){
                $tmp .= ($v=='')? 'NULL,' : "'$v',";
            }
            $tmp = rtrim($tmp,',');
            $query .= "($tmp),";
        }
        $query = rtrim($query,',');
        $sql2 = "INSERT INTO headers (startedDateTime, wait, method, isp, server_lat, server_lon, latitude, longitude, req_contenttype, req_cachecontrol, req_pragma, req_age, req_host, contenttype, cachecontrol, pragma, expires, age,lastmodified, userid, headers_id) VALUES $query";

        // UPLOAD
        mysqli_query($db, $sql1); //userdata
        mysqli_query($db, $sql2); //headers

        if(mysqli_affected_rows($db))
        {
            echo "successful";
        }
        else
        {
            echo "error";
        }

    }
}

