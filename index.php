<?php
session_start();
$url_array = explode('?', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$url = $url_array[0];

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId('1002091321411-lle8r296e7811q4m63eg2m7fm4rua27j.apps.googleusercontent.com');
$client->setClientSecret('FzCyy3_tmtJZfIAKsEoIRd3H');
$client->setRedirectUri($url);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
if (isset($_GET['code'])) {
    $data = $client->authenticate($_GET['code']);
    print_r($data);
    $file = fopen('token.json', 'w');
    fwrite($file, json_encode($data));
    fclose($file);
    header('location:' . $url);
    exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate();
}
$files = array();
$dir = dir('files');
while ($file = $dir->read()) {
    if ($file != '.' && $file != '..') {
        $files[] = $file;
    }
}
$dir->close();
#if (!empty($_POST)) {
$client->setAccessToken($_SESSION['accessToken']);
$service = new Google_DriveService($client);
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$file = new Google_DriveFile();
foreach ($files as $file_name) {
    $file_path = 'files/' . $file_name;
    $mime_type = finfo_file($finfo, $file_path);
    $file->setTitle($file_name);
    $file->setDescription('This is a ' . $mime_type . ' document');
    $file->setMimeType($mime_type);
    // $file->setShared(1);
    $parent = new Google_ParentReference();
    //$parent->setId($parentId);
    //$file->setParents(array($parent));
    // $file->setParents(array('1FWZYjynhELamqBV8MseyA1htYDRWiMNZ'));
    $obj = $service->files->insert(
        $file,
        array(
            'data' => file_get_contents($file_path),
            'mimeType' => $mime_type
        )
    );
    print_r($obj);
    unlink($file_path);
    $testFile = $service->files->get("1O_gIFbOhJj_PrJMU7aIdZNbeoCMGHxkJ");
    // print_r($testFile);
}

finfo_close($finfo);
    // header('location:'.$url);exit;
    // echo "test";
#}

