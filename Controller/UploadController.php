<?php
require_once('../Model/Database.php');
require_once('../Controller/Upload.php');
require_once('../Model/UploadModel.php');

// Example configuration
$config_upload = [
    'allowedMimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
    'allowedExtensions' => ['jpg', 'jpeg', 'png', 'webp'],
    'maxFileSize' => 104857600, // 100MB
    'maxImgWidth' => 3840,    // 4K width
    'maxImgHeight' => 2160,   // 4K height
];

$db = new Database();
$pdo = $db->connect();
$feedback = "";

// Process the file upload when the form is submitted
if (isset($_POST['go'])) {
    $altText = filter_input(INPUT_POST, 'normalo'); // Alt text for the image
    
    // Initialize Upload class with configuration
    $uploader = new Upload($config_upload);

    // Check for file upload errors
    if ($uploader->checkFileError()) {
        // Check if the file passes all validations (size, type, image dimensions)
        if ($uploader->checkFileInQuarantine()) {
            // Try to move the file to the target directory
            $fileName = $uploader->moveFile();
            if ($fileName) {
                
                // Initialize UploadModel for saving file data into the database
                $uploadModel = new UploadModel($pdo);
                if ($uploadModel->saveFilePath($filePath, $altText)) {
                    $feedback .= "File uploaded and path saved successfully!<br>";
                } else {
                    $feedback .= "Error: Unable to save file path to the database.<br>";
                }
            } else {
                $feedback .= "Error: Unable to move the file.<br>";
            }
        } else {
            $feedback .= "Error: File validation failed.<br>";
        }
    } else {
        $feedback .= "Error: File upload encountered an issue.<br>";
    }

    // Display any validation errors
    foreach ($uploader->getErrors() as $error) {
        $feedback .= $error . "<br>";
    }
}
?>
