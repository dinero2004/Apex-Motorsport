<?php
require_once('../config/request.php');
require_once('../class/rawUpload.class.php');

// Example configuration
$config_upload = [
    'allowedMimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
    'allowedExtensions' => ['jpg', 'jpeg', 'png', 'webp'],
    'maxFileSize' => 104857600, // 10MB
    'maxImgWidth' => 3840,    // 4K width
    'maxImgHeight' => 2160,   // 4K height

];

$db = new Database();
$pdo = $db->connect();

$feedback = "";

// feedback error improve here 

if (isset($_POST['go'])) {
    $targetDir = filter_input(INPUT_POST, 'chooser');
    $altText = filter_input(INPUT_POST, 'normalo');
    $uploader = new RawUpload($config_upload, $targetDir);

    if ($uploader->ckeckFileError()) {
        if ($uploader->checkFileInQuarantine()) {
            if ($uploader->moveFile()) {
                $fileName = $_FILES["myFile"]["name"];
                $timestamp = time();
                $filePath = $targetDir . "/" . $timestamp . "-" . basename($fileName);

                $uploader->savePath($filePath, $altText);
                $feedback .= "File uploaded and path saved successfully!<br>"; //html should not be 
            } else {
                $feedback .= "Error: Unable to move the file.<br>";
            }
        } else {
            $feedback .= "Error: File validation failed.<br>";
        }
    } else {
        $feedback .= "Error: File upload encountered an issue.<br>";
    }

    foreach ($uploader->errorsArr as $error) {
        $feedback .= $error . "<br>";
    }
}
 