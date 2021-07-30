<?php
$url = "http://127.0.0.1:84/upload/Upload.php";

$data = array(
    "name" => "chunk",
    "size" => 1233,
    "file" => "file.txt",
    "error" => "409",
    "mime" => "text/pdf",
    "path" => "storage/public/upload",
    "hash" => "ahsjadbjabjasdnasf"
);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch , CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
$output  = curl_exec($ch);

if($output === false){
    echo "Curl Error" . curl_error($ch);
}


curl_close($ch);

print_r($output);
