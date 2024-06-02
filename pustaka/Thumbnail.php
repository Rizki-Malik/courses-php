<?php

class Thumbnail {
    private static $targetDir;

    function __construct() {
        self::$targetDir = $_SERVER['DOCUMENT_ROOT']."./assets/img/";
    }

    public static function upload($file) {
        try {
            $targetFile = self::$targetDir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if (!self::isImage($file)) {
                throw new Exception("File is not an image.");
            }

            if (self::fileExists($targetFile)) {
                throw new Exception("Sorry, file already exists.");
            }

            if (self::isTooLarge($file)) {
                throw new Exception("Sorry, your file is too large.");
            }

            if (!self::isAllowedFormat($imageFileType)) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "The file " . basename($file["name"]) . " has been uploaded.";
            } else {
                throw new Exception("Sorry, there was an error uploading your file.");
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function update($file, $currentImg) {
        try {
            $targetFile = self::$targetDir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if (!self::isImage($file)) {
                throw new Exception("File is not an image.");
            }

            if (self::fileExists($targetFile)) {
                throw new Exception("Sorry, file already exists.");
            }

            if (self::isTooLarge($file)) {
                throw new Exception("Sorry, your file is too large.");
            }

            if (!self::isAllowedFormat($imageFileType)) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Remove the current photo
            if (file_exists(self::$targetDir . $currentImg)) {
                if (!unlink(self::$targetDir . $currentImg)) {
                    throw new Exception("Sorry, there was an error deleting the current Image.");
                }
            }

            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "The file " . basename($file["name"]) . " has been uploaded.";
            } else {
                throw new Exception("Sorry, there was an error uploading your file.");
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function delete($fileName) {
        $filePath = self::$targetDir . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    private static function isImage($file) {
        $check = getimagesize($file["tmp_name"]);
        return $check !== false;
    }

    private static function fileExists($file) {
        return file_exists($file);
    }

    private static function isTooLarge($file) {
        return $file["size"] > 50000000;
    }

    private static function isAllowedFormat($format) {
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        return in_array($format, $allowedFormats);
    }
}