<?php 

class RawUpload {
    private $targetDir = "";
    public $errorsArr = [];
    private $allowedMimeTypes;
    private $allowedExtensions;
    private $maxFileSize;
    private $maxImgWidth;
    private $maxImgHeight;

    function __construct($config_upload, $path) {
        $this->allowedMimeTypes = $config_upload['allowedMimeTypes'];
        $this->allowedExtensions = $config_upload['allowedExtensions'];
        $this->maxFileSize = $config_upload['maxFileSize'];
        $this->maxImgWidth = $config_upload['maxImgWidth'];
        $this->maxImgHeight = $config_upload['maxImgHeight'];

        if (is_dir($path)) {
            $this->targetDir = $path;
        } else {
            exit("Target directory for upload does not exist");
        }
    }

	function ckeckFileError() {
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


	function checkFileInQuarantine() {
        $hasErrors = false;
 
        if ($_FILES['myFile']['size'] > $this->maxFileSize) {
            $this->errorsArr[] = "The file is too large";
            return false;
        }

        $extension = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $this->allowedExtensions)) {
            $this->errorsArr[] = "This file extension is not allowed";
            return false;
        }

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
            $this->errorsArr[] = "This file has an invalid mime type. only images allowed.";
            return false;
        }

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

	function moveFile() {
        if (is_uploaded_file($_FILES['myFile']['tmp_name'])) {
            $tmp_name = $_FILES["myFile"]["tmp_name"];
            $name = basename($_FILES["myFile"]["name"]);
            $timestamp = time();

            move_uploaded_file($tmp_name, $this->targetDir . "/" . $timestamp . "-" . $name);
            $this->errorsArr[] = "The file is now in the folder &quot;" . $this->targetDir . "&quot;.";
            return true;
        } else {
            $this->errorsArr[] = "Possible file upload attack!";
            return false;
        }
    }

	function savePath($path, $altText) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("INSERT INTO uploads (Path, Alt) VALUES (:path, :alt)");
            $stmt->execute([
                ':path' => $path,
                ':alt' => $altText,
            ]);
        } catch (PDOException $e) {
            $this->errorsArr[] = "Database error: " . $e->getMessage();
        }
    }
}
