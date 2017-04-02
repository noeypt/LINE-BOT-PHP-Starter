<?php
$access_token = '4CXVlGNEsy06zKg2fuMieG/fQAHgHTX5HGG8cKMYc/EqvS4apN11fMSolMduMo5mr9IL3MucFSfYF7PNFSCmZfExOQV7UVh4wo3JAbbxERnuYcxqZjm05leotT9pYhlq9zUsRCbodePaVB5XxwaX4QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
