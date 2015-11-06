<?php
//
// customize this file as you need
//
use \DQNEO\S3Signer\Signer;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/SecretConfig.php';


$cred = [
    'key' => SecretConfig::$config['AWS_ACCESS_KEY_ID'],
    'secret' => SecretConfig::$config['AWS_SECRET_ACCESS_KEY']
    ];
$now = time();
//$now = 1234567890;

$expires= $now + (60 * 5); // 5 minutes later
$bucket = $_GET['bucket'];
$objectKey=$_GET['key'];
$mimeType=$_GET['type'];
$acl = $_GET['acl'];
$metas=[];

$json =  Signer::getSignedURL('PUT', $cred['key'], $cred['secret'], Signer::ENDPOINT_TOKYO, $bucket, $objectKey, $expires, $mimeType, $acl, $metas);
header("Content-typte: application/json");
echo $json;
