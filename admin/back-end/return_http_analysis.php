<?php
$db = mysqli_connect('localhost', 'root', '', 'web2021');
$query = "SELECT contenttype, cachecontrol, expires, lastmodified, isp FROM headers";
$result = mysqli_query($db, $query);
$json = array();
$max_age_video = [];
$max_age_audio= [];
$max_age_app = [];
$max_age_font = [];
$max_age_text = [];
$max_age_image = [];
$max_age_others = [];
$isps = [];
$counter = 0;
while ($row = mysqli_fetch_array($result) ) {
    $max_age_temp = $row['cachecontrol'];
    $isp = strtolower($row['isp']);
    $wind = 'wind';
    $cosmote = 'ote';
    $vodafone = 'vodafone';
    $hellas = 'hellas';
    $forthnet = 'forthnet';
    if (strpos($isp,$wind) !== false) {
        $isp = 'wind';
    } elseif (strpos($isp,$cosmote) !== false) {
        $isp = 'ote';
    } elseif (strpos($isp,$vodafone) !== false) {
        $isp = 'vodafone';
    } elseif (strpos($isp,$hellas) !== false) {
        $isp = 'vodafone';
    }elseif (strpos($isp,$forthnet) !== false) {
        $isp = 'forthnet';
    }
    $isps[$counter] = $isp;
    $expires = date("d", strtotime($row['expires']));
    $lastmodified = date("d", strtotime($row['lastmodified']));
    preg_match_all('/^max-age=(\d++(?=))/', $max_age_temp, $matches);
    $max_age = implode(' ', $matches[1]);
    $content_type = $row['contenttype'];
    $video = 'video';
    $application = 'application';
    $audio = 'audio';
    $image = 'image';
    $font = 'font';
    $text = 'text';
    if (strpos($content_type, $video) !== false and ($max_age > 0)) {
         if (!(isset($max_age_video[$isp]))) {
             $max_age_video[$isp] = 0;
             $max_age_video[$isp] = $max_age_video[$isp] + $max_age;
         } else
         {
            $max_age_video[$isp] = $max_age_video[$isp] + $max_age;
         }
    } else if (strpos($content_type, $video) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_video[$isp]))) {
                $max_age_video[$isp] = 0;
                $max_age_video[$isp] = $max_age_video[$isp] + $max_age;
            } else
            {
                $max_age_video[$isp] = $max_age_video[$isp] + $max_age;
            }
        }
    } else if (strpos($content_type, $application) !== false and ($max_age > 0)) {
        if (!(isset($max_age_app[$isp]))) {
            $max_age_app[$isp] = 0;
            $max_age_app[$isp] = $max_age_app[$isp] + $max_age;
        } else
        {
            $max_age_app[$isp] = $max_age_app[$isp] + $max_age;
        }
    } else if (strpos($content_type, $application) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_app[$isp]))) {
                $max_age_app[$isp] = 0;
                $max_age_app[$isp] = $max_age_app[$isp] + $max_age;
            } else
            {
                $max_age_app[$isp] = $max_age_app[$isp] + $max_age;
            }
        }
    } else if (strpos($content_type, $audio) !== false and ($max_age > 0)) {
        if (!(isset($max_age_audio[$isp]))) {
            $max_age_audio[$isp] = 0;
            $max_age_audio[$isp] = $max_age_audio[$isp] + $max_age;
        } else
        {
            $max_age_audio[$isp] = $max_age_audio[$isp] + $max_age;
        }
    } else if (strpos($content_type, $audio) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_audio[$isp]))) {
                $max_age_audio[$isp] = 0;
                $max_age_audio[$isp] = $max_age_audio[$isp] + $max_age;
            } else
            {
                $max_age_audio[$isp] = $max_age_audio[$isp] + $max_age;
            }
        }
    } else if (strpos($content_type, $image) !== false and ($max_age > 0)) {
        if (!(isset($max_age_image[$isp]))) {
            $max_age_image[$isp] = 0;
            $max_age_image[$isp] = $max_age_image[$isp] + $max_age;
        } else
        {
            $max_age_image[$isp] = $max_age_image[$isp] + $max_age;
        }
    } else if (strpos($content_type, $image) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_image[$isp]))) {
                $max_age_image[$isp] = 0;
                $max_age_image[$isp] = $max_age_image[$isp] + $max_age;
            } else
            {
                $max_age_image[$isp] = $max_age_image[$isp] + $max_age;
            }
        }
    } else if (strpos($content_type, $font) !== false and ($max_age > 0)) {
        if (!(isset($max_age_font[$isp]))) {
            $max_age_font[$isp] = 0;
            $max_age_font[$isp] = $max_age_font[$isp] + $max_age;
        } else
        {
            $max_age_font[$isp] = $max_age_font[$isp] + $max_age;
        }       } else if (strpos($content_type, $font) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_font[$isp]))) {
                $max_age_font[$isp] = 0;
                $max_age_font[$isp] = $max_age_font[$isp] + $max_age;
            } else
            {
                $max_age_font[$isp] = $max_age_font[$isp] + $max_age;
            }
        }
    } else if (strpos($content_type, $text) !== false and ($max_age > 0)) {
        if (!(isset($max_age_text[$isp]))) {
            $max_age_text[$isp] = 0;
            $max_age_text[$isp] = $max_age_text[$isp] + $max_age;
        } else
        {
            $max_age_text[$isp] = $max_age_text[$isp] + $max_age;
        }
    } else if (strpos($content_type, $text) !== false) {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_text[$isp]))) {
                $max_age_text[$isp] = 0;
                $max_age_text[$isp] = $max_age_text[$isp] + $max_age;
            } else
            {
                $max_age_text[$isp] = $max_age_text[$isp] + $max_age;
            }
        }
    } else if ($max_age > 0) {
        if (!(isset($max_age_others[$isp]))) {
            $max_age_others[$isp] = 0;
            $max_age_others[$isp] = $max_age_others[$isp] + $max_age;
        } else
        {
            $max_age_others[$isp] = $max_age_others[$isp] + $max_age;
        }
    } else {
        $max_age = $expires - $lastmodified;
        if ($max_age > 0) {
            if (!(isset($max_age_others[$isp]))) {
                $max_age_others[$isp] = 0;
                $max_age_others[$isp] = $max_age_others[$isp] + $max_age;
            } else
            {
                $max_age_others[$isp] = $max_age_others[$isp] + $max_age;
            }
        }
    }
    $counter += 1;
}
$isps_unique=array();
foreach($isps as $k=>$v){
        if(!in_array($v, $isps_unique)){
            $isps_unique[]=$v;
    }
}
foreach($isps_unique as $k=>$value) {
    if (isset($max_age_others[$value])) {
        $data = array(
            'max_age_others' => $max_age_others[$value],
            'contenttype' => 'Others',
            'isp' => $value,
        );
        array_push($json, $data);
    }
    if (isset($max_age_app[$value])) {
        $data1 = array(
            'max_age_app' => $max_age_app[$value],
            'contenttype' => 'App',
            'isp' => $value,
        );
        array_push($json, $data1);
    }
    if (isset($max_age_font[$value])) {
        $data2 = array(
            'max_age_font' => $max_age_font[$value],
            'contenttype' => 'Font',
            'isp' => $value,
        );
        array_push($json, $data2);
    }
    if (isset($max_age_text[$value])) {
        $data3 = array(
            'max_age_text' => $max_age_text[$value],
            'contenttype' => 'Text',
            'isp' => $value,
        );
        array_push($json, $data3);
    }
    if (isset($max_age_audio[$value])) {
        $data4 = array(
            'max_age_audio' => $max_age_audio[$value],
            'contenttype' => 'Audio',
            'isp' => $value,
        );
        array_push($json, $data4);
    }
    if (isset($max_age_video[$value])) {
        $data5 = array(
            'max_age_video' => $max_age_video[$value],
            'contenttype' => 'Video',
            'isp' => $value,
        );
        array_push($json, $data5);
    }
    if (isset($max_age_image[$value])) {
        $data6 = array(
            'max_age_image' => $max_age_image[$value],
            'contenttype' => 'Image',
            'isp' => $value,
        );
        array_push($json, $data6);
    }
}

$query = "SELECT contenttype, cachecontrol, isp FROM headers";
$result = mysqli_query($db, $query);

$max_stale_video_count = [];
$min_fresh_video_count = [];
$max_stale_app_count = [];
$min_fresh_app_count = [];
$max_stale_audio_count = [];
$min_fresh_audio_count = [];
$max_stale_image_count = [];
$min_fresh_image_count = [];
$max_stale_font_count = [];
$min_fresh_font_count = [];
$max_stale_text_count = [];
$min_fresh_text_count = [];
$max_stale_others_count = [];
$min_fresh_others_count = [];
$max_stale_video_count = [];
$min_fresh_video_count = [];
$max_stale_app_count = [];
$min_fresh_app_count = [];
$max_stale_audio_count = [];
$min_fresh_audio_count = [];
$max_stale_image_count = [];
$min_fresh_image_count = [];
$max_stale_font_count = [];
$min_fresh_font_count = [];
$max_stale_text_count = [];
$min_fresh_text_count = [];
$max_stale_others_count = [];
$min_fresh_others_count = [];
$conttype_others_count = [];
$conttype_video_count = [];
$conttype_app_count = [];
$conttype_audio_count = [];
$conttype_image_count = [];
$conttype_font_count = [];
$conttype_text_count = [];
$public_video_count = [];
$private_video_count = [];
$no_cache_video_count = [];
$no_store_video_count = [];
$public_app_count = [];
$private_app_count = [];
$no_cache_app_count = [];
$no_store_app_count = [];
$public_audio_count = [];
$private_audio_count = [];
$no_cache_audio_count = [];
$no_store_audio_count = [];
$public_image_count = [];
$private_image_count = [];
$no_cache_image_count = [];
$no_store_image_count = [];
$public_font_count = [];
$private_font_count = [];
$no_cache_font_count = [];
$no_store_font_count = [];
$public_text_count = [];
$private_text_count = [];
$no_cache_text_count = [];
$no_store_text_count = [];
$public_others_count = [];
$private_others_count = [];
$no_cache_others_count = [];
$no_store_others_count = [];
$counter = [];
$max_counter = [];

foreach($isps_unique as $k=>$isp) {
    $max_stale_video_count[$isp] = 0;
    $min_fresh_video_count[$isp] = 0;
    $max_stale_app_count[$isp] = 0;
    $min_fresh_app_count[$isp] = 0;
    $max_stale_audio_count[$isp] = 0;
    $min_fresh_audio_count[$isp] = 0;
    $max_stale_image_count[$isp] = 0;
    $min_fresh_image_count[$isp] = 0;
    $max_stale_font_count[$isp] = 0;
    $min_fresh_font_count[$isp] = 0;
    $max_stale_text_count[$isp] = 0;
    $min_fresh_text_count[$isp] = 0;
    $max_stale_others_count[$isp] = 0;
    $min_fresh_others_count[$isp] = 0;
    $max_stale_video_count[$isp] = 0;
    $min_fresh_video_count[$isp] = 0;
    $max_stale_app_count[$isp] = 0;
    $min_fresh_app_count[$isp] = 0;
    $max_stale_audio_count[$isp] = 0;
    $min_fresh_audio_count[$isp] = 0;
    $max_stale_image_count[$isp] = 0;
    $min_fresh_image_count[$isp] = 0;
    $max_stale_font_count[$isp] = 0;
    $min_fresh_font_count[$isp] = 0;
    $max_stale_text_count[$isp] = 0;
    $min_fresh_text_count[$isp] = 0;
    $max_stale_others_count[$isp] = 0;
    $min_fresh_others_count[$isp] = 0;
    $conttype_others_count[$isp] = 0;
    $conttype_video_count[$isp] = 0;
    $conttype_app_count[$isp] = 0;
    $conttype_audio_count[$isp] = 0;
    $conttype_image_count[$isp] = 0;
    $conttype_font_count[$isp] = 0;
    $conttype_text_count[$isp] = 0;
    $public_video_count[$isp] = 0;
    $private_video_count[$isp] = 0;
    $no_cache_video_count[$isp] = 0;
    $no_store_video_count[$isp] = 0;
    $public_app_count[$isp] = 0;
    $private_app_count[$isp] = 0;
    $no_cache_app_count[$isp] = 0;
    $no_store_app_count[$isp] = 0;
    $public_audio_count[$isp] = 0;
    $private_audio_count[$isp] = 0;
    $no_cache_audio_count[$isp] = 0;
    $no_store_audio_count[$isp] = 0;
    $public_image_count[$isp] = 0;
    $private_image_count[$isp] = 0;
    $no_cache_image_count[$isp] = 0;
    $no_store_image_count[$isp] = 0;
    $public_font_count[$isp] = 0;
    $private_font_count[$isp] = 0;
    $no_cache_font_count[$isp] = 0;
    $no_store_font_count[$isp] = 0;
    $public_text_count[$isp] = 0;
    $private_text_count[$isp] = 0;
    $no_cache_text_count[$isp] = 0;
    $no_store_text_count[$isp] = 0;
    $public_others_count[$isp] = 0;
    $private_others_count[$isp] = 0;
    $no_cache_others_count[$isp] = 0;
    $no_store_others_count[$isp] = 0;
}

while ($row = mysqli_fetch_array($result) ) {
    $isp = strtolower($row['isp']);
    $wind = 'wind';
    $cosmote = 'ote';
    $vodafone = 'vodafone';
    $hellas = 'hellas';
    $forthnet = 'forthnet';
    if (strpos($isp, $wind) !== false) {
        $isp = 'wind';
    } elseif (strpos($isp, $cosmote) !== false) {
        $isp = 'ote';
    } elseif (strpos($isp, $vodafone) !== false) {
        $isp = 'vodafone';
    } elseif (strpos($isp, $hellas) !== false) {
        $isp = 'vodafone';
    } elseif (strpos($isp, $forthnet) !== false) {
        $isp = 'forthnet';
    }
    $temp = $row['cachecontrol'];
    $public = null;
    $private = null;
    $no_cache = null;
    $no_store = null;
    preg_match_all('/max-stale=([^,]++)/', $temp, $matches);
    $max_stale = implode(' ', $matches[1]);

    preg_match_all('/min_fresh=([^,]++)/', $temp, $matches);
    $min_fresh = implode(' ', $matches[1]);

    if (preg_match('/public/', $temp)) {
        $public = True;
        if (!(isset($counter[$isp]))) {
            $counter[$isp] = 0;
            $counter[$isp] += 1;
        } else {
            $counter[$isp] += 1;
        }
    }
    if (preg_match('/private/', $temp)) {
        $private = True;
        if (!(isset($counter[$isp]))) {
            $counter[$isp] = 0;
            $counter[$isp] += 1;
        } else {
            $counter[$isp] += 1;
        }
    }

    if (preg_match('/no-cache/', $temp)) {
        $no_cache = True;
        if (!(isset($counter[$isp]))) {
            $counter[$isp] = 0;
            $counter[$isp] += 1;
        } else {
            $counter[$isp] += 1;
        }
    }

    if (preg_match('/no-store/', $temp)) {
        $no_store = True;
        if (!(isset($counter[$isp]))) {
            $counter[$isp] = 0;
            $counter[$isp] += 1;
        } else {
            $counter[$isp] += 1;
        }
    }

    $content_type = $row['contenttype'];
    $video = 'video';
    $application = 'application';
    $audio = 'audio';
    $image = 'image';
    $font = 'font';
    $text = 'text';

    if (strpos($content_type, $video) !== false) {
        if ($max_stale > 0) {
            $max_stale_video_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_video_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_video_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_video_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_video_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_video_count[$isp] += 1;
        }
        $conttype_video_count[$isp] += 1;
    } else if (strpos($content_type, $application) !== false) {
        if ($max_stale > 0) {
            $max_stale_app_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_app_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_app_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_app_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_app_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_app_count[$isp] += 1;
        }
        $conttype_app_count[$isp] += 1;
    } else if (strpos($content_type, $audio) !== false) {
        if ($max_stale > 0) {
            $max_stale_audio_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_audio_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_audio_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_audio_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_audio_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_audio_count[$isp] += 1;
        }
        $conttype_audio_count[$isp] += 1;
    } else if (strpos($content_type, $image) !== false) {
        if ($max_stale > 0) {
            $max_stale_image_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_image_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_image_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_image_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_image_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_image_count[$isp] += 1;
        }
        $conttype_image_count[$isp] += 1;
    } else if (strpos($content_type, $font) !== false) {
        if ($max_stale > 0) {
            $max_stale_font_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_font_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_font_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_font_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_font_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_font_count[$isp] += 1;
        }
        $conttype_font_count[$isp] += 1;
    } else if (strpos($content_type, $text) !== false) {
        if ($max_stale > 0) {
            $max_stale_text_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_text_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_text_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_text_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_text_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_text_count[$isp] += 1;
        }
        $conttype_text_count[$isp] += 1;
    } else {
        if ($max_stale > 0) {
            $max_stale_others_count[$isp] += 1;
        }
        if ($min_fresh > 0) {
            $min_fresh_others_count[$isp] += 1;
        }
        if (isset($public)) {
            $public_others_count[$isp] += 1;
        }
        if (isset($private)) {
            $private_others_count[$isp] += 1;
        }
        if (isset($no_cache)) {
            $no_cache_others_count[$isp] += 1;
        }
        if (isset($no_store)) {
            $no_store_others_count[$isp] += 1;
        }
        $conttype_others_count[$isp] += 1;
    }
}
foreach($isps_unique as $k=>$value) {
    if (!(isset($max_counter[$isp]))) {
        if (!(isset($max_counter[$isp]))) {
            $max_counter[$value] = 1;
            $max_counter[$value] = $max_counter[$value] + $max_stale_video_count[$value] + $max_stale_app_count[$value] + $max_stale_audio_count[$value] + $max_stale_text_count[$value] + $max_stale_font_count[$value] + $max_stale_image_count[$value] + $max_stale_others_count[$value] + $min_fresh_video_count[$value] + $min_fresh_app_count[$value] + $min_fresh_audio_count[$value] + $min_fresh_text_count[$value] + $min_fresh_font_count[$value] + $min_fresh_image_count[$value] + $min_fresh_others_count[$value];
        }
        else{
            $max_counter[$value] = $max_counter[$value] + $max_stale_video_count[$value] + $max_stale_app_count[$value] + $max_stale_audio_count[$value] + $max_stale_text_count[$value] + $max_stale_font_count[$value] + $max_stale_image_count[$value] + $max_stale_others_count[$value] + $min_fresh_video_count[$value] + $min_fresh_app_count[$value] + $min_fresh_audio_count[$value] + $min_fresh_text_count[$value] + $min_fresh_font_count[$value] + $min_fresh_image_count[$value] + $min_fresh_others_count[$value];
        }
    }
}
foreach($isps_unique as $k=>$value) {
    if ($conttype_video_count[$value] !== 0) {
        $data = array(
            'max_stale_video' => ($max_stale_video_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_video' => ($min_fresh_video_count[$value] * 100) / $max_counter[$value] ,
            'private_video' => ($private_video_count[$value] * 100) / $counter[$value],
            'public_video' => ($public_video_count[$value] * 100) / $counter[$value],
            'no_cache_video' => ($no_cache_video_count[$value] * 100) / $counter[$value],
            'no_store_video' => ($no_store_video_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Video',
        );
        array_push($json, $data);
    }
    if ($conttype_app_count[$value] !== 0) {
        $data = array(
            'max_stale_app' => ($max_stale_app_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_app' => ($min_fresh_app_count[$value] * 100) / $max_counter[$value] ,
            'private_app' => ($private_app_count[$value] * 100) / $counter[$value],
            'public_app' => ($public_app_count[$value] * 100) / $counter[$value],
            'no_cache_app' => ($no_cache_app_count[$value] * 100) / $counter[$value],
            'no_store_app' => ($no_store_app_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Application',
        );
        array_push($json, $data);
    }
    if ($conttype_image_count[$value] !== 0) {
        $data = array(
            'max_stale_image' => ($max_stale_image_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_image' => ($min_fresh_image_count[$value] * 100) / $max_counter[$value] ,
            'private_image' => ($private_image_count[$value] * 100) / $counter[$value],
            'public_image' => ($public_image_count[$value] * 100) / $counter[$value],
            'no_cache_image' => ($no_cache_image_count[$value] * 100) / $counter[$value],
            'no_store_image' => ($no_store_image_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Image',
        );
        array_push($json, $data);
    }
    if ($conttype_audio_count[$value] !== 0) {
        $data = array(
            'max_stale_audio' => ($max_stale_audio_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_audio' => ($min_fresh_audio_count[$value] * 100) / $max_counter[$value] ,
            'private_audio' => ($private_audio_count[$value] * 100) / $counter[$value],
            'public_audio' => ($public_audio_count[$value] * 100) / $counter[$value],
            'no_cache_audio' => ($no_cache_audio_count[$value] * 100) / $counter[$value],
            'no_store_audio' => ($no_store_audio_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Audio',
        );
        array_push($json, $data);
    }
    if ($conttype_text_count[$value] !== 0) {
        $data = array(
            'max_stale_text' => ($max_stale_text_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_text' => ($min_fresh_text_count[$value] * 100) / $max_counter[$value] ,
            'private_text' => ($private_text_count[$value] * 100) / $counter[$value],
            'public_text' => ($public_text_count[$value] * 100) / $counter[$value],
            'no_cache_text' => ($no_cache_text_count[$value] * 100) / $counter[$value],
            'no_store_text' => ($no_store_text_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Text',
        );
        array_push($json, $data);
    }
    if ($conttype_font_count[$value] !== 0) {
        $data = array(
            'max_stale_font' => ($max_stale_font_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_font' => ($min_fresh_font_count[$value] * 100) / $max_counter[$value] ,
            'private_font' => ($private_font_count[$value] * 100) / $counter[$value],
            'public_font' => ($public_font_count[$value] * 100) / $counter[$value],
            'no_cache_font' => ($no_cache_font_count[$value] * 100) / $counter[$value],
            'no_store_font' => ($no_store_font_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Font',
        );
        array_push($json, $data);
    }
    if ($conttype_others_count[$value] !== 0) {
        $data = array(
            'max_stale_others' => ($max_stale_others_count[$value] * 100) / $max_counter[$value] ,
            'min_fresh_others' => ($min_fresh_others_count[$value] * 100) / $max_counter[$value] ,
            'private_others' => ($private_others_count[$value] * 100) / $counter[$value],
            'public_others' => ($public_others_count[$value] * 100) / $counter[$value],
            'no_cache_others' => ($no_cache_others_count[$value] * 100) / $counter[$value],
            'no_store_others' => ($no_store_others_count[$value] * 100) / $counter[$value],
            'isp' => $value,
            'contenttype' => 'Others',
        );
        array_push($json, $data);
    }
}
//error_log(print_r($json,TRUE));

header('Content-type: application/json');
echo json_encode($json);
