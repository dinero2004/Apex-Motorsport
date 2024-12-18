<?php

class UploadModel {
    private $pdo;

    // Inject the database connection into the model
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Save file path and alt text in the database
    public function saveFilePath($path, $altText) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO uploads (Path, Alt) VALUES (:path, :alt)");
            $stmt->execute([
                ':path' => $path,
                ':alt' => $altText
            ]);
            return true;
        } catch (PDOException $e) {
            return "Database error: " . $e->getMessage();
        }
    }
}
?>
