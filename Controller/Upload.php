<?php

class Upload {
    private $targetDir;
    private $errorsArr = [];
    private $allowedMimeTypes;
    private $allowedExtensions;
    private $maxFileSize;
    private $maxImgWidth;
    private $maxImgHeight;

    function __construct($config_upload) {
        // Fixed upload directory (uploads)
        $this->targetDir = '..assets/uploads'; // You can change this path if needed

        $this->allowedMimeTypes = $config_upload['allowedMimeTypes'];
        $this->allowedExtensions = $config_upload['allowedExtensions'];
        $this->maxFileSize = $config_upload['maxFileSize'];
        $this->maxImgWidth = $config_upload['maxImgWidth'];
        $this->maxImgHeight = $config_upload['maxImgHeight'];

        // Check if the target directory exists, if not, stop the script
        if (!is_dir($this->targetDir)) {
            exit("Target directory for upload does not exist");
        }
    }

    // Check for errors during file upload
    public function checkFileError() {
        $errorNo = $_FILES['myFile']['error'];

        switch ($errorNo) {
            case 0:
                $this->errorsArr[] = "The file is in the TMP directory.";
                break;
            case 1:
            case 2:
                $this->errorsArr[] = "The uploaded file is too large.";
                break;
            case 3:
                $this->errorsArr[] = "The file was only partially uploaded, check your internet connection.";
                break;
            case 4:
                $this->errorsArr[] = "Please select a file before submitting the form.";
                break;
            case 6:
            case 7:
            case 8:
                $this->errorsArr[] = "Could not upload the file, please contact the website administrator.";
                break;
        }

        return $errorNo === 0;
    }

    // Validate file size, extension, mime type, and image dimensions
    public function checkFileInQuarantine() {
        $hasErrors = false;
 
        // Check file size
        if ($_FILES['myFile']['size'] > $this->maxFileSize) {
            $this->errorsArr[] = "The file is too large";
            return false;
        }

        // Check file extension
        $extension = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $this->allowedExtensions)) {
            $this->errorsArr[] = "This file extension is not allowed";
            return false;
        }

        // Check mime type (from browser and file itself)
        $mimeVomBrowser = $_FILES['myFile']['type'];
        if (!in_array($mimeVomBrowser, $this->allowedMimeTypes)) {
            $this->errorsArr[] = "The mime type is not allowed";
            return false;
        }

        $filepath = realpath($_FILES['myFile']['tmp_name']);
        $filepath = str_replace(" ", "\\ ", $filepath);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeVomFile = finfo_file($finfo, $filepath);
        finfo_close($finfo);

        if (!in_array($mimeVomFile, $this->allowedMimeTypes)) {
            $this->errorsArr[] = "This file has an invalid mime type. Only images are allowed.";
            return false;
        }

        // Check image dimensions
        $sizeArr = getimagesize($_FILES['myFile']['tmp_name']);
        $width = $sizeArr[0];
        $height = $sizeArr[1];

        if ($width > $this->maxImgWidth) {
            $this->errorsArr[] = "The image is too wide.";
            $hasErrors = true;
        }

        if ($height > $this->maxImgHeight) {
            $this->errorsArr[] = "The image is too tall.";
            $hasErrors = true;
        }

        return !$hasErrors;
    }

    // Move file to target directory
    public function moveFile() {
        if (is_uploaded_file($_FILES['myFile']['tmp_name'])) {
            $tmp_name = $_FILES["myFile"]["tmp_name"];
            $name = basename($_FILES["myFile"]["name"]);
            $timestamp = time();

            // Move the uploaded file to the 'uploads' folder with timestamp
            if (move_uploaded_file($tmp_name, $this->targetDir . "/" . $timestamp . "-" . $name)) {
                return $timestamp . "-" . $name;
            } else {
                $this->errorsArr[] = "Possible file upload attack!";
                return false;
            }
        }
        return false;
    }

    // Get the errors
    public function getErrors() {
        return $this->errorsArr;
    }
}

